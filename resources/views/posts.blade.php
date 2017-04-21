@extends('layouts.app')

@section('links')
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/posts_style.css') }} ">
@endsection

@section('navbar')
    <li>
        <a href="/posts">Posts</a>
    </li>
@endsection

@section('content')
	
	<ul class="list-group">
		@foreach($posts as $post)
			<li class="list-group-item">
				<strong><span class="post_topic">{{$post->post_topic}}</span></strong>
				<span class="pull-right category_span">{{$post->category}}</span>
				<strong><span class="pull-right">{{$post->creator}} :</span></strong><br>
				<span class="post">{{$post->post}}</span>
				@if($post->can_edit === 1)
					{!! Form::open(['url' => '/post/'.$post->id, 'method' => 'delete'])!!}
						{!! Form::submit('Delete', array('class' => 'btn btn-danger pull-right')) !!}
					{!! Form::close()!!}

					{!! Form::open(['url' => '/post/'.$post->id.'/edit', 'method' =>'get']) !!}
                        {!! Form::submit('Show Post', array('class' => 'btn btn-warning pull-right')) !!} 
                    	{{csrf_field()}}
                    {!! Form::close() !!}
				@endif
			</li>
		@endforeach
	</ul>

@endsection