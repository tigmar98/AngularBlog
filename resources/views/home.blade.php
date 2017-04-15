@extends('layouts.app')

@section('links')
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/home_style.css') }} ">
@endsection

@section('scripts')
    <script type="text/javascript" src=" {{ asset('js/home_script.js') }} "></script>
@endsection

@section('navbar')
    <li>
        <!--<a href="/posts">Posts</a>-->
        <form action="/posts/{{Auth::user()['id']}}" method="GET">
            <button type="submit" class="all_post_button">Posts</button>
            {{ csrf_field() }}
        </form>
    </li>
@endsection


@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-sm-4">
            <img src="/images/{{$image_path}}" class="profile_pic">
            <form action="/imageupload" method="POST" enctype="multipart/form-data">
                <!--<input type="text" name="inp">-->
                <input type="file" name="image">
                <button type="submit">Add photo</button>
                {{method_field('PUT')}}
                {{ csrf_field() }}
            </form>
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
                                <form action="/category/{{$category->id}}" method="POST" class="pull-right" style="display:inline">
                                     {{csrf_field()}}
                                     {{method_field('Delete')}}
                                     <button type="submit" class="btn btn-danger btn_del">Delete</button>
                                </form>
                                <form  class="pull-right" style="display:inline">
                                        <!--<input type="hidden" name="_method" value="PUT"> -->
                                        <input type="hidden" name="hidId" value="{{$category->id}}" class="hidCatId">
                                        <button type="button" class="btn btn-warning edit_cat">Edit</button>
                                        {{method_field('PUT')}}
                                        {{csrf_field()}}
                                </form>
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

                    @include('common.errors')
                    <div>
                        <form action="/home" method="POST">
                            <div class="form-group col-sm-3">
                                <input type="text" name="post_topic" class="form-control" placeholder="Post Title..." required>
                            </div>
                            <input type="hidden" name="categories_id" value="{{$cat_id}}">
                            <div class="form-group col-sm-4">
                                <textarea name="post" rows="2" col="6" required></textarea>
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
                                    <p class="post_p">
                                        <strong><span class="post_topic">{{$post->post_topic}}</span></strong>
                                        <span class="post">{{$post->post}}</span>
                                    </p>
                                    <form action="/home/{{$post->id}}" method="POST" class="pull-right del_form" style="display:inline">
                                        {{csrf_field()}}
                                        {{method_field('Delete')}}
                                        <button class="btn btn-danger delete">Delete</button>
                                    </form> 
                                    <form  class="pull-right" style="display:inline">
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
                
                
 </div>
                

</div>
@endsection
