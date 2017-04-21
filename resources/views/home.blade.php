@extends('layouts.app')

@section('links')
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/homeStyle.css') }} ">
@endsection


@section('navbar')
    <li>
        {!! Form::open(['url' => '/showallposts', 'method' => 'get']) !!}
            {!! Form::submit('Posts', array('class' => 'allPostButton'))!!}
        {!! Form::close() !!}
    </li>
@endsection


@section('content')
    <div class="container">
        
        <div class="row">
            <div class="col-sm-4">
                <img src="{{$imagePath}}" class="profilePic">
            </div>
        </div>
        {!! Form::open(['url' => '/imageuploadform', 'method' => 'get']) !!}
            {!! Form::submit('Upload Image') !!}
        {!! Form::close() !!}


        <div class="row">

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Categories</div>
                    <div class="panel-body">
                        <div>
                            {!! Form::open(['url' => '/category/create', 'method' => 'get']) !!}
                                {!! Form::submit('Add Category', array('class' => 'btn btn-success')) !!}
                            {!! Form::close() !!}
                        </div>
                        <div>
                            <ul class="list-group">
                                @foreach($categories as $category)
                                   <li class="list-group-item"> 
                                        {!! Form::open(['url' => '/home/'.$category->id, 'method' => 'get']) !!}
                                            {!! Form::submit($category->category, array('class' => 'btn btn-primary catButt')) !!}
                                        {!! Form::close() !!}
                                        {!! Form::open(['url' => '/category/'.$category->id, 'method' => 'delete']) !!}
                                            {!! Form::submit('Delete', array('class' => 'btn btn-danger pull-right')) !!}
                                            {{csrf_field()}}
                                        {!! Form::close() !!}
                                        {!! Form::open(['url' => '/category/'.$category->id.'/edit', 'method' => 'get']) !!}
                                            {!! Form::submit('Edit', array('class' => 'btn btn-warning pull-right')) !!}
                                            {{csrf_field()}}
                                        {!! Form::close() !!}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                @include('common.errors')
            </div>
            @if(isset($posts))
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">Posts</div>

                        <div class="panel-body">
                            <div>
                                {!! Form::open(['url' => '/post/create', 'method' => 'get']) !!}
                                    {!! Form::submit('Create new post', array('class' => 'btn btn-success'))!!}
                                    {!! Form::hidden('catId', $catId) !!}
                                {!! Form::close()!!}
                            </div>
                            <ul class="list-group">
                                @foreach($posts as $post)
                                    <li class="list-group-item" style="text-align:left">
                                        <p class="postP">
                                           <strong><span class="post_topic">{{$post->postTopic}}</span></strong>
                                           <span class="post">{{$post->post}}</span>
                                        </p>
                                              
                                        {!! Form::open(['url' => '/post/'.$post->id]) !!}
                                            {!! Form::submit('Delete', array('class' => 'btn btn-danger pull-right')) !!}
                                            {{method_field('Delete')}}
                                            {{csrf_field()}}
                                        {!! Form::close() !!}

                                        {!! Form::open(['url' => '/post/'.$post->id.'/edit', 'method' =>'get']) !!}
                                            {!! Form::submit('Show Post', array('class' => 'btn btn-warning pull-right')) !!} 
                                            {{csrf_field()}}
                                        {!! Form::close() !!}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>            
                </div>           
            @endif        
                    
        </div>
    </div>
@endsection
