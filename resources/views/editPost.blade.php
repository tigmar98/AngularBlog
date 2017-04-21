@extends('layouts.app')

@section('content')
	
	@include('common.errors')

	{!! Form::model($post, array('url' => 'postedit/'.$post->id, 'method' => 'get'))!!}		
		{!!Form::text('postTopic')!!}
		{!!Form::text('post')!!}
		{!!Form::submit('Edit')!!}
	{!!Form::close()!!}

@endsection
