@extends('layouts.master')

@section('nav')
  @include('layouts.nav', [$nav_gameboard = '', $nav_grocery_run = 'active', $nav_metrics = '', $nav_settings = '', $nav_register = '', $nav_login = ''])
@stop

@section('content')
<!-- begin main content section -->
  <div class="col-md-6">
	<!-- <h3>Add Grocery Run</h3> -->
    <form class="grocery-run-form" method="POST" action="/grocery-runs/edit">
    <input type='hidden' value='{{ csrf_token() }}' name='_token'>
    <input type='hidden' value='{{ $grocery_run['id'] }}' name='grocery_run_id'>
    	<fieldset>
    		<legend>Edit Your Grocery Run</legend>
            <label for="dt_grocery_run">Grocery Run Date:</label>
            <input type="text" name="dt_grocery_run" id="dt_grocery_run" class="input-num-parameter"  value="{{ old('dt_grocery_run',$grocery_run['dt_grocery_run']) }}"> 
            <br>
    		<label for="total_amt">Total amount :</label>
    		<input type="number" name="total_amt" id="total_amt" class="input-num-parameter"  value="{{ old('total_amt',$grocery_run['total_amt']) }}"> 
    		<br>
    		<label for="non_food_amt">Non-food amount :</label>
    		<input type="number" name="non_food_amt" id="non_food_amt" class="input-num-parameter"  value="{{ old('non_food_amt',$grocery_run['non_food_amt']) }}"> 
    		<br>
    		<label for="food_amt">Food amount : (should be calc'd)</label>
    		<input type="number" name="food_amt" id="food_amt" class="input-num-parameter"  value="{{ old('food_amt',$grocery_run['food_amt']) }}"> 
    	</fieldset>

    	<input type="submit" value="Save" id="settings-submit-button" class="btn btn-primary btn-sm">
        <a href="/grocery-runs/{{$user_info->id}}">
            <input type="button" value="Cancel" class="btn btn-primary btn-sm"/>
        </a>
    </form>
  </div>
  <div class="col-md-6">
    <div class="grocery-listing">
        <h4>Instructions</h4>
        <p>A grocery run is your main unit of measure.  Keep it high level.  We don't want to fall into the weeds of accounting for spices used acrossed grocery runs.</p>
        <h4>Definitions</h4>
        <p>Total Amount: The amount on the receipt rounded to the nearest dollar.</p>
        <p>Non-Food Amount: What you spent on things you don't eat, like cat litter. (unless you are Stimpy?)</p>
        <p>Food Amount: This is the number that your grocery run will reflect on the Gameboard, we will count your meal counts against.</p>
    </div>
  </div>
<!-- end main content section -->
@stop
