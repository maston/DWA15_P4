@extends('layouts.master')



@section('content')
<!-- begin main content section -->
  <div class="col-md-6">
    <!-- <h3>Gameboard</h3> -->


    <form class="meal-count-form" method="POST" action="/game-board/create">
    <input type='hidden' value='{{ csrf_token() }}' name='_token'>
    <input type='hidden' value='1' name='user_id'>
    <input type='hidden' value='1' name='grocery_run_id'>

    <!-- <h4>Meal Counts</h4> -->
        <fieldset>
            <legend>Number of Meal Counts for day</legend>
            <label for="dt_meal_count">Select Date:</label>
            <input class="date_select" type="text" size="11" name="dt_meal_count" id="dt_meal_count" />
            <!-- <input type="text" name="dt_meal_count" id="dt_meal_count" class="input-num-parameter" value="{{ old('dt_meal_count',Carbon\Carbon::now()->toDateString()) }}"> -->
            <br>
            <label for="bfast_ct">Breakfasts:</label>
            
            <input type="button" id ='bfast_sub' onclick="change()" value="-">
            <input type="number" name="bfast_ct" id="bfast_ct" class="input-num-parameter" value="{{ old('bfast_ct',0) }}"> 
            <input type="button" id ='bfast_add' onclick="change()" value="+">
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
    });
    </script>
@stop