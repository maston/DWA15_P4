@extends('layouts.master')

@section('nav')
    @include('partials.nav', [$nav_gameboard = 'active', $nav_grocery_run = '', $nav_metrics = '', $nav_instructions = '', $nav_settings = '', $nav_register = '', $nav_login = ''])
@stop

@section('kpi-bar')
    @include('partials.kpi-bar')
@stop

@section('content')
<!-- begin main content section -->
<div class="col-md-6">
    <h3>Gameboard</h3>
    <p class="game-board-intro">Select grocery run from drop down to change grocery run gameboard. The name of the game is counting meals you cooked against your grocery run.</p>

    <div class="game-board-section-mc">
        <h4>Select Grocery Run
        <span class="game-board-add-grocery-run">
                <input type="button" value="Add New" id="game-board-add-new-grocery-run-btn" class="btn btn-primary btn-sm" onclick="window.location='/grocery-runs';">
        </span>
        </h4>
        @if($meal_count_selected)
        <!-- Meal Count Selected -->
        <form method='POST' action='/game-board/show/meal-count' id="form-grocery-run-select">
            <input type='hidden' value='{{ $selected_meal_count_day['id'] }}' name='meal_count_day_id' id='meal_count_day_id'>
        @else
        <!-- No Meal Count -->
        <form method='POST' action='/game-board/show/meal-count/create' id="form-grocery-run-select">
        @endif        
        {!! csrf_field() !!}
        <input type='hidden' value='{{ $selected_grocery_run['id'] }}' name='grocery_run_id'>
        
        <div class='form-group'>
            <label for="grocery_run_id">Grocery Run Date:</label>
                <select name='grocery_run_id' id='grocery_run_id' class="form-control grocery-run-date-select" onchange="showSelectedGroceryRun()">
                @foreach($grocery_run_for_dropdown as $grocery_run_id => $dt_grocery_run)

 
                    <option value='{{ $grocery_run_id }}' {{ ($grocery_run_id == $selected_grocery_run['id']) ? 'selected' : '' }}> {{ $dt_grocery_run }} </option>
                @endforeach
                </select>
            <hr>   
        </div>
        @if(isset($selected_grocery_run['dt_grocery_run']))
        <div class='form-group'>
            @if($meal_count_selected)
                <h4 id="meal-count-form-title">Update Meal Count Day
                    <input type="button" value="Delete" id="gameboard-delete-button" class="btn btn-primary btn-sm game-board-delete-button" onclick="window.location='/game-board/show/meal-count/delete/{{$selected_meal_count_day['id']}}';">
                </h4>
            @else
                <h4 id="meal-count-form-title">Add Meal Count Day</h4>
            @endif

        @include('partials.errors')
        
        <div class="input-group">
            <label for="dt_meal_count" class="col-md-6 game-board-select-dt">Select Date:</label>
            @if($meal_count_selected)
                <input type='date'  class="col-md-6 game-board-date-select" name='dt_meal_count' id="dt_meal_count" value="{{ old('dt_meal_count',$selected_meal_count_day['dt_meal_count']) }}">
            @else
                <input type='date'  class="col-md-6 game-board-date-select" name='dt_meal_count' id="dt_meal_count" value="{{ old('dt_meal_count',date("Y-m-j")) }}">
            @endif
            <br>
            <div class="col-md-4 game-board-input-label">
                <label for="bfast_ct">Breakfasts:</label>
            </div>
            <div class="col-md-8 game-board-input">
                <input type="button" id ='bfast_sub' class="btn btn-sm" onclick="return false;" value="-">
                @if($meal_count_selected)
                    <input type="number" name="bfast_ct" id="bfast_ct" class="meal-count-input" min="0" max="30" value="{{ old('bfast_ct',$selected_meal_count_day['bfast_ct']) }}">  
                @else
                    <input type="number" name="bfast_ct" id="bfast_ct" class="meal-count-input" min="0" max="30" value="{{ old('bfast_ct',0) }}">
                @endif
                <input type="button" id ='bfast_add' class="btn btn-sm" onclick="return false;" value="+">
            </div>
            <br>
            <div class="col-md-4 game-board-input-label">
                <label for="lunch_ct">Lunches:</label>
            </div>
            <div class="col-md-8 game-board-input">
                <input type="button" id ='lunch_sub' class="btn btn-sm" onclick="return false;" value="-">
                @if($meal_count_selected)
                    <input type="number" name="lunch_ct" id="lunch_ct" class="meal-count-input" min="0" max="30" value="{{ old('lunch_ct',$selected_meal_count_day['lunch_ct']) }}">
                @else
                    <input type="number" name="lunch_ct" id="lunch_ct" class="meal-count-input" min="0" max="30" value="{{ old('lunch_ct',0) }}" >
                @endif 
                <input type="button" id ='lunch_add' class="btn btn-sm" onclick="return false;" value="+">
            </div>
            <br>
            <div class="col-md-4 game-board-input-label">
                <label for="dinner_ct">Dinners:</label>
            </div>
            <div class="col-md-8 game-board-input">
                <input type="button" id ='dinner_sub' class="btn btn-sm" onclick="return false;" value="-">
                @if($meal_count_selected)
                    <input type="number" name="dinner_ct" id="dinner_ct" class="meal-count-input" min="0" max="30" value="{{ old('dinner_ct',$selected_meal_count_day['dinner_ct']) }}"> 
                @else
                    <input type="number" name="dinner_ct" id="dinner_ct" class="meal-count-input" min="0" max="30" value="{{ old('dinner_ct',0) }}"> 
                @endif                 
                <input type="button" id ='dinner_add' class="btn btn-sm" onclick="return false;" value="+">
            </div>
            <br>
            <div class="col-md-4 game-board-input-label">
                <label for="coffee_ct">Coffee:</label>
            </div>
            <div class="col-md-8 game-board-input">
                <input type="button" id ='coffee_sub' class="btn btn-sm" onclick="return false;" value="-" >
                @if($meal_count_selected)
                    <input type="number" name="coffee_ct" id="coffee_ct" class="meal-count-input" min="0" max="30" value="{{ old('coffee_ct',$selected_meal_count_day['coffee_ct']) }}" > 
                @else
                    <input type="number" name="coffee_ct" id="coffee_ct" class="meal-count-input" min="0" max="30" value="{{ old('coffee_ct',0) }}"> 
                @endif                 
                <input type="button" id ='coffee_add' class="btn btn-sm" onclick="return false;" value="+">
            </div>
        </div>
    </div>
        @if($meal_count_selected)
            <input type="submit" value="Update" id="mealcount-update-button" class="btn btn-primary btn-sm game-board-add-button" onclick="getChkSum()">
        @else
            <input type="submit" value="Save" id="mealcount-add-button" class="btn btn-primary btn-sm game-board-add-button" onclick="getChkSum()">
        @endif 
        <input type="button" value="Cancel" id="mealcount-cancel-button" class="btn btn-primary btn-sm" onclick="window.location='/game-board';">
        <input type='hidden' value="0" name='one_meal_count_entered' id='one_meal_count_entered'> 
    @endif
    </form>
    </div>
