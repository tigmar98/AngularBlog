@extends('layouts.app')

@section('links')
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/style.css') }} ">
@endsection

@section('scripts')
    <script type="text/javascript" src=" {{ asset('js/script.js') }} "></script>
@endsection

@section('navbar')
    <a href="#">Posts</a>
@endsection


@section('content')
<div class="container">
    
<!--
    <div class="row">
        <div class="col-sm-4">
            <form action="/imageupload" method="post">
                {{ csrf_field() }}
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
                    <div>
                        <form action="/category" method="post">
                            {{ csrf_field() }}
                            <input type="text" name="categoryName" required>
                            <button type="submit" class="btn btn-primary">Add A New Category</button>
                        </form>
                    </div>
                    <ul class="list-group">
                        @foreach($categories as $category)
                           <li class="list-group-item"> 
                                <form action="/home/{{$category->id}}" method="get" style="display:inline">
                                    <button type="submit" class="btn btn-primary catButt">{{$category->category}}</button>
                                </form>
                                <form action="/category/{{$category->id}}" method="post" class="pull-right" style="display:inline">
                                     {{csrf_field()}}
                                     {{method_field('Delete')}}
                                     <button type="submit" class="btn btn-danger btnDel">Delete</button>
                                </form>
                                <form  class="pull-right" style="display:inline">
                                        <!--<input type="hidden" name="_method" value="PUT"> -->
                                        <input type="hidden" name="hidId" value="{{$category->id}}" class="hidCatId">
                                        <button type="button" class="btn btn-warning editCat">Edit</button>
                                        {{method_field('PUT')}}
                                        {{csrf_field()}}
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        @if(isset($posts))
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Posts</div>

                <div class="panel-body">

                    @include('common.errors')
                    <div>
                        <form action="/home" method="post">
                            <div class="form-group col-sm-3">
                                <input type="text" name="postTitle" class="form-control" placeholder="Post Title...">
                            </div>
                            <input type="hidden" name="categories_id" value="{{$cat_id}}">
                            <div class="form-group col-sm-4">
                                <textarea name="postBody" rows="2" col="6"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add a new post</button>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                      <ul class="list-group">
                            @foreach($posts as $post)
                                <li class="list-group-item" style="text-align:left">
                                    <p class="postP">
                                        <strong><span class="postTopic">{{$post->post_topic}}</span></strong>
                                        <span class="postBody">{{$post->post}}</span>
                                    </p>
                                    <form action="/home/{{$post->id}}" method="post" class="pull-right delForm" style="display:inline">
                                        {{csrf_field()}}
                                        {{method_field('Delete')}}
                                        <button class="btn btn-danger delete">Delete</button>
                                    </form> 
                                    <form  class="pull-right" style="display:inline">
                                        <!--<input type="hidden" name="_method" value="PUT"> -->
                                        <input type="hidden" name="hidId" class="hidPostId" value="{{$post->id}}">
                                        <button type="button" class="btn btn-warning edit">Edit</button>
                                        {{method_field('PUT')}}
                                        {{csrf_field()}}
                                    </form>
                                </li>
                            @endforeach
                    </ul>
                </div>
             </div>            
        </div>           
      @endif          
                
                <!-- {{Auth::user()['id']}} -->
 </div>
                

</div>
@endsection
