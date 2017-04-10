@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Posts</div>

                <div class="panel-body">

                    @include('common.errors')


                    <form action="/home" method="post" class="form-horizontal">
                        <div class="form-group col-sm-6">
                            <input type="text" name="postTitle" class="form-control" placeholder="Post Title...">
                        </div>
                        <div class="form-group col-sm-4">
                            <textarea name="postBody" rows="4" col="6"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>

               
                 <!--<p>{{ $posts }}</p>-->
                
                <ul class="list-group">
                    @foreach($posts as $post)
                        <li class="list-group-item">
                            {{$post['post_topic']}} 
                            <form action="/home/{{$post->id}}" method="post" class="pull-right">
                                {{csrf_field()}}
                                {{method_field('Delete')}}
                                <button class="btn btn-warning">Delete</button>
                            </form> 
                        </li>
                    @endforeach
                </ul>

                {{Auth::user()}}

            </div>
        </div>
    </div>
</div>
@endsection
