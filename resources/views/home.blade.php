@extends('layouts.app')

@section('links')
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/home_style.css') }} ">
@endsection


@section('navbar')
    <li>
        {!! Form::open(['url' => '/showallposts', 'method' => 'get']) !!}
            {!! Form::submit('Posts', array('class' => 'all_post_button'))!!}
        {!! Form::close() !!}
    </li>
@endsection


@section('content')
    <div class="container">
        
        <div class="row">
            <div class="col-sm-4">
                <img src="{{$image_path}}" class="profile_pic">
                @if($viaFacebook === 0 )
                    <form action="/imageupload" method="POST" enctype="multipart/form-data">
                        <!--<input type="text" name="inp">-->
                        <input type="file" name="image">
                        <button type="submit">Add photo</button>
                        {{method_field('PUT')}}
                        {{ csrf_field() }}
                    </form>
                @endif
            </div>
        </div>


        <div class="row">

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Categories</div>
                    <div class="panel-body">
                        <div>
                            <form action="/category" method="POST">
                                {{ csrf_field() }}
                                <input type="text" name="categoryName" required>
                                <button type="submit" class="btn btn-primary">Add A New Category</button>
                            </form>
                        </div>
                        <ul class="list-group">
                            @foreach($categories as $category)
                               <li class="list-group-item"> 
                                    <form action="/home/{{$category->id}}" method="GET" style="display:inline">
                                        <button type="submit" class="btn btn-primary catButt">{{$category->category}}</button>
                                    </form>
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

            @include('common.errors')

            @if(isset($posts))
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">Posts</div>

                        <div class="panel-body">
                            <div>
                                {!! Form::open(['url' => '/home'])!!}
                                    {!! Form::text('post_topic', 'Post Topic...')!!}
                                    {!! Form::text('post', 'Post')!!}
                                    {!! Form::hidden('categories_id', "$cat_id")!!}
                                    {!! Form::submit('Add new post', array('class' => 'btn btn-success'))!!}
                                    {{ csrf_field() }}
                                {!! Form::close()!!} 
                            </div>
                            <ul class="list-group">
                                @foreach($posts as $post)
                                    <li class="list-group-item" style="text-align:left">
                                        <p class="post_p">
                                           <strong><span class="post_topic">{{$post->post_topic}}</span></strong>
                                           <span class="post">{{$post->post}}</span>
                                        </p>
                                              
                                        {!! Form::open(['url' => '/home/'.$post->id]) !!}
                                            {!! Form::submit('Delete', array('class' => 'btn btn-danger pull-right')) !!}
                                            {{method_field('Delete')}}
                                            {{csrf_field()}}
                                        {!! Form::close() !!}

                                        {!! Form::open(['url' => '/home/'.$post->id.'/edit', 'method' =>'get']) !!}
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
