@extends('layouts.master')

@section('content')
<!-- begin main content section -->
  <div class="col-md-6">
	<h3>Grocery Runs</h3>
    <p>Your unit of measure for LMG.  Click date to edit or add a new Run.</p>
    <table border="1">
        <caption>Your Grocery Runs</caption>
        <tr>
            <th>Date</th>
            <th>Total Amt</th>
            <th>Non Food Amt</th>
            <th>Food Amt</th>
        </tr>
    @foreach($user_grocery_runs as $grocery_run)
        <tr>
            <td><a href="/grocery-runs/edit/{{$grocery_run['id']}}">{{ $grocery_run['dt_grocery_run'] }}</a></td>
            <td>${{ $grocery_run['total_amt'] }}</td> 
            <td>${{ $grocery_run['food_amt'] }}</td>
            <td>${{ $grocery_run['non_food_amt'] }}</td>
        </tr>
    @endforeach
    </table>
    <a href="/grocery-runs/create/{{$grocery_run['user_id']}}">
        Add New
    </a>
  </div>
  <div class="col-md-6">
    <div class="grocery-listing">
        <h4>Summary Metrics for Grocery Runs</h4>
        <p>put some fancy numbers</p>

    </div>
  </div>
<!-- end main content section -->
@stop
