<!DOCTYPE html>
<html lang="en">
	<head>
		<title>LunchMoneyGame</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Sarah Maston">
		<meta name="keywords" content="obesity, save money, diet, health game, health tracker, cook at home">
		<meta name="description" content="The LunchMoneyGame helps people effortlessly change their habits and approach to how much they spend on food and coffee. It begins with a simple pasta dinner cooked at home or bringing a cup of coffee in a travel mug. These little steps add up, and this app proves it. And as you see these little bits turn into something bigger, the motivation to keep going adds up.">

		<!-- CSS Links -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/lavish-bootstrap.css">
		<link rel="stylesheet" href="/css/site.css">
	  
		<!-- jQuery v1.11.2 -->
		<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>	
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

			@yield('kpi-bar')
			        
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
