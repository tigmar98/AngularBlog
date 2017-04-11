@extends('layouts.app')

@section('content')
<div class="container">
    
<!--
    <div class="row">
        <div class="col-sm-4">
            <form action="/imageupload" method="post">
                <input type="file" name="img">
                <button type="submit">Add photo</button>
            </form>
        </div>
    </div>
-->

    <div class="row">

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Categories</div>
                <div class="panel-body">
                    <div class="">
                        <form action="/category" method="post">
                            <input type="text" name="categoryName" required>
                            <button type="submit" class="btn btn-primary">Add A New Category</button>
                        </form>
                    </div>
                    @foreach($categories as $category)
                        {{$category->category}}  <br>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Posts</div>

                <div class="panel-body">

                    @include('common.errors')

                    <form action="/home" method="post" class="col-sm-10">
                        <div class="form-group col-sm-3">
                            <input type="text" name="postTitle" class="form-control" placeholder="Post Title...">
                        </div>
                        <div class="form-group col-sm-6">
                            <textarea name="postBody" rows="2" col="6"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
        </div>            
    </div>           
                
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

                <!-- {{Auth::user()['id']}} -->
        </div>
</div>
@endsection
