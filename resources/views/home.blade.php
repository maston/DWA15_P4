@extends('layouts.master')


@section('nav')
    @include('layouts.nav', [$nav_gameboard = '', $nav_grocery_run = '', $nav_metrics = '', $nav_settings = '', $nav_register = '', $nav_login = ''])
@stop


@section('content')

<div class="col-md-3 carton-reverse-img"></div>
<div class="col-md-9 home-copy">
    <div>
        <h2>How much money...</h2> 
        <h3>Do you spend on food a month? A week? A day?</h3>
        <p>
The Lunch Money Game
How much money...
Do you spend on food a month? A week? A day?</p>

<a href="#">LEARN MORE</a>
<h3>Who is this for?</h3>
<h4>LMG is for anyone who wants a helping hand to save money and get on a healthier eating path.</h4>

<p>We will help you get started and make it easier for you to do the things you know are better for your wallet and your waistline in just a few easy steps.</p>
<img src="img/peeps.png">
<a href="#">Meet John &amp; Jane</a>
<p>These aren't their real names.</p>

    </div>

</div>
@stop