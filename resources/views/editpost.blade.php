@extends('layouts.app')

@section('content')
	
	@include('common.errors')

	{!! Form::model($post, array('url' => 'postedit/'.$post->id, 'method' => 'get'))!!}
		
		{!!Form::text('post_topic')!!}
		{!!Form::text('post')!!}
		{!!Form::submit('Edit')!!}
	{!!Form::close()!!}

@endsection
