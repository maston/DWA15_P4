@extends('layouts.master')


@section('nav')
    @include('partials.nav', [$nav_gameboard = '', $nav_grocery_run = '', $nav_metrics = '', $nav_instructions = 'active', $nav_settings = '', $nav_register = '', $nav_login = ''])
@stop


@section('content')

<div class="col-md-3 carton-reverse-img"></div>
<div class="col-md-9 home-copy">
    <div>
        <div class="instruction-intro">
        	<h2>Welcome to LunchMoneyGame</h2>
            <h3>Introduction</h3> 
            <p>The purpose of this game is to teach you to cook at home again.</p>
            <br>
            "When I cook at home I don't spend $20."  This was my mantra as I started to play.</p>
            <p>Conceptually, here is how this works.  You will go grocery shopping.  (I know that's daunting if you haven't 
            made a list or been inside a store... the coaching section is coming soon!)
            <br>
            Once you go grocery shopping you will record the amount you spent on food.
            <br>
            Then we do some math on what you saved by cooking at home.
            <br>
            That's it.
            </p>
            <h4>How do you know what I'm saving?</h4>
            <p>Your "average meal spend" <a href="/settings">settings.</a> You will enter the amount you usually spend ording food or coffee.</p>  
            <h4>How do you calcuate my savings?</h4>
            <p>Math.  We take the count of your meals and mulitply the amount you usually spend. If it's not obvious, email me.
            <br>
            Don't over think it.</p>
        </div>
        <div class="instructions-buttons">
        <h3>Choose your own adventure: </h3>
            <a href="/settings">
                <input type="button" value="Go to Settings" id="instructions-settings-button" class="btn btn-primary btn-sm instructions-settings-button">
            </a>
            <a href="/game-board">
                <input type="button" value="Go to Gameboard" id="instructions-gameboard-button" class="btn btn-primary btn-sm instructions-gameboard-button">
            </a>
        </div>
    </div>

</div>
@stop





