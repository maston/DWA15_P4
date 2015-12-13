@extends('layouts.master')

@section('nav')
    @include('layouts.nav', [$nav_gameboard = 'active', $nav_grocery_run = '', $nav_metrics = '', $nav_settings = '', $nav_register = '', $nav_login = ''])
@stop

@section('content')
   
<!-- begin main content section -->
  <div class="col-md-6">
    <!-- <h3>Gameboard</h3> -->
    <div class="grocery-run-bar">
        <h3>Your Grocery Run</h3>

        <form method='POST' action='/game-board' id="form-grocery-run-select">
        <input type='hidden' value='{{ csrf_token() }}' name='_token'>
            <p class="grocery-run-deets">Select grocery run from drop down to change grocery run gameboard.</p>
            <div class='form-group'>
            <div class="input-group">
            <div class="input-group-addon">Grocery Run Date:</div>
                <select name='grocery_run_id' id='grocery_run_id' class="form-control grocery-run-date-select" onchange="showSelectedGroceryRun()">
                        @foreach($grocery_run_for_dropdown as $grocery_run_id => $dt_grocery_run)

                            {{ $selected = ($grocery_run_id == $selected_grocery_run['id']) ? 'selected' : '' }}

                            <option value='{{ $grocery_run_id }}' {{ $selected }}> {{ $dt_grocery_run }} </option>
                        @endforeach
                    </select>
            </div>
            </div>
        </form>
    </div>
    <table class="table table-condensed active">
        <caption>Meal Counts For This Grocery Run</caption>
        <tr  class="active">
            <th>Date of Meal</th>
            <th>Breakfast</th>
            <th>Lunch</th>
            <th>Dinner</th>
            <th>Coffee</th>
        </tr>
    @foreach ($user_grocery_runs as $user_grocery_run) 
      @if ($user_grocery_run['id']==$selected_grocery_run['id'])
        @foreach($user_grocery_run->meal_count_day as $meal_count_day)
            <tr>
                <td><a href="/test-board/show/meal-count/{{$meal_count_day['id']}}">{{ $meal_count_day['dt_meal_count'] }}</a></td>
                <td>{{ $meal_count_day['bfast_ct'] }}</td> 
                <td>{{ $meal_count_day['lunch_ct'] }}</td>
                <td>{{ $meal_count_day['dinner_ct'] }}</td>
                <td>{{ $meal_count_day['coffee_ct'] }}</td>
            </tr>
        @endforeach
      @endif
    @endforeach
        <tr class="success">
            <td>Totals</td>
            <td>{{ $bfast_ct_tot }}</td>
            <td>{{ $lunch_ct_tot }}</td>
            <td>{{ $dinner_ct_tot }}</td>
            <td>{{ $coffee_ct_tot }}</td>
        </tr>
    </table>

  </div>
  <div class="col-md-6">
    <h3>Grocery Run Summary</h3>
            <div class="grocery-run-deets">
                <p class="spent-on-run">Spent on Grocery Run :: ${{ $selected_grocery_run['food_amt'] }} 
                <span class="saved-on-run">Total Saved :: ${{ $grocery_run_grand_tot }} </span></p>
            </div>
    <div class="settings-info">

     <table class="table table-condensed active">
        <caption>Savings For This Grocery Run</caption>
        <tr class="active">
            <th>Date of Meal</th>
            <th>Breakfast</th>
            <th>Lunch</th>
            <th>Dinner</th>
            <th>Coffee</th>
        </tr>
    @foreach ($user_grocery_runs as $user_grocery_run) 
      @if ($user_grocery_run['id']==$selected_grocery_run['id'])
        @foreach($user_grocery_run->meal_count_day as $meal_count_day)
        <tr>
            <td><a href="/test-board/show/meal-count/{{$meal_count_day['id']}}">{{ $meal_count_day['dt_meal_count'] }}</a></td>
            <td>{{ $meal_count_day['bfast_ct'] * $user_info['bfast_spend']}}</td> 
            <td>{{ $meal_count_day['lunch_ct'] * $user_info['lunch_spend'] }}</td>
            <td>{{ $meal_count_day['dinner_ct'] * $user_info['dinner_spend'] }}</td>
            <td>{{ $meal_count_day['coffee_ct'] * $user_info['coffee_spend'] }}</td>
        </tr>
        @endforeach
      @endif
    @endforeach
        <tr  class="success">
            <td>Totals</td>
            <td>{{ $bfast_save_tot }}</td>
            <td>{{ $lunch_save_tot }}</td>
            <td>{{ $dinner_save_tot }}</td>
            <td>{{ $coffee_save_tot }}</td>
        </tr>
    </table>
    <a href="#"> Go to Metrics</a>
    </div>
