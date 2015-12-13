@extends('layouts.master')

@section('nav')
  @include('layouts.nav', [$nav_gameboard = 'active', $nav_grocery_run = '', $nav_metrics = '', $nav_settings = '', $nav_register = '', $nav_login = ''])
@stop

@section('content')
<section class="row grocery-run-bar">
	<div class="col-md-12">
		<span class="grocery-run-deets">Grocery Run Date: {{ $user_grocery_run['dt_grocery_run'] }} :: Total Food Cost = ${{ $user_grocery_run['food_amt'] }} 
		(<a href="#">Change Grocery Run</a>)</span>
	</div>
</section>
<!-- begin main content section -->
  <div class="col-md-6">
	<h3>Gameboard</h3>
    <form class="settings-form" method="POST" action="/game-board/create">

    <input type='hidden' value='{{ csrf_token() }}' name='_token'>
    <input type='hidden' value='{{ $user_info['id'] }}' name='user_id'>
    <input type='hidden' value='{{ $user_grocery_run['id'] }}' name='grocery_run_id'>
    <!-- <h4>Meal Counts</h4> -->
    	<fieldset>
    		<legend>Number of Meal Counts for day</legend>
    		<label for="dt_meal_count">Select Date:</label>
    		<input type="text" name="dt_meal_count" id="dt_meal_count" class="input-num-parameter" value="{{ old('dt_meal_count',Carbon\Carbon::now()->toDateString()) }}">
    		<br>
    		<label for="bfast_ct">Breakfasts:</label>
    		<input type="number" name="bfast_ct" id="bfast_ct" class="input-num-parameter" value="{{ old('bfast_ct',0) }}"> 
    		<br>
    		<label for="lunch_ct">Lunches:</label>
    		<input type="number" name="lunch_ct" id="lunch_ct" class="input-num-parameter" value="{{ old('lunch_ct',0) }}"> 
    		<br>
    		<label for="dinner_ct">Dinners:</label>
    		<input type="number" name="dinner_ct" id="dinner_ct" class="input-num-parameter" value="{{ old('dinner_ct',0) }}"> 
    		<br>
    		<label for="coffee_ct">Coffee:</label>
    		<input type="number" name="coffee_ct" id="coffee_ct" class="input-num-parameter" value="{{ old('coffee_ct',0) }}"> 
    	</fieldset>
          <input type="submit" value="Save" id="settings-submit-button" class="btn btn-primary btn-sm">
    </form>	
  </div>
  <div class="col-md-6">
  	<h3>Grocery Run Summary</h3>
    <div class="settings-info">
     <p> start counting meals towards this grocery run! </p>
    </div>
  </div>
<!-- end main content section -->
@stop
