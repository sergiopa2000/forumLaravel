@extends('app.base')

@section('content')
<div class="border-bottom">
    <div class="subnav w-50 m-auto">
        <ul class="list-group list-group-horizontal text-uppercase font-weight-bold">
            <li class="list-inline-item mr-4 pt-3 pb-3"><a href="{{ url('user/' . $user->id) }}" class="pt-3 pb-3 ">Overview</a></li>
            <li class="list-inline-item mr-4 pt-3 pb-3"><a href="{{ url('user/' . $user->id . '/posts') }}" class="pt-3 pb-3">Posts</a></li>
            <li class="list-inline-item pt-3 pb-3 active"><a href="{{ url('user/' . $user->id . '/comments') }}" class="pt-3 pb-3">Comments</a></li>
        </ul>
    </div>
</div>

<div style="min-height: 75.1vh;" class="d-flex align-items-center">
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row mb-5">
            <div class="col-md-3 border-right d-flex justify-content-end pr-5">
                <div class="d-flex flex-column pb-5 mb-5 align-items-center w-50">
                    <img class="rounded-circle mt-5" width="150px" src="{{ $user->image }}">
                    <span class="font-weight-bold">{{ $user->name }}</span><span class="text-black-50">{{ $user->email }}</span><span class="text-black-50">{{ $user->birthdate }}</span>
                </div>
            </div>
            <div class="col-md-8 border-right overflow-auto" style="height: 75.1vh;">
            @error('commentDeleteError')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('commentTimeError')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @foreach($comments as $comment)
                <div class="card mt-2">
                    <div class="card-body p-2 p-sm-3">
                        <div class="media forum-item">
                            <a href="#" data-toggle="collapse" data-target=".forum-content"><img src="{{ $user->image }}" class="mr-3 rounded-circle" width="50" alt="User" /></a>
                            <div class="media-body">
                                <h6 class="text-body" style="font-size: 1.2em;">--> <span class="text-body">{{ $comment->post->title }}</span></h6>
                                <p class="text-secondary">
                                    {{ $comment->message }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center align-middle">
                                    <p class="text-muted" style="margin: 0;"><span class="text-primary" >{{ $user->name }}<span></p>
                                    @php
                                        $mytime = Carbon\Carbon::now('+1:00');
                                        $limitTime = Carbon\Carbon::createFromDate($comment->created_at)->addMinutes(5);
                                    @endphp
                                    @if($limitTime > $mytime && session()->has('user') && session('user')->name == $user->name)
                                    <div>
                                        <button id="edit{{ $comment->id }}" data-toggle="modal" data-target="#editCommentModal" data-post="{{ $comment->post->id }}" data-message="{{ $comment->message }}" data-url="{{ url('comment/' . $comment->id) }}" class="editButton btn btn-outline-warning comments">Edit</button>
                                        <button data-toggle="modal" data-target="#deleteModal" data-url="{{ url('comment/' . $comment->id) }}" class="deleteButton btn btn-outline-danger comments ml-3">Delete</button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Delete Comment Modal -->
<div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" id="deleteForm">
                @method('delete')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Delete comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this comment?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-danger" value="Delete"></input>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Comment Modal -->
<div class="modal fade" id="editCommentModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ url('comment') }}" id="editCommentForm" method="post">
                @method('put')
                @csrf
                <div class="modal-header d-flex align-items-center bg-primary text-white">
                    <h6 class="modal-title mb-0" id="threadModalLabel">New Comment</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @error('commentEditError')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea required id="message" class="form-control summernote" rows="10" name="message"></textarea>
                    </div>
                    
                    <input hidden type="number" name="idPost" class="btn btn-primary" value="" id="idPost">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value="Comment">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('assets/post-delete-modal.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/comment-edit-modal.js') }}"></script>
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