@extends("login")
@section("content")
  {{ Form::open(array('class' => 'form-signin')) }}
  @if($errors->has())  
    @foreach($errors->all() as $message)
		<div class="alert alert-info">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  {{ $message }}	
		</div>
    @endforeach	
	@endif
    {{ Form::label("username", "Username") }}
    {{ Form::text("username", Input::old("username"), array('class' => 'form-control')) }}
    {{ Form::label("password", "Password") }}
    {{ Form::password("password",  array('class' => 'form-control')) }}
    {{ Form::submit("login", array('class' => 'btn btn-large btn-info')) }}
  {{ Form::close() }}
  
@stop
