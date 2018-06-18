<div class="col-xs-8">
    <div class="box">
        <div class="box-body ">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                {!! Form::label('title', 'Başlık') !!}
                {!! Form::text('title',null,['class' => 'form-control']) !!}

                @if($errors->has('title'))
                    <span class="help-block"> {{ $errors->first('title') }} </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                {!! Form::label('slug', 'URL') !!}
                {!! Form::text('slug',null,['class' => 'form-control']) !!}

                @if($errors->has('slug'))
                    <span class="help-block"> {{ $errors->first('slug') }} </span>
                @endif
            </div>

            <div class="form-group excerpt">
                {!! Form::label('excerpt', 'Ön Yazı') !!}
                {!! Form::textarea('excerpt',null,['class' => 'form-control']) !!}

                @if($errors->has('excerpt'))
                    <span class="help-block"> {{ $errors->first('excerpt') }} </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                {!! Form::label('body', 'İçerik') !!}
                {!! Form::textarea('body',null,['class' => 'form-control']) !!}

                @if($errors->has('body'))
                    <span class="help-block"> {{ $errors->first('body') }} </span>
                @endif
            </div>
            <hr>
        </div>
    </div>
</div>

<div class="col-xs-4">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Yayınlama Tarihi</h3>
        </div>

        <div class="box-body">
            <div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }}">
                {!! Form::text('published_at',null,['class' => 'form-control', 'placeholder' => 'Y-m-d H:i:s']) !!}

                @if($errors->has('published_at'))
                    <span class="help-block"> {{ $errors->first('published_at') }} </span>
                @endif
            </div>
        </div>
        <div class="box-footer clearfix">
            <div class="pull-left">
                <a id="draft-btn" class="btn btn-default">Taslak Olarak Kaydet</a>
            </div>
            <div class="pull-right">
                {!! Form::submit('Yayınla', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>

    <div class="box with-border">
        <div class="box-header">
            <h3 class="box-title">Kategori</h3>
        </div>
        <div class="box-body">
            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                {!! Form::select('category_id',App\Category::pluck('title','id'),null,['class' => 'form-control', 'placeholder' => 'Kategori Seçiniz']) !!}
                @if($errors->has('category_id'))
                    <span class="help-block"> {{ $errors->first('category_id') }} </span>
                @endif
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Thumbnail</h3>
        </div>
        <div class="box-body text-center">
            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="{{ @$post->image_thumb_url ?: 'http://placehold.it/200x150&text=Resim+Yok' }}" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"
                            style="max-width: 200px; max-height: 150px;"></div>
                    <div>
                        <span class="btn btn-default btn-file"><span
                                    class="fileinput-new">Resim Seç</span><span
                                    class="fileinput-exists">Değiştir</span>{!! Form::file('image') !!}</span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Sil</a>
                    </div>
                </div>
                @if($errors->has('image'))
                    <span class="help-block">{{ $errors->first('image') }}</span>
                @endif
            </div>
        </div>
    </div>
</div>