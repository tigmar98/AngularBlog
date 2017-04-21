@extends('layouts.app')

@section('navbar')
    <li>
        {!! Form::open(['url' => '/showallposts', 'method' => 'get']) !!}
            {!! Form::submit('Posts', array('class' => 'allPostButton'))!!}
        {!! Form::close() !!}
    </li>
@endsection

@section('content')
    {!! Form::open(['url' => '/imageupload', 'method' => 'put', 'files' => true]) !!}
    	{!! Form::file('image') !!}
    	{!! Form::submit('Add Profile Picture') !!}
    	{{  csrf_field() }}
    {!! Form::close() !!}
@endsection 