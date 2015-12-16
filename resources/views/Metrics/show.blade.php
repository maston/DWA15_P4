@extends('layouts.master')

@section('nav')
  @include('partials.nav', [$nav_gameboard = '', $nav_grocery_run = '', $nav_metrics = 'active', $nav_instructions = '', $nav_settings = '', $nav_register = '', $nav_login = ''])
@stop

@section('kpi-bar')
    @include('partials.kpi-bar')
@stop

@section('content')

<div class="col-md-6">
    <h2>Player Metrics</h2>
    <p class="metrics-intro-blurb">Your total savings looks like this. Good job!</p>
	<div class="player-metrics-section">
    	<div class="col-md-4">
        	<div class="all-time-save">
        		<h5>All Time Save</h5>
        		<p>${{number_format($kpi_player_total_save, 2, '.', '')}}</p>
        	</div>
    	</div>
    	<div class="col-md-4">
        	<div class="all-time-grocery-spend">
        		<h5>Spent On Food</h5>
        		<p>${{number_format($kpi_player_total_food_spend, 2, '.', '')}}</p>
        	</div>
    	</div>
    	<div class="col-md-4">
        	<div class="all-time-profit">
        		<h5>Back In Your Pocket</h5>
        		<p>${{number_format($kpi_player_total_back_in_pocket, 2, '.', '')}}</p>
        	</div>
    	</div>
        <table class="table table-condensed active">
            <caption>The Money</caption>
            <tr class="active">
                <th>Month-Year</th>
                <th>Breakfast</th>
                <th>Lunch</th>
                <th>Dinner</th>
                <th>Coffee</th>
                <th>Total</th>
            </tr>
            @foreach($kpi_player_save_detail as $player_save)
            <tr>
    	        <td>{{ $player_save->dt }}</td>
    	        <td>${{ $player_save->tot_bfast_save }}</td> 
    	        <td>${{ $player_save->tot_lunch_save }}</td> 
    	        <td>${{ $player_save->tot_dinner_save }}</td> 
    	        <td>${{ $player_save->tot_coffee_save }}</td>
    	        <td>${{ $player_save->tot_month_save }}</td>
            </tr>
            @endforeach
            @foreach($kpi_player_grand_totals as $player_grand_total)
            <tr class="success">
                <td>Grand Totals</td>
                <td>${{ $player_grand_total->grand_tot_bfast_save }}</td> 
                <td>${{ $player_grand_total->grand_tot_lunch_save }}</td> 
                <td>${{ $player_grand_total->grand_tot_dinner_save }}</td> 
                <td>${{ $player_grand_total->grand_tot_coffee_save }}</td>
                <td>${{ $player_grand_total->grand_tot_save }}</td> 
            </tr>
            @endforeach
        </table>
        <table class="table table-condensed active">
            <caption>The Counts</caption>
            <tr class="active">
                <th>Month-Year</th>
                <th>Breakfast</th>
                <th>Lunch</th>
                <th>Dinner</th>
                <th>Coffee</th>
                <th>Total</th>
            </tr>
            @foreach($kpi_player_meal_count_detail as $player_meal_count)
            <tr>
    	        <td>{{ $player_meal_count->dt }}</td>
    	        <td>{{ $player_meal_count->tot_bfast_ct }}</td> 
    	        <td>{{ $player_meal_count->tot_lunch_ct }}</td> 
    	        <td>{{ $player_meal_count->tot_dinner_ct }}</td> 
    	        <td>{{ $player_meal_count->tot_coffee_ct }}</td>
    	        <td>{{ $player_meal_count->tot_month_ct }}</td>
            </tr>
            @endforeach
            @foreach($kpi_player_grand_totals as $player_grand_total)
            <tr class="success">
                <td>Grand Totals</td>
                <td>{{ $player_grand_total->grand_tot_bfast_ct }}</td> 
                <td>{{ $player_grand_total->grand_tot_lunch_ct }}</td> 
                <td>{{ $player_grand_total->grand_tot_dinner_ct }}</td> 
                <td>{{ $player_grand_total->grand_tot_coffee_ct }}</td>
                <td>{{ $player_grand_total->grand_tot_ct }}</td> 
            </tr>
            @endforeach
        </table>
    </div>