<!-- end main content section -->
@stop

@section('body')

    <script type="text/javascript">
        function showSelectedGroceryRun() {
            //get selected grocery run's gameboard
            window.open(document.getElementById('grocery_run_id').value,"_self")
        }
    </script>

    <script type="text/javascript">

    $(document).ready(function() {
      //** begin onLoad events **
        //global vars
        // var test ={{ Carbon\Carbon::now()->year }};
        // var default_day = {{ Carbon\Carbon::now()->day }};
        // var default_month = {{ Carbon\Carbon::now()->month }};
        // var default_year = {{ Carbon\Carbon::now()->year }};
        // var test = new Date(default_year, default_month - 1, default_day)
        // console.log(test);
        // var date_today = new Date();
        // var userID = "{{ Auth::user()->id }}";
        // Carbon\Carbon::parse('11/06/1990')->format('d/m/Y')

        // var grocery_run_year = "{{ Carbon\Carbon::parse($dt_grocery_run)->format('Y') }}";

        // var grocery_run_month = "{{ Carbon\Carbon::parse($dt_grocery_run)->format('m') }}";
        // var grocery_run_day = "{{ Carbon\Carbon::parse($dt_grocery_run)->format('d') }}";
        // var grocery_run_date = new Date(2015,11,4);  //year, month-1, day of grocery run
        // var grocery_run_date = new Date(document.getElementById('grocery_run_id').options[selectedIndex].text); 
        // alert("grocery run date: " + grocery_run_date);
        var e = document.getElementById("grocery_run_id");
        var selected_grocery_run_date = e.options[e.selectedIndex].text;
        var grocery_run_date = new Date(selected_grocery_run_date);
        //create datepicker
        $('input.date_select').datepicker({ minDate: grocery_run_date});
        // $("#yourinput").datepicker( "setDate" , "7/11/2011" );
        // $('input.date_select').datepicker( "setDate", "10/12/2012" );
        console.log("loaded doc with datepickers");
        // console.log("grocery run year: " + grocery_run_year);
        // console.log("grocery run month: " + grocery_run_month);
        // console.log("grocery run day: " + grocery_run_day);
        // console.log("grocery run date: " + grocery_run_date);
        // console.log("grocery run select val: " + document.getElementById('grocery_run_id').options[selectedIndex].text);

        
        // BFAST ADD/SUB BUTTONS
        $('#bfast_add').click(function(){
            var ct=document.getElementById('bfast_ct').value;
           $('#bfast_ct').val(parseInt(document.getElementById('bfast_ct').value)+1);
        });

        $('#bfast_sub').click(function(){
            var ct = parseInt(document.getElementById('bfast_ct').value)-1;
            if (ct<0) {
              ct = 0;
            }
           $('#bfast_ct').val(ct);
        });
        // LUNCH ADD/SUB BUTTONS
       $('#lunch_add').click(function(){
            var ct=document.getElementById('lunch_ct').value;
           $('#lunch_ct').val(parseInt(document.getElementById('lunch_ct').value)+1);
        });

        $('#lunch_sub').click(function(){
            var ct = parseInt(document.getElementById('lunch_ct').value)-1;
            if (ct<0) {
              ct = 0;
            }
           $('#lunch_ct').val(ct);
        });

        // Dinner ADD/SUB BUTTONS
       $('#dinner_add').click(function(){
            var ct=document.getElementById('dinner_ct').value;
           $('#dinner_ct').val(parseInt(document.getElementById('dinner_ct').value)+1);
        });

        $('#dinner_sub').click(function(){
            var ct = parseInt(document.getElementById('dinner_ct').value)-1;
            if (ct<0) {
              ct = 0;
            }
           $('#dinner_ct').val(ct);
        });

        // coffee ADD/SUB BUTTONS
       $('#coffee_add').click(function(){
            var ct=document.getElementById('coffee_ct').value;
           $('#coffee_ct').val(parseInt(document.getElementById('coffee_ct').value)+1);
        });

        $('#coffee_sub').click(function(){
            var ct = parseInt(document.getElementById('coffee_ct').value)-1;
            if (ct<0) {
              ct = 0;
            }
           $('#coffee_ct').val(ct);
        });
    });
    </script>

@stop