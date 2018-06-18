<?php

namespace App\Views\Composers;

use App\Category;
use App\Post;
use Illuminate\View\View;

class NavigationComposer
{
  public function compose(View $view)
  {
    $this->composeCategories($view);
    $this->composePopularPosts($view);
  }
  
  private function composeCategories(View $view)
  {
    $categories = Category::with(['posts' => function ($query) {
      $query->published();
    }])->orderBy('title', 'asc')->get();
    $view->with('categories', $categories);
  }
  
  private function composePopularPosts($view)
  {
    $popularPosts = Post::published()->popular()->take(3)->get();
    $view->with('popularPosts', $popularPosts);
  }
}