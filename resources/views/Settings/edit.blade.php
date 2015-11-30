@extends('layouts.master')

@section('nav')
  @include('layouts.nav', [$nav_gameboard = '', $nav_grocery_run = '', $nav_metrics = '', $nav_settings = 'active', $nav_register = '', $nav_login = ''])
@stop

@section('content')
<!-- start main content section -->
<!-- settings form section  -->
<div class="col-md-6">
  <form class="settings-form" method="POST" action="/settings">
    <input type='hidden' value='{{ csrf_token() }}' name='_token'>
    <fieldset>
    	<legend>Settings :: Average Spend (in dollars)</legend>
      <div class="form-group">
        <label for="bfast_spend">Breakfast :</label>
        <div class="input-group">
          <div class="input-group-addon">$</div>
          <input type="number" class="form-control spend-input" name="bfast_spend" id="bfast_spend" placeholder="Amount" value="{{ old('bfast_spend',$user_info['bfast_spend']) }}">
        </div>
      </div>

      <div class="form-group">
        <label  for="lunch_spend">Lunch :</label>
        <div class="input-group">
          <div class="input-group-addon">$</div>
          <input type="number" class="form-control spend-input" name="lunch_spend" id="lunch_spend" placeholder="Amount" value="{{ old('lunch_spend',$user_info['lunch_spend']) }}">
        </div>
      </div>

      <div class="form-group">
        <label  for="dinner_spend">Dinner :</label>
        <div class="input-group">
          <div class="input-group-addon">$</div>
          <input type="number" class="form-control spend-input" name="dinner_spend" id="dinner_spend" placeholder="Amount" value="{{ old('dinner_spend',$user_info['dinner_spend']) }}">
        </div>
      </div>

      <div class="form-group">
        <label  for="coffee_spend">Coffee :</label>
        <div class="input-group">
          <div class="input-group-addon">$</div>
          <input type="number" class="form-control spend-input" name="coffee_spend" id="coffee_spend" placeholder="Amount" value="{{ old('coffee_spend',$user_info['coffee_spend']) }}">
        </div>
      </div>

      <div class="form-group">
        <label for="zipcode">Zipcode <span>(optional)</span>:</label>
        <div class="input-group">
          <input type="text" name="zipcode" id="zipcode" class="form-control spend-input" value="{{ old('zipcode',$user_info['zipcode']) }}"> 
        </div>
      </div>
    </fieldset>
    <input type="submit" value="Save Settings" class="btn btn-primary settings-save-btn">
  </form>
</div>
<!-- settings instructions section -->
<div class="col-md-6">
  <div class="settings-info">
    <h3>Settings Instructions</h3>
    <h4 class="settings-info-header">What is "average spend"?</h4>
    <p class="settings-info-text">The average spend is the amount of money you would normal spend on the type of meal by ordering it.<br>
      <span class="settings-info-defaulted">We have defaulted these values and you can adjust them later if you like.<span>
    </p> 

    <h4 class="settings-info-header">An Example</h4>
    <img src="/img/take-out.png" class="settings-info-takeout-img">
    <p class="settings-info-text">When I order Indian Food or pizza for dinner, and wait 45 minutes for it to show up, it costs me about $20.<br>
      That is my average spend for ordering a meal. <br>
      Coffee at the shop costs me about $2.50 for a medium.  (Though maybe with the lattes it's about $4.)
    </p>

    <h4 class="settings-info-header">Hey! Why are you asking me for a zipcode??</h4>
    <img src="/img/earth.png" class="settings-info-earth-img">
    <p class="settings-info-text">I'll tell you.  We have grouped you by your Zipcode for your "National Team."  You are welcome to be in the anonymous
      bucket, (we will still count your savings towards the national population savings).  <br>
      But should you decide to give us a zipcode we can get you on "<a href="#">the map</a>" and 
      you contribute to the local leaderboards. (coming soon!)</p>
    </div>
</div>
<!-- end main content section -->
@stop