</div>
<div class="col-md-6">
    <h3>Grocery Run Summary</h3>
    @if(isset($selected_grocery_run['dt_grocery_run']))
    <div class="game-board-grocery-run-metrics">
        <p>Grocery Run Date :: {{ $selected_grocery_run['dt_grocery_run'] }} </p>
        <p class="game-board-spent-on-run">Spent on Grocery Run :: ${{ number_format($selected_grocery_run['food_amt'], 2, '.', '') }} 
            <span class="game-board-saved-on-run">Total Saved :: ${{ number_format($grocery_run_grand_tot, 2, '.', '') }} </span>
        </p>
    </div>
    <div class="game-board-grid">
        <table class="table table-condensed active">
            <caption>Meal Counts For This Grocery Run
                    <input type="button" value="Add New" id="gameboard-add-button" class="btn btn-primary btn-sm game-board-add-button" onclick="window.location='/game-board/show/meal-count/new/{{ $selected_grocery_run['id'] }}';">
            </caption>
            <tr  class="active">
                <th>Date of Meal (click to edit)</th>
                <th class="game-board-grid-item">Breakfast</th>
                <th class="game-board-grid-item">Lunch</th>
                <th class="game-board-grid-item">Dinner</th>
                <th class="game-board-grid-item">Coffee</th>
            </tr>
            @foreach ($user_grocery_runs as $user_grocery_run) 
              @if ($user_grocery_run['id']==$selected_grocery_run['id'])
                @foreach($user_grocery_run->meal_count_day as $meal_count_day)
                    <tr>
                        <td><a href="/game-board/show/meal-count/{{$meal_count_day['id']}}">{{ $meal_count_day['dt_meal_count'] }}</a></td>
                        <td class="game-board-grid-item">{{ $meal_count_day['bfast_ct'] }}</td> 
                        <td class="game-board-grid-item">{{ $meal_count_day['lunch_ct'] }}</td>
                        <td class="game-board-grid-item">{{ $meal_count_day['dinner_ct'] }}</td>
                        <td class="game-board-grid-item">{{ $meal_count_day['coffee_ct'] }}</td>
                    </tr>
                @endforeach
              @endif
            @endforeach
            <tr class="success">
                <td>Totals</td>
                <td class="game-board-grid-item">{{ $bfast_ct_tot }}</td>
                <td class="game-board-grid-item">{{ $lunch_ct_tot }}</td>
                <td class="game-board-grid-item">{{ $dinner_ct_tot }}</td>
                <td class="game-board-grid-item">{{ $coffee_ct_tot }}</td>
            </tr>
        </table>
        <table class="table table-condensed active">
            <caption>Savings For This Grocery Run</caption>
            <tr class="active">
                <th>Date of Meal (click to edit)</th>
                <th class="game-board-grid-item">Breakfast</th>
                <th class="game-board-grid-item">Lunch</th>
                <th class="game-board-grid-item">Dinner</th>
                <th class="game-board-grid-item">Coffee</th>
            </tr>
            @foreach ($user_grocery_runs as $user_grocery_run) 
              @if ($user_grocery_run['id']==$selected_grocery_run['id'])
                @foreach($user_grocery_run->meal_count_day as $meal_count_day)
                <tr>
                    <td><a href="/game-board/show/meal-count/{{$meal_count_day['id']}}">{{ $meal_count_day['dt_meal_count'] }}</a></td>
                    <td class="game-board-grid-item">${{ number_format($meal_count_day['bfast_ct'] * $user_info['bfast_spend'], 2, '.', '')}}</td> 
                    <td class="game-board-grid-item">${{ number_format($meal_count_day['lunch_ct'] * $user_info['lunch_spend'], 2, '.', '') }}</td>
                    <td class="game-board-grid-item">${{ number_format($meal_count_day['dinner_ct'] * $user_info['dinner_spend'], 2, '.', '') }}</td>
                    <td class="game-board-grid-item">${{ number_format($meal_count_day['coffee_ct'] * $user_info['coffee_spend'], 2, '.', '') }}</td>
                </tr>
                @endforeach
              @endif
            @endforeach
            <tr  class="success">
                <td>Totals</td>
                <td class="game-board-grid-item">${{ number_format($bfast_save_tot, 2, '.', '') }}</td>
                <td class="game-board-grid-item">${{ number_format($lunch_save_tot, 2, '.', '') }}</td>
                <td class="game-board-grid-item">${{ number_format($dinner_save_tot, 2, '.', '') }}</td>
                <td class="game-board-grid-item">${{ number_format($coffee_save_tot , 2, '.', '')}}</td>
            </tr>
        </table>
    </div>
    @else
    <div class="game-board-grocery-run-metrics-empty">
        <h4>No grocery runs added yet!</h4>
    </div>    
    @endif
