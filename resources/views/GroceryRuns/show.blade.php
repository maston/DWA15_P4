@extends('layouts.master')

@section('nav')
    @include('partials.nav', [$nav_gameboard = '', $nav_grocery_run = 'active', $nav_metrics = '', $nav_settings = '', $nav_register = '', $nav_login = ''])
@stop

@section('kpi-bar')
    @include('partials.kpi-bar')
@stop

@section('content')
<!-- begin main content section -->
<div class="col-md-6">
    <h3>Grocery Run</h3> 
    <p class="grocery-run-intro">A grocery run is your main unit of measure.  Keep it high level.  We don't want to fall into the weeds of accounting for spices used acrossed grocery runs.</p>
    <div class="grocery-run-section">
        @if($grocery_run_selected)
            <h4>Update Grocery Run
                <a href="/grocery-runs/delete/{{$selected_grocery_run['id']}}">
                    <input type="button" value="Delete" id="grocery-run-delete-button" class="btn btn-primary btn-sm grocery-run-delete-button">
                </a>
            </h4>
        @else
            <h4>Add New Grocery Run</h4>
        @endif


        <form method="POST" action="/grocery-runs">
            {!! csrf_field() !!}
            @if($grocery_run_selected)
                <input type='hidden' value='{{ $selected_grocery_run['id'] }}' name='grocery_run_id'>
            @endif  
            <fieldset>
                @include('partials.errors')
                <div class="col-md-12 form-group">
                    <div class="col-md-4">
                        <label for="dt_grocery_run" class="grocery-run-select-dt-label">Select Date:</label>
                    </div>
                    <div class="grocery-run-input-date col-md-8">
                        @if($grocery_run_selected)
                            <input type='date' class="grocery-run-date-select" value="{{ old('dt_grocery_run',$selected_grocery_run['dt_grocery_run']) }}" name='dt_grocery_run' id="dt_grocery_run" >
                        @else
                            <input type='date' class="grocery-run-date-select" value="{{ old('dt_grocery_run', date("Y-m-j")) }}" name='dt_grocery_run' id="dt_grocery_run" > 
                        @endif 
                    </div>
                </div>

                <div class="col-md-12 form-group">
                    <div class="col-md-4 grocery-run-input-label">
                        <label for="total_amt">Total amount:</label>
                    </div>
                    <div class="col-md-8 input-group">
                    <div class="input-group-addon">$</div>
                        @if($grocery_run_selected)
                            <input type="number" step="any" name="total_amt" id="total_amt" class="form-control grocery-run-input" min="0" value="{{ old('total_amt',$selected_grocery_run['total_amt']) }}" onkeyup="getFoodAmount()" onmouseup="getFoodAmount()"> 
                        @else
                            <input type="number" step="any" name="total_amt" id="total_amt" class="form-control grocery-run-input" min="0" value="{{ old('total_amt',0) }}" onkeyup="getFoodAmount()" onmouseup="getFoodAmount()"> 
                        @endif 
                    </div>
                </div>     

                <div class="col-md-12 form-group">
                    <div class="col-md-4 grocery-run-input-label">
                        <label for="non_food_amt">Non-food :</label>
                    </div>
                    <div class="col-md-8 input-group">
                        <div class="input-group-addon">$</div>
                        @if($grocery_run_selected)
                            <input type="number" step="any" name="non_food_amt" id="non_food_amt" class="form-control grocery-run-input"  value="{{ old('non_food_amt',$selected_grocery_run['non_food_amt']) }}" onkeyup="getFoodAmount()" onmouseup="getFoodAmount()"> 
                        @else
                            <input type="number" step="any" name="non_food_amt" id="non_food_amt" class="form-control grocery-run-input"  value="{{ old('non_food_amt',0) }}" onkeyup="getFoodAmount()" onmouseup="getFoodAmount()">
                        @endif 
                    </div>
                </div>

                <div class="col-md-12 form-group">
                    <div class="col-md-4 grocery-run-input-label">
                        <label for="food_amt">Food amount:</label>
                    </div>
                    <div class="col-md-8  input-group">
                    <div class="input-group-addon">$</div>
                        @if($grocery_run_selected)
                            <input type="number" step="any" name="food_amt" id="food_amt" class="form-control grocery-run-input" value="{{ old('food_amt',$selected_grocery_run['food_amt']) }}" readonly> 
                        @else
                            <input type="number" step="any" name="food_amt" id="food_amt" class="form-control grocery-run-input"  value="{{ old('food_amt', 0) }}" readonly> 
                        @endif 
                    </div>
                </div>
            </fieldset>
            @if($grocery_run_selected)
                <input type="submit" value="Update" id="grocery-run-submit-button" class="btn btn-primary btn-sm grocery-run-save-btn">
            @else
                <input type="submit" value="Save" id="grocery-run-submit-button" class="btn btn-primary btn-sm grocery-run-save-btn">
            @endif
                <a href="/grocery-runs"><input type="button" value="Cancel" id="grocery-run-cancel-button" class="btn btn-primary btn-sm grocery-run-cancel-btn"/></a>
        </form>
    </div>
</div>

<div class="col-md-6">
    <h3>Definitions</h3>
    <div class="grocery-run-definitions">
        <p><strong>Total Amount:</strong> <br>The amount on the receipt rounded to the nearest dollar.</p>
        <p><strong>Non-Food Amount:</strong> <br>What you spent on things you don't eat, like cat litter. (unless you are Stimpy?)</p>
        <p><strong>Food Amount:</strong> <br>This is the number that your grocery run will reflect on the Gameboard.</p>
    </div>
    <div class="grocery-run-grid">
        <table  class="table table-condensed active table-hover">
            <caption>Your Grocery Runs
                <a href="/grocery-runs/"><input type="button" value="Add New" class="btn btn-primary btn-sm grocery-run-add-btn"/></a>
            </caption>
            <tr class="active">
                <th>Date (click date to edit)</th>
                <th>Total Amt</th>
                <th>Non Food Amt</th>
                <th>Food Amt</th>
            </tr>
            @foreach($user_grocery_runs as $grocery_run)
                <tr>
                    <td><a href="/grocery-runs/{{$grocery_run['id']}}">{{ $grocery_run['dt_grocery_run'] }}</a></td>
                    <td>${{ $grocery_run['total_amt'] }}</td> 
                    <td>${{ $grocery_run['non_food_amt'] }}</td>
                    <td>${{ $grocery_run['food_amt'] }}</td>
                </tr>
            @endforeach
            @if($user_grocery_runs->count()==0)
            <tr class="info grocery-run-grid-noresults">
                <td colspan="4">No Grocery Runs Entered Yet</td>
            </tr>
            @endif
        </table>  

    </div>
</div>
<!-- end main content section -->
@stop


@section('body')
<script type="text/javascript">
    function getFoodAmount() {
        var tot_food_amt = document.getElementById('total_amt').value;
        var non_food_amt = document.getElementById('non_food_amt').value;

        if (tot_food_amt == "")
            tot_food_amt = 0;
        if (non_food_amt == "")
            non_food_amt = 0;

        var food_amt = parseInt(tot_food_amt) - parseInt(non_food_amt);

        if (!isNaN(food_amt)) {
            document.getElementById('food_amt').value = food_amt;
        }
    }
</script>   
@stop