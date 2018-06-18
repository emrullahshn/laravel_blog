@extends('layouts.backend.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dasbhboard
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body ">
                            <h3>MyBlog'a hoş geldiniz!</h3>
                            <h4>Hadi Başla</h4>
                            <p><a href="{{ route('blog.create') }}" class="btn btn-primary">İlk Makaleni Yaz!</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