</div>
<!-- end main content section -->
@stop

@section('body')
<script type="text/javascript">
    $(document).ready(function() {

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

    function getChkSum() {
        var bfast_ct = document.getElementById('bfast_ct').value;
        var lunch_ct = document.getElementById('lunch_ct').value;
        var dinner_ct = document.getElementById('dinner_ct').value;
        var coffee_ct = document.getElementById('coffee_ct').value;

        if (bfast_ct == "")
           bfast_ct = 0;
        if (lunch_ct == "")
           lunch_ct = 0;
        if (dinner_ct == "")
           dinner_ct = 0;
        if (coffee_ct == "")
           coffee_ct = 0;

        var result = parseInt(bfast_ct) + parseInt(lunch_ct) + parseInt(dinner_ct) + parseInt(coffee_ct);

        if (!isNaN(result)) {
           document.getElementById('one_meal_count_entered').value = result;
        }
    }

    function showSelectedGroceryRun() {
        //get selected grocery run's gameboard
        var url = '/game-board/show/' + document.getElementById('grocery_run_id').value;
        window.open(url,"_self");
    }

    function addNewMealCountDay() {
        document.getElementById('meal_count_day_id').value = '';
        document.getElementById('meal-count-form-title').innerHTML = 'Add Meal Count Day';

    }
</script>

@stop