@extends('layouts.app')


@section('content')
	
	@include('common.errors')

	{!! Form::open(['url' => '/post'])!!}
        {!! Form::text('postTopic', 'Post Topic...')!!}
        {!! Form::text('post', 'Post')!!}
        {!! Form::hidden('categoriesId', $catId)!!}
        {!! Form::submit('Add new post', array('class' => 'btn btn-success'))!!}
        {{ csrf_field() }}
    {!! Form::close()!!} 
	
@endsection
