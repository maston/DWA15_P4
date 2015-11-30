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
        <p class="grocery-run-deets">Select grocery run from drop down to change grocery run gameboard.</p>
        <h4 class="grocery-run-deets">Grocery Run Date: {{ $most_recent_grocery_run['dt_grocery_run'] }}</h4>
        <h4 class="grocery-run-deets">Total Food Cost = ${{ $most_recent_grocery_run['food_amt'] }} </h4>
        (<a href="#">Change Grocery Run</a>)
        <input type='hidden' value='{{ csrf_token() }}' name='_token'>
        <div class='form-group'>
            <label for='grocery_run_id'>Grocery Run Date:</label>
            <select name='grocery_run_id' id='grocery_run_id'>
                @foreach($grocery_run_for_dropdown as $grocery_run_id => $dt_grocery_run)

                    {{ $selected = ($grocery_run_id == $most_recent_grocery_run->grocery_run_id) ? 'selected' : '' }}

                    <option value='{{ $grocery_run_id }}' {{ $selected }}> {{ $dt_grocery_run }} </option>
                @endforeach
            </select>
        </div>
        <input type="submit" value="Load GR" class="btn btn-primary settings-save-btn">
    </form>
    </div>

<!-- end main content section -->
@stop
