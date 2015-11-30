@extends('layouts.master')

@section('nav')
    @include('layouts.nav', [$nav_gameboard = '', $nav_grocery_run = '', $nav_metrics = '', $nav_settings = '', $nav_register = '', $nav_login = ''])
@stop

@section('content')
<!-- begin main content section -->
  <div class="registration-intro">
    <a class="btn btn-default registration-intro-button" href="/settings" role="button">Skip. </a>
    <h1>Welcome to LMG!</h1>
    <p>We are stoked to have you here.  LMG is a tool that helped our founder, Sarah, save thousands of dollars.<br>
    She just made something she found kinda dull, though necessary, into a game.<br>
    She won't do anything unless it's a game.</p>
	<h3>Here are the concepts you need to know:</h3>
    <div class="lmg-concepts">
    <h4><span class="concept-number">1.</span>Settings mean "Your Usual Spend On Meals"</h4>
    <p>So, when you order food and/or go out.  What do you usually spend?  This is what we are going to set up as how much
    you save when you "don't." <br>
    Easy peasy.<br>
    We shall set that up next.</p>

    <h4><span class="concept-number">2.</span>Grocery Runs == Unit of Measure</h4>
    <p>Grocery runs are a unit of measure you will count your small victories against.<br>
    <h5>Small victories are:
    <ul>
        <li>Brewing coffee at home or at work. It counts. You get a Coffee-Point.</li>
        <li>Cooking a dinner. Counts! Point to you.</li>
        <li>Bringing home cooked leftovers to work for lunch. Point.</li>
    </ul>
    </p>
    <h4><span class="concept-number">3.</span>Meal Counts?</h4>
    <p>All we are going to do here is count a meal when you cook something against your grocery run, bring in
    leftovers to work for lunch, make breakfast on saturday, or not buy coffee but brew it yourself.<br>
    <br>
    Too macro?  #trust</p>
    <h4><span class="concept-number">4.</span>But what if I still go out?</h4>
    <p>That's fine.<br>
    If you knew Sarah, you would know she's not into that kind of stress.  She also likes her 
    local restaurants a lot.<br>
    You are only going to be rewarded for your good behavior with no pressure that anything is "bad."
    </p>
    </div>
    <div class="intro-footer">
        <a class="btn btn-default registration-intro-button" href="/settings" role="button">Got it! Let's go!</a>
    </div>

  </div>
<!-- end main content section -->
@stop
