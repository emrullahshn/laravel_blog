<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PostRequest;
use App\Post;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogController extends BackendController
{
  protected $uploadPath;
  
  public function __construct()
  {
    parent::__construct();
    $this->uploadPath = public_path('img');
  }
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $status = $request->get('status');
    if ($status && $status == 'trash') {
      $posts = Post::onlyTrashed()->with('category', 'author')->latest()->paginate($this->limit);
      $postCount = Post::onlyTrashed()->count();
      $onlyTrashed = true;
    } elseif ($status && $status == 'published') {
      $posts = Post::published()->with('category', 'author')->latest()->paginate($this->limit);
      $postCount = Post::published()->count();
      $onlyTrashed = false;
    } elseif ($status && $status == 'scheduled') {
      $posts = Post::scheduled()->with('category', 'author')->latest()->paginate($this->limit);
      $postCount = Post::scheduled()->count();
      $onlyTrashed = false;
    } elseif ($status && $status == 'draft') {
      $posts = Post::draft()->with('category', 'author')->latest()->paginate($this->limit);
      $postCount = Post::draft()->count();
      $onlyTrashed = false;
    } else {
      $posts = Post::with('category', 'author')->latest()->paginate($this->limit);
      $postCount = Post::count();
      $onlyTrashed = false;
    }
    
    return view("backend.blog.index", compact('posts', 'postCount', 'onlyTrashed'));
  }
  
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Post $post)
  {
    return view('backend.blog.create', compact('post'));
  }
  
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(PostRequest $request)
  {
    $data = $this->handleRequest($request);
    
    $request->user()->posts()->create($data);
    
    return redirect(route('blog.index'))->with('message', 'Makale başarılı bir şekilde oluşturuldu.');
  }
  
  private function handleRequest($request)
  {
    $data = $request->all();
    
    if ($request->hasFile('image')) {
      $image = $request->file('image');
      $fileName = $image->getClientOriginalName();
      $destination = $this->uploadPath;
      
      $successUploaded = $image->move($destination, $fileName);
      
      if ($successUploaded) {
        $extension = $image->getClientOriginalExtension();
        $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
        
        Image::make($destination.'/'.$fileName)
          ->resize(250, 170)
          ->save($destination.'/'.$thumbnail);
      }
      
      $data['image'] = $fileName;
    }
    
    return $data;
  }
  
  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }
  
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $post = Post::findOrFail($id);
    
    return view("backend.blog.edit", compact('post'));
  }
  
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function update(PostRequest $request, $id)
  {
    $post = Post::findOrFail($id);
    $oldImage = $post->image;
    $data = $this->handleRequest($request);
    $post->update($data);
    
    if (file_exists($oldImage)) {
      if ($oldImage !== $post->image) {
        $this->removeImage($oldImage);
      }
    }
    
    return redirect(route('blog.index'))->with('message', 'Makale başarılı bir şekilde güncellendi.');
    
  }
  
  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Post::findOrFail($id)->delete();
    
    return redirect(route('blog.index'))->with('trash-message', ['Makale başarılı bir şekilde silindi.', $id]);
    
  }
  
  public function restore($id)
  {
    $post = Post::withTrashed()->findOrFail($id);
    $post->restore();
    
    return redirect(route('blog.index'))->with('message', 'Makale başarılı bir şekilde geri alındı.');
    
  }
  
  public function forceDestroy($id)
  {
    $post = Post::withTrashed()->findOrFail($id);
    $post->forceDelete();
    
    $this->removeImage($post->image);
    
    return redirect('/backend/blog?status=trash')->with('message', 'Makale kalıcı olarak silindi');
  }
  
  private function removeImage($image)
  {
    if (!empty($image)) {
      $imagePath = $this->uploadPath.'/'.$image;
      $ext = substr(strrchr($image, '.'), 1);
      $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $image);
      $thumbnailPath = $this->uploadPath.'/'.$thumbnail;
      
      if (file_exists($imagePath))
        unlink($imagePath);
      if ($thumbnailPath)
        unlink($thumbnailPath);
    }
  }
}
