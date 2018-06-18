@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if(! $posts->count())
                    <div class="alert alert-warning">
                        <p>Kayıt Bulunamadı!</p>
                    </div>
                @else
                    @if(isset($categoryName))
                        <div class="alert alert-info">
                            <p>Kategori:<strong> {{ $categoryName }}</strong></p>
                        </div>
                    @endif
                    @if(isset($authorName))
                        <div class="alert alert-info">
                            <p>Yazar:<strong> {{ $authorName }}</strong></p>
                        </div>
                    @endif
                    @foreach($posts as $post)
                        <article class="post-item">
                            @if ($post->image_url)
                                <div class="post-item-image">
                                    <a href="{{ '/blog/'. $post->slug }}">
                                        <img src="{{ $post->image_url }}" alt="">
                                    </a>
                                </div>
                            @endif
                            <div class="post-item-body">
                                <div class="padding-10">
                                    <h2><a href="{{ '/blog/'. $post->slug }}">{{ $post->title }}</a></h2>
                                    <p>{!! $post->excerpt_html !!}</p>
                                </div>

                                <div class="post-meta padding-10 clearfix">
                                    <div class="pull-left">
                                        <ul class="post-meta-group">
                                            <li><i class="fa fa-user"></i><a
                                                        href="{{ route('author',$post->author->slug) }}"> {{ $post->author->name }}</a>
                                            </li>
                                            <li><i class="fa fa-clock-o"></i>
                                                <time> {{ $post->date }}</time>
                                            </li>
                                            <li><i class="fa fa-folder"></i><a
                                                        href="{{ '/blog/'. $post->slug }}">  {{ $post->category->title }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ '/blog/'. $post->slug }}">Okumaya Devam Et &raquo;</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                @endif
                <nav>
                    {{ $posts->links() }}
                </nav>
            </div>
            @include('layouts.sidebar')
        </div>
    </div>
@endsection
