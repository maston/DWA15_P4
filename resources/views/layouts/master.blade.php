<!DOCTYPE html>
<html lang="en">
<head>
	<title>LunchMoneyGame</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Sarah Maston">
	<meta name="keywords" content="obesity, save money, diet, health game, health tracker">
	<meta name="description" content="Game that helps you change your eating behaviors... etc..">

	<!-- CSS Links -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet"  type="text/css" href="https://code.jquery.com/ui/1.11.4/themes/eggplant/jquery-ui.css" media="all" />
	<link rel="stylesheet" href="css/lavish-bootstrap.css">
	<link rel="stylesheet" href="/css/site.css">
  
	<!-- jQuery v1.11.2 -->
	<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>	
	<!-- jQueryUI v1.11.4 -->
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<!-- jquery-moment.js - jQuery Plugin to format Date src: momentjs.com v2.9.0 -->
	<script src="js/moment.min.js"></script>
</head>

<body>
<!-- begin bootstrap container -->
<div class="container"> 


<!--  begin header -->
<header class="row">
		{{-- Main page nav will be yielded here --}}
        @yield('nav')
</header>
<!--  end header -->
<section class="row kpi-bar">

		@if(Auth::check())
	<div class="col-md-12">
		<span class="kpi-total-save">Total You've Saved : a number</span>
		<span class="kpi-global-total-save">All Players : some other number</span>
	</div>
		@else
	<div class="col-md-12">
		<span class="kpi-global-total-save">Global Save :: number that is updating</span>
	</div>
		@endif
</section>
        
@yield('game_board_grocery_run_info')

<main class="row">
    @if(\Session::has('flash_message'))
        <div class='flash_message'>
            {{ \Session::get('flash_message') }}
        </div>
    @endif
		{{-- Main page content will be yielded here --}}
        @yield('content')

</main>


<!-- begin footer -->
<footer class="row">
	<p class="col-md-12" id="footer-copyright">
		&copy;2015 LunchMoneyGame.com
	</p>
</footer>
<!-- end footer -->

</div>
    {{-- Yield any page specific JS files or anything else you might want at the end of the body --}}
    @yield('body')
</body>

</html>
