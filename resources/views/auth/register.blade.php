@extends('layouts.master')

@section('nav')
    @include('layouts.nav', [$nav_gameboard = '', $nav_grocery_run = '', $nav_metrics = '', $nav_settings = '', $nav_register = 'active', $nav_login = ''])
@stop

@section('content')


    <img src="img/logo-sm.png" class="login-logo">

    <div class='panel login-form'>
     <div class="panel-heading login-heading">Register</div>
    @if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">Please review registration errors:
        <ul class='errors'>
            @foreach ($errors->all() as $error)
                <li><span class='fa fa-exclamation-circle'></span> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method='POST' action='/register'>
        {!! csrf_field() !!}
        <div class="login-form-inputs">
        <div class='form-group'>
            <input placeholder='Name' name='name' class='form-control' type='text' value='{{ old('name') }}'>
        </div>

        <div class='form-group'>
            <input placeholder='Email' name='email' class='form-control' type='email' value='{{ old('email') }}'>
        </div>

        <div class='form-group'>
            <input placeholder='Password' name='password' class='form-control' type='password' value='{{ old('password') }}'>
        </div>

        <div class='form-group'>
            <input placeholder='Confirm Password' name='password_confirmation' class='form-control' type='password' value='{{ old('password_confirmation') }}'>
        </div>

            <button type='submit' class='btn btn-primary register-submit'>Register</button>
        </div>
    </form>
    <div class="panel-footer login-panel-footer">Already have an account? <a href='/login'>Login here...</a></div>
    </div>

@stop