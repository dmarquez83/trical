@extends('layouts.login')
@section('content')
<!-- BEGIN LOGIN FORM -->
{!! Form::open(['route' => 'auth/login', 'class' => 'login-form']) !!}
    <h3 class="form-title">{{ trans('home.header.session') }}</h3>
     @include('modules.admin.users.partials.messager_login')
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">trans('form.label.company_id')</label>
        <div class="input-icon">
            <i class="fa fa-briefcase"></i>
            <!--{!! Form::text('company_id', '', ['class'=> 'form-control placeholder-no-fix','placeholder' => trans('form.label.company_id'), 'autocomplete' => 'off']) !!}-->
                {!! Form::select('company_id', $companies, null, ['class' => 'form-control placeholder-no-fix']) !!}
        </div>
    </div>     
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">trans('form.label.username')</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>
            {!! Form::text('username', '', ['class'=> 'form-control placeholder-no-fix','placeholder' => trans('form.label.username'), 'autocomplete' => 'off']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            {!! Form::password('password', ['class'=> 'form-control placeholder-no-fix','placeholder' => trans('form.label.password'), 'autocomplete' => 'off']) !!}
        </div>
    </div>
    <div class="form-actions">
        <label class="checkbox">
            <input type="checkbox" name="remember" value="1" /> {{ trans('form.label.remember') }} </label>
            {!! Form::submit(trans('form.login.submit'),['class' => 'btn green pull-right']) !!}
    </div>

  <!--  <div class="forget-password">
        <h4> {{ trans('passwords.forgot') }}</h4>
        <p> no se preocupe, haga clic
            <a href="javascript:;" id="forget-password"> aquí </a>   para restablecer su contraseña. </p>
    </div>-->

{!! Form::close() !!}
<!-- END LOGIN FORM -->
<!-- BEGIN FORGOT PASSWORD FORM -->
<!--{!! Form::open(['route' => 'password/postEmail', 'POST' , 'class' => 'forget-form' ]) !!}
    <h3>{{ trans('passwords.forgot') }}</h3>
    <p> {{ trans('passwords.enter_email') }}  </p>
    <div class="form-group">
        <div class="input-icon">
            <i class="fa fa-envelope"></i>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
    </div>
    <div class="form-actions">
        <button type="button" id="back-btn" class="btn red btn-outline">{{ trans('pagination.back') }} </button>
        <button type="submit" class="btn green pull-right"> {{ trans('form.login.submit')  }} </button>
    </div>
{!! Form::close() !!}-->
<!-- END FORGOT PASSWORD FORM -->
@endsection
