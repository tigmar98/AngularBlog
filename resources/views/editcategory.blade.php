@extends('layouts.app')


@section('content')
	
	@include('common.errors')

	{!! Form::model($category, array('url' => 'categoryedit/'.$category->id, 'method' => 'get'))!!}	
		{!!Form::text('category')!!}
		{!!Form::submit('Edit')!!}
	{!!Form::close()!!}
	
@endsection
