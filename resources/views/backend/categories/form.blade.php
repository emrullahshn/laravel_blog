<div class="col-xs-12">
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
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{ $category->exists ? 'Güncele' : 'Kaydet' }}</button>
            <a href="{{ route('categories.index') }}" class="btn btn-default"> Vazgeç </a>
        </div>
    </div>
</div>

