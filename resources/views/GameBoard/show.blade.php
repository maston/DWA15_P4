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

        <form method='POST' action='/game-board'>
        <input type='hidden' value='{{ csrf_token() }}' name='_token'>
            <p class="grocery-run-deets">Select grocery run from drop down to change grocery run gameboard.</p>
            <!-- <h4 class="grocery-run-deets">Grocery Run Date: {{ $selected_grocery_run['dt_grocery_run'] }}</h4> -->
            <div class='form-group'>
            <div class="input-group">
            <div class="input-group-addon">Grocery Run Date:</div>
                <!-- <label for='grocery_run_id'>Grocery Run Date:</label> -->
                <select name='grocery_run_id' id='grocery_run_id' class="form-control grocery-run-date-select">
                        @foreach($grocery_run_for_dropdown as $grocery_run_id => $dt_grocery_run)

                            {{ $selected = ($grocery_run_id == $selected_grocery_run['id']) ? 'selected' : '' }}

                            <option value='{{ $grocery_run_id }}' {{ $selected }}> {{ $dt_grocery_run }} </option>
                        @endforeach
                    </select>
            </div>
            </div>
            <input type="submit" value="Load GR" class="btn btn-primary settings-save-btn">
            <div class="grocery-run-deets">
                <p class="spent-on-run">Spent on Grocery Run :: ${{ $selected_grocery_run['food_amt'] }} 
                <span class="saved-on-run">Saved :: ${{ $grocery_run_grand_tot }} </span></p>
            </div>
<!--            <div class='form-group'>
                <label for='grocery_run_id'>Grocery Run Date:</label>
                <select name='grocery_run_id' id='grocery_run_id'>
                    @foreach($grocery_run_for_dropdown as $grocery_run_id => $dt_grocery_run)

                        {{ $selected = ($grocery_run_id == $selected_grocery_run['id']) ? 'selected' : '' }}

                        <option value='{{ $grocery_run_id }}' {{ $selected }}> {{ $dt_grocery_run }} </option>
                    @endforeach
                </select>
            </div> -->
            
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
            <input class="date_select" type="text" size="11" name="dt_meal_count" id="dt_meal_count" />
            <br>
            <label for="bfast_ct">Breakfasts:</label>
            <input type="button" id ='bfast_sub' onclick="return false;" value="-">
            <input type="number" name="bfast_ct" id="bfast_ct" class="form-control meal-count-input" value="{{ old('bfast_ct',0) }}"> 
            <input type="button" id ='bfast_add' onclick="return false;" value="+">
            <br>
            <label for="lunch_ct">Lunches:</label>
            <input type="button" id ='lunch_sub' onclick="return false;" value="-">
            <input type="number" name="lunch_ct" id="lunch_ct" class="form-control meal-count-input" value="{{ old('lunch_ct',0) }}"> 
            <input type="button" id ='lunch_add' onclick="return false;" value="+">
            <br>
            <label for="dinner_ct">Dinners:</label>
            <input type="button" id ='dinner_sub' onclick="return false;" value="-">
            <input type="number" name="dinner_ct" id="dinner_ct" class="form-control meal-count-input" value="{{ old('dinner_ct',0) }}"> 
            <input type="button" id ='dinner_add' onclick="return false;" value="+">
            <br>
            <label for="coffee_ct">Coffee:</label>
            <input type="button" id ='coffee_sub' onclick="return false;" value="-">
            <input type="number" name="coffee_ct" id="coffee_ct" class="form-control meal-count-input" value="{{ old('coffee_ct',0) }}"> 
            <input type="button" id ='coffee_add' onclick="return false;" value="+">
        </fieldset>
          <input type="submit" value="Save" id="settings-submit-button" class="btn btn-primary btn-sm">
    </form> 
  </div>
  <div class="col-md-6">
    <h3>Grocery Run Summary</h3>
    <div class="settings-info">
    <table class="table table-condensed active">
        <caption>Meal Counts For This Grocery Run</caption>
        <tr  class="active">
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
        <tr class="success">
            <td>Totals</td>
            <td>{{ $bfast_ct_tot }}</td>
            <td>{{ $lunch_ct_tot }}</td>
            <td>{{ $dinner_ct_tot }}</td>
            <td>{{ $coffee_ct_tot }}</td>
        </tr>
    </table>
     <table class="table table-condensed active">
        <caption>Savings For This Grocery Run</caption>
        <tr class="active">
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
        var grocery_run_date = new Date(2015,11,4);  //year, month-1, day of grocery run

        //create datepicker
        $('input.date_select').datepicker({ minDate: grocery_run_date});
        console.log("loaded doc with datepickers");
        
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