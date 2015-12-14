<section class="row kpi-bar">

		@if(Auth::check())
	<div class="col-md-12">
		<span class="kpi-total-save">Total You've Saved : ${{$user_total_save}}</span>
		<span class="kpi-global-total-save">All Players : ${{$game_total_save}}</span>
	</div>
		@else
	<div class="col-md-12">
		<span class="kpi-global-total-save">Global Save :: number that is updating</span>
	</div>
		@endif
</section>