</div>
<div class="col-md-6">
    <h2>The LMG Bigger Picture</h2>
    <p class="metrics-intro-blurb">Here is where it gets interesting... here is how much all players in the game are saving cooking at home.</p>
    <div class="lmg-metrics-section">
    	<div class="col-md-4">
    		<div class="all-time-save">
    			<h5>All Time Save</h5>
    			<p>${{number_format($kpi_lmg_total_save, 2, '.', '')}}</p>
    		</div>
    	</div>
    	<div class="col-md-4">
    		<div class="all-time-grocery-spend">
    			<h5>Grocery Spend</h5>
    			<p>${{number_format($kpi_lmg_total_food_spend, 2, '.', '')}}</p>
    		</div>
    	</div>
    	<div class="col-md-4">
    		<div class="all-time-profit">
    			<h5>Back In Pockets</h5>
    			<p>${{number_format($kpi_lmg_total_back_in_pocket, 2, '.', '')}}</p>
    		</div>
    	</div>
        <table class="table table-condensed active">
            <caption>All Our Money</caption>
            <tr  class="active">
                <th>Month-Year</th>
                <th>Breakfast</th>
                <th>Lunch</th>
                <th>Dinner</th>
                <th>Coffee</th>
                <th>Total</th>
            </tr>
            @foreach($kpi_lmg_save_detail as $lmg_save)
            <tr>
    	        <td>{{ $lmg_save->dt }}</td>
    	        <td>${{ $lmg_save->tot_bfast_save }}</td> 
    	        <td>${{ $lmg_save->tot_lunch_save }}</td> 
    	        <td>${{ $lmg_save->tot_dinner_save }}</td> 
    	        <td>${{ $lmg_save->tot_coffee_save }}</td>
    	        <td>${{ $lmg_save->tot_month_save }}</td>
            </tr>
            @endforeach
            @foreach($kpi_lmg_grand_totals as $lmg_grand_total)
            <tr class="success">
                <td>Grand Totals</td>
                <td>${{ $lmg_grand_total->grand_tot_bfast_save }}</td> 
                <td>${{ $lmg_grand_total->grand_tot_lunch_save }}</td> 
                <td>${{ $lmg_grand_total->grand_tot_dinner_save }}</td> 
                <td>${{ $lmg_grand_total->grand_tot_coffee_save }}</td>
                <td>${{ $lmg_grand_total->grand_tot_save }}</td> 
            </tr>
            @endforeach
        </table>
        <table class="table table-condensed active">
            <caption>So Much Cooking</caption>
            <tr  class="active">
                <th>Month-Year</th>
                <th>Breakfast</th>
                <th>Lunch</th>
                <th>Dinner</th>
                <th>Coffee</th>
                <th>Total</th>
            </tr>
            @foreach($kpi_lmg_meal_count_detail as $lmg_meal_count)
            <tr>
    	        <td>{{ $lmg_meal_count->dt }}</td>
    	        <td>{{ $lmg_meal_count->tot_bfast_ct }}</td> 
    	        <td>{{ $lmg_meal_count->tot_lunch_ct }}</td> 
    	        <td>{{ $lmg_meal_count->tot_dinner_ct }}</td> 
    	        <td>{{ $lmg_meal_count->tot_coffee_ct }}</td>
    	        <td>{{ $lmg_meal_count->tot_month_ct }}</td>
            </tr>
            @endforeach
            @foreach($kpi_lmg_grand_totals as $lmg_grand_total)
            <tr class="success">
                <td>Grand Totals</td>
                <td>{{ $lmg_grand_total->grand_tot_bfast_ct }}</td> 
                <td>{{ $lmg_grand_total->grand_tot_lunch_ct }}</td> 
                <td>{{ $lmg_grand_total->grand_tot_dinner_ct }}</td> 
                <td>{{ $lmg_grand_total->grand_tot_coffee_ct }}</td>
                <td>{{ $lmg_grand_total->grand_tot_ct }}</td> 
            </tr>
            @endforeach
        </table>
    </div>
</div>
@stop