@extends('layouts.master')

@section('nav')
    @include('layouts.nav', [$nav_gameboard = 'active', $nav_grocery_run = '', $nav_metrics = '', $nav_settings = '', $nav_register = '', $nav_login = ''])
@stop

@section('content')
<!-- begin main content section -->
  <div class="col-md-6">
	<!-- <h3>Gameboard</h3> -->
    <div class="grocery-run-bar">
    	<h3 class="grocery-run-deets">Your Grocery Run</h3>

      	<form method='POST' action='/game-board'>
      	<input type='hidden' value='{{ csrf_token() }}' name='_token'>
        	<p class="grocery-run-deets">Select grocery run from drop down to change grocery run gameboard.</p>
        	<h4 class="grocery-run-deets">Grocery Run Date: {{ $selected_grocery_run['dt_grocery_run'] }}</h4>
        	<h4 class="grocery-run-deets">Total Food Cost = ${{ $selected_grocery_run['food_amt'] }} </h4>
        	(<a href="#">Change Grocery Run</a>)

        	<div class='form-group'>
            	<label for='grocery_run_id'>Grocery Run Date:</label>
            	<select name='grocery_run_id' id='grocery_run_id'>
                	@foreach($grocery_run_for_dropdown as $grocery_run_id => $dt_grocery_run)

                    	{{ $selected = ($grocery_run_id == $selected_grocery_run['id']) ? 'selected' : '' }}

                    	<option value='{{ $grocery_run_id }}' {{ $selected }}> {{ $dt_grocery_run }} </option>
                	@endforeach
            	</select>
        	</div>
        	<input type="submit" value="Load GR" class="btn btn-primary settings-save-btn">
      	</form>
	</div>

    <form class="meal-count-form" method="POST" action="/game-board/create">
    <input type='hidden' value='{{ csrf_token() }}' name='_token'>
    <input type='hidden' value='{{ $user_info['id'] }}' name='user_id'>
    <input type='hidden' value='{{ $selected_grocery_run['id'] }}' name='grocery_run_id'>
    @if(!empty($selected_meal_count_day))
    <input type='hidden' value='{{ $selected_meal_count_day['id'] }}' name='meal_count_day_id'>
    @endif
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
    <table border="1">
        <caption>Meal Counts For This Grocery Run</caption>
        <tr>
            <th>Date of Meals</th>
            <th>Breakfasts</th>
            <th>Lunches</th>
            <th>Dinners</th>
            <th>Coffees</th>
        </tr>
    @foreach ($user_grocery_runs as $user_grocery_run) 
      @if ($user_grocery_run['id']==$selected_grocery_run['id'])
	    @foreach($user_grocery_run->meal_count_day as $meal_count_day)
	        <tr>
	            <td><a href="/grocery-runs/edit/{{$meal_count_day['grocery_run_id']}}">{{ $meal_count_day['dt_meal_count'] }}</a></td>
	            <td>{{ $meal_count_day['bfast_ct'] }}</td> 
	            <td>{{ $meal_count_day['lunch_ct'] }}</td>
	            <td>{{ $meal_count_day['dinner_ct'] }}</td>
	            <td>{{ $meal_count_day['coffee_ct'] }}</td>
	        </tr>
	    @endforeach
	  @endif
	@endforeach
        <tr>
            <td>Totals</td>
            <td>#</td>
            <td>#</td>
            <td>#</td>
            <td>#</td>
        </tr>
    </table>
     <table border="1">
        <caption>Savings For This Grocery Run</caption>
        <tr>
            <th>Date of Meals</th>
            <th>Breakfasts</th>
            <th>Lunches</th>
            <th>Dinners</th>
            <th>Coffees</th>
        </tr>
    @foreach ($user_grocery_runs as $user_grocery_run) 
      @if ($user_grocery_run['id']==$selected_grocery_run['id'])
	    @foreach($user_grocery_run->meal_count_day as $meal_count_day)
        <tr>
            <td><a href="/grocery-runs/edit/{{$meal_count_day['grocery_run_id']}}">{{ $meal_count_day['dt_meal_count'] }}</a></td>
            <td>{{ $meal_count_day['bfast_ct'] * $user_info['bfast_spend']}}</td> 
            <td>{{ $meal_count_day['lunch_ct'] * $user_info['lunch_spend'] }}</td>
            <td>{{ $meal_count_day['dinner_ct'] * $user_info['dinner_spend'] }}</td>
            <td>{{ $meal_count_day['coffee_ct'] * $user_info['coffee_spend'] }}</td>
        </tr>
	    @endforeach
	  @endif
	@endforeach
        <tr>
            <td>Totals</td>
            <td>#</td>
            <td>#</td>
            <td>#</td>
            <td>#</td>
        </tr>
    </table>
    <a href="#"> Go to Metrics</a>
    </div>
<!-- end main content section -->
@stop