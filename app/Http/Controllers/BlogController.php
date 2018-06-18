<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Category;

class BlogController extends Controller
{
  protected $limit = 3;
  
  public function index()
  {
    $posts = Post::with('author')
      ->latestFirst()
      ->published()
      ->simplePaginate($this->limit);
    
    return view("blog.index", compact('posts', 'categories'));
  }
  
  public function category(Category $category)
  {
    $categoryName = $category->title;
    
    $posts = $category->posts()->with('author')->latestFirst()->published()->paginate($this->limit);
    
    return view("blog.index", compact('posts', 'categories', 'categoryName'));
    
  }
  
  public function author(User $author)
  {
    $authorName = $author->name;
    
    $posts = $author->posts()->with('category')->latestFirst()->published()->paginate($this->limit);
    
    return view("blog.index", compact('posts', 'categories', 'authorName'));
  }
  
  public function show($slug)
  {
    $post = Post::with('author')->where('slug', $slug)->published()->first();
    if ($post){
      $post->increment('view_count', 1);
      return view("blog.show", compact('post', 'categories'));
    }else {
      return view("errors.404");
    }
    
  }
}
