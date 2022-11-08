@extends('app.base')

@section('content')
<div class="border-bottom">
    <div class="subnav w-50 m-auto">
        <ul class="list-group list-group-horizontal text-uppercase font-weight-bold">
            <li class="list-inline-item mr-4 pt-3 pb-3"><a href="{{ url('user/' . $user->id) }}" class="pt-3 pb-3 ">Overview</a></li>
            <li class="list-inline-item mr-4 pt-3 pb-3 active"><a href="{{ url('user/' . $user->id . '/posts') }}" class="pt-3 pb-3">Posts</a></li>
            <li class="list-inline-item pt-3 pb-3"><a href="{{ url('user/' . $user->id . '/comments') }}" class="pt-3 pb-3">Comments</a></li>
        </ul>
    </div>
</div>

<div class="d-flex align-items-center">
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row mb-5">
            <div class="col-md-3 border-right d-flex justify-content-end pr-5">
                <div class="d-flex flex-column pb-5 mb-5 align-items-center w-50">
                    <img class="rounded-circle mt-5" width="150px" src="{{ $user->image }}">
                    <span class="font-weight-bold">{{ $user->name }}</span><span class="text-black-50">{{ $user->email }}</span><span class="text-black-50">{{ $user->birthdate }}</span>
                </div>
            </div>
            <div class="col-md-8 border-right overflow-auto" style="height: 75.1vh;">
            @error('postDeleteError')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('postTimeError')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @foreach($posts as $post)
                <div class="card mt-2">
                    <div class="card-body p-2 p-sm-3">
                        <div class="media forum-item">
                            <a href="#" data-toggle="collapse" data-target=".forum-content"><img src="{{ $post->user->image }}" class="mr-3 rounded-circle" width="50" alt="User" /></a>
                            <div class="media-body">
                                <h6 class="text-body" style="font-size: 1.2em;">{{ $post->title }} <--> <a href="{{ url('category/' . $post->category->id) }}" class="text-primary">{{ $post->category->name }}</a></h6>
                                <p class="text-secondary">
                                    {{ $post->message }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center align-middle">
                                    <p class="text-muted" style="margin: 0;"><span class="text-primary" >{{ $user->name }}</span> posted on <span class="text-secondary font-weight-bold">{{ $post->created_at }}</span></p>
                                    @php
                                        $mytime = Carbon\Carbon::now('+1:00');
                                        $limitTime = Carbon\Carbon::createFromDate($post->created_at)->addMinutes(5);
                                    @endphp
                                    @if($limitTime > $mytime && session()->has('user') && session('user')->name == $user->name)
                                    <div>
                                        <button id="edit{{ $post->id }}" data-toggle="modal" data-target="#editPostModal" data-title="{{ $post->title }}" data-message="{{ $post->message }}" data-url="{{ url('post/' . $post->id) }}" class="editButton btn btn-outline-warning comments">Edit</button>
                                        <button data-toggle="modal" data-target="#deleteModal" data-url="{{ url('post/' . $post->id) }}" class="deleteButton btn btn-outline-danger comments ml-3">Delete</button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="text-muted small text-center">
                                <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> {{ mt_rand(1, 100) }}</span>
                                <span><i class="far fa-comment ml-2"></i> {{ count($post->comments) }}</span>
                            </div>
                            
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Delete Post Modal -->
<div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" id="deleteForm">
                @method('delete')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Delete post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this post?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-danger" value="Delete"></input>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Post Modal -->
<div class="modal fade" id="editPostModal" role="dialog" aria-labelledby="threadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" id="editPostForm" method="POST">
                @method('put')
                @csrf
                <div class="modal-header d-flex align-items-center bg-primary text-white">
                    <h6 class="modal-title mb-0" id="threadModalLabel">Edit Post</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @error('postEditError')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    @error('idCategory')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    @error('message')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input required id="title" value="" type="text" class="form-control" name="title" placeholder="Enter title" minlength="2" maxlength="60"/>
                    </div>
                    
                    <label for="title">Category</label>
                    <div class="form-group">
                        <select name="idCategory" class="form-select">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="title">Message</label>
                        <textarea required id="message" class="form-control summernote" rows="10" name="message" minlength="4" maxlength="500">{{ old('message') }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value="Edit"></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('assets/post-delete-modal.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/post-edit-modal.js') }}"></script>
    @if ($errors->has('idCategory') || $errors->has('title') || $errors->has('message') || $errors->has('postEditError'))
        <script>
            let idPost_json = "{{ json_encode(session('idPost')) }}";
            let idPost = JSON.parse(idPost_json);

            $('#edit' + idPost).click();
        </script>
    @endif
@endsection

@section('styles')
    <style>
        p{
            word-break: break-all;
            white-space: normal;
            margin-right: 20px;
        }
        
        .navbar{
            margin: 0 !important;;
        }
        
        .subnav .active a{
            color: #0d6efd;
            border-bottom:  2px solid #0d6efd;
        }
        
        .subnav li a{
            color: black;
            text-decoration: none;
        }
        
        .subnav li:hover a{
            color: #0d6efd;
            border-bottom:  2px solid #0d6efd;
        }
    </style>
@endsection 