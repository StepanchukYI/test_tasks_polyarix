@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {!! Form::open(['route'=> ['user.edit'], 'enctype' => 'multipart/form-data']) !!}

                @if(isset($success))
                    <span>
                                        <strong>Пользователь обновлен!</strong>
                    </span>
                @endif
                <div class="form-group">
                    {!! Form::label('Name') !!}
                    {!! Form::text('name', $user->name, ['class'=>'form_control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Last name') !!}
                    {!! Form::text('last_name', $user->last_name, ['class'=>'form_control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Email') !!}
                    {!! Form::email('email', $user->email, ['class'=>'form_control']) !!}
                </div>

                <div class="form-group">
                    Old Avatar:
                    <br>
                    <img src="{{$user->image }}">
                    <br>
                    {!! Form::label('Image link') !!}
                    {!! Form::text('image',$user->image, ['class'=>'form_control']) !!}
                </div>
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
                <div class="form-group">
                    {!! Form::label('Password') !!}
                    {!! Form::password('password', null, ['class'=>'form_control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Password Conformation') !!}
                    {!! Form::password('password_confirmation', null, ['class'=>'form_control']) !!}
                </div>
                {!! Form::hidden('_token', csrf_token()) !!}

                <div class="form-group">
                    {!! Form::submit('Update',['class'=>'form_control']) !!}
                </div>
                {!! Form::close() !!}


            </div>
        </div>
    </div>
</div>
@endsection
