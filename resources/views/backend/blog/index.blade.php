@extends('layouts.backend.main')

@section('title','MyBlog | Blog')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blog
                <small> Tüm Makaleler</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}"><i class="fa fa-dashboard"> Dashboard </i></a>
                </li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                <li class="active">Tüm Kayıtlar</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header clearfix">
                            <div class="pull-left">
                                <a href="{{ route('blog.create') }}" class="btn btn-success">Yeni Ekle</a>
                            </div>
                            <div class="pull-right" style="padding: 7px 0;">
                                <a href="?status=all">Tümü</a>|
                                <a href="?status=published">Yayınlananlar</a>|
                                <a href="?status=scheduled">Zamanlananlar</a>|
                                <a href="?status=draft">Taslaklar</a>|
                                <a href="?status=trash">Silinenler</a>
                            </div>
                        </div>
                        <div class="box-body ">
                            @include('backend.partials.message')
                            @if(! $posts->count())
                                <div class="alert alert-danger">
                                    <strong>Kayıt Bulunamadı!</strong>
                                </div>
                            @endif

                            @if($onlyTrashed)
                                @include('backend.blog.table-trash')
                            @else
                                @include('backend.blog.table')
                            @endif
                        </div>
                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                {{ $posts->appends( Request::query() )->render() }}
                            </div>
                            <div class="pull-right">
                                <small>{{ $postCount }} kayıt bulundu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
      $('ul.pagination').addClass('no-margin pagination-sm')
    </script>
@endsection