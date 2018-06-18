<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\UserDestroyRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;

class UsersController extends BackendController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = User::orderBy('name')->paginate($this->limit);
    $usersCount = User::count();
    
    return view('backend.users.index', compact('users', 'usersCount'));
  }
  
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $user = new User();
    
    return view('backend.users.create', compact('user'));
  }
  
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(UserStoreRequest $request)
  {
    $user = User::create($request->all());
    $user->attachRole($request->role);
    
    return redirect('/backend/users')->with('message', 'Kullanıcı başarılı bir şekilde oluşturuldu.');
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
    $user = User::findOrFail($id);
    
    return view('backend.users.edit', compact('user'));
  }
  
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function update(UserUpdateRequest $request, $id)
  {
    $user = User::findOrFail($id);
    $user->update($request->all());
    
    $user->detachRoles();
    $user->attachRole($request->role);
  
    return redirect('/backend/users')->with('message', 'Kullanıcı başarılı bir şekilde güncellendi.');
  }
  
  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(UserDestroyRequest $request, $id)
  {
    $user = User::findOrFail($id);
    $deleteOption = $request->delete_option;
    $selectedUser = $request->selected_user;
    
    if ($deleteOption == "delete")
      $user->posts()->withTrashed()->forceDelete();
    elseif ($deleteOption == "attribute")
      $user->posts()->update(['author_id' => $selectedUser]);
    
    $user->delete();
    
    return redirect('/backend/users')->with('message', 'Kullanıcı başarılı bir şekilde silindi.');
  }
  
  public function confirm(UserDestroyRequest $request, $id)
  {
    $user = User::findOrFail($id);
    $users = User::where('id', '!=', $user->id)->pluck('name', 'id');
    
    return view('backend.users.confirm', compact('user', 'users'));
  }
}
