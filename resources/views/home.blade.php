@extends('layouts.master')


@section('nav')
    @include('partials.nav', [$nav_gameboard = '', $nav_grocery_run = '', $nav_metrics = '', $nav_settings = '', $nav_register = '', $nav_login = ''])
@stop


@section('content')

<div class="col-md-3 carton-reverse-img"></div>
<div class="col-md-9 home-copy">
    <div class="home-intro-incentives">
    	<h2>Welcome to LunchMoneyGame</h2>
        <h3>Need more incentives than a thinner waist and fatter wallet?</h3> 
        <ul>
        	<li>25% of Americans eat fast food daily. We spend billions at restaurants annually.</li>
        	<li>Grocery stores throw out around 300 million tons of unpurchased food every year.</li>
        	<li>Americans now spend more than $190B on healthcare costs related to obesity.</li>
        </ul>
        <h3>Help solve a national problem.</h3>
        <h4>LMG will help you, and our nation, start to reverse these trends and save your money.</h4>
	</div>
	<div class="home-intro-who">
		<h3>Who is this for?</h3>
		<h4>LMG is for anyone who wants a helping hand to save money and get on a healthier eating path.</h4>

		<p>We will help you get started and make it easier for you to do the things you know are better for your wallet and your waistline in just a few easy steps.</p>
	    
	    <div class="home-buttons">
	        <a href="/register">
	            <input type="button" value="Register Now" id="home-register-button" class="btn btn-primary btn-sm home-register-button">
	        </a>
		     <a href="/login">
		        <input type="button" value="Login" id="home-login-button" class="btn btn-primary btn-sm home-login-button">
		    </a>
	    </div>    

    </div>
</div>
@stop





