@if(count($errors) > 0)
<div class="alert alert-danger" role="alert">Please review errors:
    <ul class='errors'>
        @foreach ($errors->all() as $error)
			<li><span class='fa fa-exclamation-circle'></span> {{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif