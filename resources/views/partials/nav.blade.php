	<nav class="navbar navbar-inverse">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span> 
	      </button>
	      <a class="navbar-brand" href="/">LunchMoneyGame</a>
	      <!-- <a class="navbar-brand" href="#"><img alt="Brand" src="logo_toolbar.png"></a> -->
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	    @if(Auth::check())
	      <ul class="nav navbar-nav">
	          <li class= {{ $nav_gameboard }} ><a href="/game-board">Your Gameboard</a></li>
	          <li class= {{ $nav_grocery_run }} ><a href="/grocery-runs">Grocery Runs</a></li>
	          <li class= {{ $nav_metrics }} ><a href="/metrics">Metrics</a></li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
<!-- 	      	<li><a href="#">Coaching Corner</a></li> -->
	        <li class= {{ $nav_settings }}><a href="/settings"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
			<li><p class="navbar-text navbar-right">Hello, {{$user_info['name']}} <span class="glyphicon glyphicon-user"></span>  (<a href="/logout" class="navbar-link">logout</a>)</p>
            </li>
	      </ul>
	    @else
	  <ul class="nav navbar-nav">
	          <li class= {{ $nav_gameboard }} ><a href="#">The Problem</a></li>
	          <li class= {{ $nav_grocery_run }} ><a href="#">How To Play</a></li>
	          <li class= {{ $nav_metrics }} ><a href="#">About Us</a></li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li class= {{ $nav_register }} ><a href="/register"><span class="glyphicon glyphicon-pencil"></span>  Register</a></li>
			<li class= {{ $nav_login }} ><a href="/login"><span class="glyphicon"></span>Login</a></li>
            </li>
	      </ul>
	    @endif
<!-- <p class="navbar-text navbar-right">Signed in as Sarah.<a href="#" class="navbar-link">logout</a></p> -->
	    </div>
	</nav>