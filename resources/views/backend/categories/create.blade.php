@extends('layouts.backend.main')

@section('title','MyBlog | Kategori Ekle')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Kategoriler
                <small> Kategori Ekle</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}"><i class="fa fa-dashboard"> Dashboard </i></a>
                </li>
                <li><a href="{{ route('categories.index') }}">Kategoriler</a></li>
                <li class="active">Kategori Ekle</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                {!! Form::model($category,[
                            'method' => 'POST',
                            'route' => 'categories.store',
                            'files' => true,
                            'id' => 'category-form'
                            ]) !!}

                @include("backend.categories.form")

                {!! Form::close() !!}
            </div>
        </section>
    </div>
@endsection

@include('backend.categories.script')