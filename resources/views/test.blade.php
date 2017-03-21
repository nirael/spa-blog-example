@extends('layouts.app')


@section('content')

<form class='form-horizontal'  method="POST" action="{{ url('/posts/') }}">
CREATE
  <div class='form-group'>
  Name:<br>
  	<input type="hidden" name='_token' value='{{ csrf_token() }}'>
  	 
     <input class='form-control' name='name' required>
  Contents:<br>
  	 <textarea  class='form-control' cols='10' rows='20' name='content' required></textarea>
  <button type="submit" class='btn btn-success'>Submit </button>
  </div>
</form>

<form class='form-horizontal' method="POST" action="{{ url('/posts/32/') }}">
UPDATE
  <div class='form-group'>
  Name:<br>
  	<input type="hidden" name='_token' value='{{ csrf_token() }}'>
  	  {{ method_field("PUT") }}
     <input class='form-control' name='name' required>
  Contents:<br>
  	 <textarea  class='form-control' cols='10' rows='20' name='content' required></textarea>
  <button type="submit" class='btn btn-success'>Submit </button>
  </div>
</form>

<form class='form-horizontal' method="POST" action="{{ url('/posts/45/') }}">
DELETE
  <div class='form-group'>
  Name:<br>
  	<input type="hidden" name='_token' value='{{ csrf_token() }}'>
  	 {{ method_field("DELETE") }}
    
  <button type="submit" class='btn btn-success'>Submit </button>
  </div>
</form>

<a href="{{ url('/posts/') }}">All</a>
<a href="{{ url('/posts/32/') }}">32</a>
@stop