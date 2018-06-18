<?php

namespace App;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
  use SoftDeletes;
  protected $fillable = ['title', 'slug', 'excerpt', 'body', 'published_at', 'category_id','image'];
  protected $dates = ['published_at'];
  
  public function author()
  {
    return $this->belongsTo(User::class);
  }
  
  public function category()
  {
    return $this->belongsTo(Category::class);
  }
  
  public function getImageUrlAttribute($value)
  {
    $imageUrl = "";
    
    if (!is_null($this->image)) {
      $imagePath = public_path()."/img/".$this->image;
      if (file_exists($imagePath)) $imageUrl = asset("img/".$this->image);
    }
    
    return $imageUrl;
  }
  
  public function getImageThumbUrlAttribute($value)
  {
    $imageUrl = "";
    
    if (!is_null($this->image)) {
      $ext = substr(strchr($this->image, '.'), 1);
      $thumbnail = str_replace(".{ext}", "_thumb.{ext}", $this->image);
      $imagePath = public_path()."/img/".$thumbnail;
      if (file_exists($imagePath)) $imageUrl = asset("img/".$thumbnail);
    }
    
    return $imageUrl;
  }
  
  public function getDateAttribute($value)
  {
    Carbon::setLocale('tr');
    
    return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
  }
  
  public function getContentAttribute()
  {
    return $this->body ? Markdown::convertToHtml(e($this->body)) : null;
  }
  
  public function getExcerptHtmlAttribute()
  {
    return $this->excerpt ? Markdown::convertToHtml(e($this->excerpt)) : null;
  }
  
  
  public function scopeLatestFirst($query)
  {
    return $query->orderBy('created_at', 'desc');
  }
  
  public function scopePopular($query)
  {
    return $query->orderBy('view_count', 'desc');
  }
  
  public function scopePublished($query)
  {
    return $query->where("published_at", "<=", Carbon::now());
  }
  
  public function scopeScheduled($query)
  {
    return $query->where("published_at", ">", Carbon::now());
  }
  
  public function scopeDraft($query)
  {
    return $query->whereNull("published_at");
  }
  
  public function dateFormatted($showTime = false)
  {
    $format = "d/m/Y";
    if ($showTime) $format = $format." H:i:s";
    
    return $this->created_at->format($format);
  }
  
  public function publicationLabel()
  {
    if (!$this->published_at)
      return '<span class="label label-warning">Tasklak</span>';
    else if ($this->published_at && $this->published_at->isFuture())
      return '<span class="label label-info">Zamanlandı</span>';
    else
      return '<span class="label label-success">Yayınlandı</span>';
    
  }
  
  public function setPublishedAtAttribute($value)
  {
    $this->attributes['published_at'] = $value ?: null;
  }
}
