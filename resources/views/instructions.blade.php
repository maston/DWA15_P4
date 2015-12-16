@extends('layouts.master')


@section('nav')
    @include('partials.nav', [$nav_gameboard = '', $nav_grocery_run = '', $nav_metrics = '', $nav_instructions = 'active', $nav_settings = '', $nav_register = '', $nav_login = ''])
@stop


@section('content')

<div class="col-md-2 carton-reverse-img"></div>
<div class="col-md-10 home-copy">
        <h2>Welcome to LunchMoneyGame!</h2>
        <div class="instruction-intro">  

            <div class="instructions-buttons">
                <input type="button" value="Go to Settings" id="instructions-settings-button" class="btn btn-primary btn-sm instructions-settings-button" onclick="window.location='/my/settings';">
                <br>
                <input type="button" value="Go to Gameboard" id="instructions-gameboard-button" class="btn btn-primary btn-sm instructions-gameboard-button" onclick="window.location='/game-board';">

            </div>      	
            <h3>Introduction</h3> 
            <p>LunchMoneyGame is a tool and process that teaches how to reverse the behaviors around spending money on restaurant food.  Using the relationship with money to influence the relationship with food choices, it is a simple system of self-reward that can reverse downward trends in one’s health.</p>
            <h4>How it works</h4>
            <p>“When I cook at home, I don’t spend $20.”  Learning to cook a meal at home puts the money you didn’t spend on take-out or a restaurant back in your pocket.  Every cup of coffee you brew at work or home is $2 you didn’t spend at a coffee shop.  This adds up.  LunchMoneyGame is a tool that collects your points as you perform the behavior of home cooking and counts those actions against a weekly Grocery Run.</p>
            <h4>Example of Cooking One Meal</h4>
            <p>Our user will be cooking a simple meal of “Sausage Pasta” which is a jar of sauce, a pasta, a chicken sausage grilled, and a frozen veggie.</p>
            <ul class="intro-lmg-example">
                <li>Grocery Run on a Sunday for ingredients = $20</li>
                <li>Dinner on that Sunday for 2 people = 2 LMG dinner points</li>
                <li>Leftovers taken to lunch Monday for 2 people = 2 LMG lunch points</li>
                <li>Coffee brewed on Monday morning and taken in travel mugs = 2 LMG coffee points</li>
            </ul>
            <p>The "average spend" settings for this user are:</p>
            <ul class="intro-lmg-example">
                <li>Dinner = $20</li>
                <li>Lunch = $10</li>
                <li>Coffee = $2.50</li>
            </ul>
            <h4>The Results for Run</h4>
            <p>Dinner (2 * $20) + Lunch (2 * $10) + Coffee (2 * $2.50) = $65 not spent on restaurant food.</p>
            <p>If our user repeats this process for a month the total is $260.<br>
               If our user learns to cook more meals… this number starts to go up. <br>
               LunchMoneyGame keeps track.</p>
            <h3>FAQ</h3>
            <h4>How do you know what I'm saving?</h4>
            <p>Your "average meal spend" <a href="/settings">settings.</a> You will enter the amount you usually spend ording food or coffee.</p>  
            <h4>How do you calcuate my savings?</h4>
            <p>Math.  We take the count of your meals and mulitply the amount you usually spend. If it's not obvious, email me.
            <br>
            Don't over think it.</p>
        </div>

</div>
@stop





