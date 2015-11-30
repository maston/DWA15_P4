@extends('layouts.master')


@section('nav')
    @include('layouts.nav', [$nav_gameboard = '', $nav_grocery_run = '', $nav_metrics = '', $nav_settings = '', $nav_register = '', $nav_login = 'active'])
@stop


@section('content')


    <img src="img/logo-sm.png" class="login-logo">

    <div class='panel login-form'>
     <div class="panel-heading login-heading">Login</div>
    @if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">Please review login errors:
        <ul class='errors'>
            @foreach ($errors->all() as $error)
                <li><span class='fa fa-exclamation-circle'></span> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method='POST' action='/login'>

        {!! csrf_field() !!}
    <div class="login-form-inputs">
        <div class='form-group'>
            <input placeholder='Email' name='email' class='form-control' type='email' value='{{ old('email') }}'>
            <!-- <label for='email'>Email</label>
            <input type='text' name='email' id='email' value='{{ old('email') }}'> -->
        </div>

        <div class='form-group'>
            <input placeholder='Password' name='password' class='form-control' type='password' value='{{ old('password') }}'>
            <!-- <label for='password'>Password</label>
            <input type='password' name='password' id='password' value='{{ old('password') }}'> -->
        </div>

        <div class='form-group'>
            <input type='checkbox' name='remember' id='remember'>
            <label for='remember' class='checkboxLabel'>Remember me</label>
            <button type='submit' class='btn btn-primary login-submit'>Login</button>
        </div>

        
    </div>
    </form>
    <div class="panel-footer login-panel-footer">Don't have an account? <a href='/register'>Register here...</a></div>
    </div>
@stop