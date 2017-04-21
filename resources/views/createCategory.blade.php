@extends('layouts.app')


@section('content')
	
	@include('common.errors')

	{!! Form::open(['url' => '/category']) !!}
    	{!! Form::text('categoryName') !!}
        {!! Form::submit('Add A New Category', array('class' => 'btn btn-success')) !!}
        {{ csrf_field() }}
    {!! Form::close() !!}
	
@endsection
