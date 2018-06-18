<?php

namespace App;

use GrahamCampbell\Markdown\Facades\Markdown;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use LaratrustUserTrait;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password','slug','bio'
  ];
  
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];
  
  public function posts()
  {
    return $this->hasMany(Post::class, 'author_id');
  }
  
  public function getRouteKeyName()
  {
    return 'slug';
  }
  
  public function getBioHtmlAttribute()
  {
    return $this->bio ? Markdown::convertToHtml(e($this->bio)) : null;
  }
  
  public function gravatar()
  {
    $email = $this->email;
    $default = "http://icons.iconarchive.com/icons/icons8/windows-8/128/Users-User-icon.png";
    $size = 100;
    
    return "https://www.gravatar.com/avatar/".md5(strtolower(trim($email)))."?d=".urlencode($default)."&s=".$size;
  }
  
  public function setPasswordAttribute($value)
  {
    if (!empty($value)) $this->attributes['password'] = bcrypt($value);
  }
}
