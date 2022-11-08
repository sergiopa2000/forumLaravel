@extends('app.base')

@section('content')
<div class="container" style="height: 110vh;">
    <div class="main-body p-0">
        <div class="inner-wrapper">
            <!-- Inner sidebar -->
            <div class="inner-sidebar">
                <!-- Inner sidebar header -->
                <div class="inner-sidebar-header justify-content-center">
                    <button class="btn btn-primary has-icon btn-block" type="button" data-toggle="modal" data-target="#categoryModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        NEW CATEGORY
                    </button>
                </div>

                <div class="inner-sidebar-body p-0">
                    <div class="p-3 h-100" data-simplebar="init">
                        <div class="simplebar-wrapper" style="margin: -16px;">
                            <div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                                        <div class="simplebar-content" style="padding: 16px;">
                                            <nav class="nav nav-pills nav-gap-y-1 flex-column">
                                                <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon active">All posts</a>
                                                @foreach($categories as $category)
                                                <a href="{{ url('category/' . $category->id) }}" class="nav-link nav-link-faded has-icon">{{ $category->name }}</a>
                                                @endforeach
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simplebar-placeholder" style="width: 234px; height: 292px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 151px; display: block; transform: translate3d(0px, 0px, 0px);"></div></div>
                    </div>
                </div>
            </div>

            <div class="inner-main">
                <div class="inner-main-header">
                    <a class="btn btn-success has-icon btn-block text-white" type="button" data-toggle="modal" data-target="#postModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        NEW POST
                    </a>
                </div>
                <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                    @foreach($posts as $post)
                    <div class="card mt-2">
                        <div class="card-body p-2 p-sm-3">
                            <div class="media forum-item">
                                <a href="#" data-toggle="collapse" data-target=".forum-content"><img src="{{ $post->user->image }}" class="mr-3 rounded-circle" width="50" alt="User" /></a>
                                <div class="media-body">
                                    <h6 class="text-body" style="font-size: 1.2em;">{{ $post->title }}</h6>
                                    <p class="text-secondary">
                                        {{ $post->message }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center align-middle">
                                        <p class="text-muted" style="margin: 0;"><a href="{{ url('user/' . $post->user->id) }}">{{ $post->user->name }}</a> posted on <span class="text-secondary font-weight-bold">{{ $post->created_at }}</span></p>
                                        <a href="javascript:void(0)" class="btn btn-outline-primary comments" data-post="{{ $post->id }}">Comments</a>
                                    </div>
                                </div>
                                <div class="text-muted small text-center">
                                    <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> {{ mt_rand(1, 100) }}</span>
                                    <span><i class="far fa-comment ml-2"></i> {{ count($post->comments) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div id="comments{{ $post->id }}" class="hidden commentsBox">
                        @foreach($post->comments as $comment)
                        <div class="card bg-light" style="width: 90%;margin-left: auto;">
                            <div class="card-body p-2 p-sm-3">
                                <div class="media forum-item">
                                    <a href="#" data-toggle="collapse" data-target=".forum-content"><img src="{{ $comment->user->image }}" class="mr-3 rounded-circle" width="50" alt="User" /></a>
                                    <div class="media-body">
                                        <p class="text-secondary">
                                            {{ $comment->message }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center align-middle">
                                            <p class="text-muted" style="margin: 0;"><a href="{{ url('user/' . $comment->user->id) }}">{{ $comment->user->name }}</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div style="width: 90%;margin-left: auto;">
                            <button class="btn btn-primary has-icon btn-block newComment" data-post="{{ $post->id }}" type="button" data-toggle="modal" data-target="#commentModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-2">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                NEW COMMENT
                            </button>
                        </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- New Post Modal -->
        <div class="modal fade" id="postModal" role="dialog" aria-labelledby="threadModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    
                    @if (session()->has('user'))
                    <form action="{{ url('post') }}" method="post">
                        @csrf
                        <div class="modal-header d-flex align-items-center bg-primary text-white">
                            <h6 class="modal-title mb-0" id="threadModalLabel">New Post</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="text-light" aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @error('postCreateError')
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
                            <div class="alert alert-warning">Once created you will only have 5 minutes to delete this post</div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input required value="{{ old('title') }}" type="text" class="form-control" name="title" placeholder="Enter title" minlength="2" maxlength="60"/>
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
                                <textarea required class="form-control summernote" rows="10" name="message" minlength="4" maxlength="500">{{ old('message') }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" value="Post"></button>
                            </div>
                        </div>
                    </form>
                    @else
                    <div class="modal-header d-flex align-items-center bg-danger text-white">
                        <h6 class="modal-title mb-0" id="threadModalLabel">Warning</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-light" aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="alert alert-danger mb-0">You need to be logged to create a new post</div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- New Category Modal -->
        <div class="modal fade" id="categoryModal" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    @if (session()->has('user'))
                    <form action="{{ url('category') }}" method="POST">
                        @csrf
                        <div class="modal-header d-flex align-items-center bg-primary text-white">
                            <h6 class="modal-title mb-0" id="threadModalLabel">New Category</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="text-light" aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @error('categoryCreateError')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input required value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Enter title" minlength="2" maxlength="20"/>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" value="Create category"></input>
                            </div>
                        </div>
                    </form>
                    @else
                    <div class="modal-header d-flex align-items-center bg-danger text-white">
                        <h6 class="modal-title mb-0" id="threadModalLabel">Warning</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-light" aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="alert alert-danger mb-0">You need to be logged to create a new category</div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- New Comment Modal -->
        <div class="modal fade" id="commentModal" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    @if (session()->has('user'))
                    <form action="{{ url('comment') }}" method="POST">
                        @csrf
                        <div class="modal-header d-flex align-items-center bg-primary text-white">
                            <h6 class="modal-title mb-0" id="threadModalLabel">New Comment</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="text-light" aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @error('commentCreateError')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="alert alert-warning">Once created you will only have 5 minutes to delete this comment</div>
                            <div class="form-group">
                                <label for="title">Message</label>
                                <textarea required class="form-control summernote" rows="10" name="message"></textarea>
                            </div>
                            
                            <input hidden type="number" name="idPost" class="btn btn-primary" value="" id="idPost">

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" value="Comment">
                            </div>
                        </div>
                    </form>
                    @else
                    <div class="modal-header d-flex align-items-center bg-danger text-white">
                        <h6 class="modal-title mb-0" id="threadModalLabel">Warning</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-light" aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="alert alert-danger mb-0">You need to be logged to commnet in a posty</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="{{ url('assets/comments.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/comment-create-modal.js') }}"></script>
    @if ($errors->has('name') || $errors->has('categoryCreateError'))
        <script>
            $(function() {
                $('#categoryModal').modal('show');
            });
        </script>
    @endif
    
    @if ($errors->has('idCategory') || $errors->has('title') || $errors->has('message') || $errors->has('postCreateError'))
        <script>
            $(function() {
                $('#postModal').modal('show');
            });
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
    
    .comments:hover{
        color: white;
    }
    
    .hidden{
        display: none;
    }
    </style>
@endsection