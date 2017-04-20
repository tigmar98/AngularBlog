@extends('layouts.app')

@section('links')
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/posts_style.css') }} ">
@endsection

@section('scripts')
    <script type="text/javascript" src=" {{ asset('js/posts_script.js') }} "></script>
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
				<input type="hidden" name="id" class="post_id" value="{{$post->id}}">
				<input type="hidden" name="can_edit" class="can_edit" value="{{$post->can_edit}}">
				<span class="post">{{$post->post}}</span>
				{!! Form::open(['url' => '/posts/'.$post->id, 'method' => 'delete'])!!}
					{!! Form::submit('Delete', array('class' => 'btn btn-danger pull-right')) !!}
				{!! Form::close()!!}
			</li>
		@endforeach
	</ul>

@endsection