@extends('layouts.master')

@section('content')
<!-- begin main content section -->
  <div class="col-md-6">
	<h3>User Settings</h3>
    <form class="settings-form">
  	
    <input type='hidden' value='{{ csrf_token() }}' name='_token'>
    <input type='hidden' value='{{ 1 }}' name='user_id'>
    	<fieldset>
    		<legend>Average Spend Settings</legend>
    		<label for="bfast_spend">Breakfast Spend (in $) :</label>
    		<input type="number" name="bfast_spend" id="bfast_spend" class="input-num-parameter" min="1" max="99" value="{{ old('bfast_spend',5) }}"> 
    		<br>
    		<label for="lunch_spend">Lunch Spend (in $) :</label>
    		<input type="number" name="lunch_spend" id="lunch_spend" class="input-num-parameter" min="1" max="99" value="{{ old('lunch_spend',10) }}"> 
    		<br>
    		<label for="dinner_spend">Dinner Spend (in $) :</label>
    		<input type="number" name="dinner_spend" id="lunch_spend" class="input-num-parameter" min="1" max="99" value="{{ old('dinner_spend',10) }}"> 
    		<br>
    		<label for="coffee_spend">Coffee Spend (in $) :</label>
    		<input type="number" name="coffee_spend" id="coffee_spend" class="input-num-parameter" min="1" max="99" value="{{ old('coffee_spend',10) }}"> 
    	</fieldset>
    	<fieldset>
    		<legend>Optional Settings</legend>
    		<label for="zipcode">Zipcode :</label>
    		<input type="text" name="zipcode" id="zipcode" class="input-zipcode-parameter" value="{{ old('zipcode',00000) }}"> 
    		<br>
    	</fieldset>

    	<input type="submit" value="Save" id="settings-submit-button" class="btn btn-primary btn-sm">
    </form>
  </div>
  <div class="col-md-6">
  	<h3>Instructions</h3>
    <div class="settings-info">
    	<p>Setting your average spend means...</p>
    	<p>Optional settings are... </p>
    </div>
  </div>
<!-- end main content section -->
@stop
