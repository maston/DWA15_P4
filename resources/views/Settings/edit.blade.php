@extends('layouts.master')

@section('content')
<!-- begin main content section -->
  <div class="col-md-6">
	<h3>User Settings</h3>
    <form class="settings-form" method="POST" action="/settings">
    <input type='hidden' value='{{ csrf_token() }}' name='_token'>
    <input type='hidden' value='{{ $user_info['id'] }}' name='user_id'>
    	<fieldset>
    		<legend>Average Spend Settings</legend>
    		<label for="bfast_spend">Breakfast Spend (in $) :</label>
    		<input type="number" name="bfast_spend" id="bfast_spend" class="input-num-parameter"  value="{{ old('bfast_spend',$user_info['bfast_spend']) }}"> 
    		<br>
    		<label for="lunch_spend">Lunch Spend (in $) :</label>
    		<input type="number" name="lunch_spend" id="lunch_spend" class="input-num-parameter"  value="{{ old('lunch_spend',$user_info['lunch_spend']) }}"> 
    		<br>
    		<label for="dinner_spend">Dinner Spend (in $) :</label>
    		<input type="number" name="dinner_spend" id="dinner_spend" class="input-num-parameter"  value="{{ old('dinner_spend',$user_info['dinner_spend']) }}"> 
    		<br>
    		<label for="coffee_spend">Coffee Spend (in $) :</label>
    		<input type="number" name="coffee_spend" id="coffee_spend" class="input-num-parameter" value="{{ old('coffee_spend',$user_info['coffee_spend']) }}"> 
    	</fieldset>
    	<fieldset>
    		<legend>Optional Settings</legend>
    		<label for="zipcode">Zipcode :</label>
    		<input type="text" name="zipcode" id="zipcode" class="input-zipcode-parameter" value="{{ old('zipcode',$user_info['zipcode']) }}"> 
    		<br>
    	</fieldset>

    	<input type="submit" value="Save" id="settings-submit-button" class="btn btn-primary btn-sm">
    </form>
  </div>
  <div class="col-md-6">
  	<h3>Instructions</h3>
    <div class="settings-info">
    	<h4>What is average spend?</h4>
    	<p>The average spend is the amount of money you would normal spend on the type of meal by ordering it.  For example,
    	the cost of a cup of coffee at the shop is $2.50.  If you brew that cup of coffee at home and use a travel mug on your commute you save $2.50, (and some time).
    	We have defaulted these values and you can adjust them later if you like.</p>
    	<h4>Why are you asking me for a zipcode??</h4>
    	<p>I'll tell you.  We have grouped you by your Zipcode for your "National Team."  You are welcome to be in the anonymous
    	bucket, (we will still count your savings towards the population savings).  But should you decide to give us a zipcode we can get you on "<a href="#">the map</a>" and 
    	you contribute to the local leaderboards. (coming soon!)</p>
    </div>
  </div>
<!-- end main content section -->
@stop
