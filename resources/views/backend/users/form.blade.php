<div class="col-xs-12">
    <div class="box">
        <div class="box-body ">

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name', 'Ad Soyad') !!}
                {!! Form::text('name',null,['class' => 'form-control']) !!}

                @if($errors->has('name'))
                    <span class="help-block"> {{ $errors->first('name') }} </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                {!! Form::label('slug', 'URL') !!}
                {!! Form::text('slug',null,['class' => 'form-control']) !!}

                @if($errors->has('slug'))
                    <span class="help-block"> {{ $errors->first('slug') }} </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('email', 'Email') !!}
                {!! Form::text('email',null,['class' => 'form-control']) !!}

                @if($errors->has('email'))
                    <span class="help-block"> {{ $errors->first('email') }} </span>
                @endif
            </div>


            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                {!! Form::label('password', 'Şifre') !!}
                {!! Form::password('password',['class' => 'form-control']) !!}

                @if($errors->has('password'))
                    <span class="help-block"> {{ $errors->first('password') }} </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                {!! Form::label('password_confirmation', 'Şifre Tekrarı') !!}
                {!! Form::password('password_confirmation',['class' => 'form-control']) !!}

                @if($errors->has('password_confirmation'))
                    <span class="help-block"> {{ $errors->first('password_confirmation') }} </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                {!! Form::label('role', 'Yetki') !!}
                @if($user->exists && ($user->id == config('cms.default_user_id')) || isset($hideRoleDropDown))
                    {!! Form::hidden('role',$user->roles->first()->id) !!}
                    <p class="form-control-static">{{ $user->roles->first()->display_name }}</p>
                @else
                    {!! Form::select('role',\App\Role::pluck('display_name','id'),$user->exists ? $user->roles->first()->id : null,['class' => 'form-control', 'placeholder' => 'Yetki Seçiniz']) !!}
                @endif

                @if($errors->has('role'))
                    <span class="help-block"> {{ $errors->first('role') }} </span>
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('bio', 'Biyografi') !!}
                {!! Form::textarea('bio',null,['rows' => 5,'class' => 'form-control']) !!}

                @if($errors->has('bio'))
                    <span class="help-block"> {{ $errors->first('bio') }} </span>
                @endif
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{ $user->exists ? 'Güncele' : 'Kaydet' }}</button>
            <a href="{{ route('users.index') }}" class="btn btn-default"> Vazgeç </a>
        </div>
    </div>
</div>

