@extends('layouts.master')

@section('nav')
  @include('layouts.nav', [$nav_gameboard = '', $nav_grocery_run = 'active', $nav_metrics = '', $nav_settings = '', $nav_register = '', $nav_login = ''])
@stop

@section('content')
   
<!-- begin main content section -->
  <div class="col-md-6">
    <div class="grocery-listing">
        <h3>Grocery Run</h3> 
        <h4>Instructions</h4>
        <p>A grocery run is your main unit of measure.  Keep it high level.  We don't want to fall into the weeds of accounting for spices used acrossed grocery runs.</p>

    </div>

    <form class="grocery-run-form" method="POST" action="/grocery-runs">
    <input type='hidden' value='{{ csrf_token() }}' name='_token'>
    @if($grocery_run_selected)
        <input type='hidden' value='{{ $selected_grocery_run['id'] }}' name='grocery_run_id'>
    @endif  
        <fieldset>

                @if($grocery_run_selected)
                    <legend>Update Grocery Run</legend>
                @else
                    <legend>Add New Grocery Run</legend>
                @endif

            <label for="dt_grocery_run">Grocery Run Date:</label>
	           @if($grocery_run_selected)
	            	<input type='date' value="{{ old('dt_grocery_run',$selected_grocery_run['dt_grocery_run']) }}" name='dt_grocery_run' id="dt_grocery_run" >
	            @else
	                <input type='date' value="{{ old('dt_grocery_run', date("Y-m-j")) }}" name='dt_grocery_run' id="dt_grocery_run" > 
	            @endif 
            <br>
            
            <label for="total_amt">Total amount :</label>
	            @if($grocery_run_selected)
	            	<input type="number" name="total_amt" id="total_amt" class="input-num-parameter"  value="{{ old('total_amt',$selected_grocery_run['total_amt']) }}" onkeyup="getFoodAmount()"> 
	            @else
	                <input type="number" name="total_amt" id="total_amt" class="input-num-parameter"  value="{{ old('total_amt',0) }}" onkeyup="getFoodAmount()"> 
	            @endif       
            <br>


            <label for="non_food_amt">Non-food amount : (e.g., Cat Litter)</label>
	            @if($grocery_run_selected)
	            	<input type="number" name="non_food_amt" id="non_food_amt" class="input-num-parameter"  value="{{ old('non_food_amt',$selected_grocery_run['non_food_amt']) }}" onkeyup="getFoodAmount()"> 
	            @else
	                <input type="number" name="non_food_amt" id="non_food_amt" class="input-num-parameter"  value="{{ old('non_food_amt',0) }}" onkeyup="getFoodAmount()">
	            @endif 
	        <br>

			<label for="food_amt">Food amount:</label>
		  	@if($grocery_run_selected)
		  		<input type="number" name="food_amt" id="food_amt" class="" value="{{ old('food_amt',$selected_grocery_run['food_amt']) }}" readonly> 
			@else
		    	<input type="number" name="food_amt" id="food_amt" class=""  value="{{ old('food_amt', 0) }}" readonly> 
			@endif 


<!--             <br> -->
<!--             <div class="input-group">
           	<div class="input-group-addon">Food amount :</div>
            @if($grocery_run_selected)
            	<input type="number" name="food_amt" id="food_amt" class="input-num-parameter" aria-label="Amount (to the nearest dollar)" value="{{ old('food_amt',$selected_grocery_run['food_amt']) }}" readonly> 
            @else
                <input type="number" name="food_amt" id="food_amt" class="input-num-parameter" aria-label="Amount (to the nearest dollar)" value="{{ old('food_amt',0) }}" readonly> 
            @endif 
            </div> -->

        </fieldset>

        <input type="submit" value="Save" id="settings-submit-button" class="btn btn-primary btn-sm">
        <a href="/grocery-runs">
            <input type="button" value="Cancel" class="btn btn-primary btn-sm"/>
        </a>
    </form>
          <h4>Definitions</h4>
        <p>Total Amount: The amount on the receipt rounded to the nearest dollar.</p>
        <p>Non-Food Amount: What you spent on things you don't eat, like cat litter. (unless you are Stimpy?)</p>
        <p>Food Amount: This is the number that your grocery run will reflect on the Gameboard, we will count your meal counts against.</p>
  </div>
  <div class="col-md-6">
<h3>Your Grocery Runs (click date to edit)</h3> 
    <table  class="table table-condensed active table-hover">
<!--         <caption>Your Grocery Runs</caption> -->
        <tr class="active">
            <th>Date</th>
            <th>Total Amt</th>
            <th>Non Food Amt</th>
            <th>Food Amt</th>
        </tr>
    @foreach($user_grocery_runs as $grocery_run)
        <!-- <tr onClick="getGroceryRunDeets({{$grocery_run['id']}}">{{ $grocery_run['dt_grocery_run'] }})"> -->
        <tr>
            <td><a href="/grocery-runs/{{$grocery_run['id']}}">{{ $grocery_run['dt_grocery_run'] }}</a></td>
            <td>${{ $grocery_run['total_amt'] }}</td> 
            <td>${{ $grocery_run['non_food_amt'] }}</td>
            <td>${{ $grocery_run['food_amt'] }}</td>
        </tr>
    @endforeach
    </table>
    <a href="/grocery-runs/">
        Add New
    </a>
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

	       var result = parseInt(tot_food_amt) - parseInt(non_food_amt);

	       if (!isNaN(result)) {
	           document.getElementById('food_amt').value = result;
	       }
	   }
	</script>   
@stop