@extends('layouts.backend.main')

@section('title','MyBlog | Blog Ekle')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blog
                <small> Blog Ekle</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}"><i class="fa fa-dashboard"> Dashboard </i></a>
                </li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                <li class="active">Blog Ekle</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                {!! Form::model($post,[
                            'method' => 'POST',
                            'route' => 'blog.store',
                            'files' => true,
                            'id' => 'post-form'
                            ]) !!}

                @include("backend.blog.form")

                {!! Form::close() !!}
            </div>
        </section>
    </div>
@endsection

@include('backend.blog.script')