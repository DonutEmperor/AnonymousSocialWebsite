@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
@endsection

@section("content")
<div class="thread">
    <!-- This is where your content goes -->
    <div class="container">
        <div class="d-flex justify-content-between">
            <a href="{{ url()->previous() }}" class="btn btn-primary mb-5">Back</a>
            @if(session('success_thread'))
            <div class="alert alert-success mb-5 px-2 py-2">
                {{ session('success_thread') }}
            </div>
            @endif
            <!-- This is the "update thread" modal -->
            @foreach($threads as $thread)
            @auth
            <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#updateThread">
                Edit Thread
            </button>
            @endauth
            <div class="modal fade" id="updateThread" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateThreadLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="updateThreadLabel">Update thread</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="{{route('thread.update', ['id' =>$thread->id])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="thread_id" value="{{ $thread->id }}">
                                <div class="mb-1">
                                    <label for="thread-title" class="col-form-label">Title:</label>
                                    <input type="text" class="form-control" name="title" required data-validation-required-message="Please enter a title for your thread." maxlength="50" value="{{ old('title' , $thread->title) }}">
                                    <div class="invalid-feedback">
                                        Title cannot exceed 50 characters.
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="thread-content" class="col-form-label">Content:</label>
                                    <textarea class="form-control" name="content" style="height: 300px" required data-validation-required-message="Please enter a content for your thread.">{{ old('content', $thread->content) }}</textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update thread</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Display thread card -->
        <div class="row mb-0">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                @foreach($threads as $thread)
                                <div class="thread">
                                    <h3 class="mt-0">{{$thread->title}}</h3>
                                    <h6>Thread ID: {{$thread->id}}</h6>
                                    <p>{{$thread->content}}</p>
                                    <p class="mb-3">
                                        <span id="upvotes_{{$thread->id}}">{{$thread->upvotes}}</span> upvotes |
                                        <span id="downvotes_{{$thread->id}}">{{$thread->downvotes}}</span> downvotes |
                                        {{$thread->created_at}}
                                    </p>
                                    <button class="btn btn-sm btn-success upvote-button" data-id="{{$thread->id}}">^</button>
                                    <button class="btn btn-sm btn-danger downvote-button" data-id="{{$thread->id}}">v</button>
                                    <a class="btn btn-sm btn-warning">Report</a>
                                    @auth
                                    <!-- Delete Thread Button -->
                                    <button type="button" class="btn btn-danger py-1 px-1" data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $thread->id }}">
                                        Delete Thread
                                    </button>

                                    <!-- Confirmation Modal -->
                                    <div class="modal fade" id="confirmDelete{{ $thread->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeleteLabel">Confirm Deletion</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this thread?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('thread.delete', ['id' => $thread->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endauth
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 text-md-right">
                <x-topic-box :topics="$allTopics" />
            </div>
        </div>

        <!-- Comment Section  -->
        <div>
            <h6 class="text-decoration-underline">Comments({{$commentCount}})</h6>
        </div>
        <!-- Create Comment Form -->
        <div class="card col-8">
            <div class="card-body">
                <div class="media">
                    <div class="create-comment">
                        <form action="{{route('comment.create')}}" method="POST">
                            @csrf
                            <!-- <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Header" id="headerText" value="{{ old('header') }}" required>
                                <label for="header">Header</label>
                            </div> -->
                            <div class="form-floating">
                                <input type="hidden" name="thread_id" value="{{ $thread->id }}">
                                <textarea class="form-control" placeholder="Leave a comment here" name="comments" id="floatingTextarea" style="height: 100px" required>{{ old('comments') }}</textarea>
                                <label for="floatingTextarea2">Comments</label>
                                <br>
                                <!-- <button type="submit" class="btn btn-outline-success btn-sm" style="float:right">Submit</button> -->
                                <button type="submit" class="btn btn-outline-success btn-sm submit-comment" style="float:right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comment success and error session display -->
        @if(session('success_comment'))
        <div class="alert alert-success mt-3 col-8">
            {{ session('success_comment') }}
        </div>
        @elseif(session('comment-delete-success'))
        <div class="alert alert-success mt-3 col-8">
            {{ session('comment-delete-success') }}
        </div>
        @elseif ($errors->has('comment-deletion'))
        <div class="alert alert-danger mt-3 col-8">
            {{ $errors->first('comment-deletion') }}
        </div>
        @elseif(session('error') && session('error')['status'] === 429)
        <div class="alert alert-danger mt-3 col-8">
            {{ session('error')['message'] }}
        </div>
        @endif

        <!-- Display comments -->
        <div class="card col-8 mt-3">
            <div class="card-body">
                <div class="media">
                    @if(count($comments) > 0)
                    @foreach($comments as $comment)
                    <div class="comment mb-3">
                        <h6>
                            {{$comment->body}}
                        </h6>
                        <p class="mb-3">
                            <span id="c-upvotes_{{$comment->id}}">{{$comment->upvotes}}</span> upvotes |
                            <span id="c-downvotes_{{$comment->id}}">{{$comment->downvotes}}</span> downvotes |
                            {{$comment->created_at}}
                        </p>
                        <!-- <p class="mb-3"> {{$comment->upvotes}} upvotes | {{$comment->downvotes}} downvotes | {{$comment->created_at}} </p> -->
                        <button class="btn btn-sm btn-success comment-upvote-button" data-comment-id="{{ $comment->id }}">^</button>
                        <button class="btn btn-sm btn-danger comment-downvote-button" data-comment-id="{{ $comment->id }}">v</button>
                        <a class="btn btn-sm btn-warning">Report</a>
                        @auth
                        <!-- This is the "update comment" modal -->
                        <button type="button" class="btn btn-primary px-1 py-1" data-bs-toggle="modal" data-bs-target="#updateComment{{ $comment->id }}">
                            Edit Comment
                        </button>
                        <div class="modal fade" id="updateComment{{ $comment->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateCommentLabel{{ $comment->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="updateCommentLabel{{ $comment->id }}">Update comment</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="{{ route('comment.update', ['id' => $comment->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-1">
                                                <label for="comment-body" class="col-form-label">Body:</label>
                                                <textarea type="text" class="form-control" name="body" required maxlength="255">{{ old('body', $comment->body) }}</textarea>
                                                <div class="invalid-feedback">
                                                    Body cannot exceed 255 characters.
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update Comment</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endauth

                        @auth
                        <!-- Delete Comment Button -->
                        <button type="button" class="btn btn-danger py-1 px-1" data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $comment->id }}">
                            Delete Comment
                        </button>
                        <!-- Confirmation Modal -->
                        <div class="modal fade" id="confirmDelete{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabelComment" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDeleteLabelComment">Confirm Deletion</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this comment?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('comment.delete', ['id' => $comment->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endauth
                    </div>
                    @endforeach
                    @else
                    <p>No comments available.</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section("script")
<!-- This is where your js/other scripts code goes -->
<script>
    $(document).ready(function() {
        $('.submit-comment').on('click', function() {
            var threadId = $(this).data('id');
            $('#thread_id_input').val(threadId);
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        // Handle upvote button clicks
        const upvoteButtons = document.querySelectorAll('.upvote-button');
        upvoteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const threadId = this.getAttribute('data-id');
                voteThread(threadId, 'upvote');
            });
        });

        // Handle downvote button clicks
        const downvoteButtons = document.querySelectorAll('.downvote-button');
        downvoteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const threadId = this.getAttribute('data-id');
                voteThread(threadId, 'downvote');
            });
        });

        applyInitialActiveState();

        function voteThread(threadId, voteType) {
            fetch(`/thread/${threadId}/${voteType}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    // Update the displayed counts
                    document.getElementById(`upvotes_${threadId}`).textContent = data.upvotes;
                    document.getElementById(`downvotes_${threadId}`).textContent = data.downvotes;

                    // Toggle vote status and active class
                    const commentUpvoteButton = document.querySelector(`.upvote-button[data-id="${threadId}"]`);
                    const commentDownvoteButton = document.querySelector(`.downvote-button[data-id="${threadId}"]`);

                    // ... (Rest of the code for toggling active class)
                    if (voteType === 'upvote') {
                        if (commentUpvoteButton.classList.contains('active')) {
                            commentUpvoteButton.classList.remove('active');
                            sessionStorage.removeItem(`active_${threadId}`);
                            voteType = 'unvote';
                        } else {
                            commentUpvoteButton.classList.add('active');
                            commentDownvoteButton.classList.remove('active');
                            sessionStorage.setItem(`active_${threadId}`, 'upvote');
                        }
                    } else if (voteType === 'downvote') {
                        if (commentDownvoteButton.classList.contains('active')) {
                            commentDownvoteButton.classList.remove('active');
                            sessionStorage.removeItem(`active_${threadId}`);
                            voteType = 'unvote';
                        } else {
                            commentDownvoteButton.classList.add('active');
                            commentUpvoteButton.classList.remove('active');
                            sessionStorage.setItem(`active_${threadId}`, 'downvote');
                        }
                    }
                    // Manage session storage
                    if (voteType === 'unvote') {
                        // User unvoted, remove the session value
                        sessionStorage.removeItem(`active_${threadId}`);
                        fetch(`/thread/${threadId}/unvote`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                        });
                    } else {
                        // Set session storage for active state
                        sessionStorage.setItem(`active_${threadId}`, voteType);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function applyInitialActiveState() {
            upvoteButtons.forEach(button => {
                const threadId = button.getAttribute('data-id');
                const activeState = sessionStorage.getItem(`active_${threadId}`);
                if (activeState === 'upvote') {
                    button.classList.add('active');
                }
            });

            downvoteButtons.forEach(button => {
                const threadId = button.getAttribute('data-id');
                const activeState = sessionStorage.getItem(`active_${threadId}`);
                if (activeState === 'downvote') {
                    button.classList.add('active');
                }
            });
        }


        // Handle comment upvote and downvote button clicks
        const commentUpvoteButtons = document.querySelectorAll('.comment-upvote-button');
        const commentDownvoteButtons = document.querySelectorAll('.comment-downvote-button');

        // Handle upvote button clicks
        commentUpvoteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const commentId = this.getAttribute('data-comment-id');
                voteComment(commentId, 'upvote');
            });
        });

        // Handle downvote button clicks
        commentDownvoteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const commentId = this.getAttribute('data-comment-id');
                voteComment(commentId, 'downvote');
            });
        });

        applyCInitialActiveState();

        // Function to handle comment voting
        function voteComment(commentId, voteType) {
            fetch(`/comment/${commentId}/${voteType}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    // Update displayed counts
                    document.getElementById(`c-upvotes_${commentId}`).textContent = data.upvotes;
                    document.getElementById(`c-downvotes_${commentId}`).textContent = data.downvotes;

                    // Toggle vote status and active class
                    const commentUpvoteButton = document.querySelector(`.comment-upvote-button[data-comment-id="${commentId}"]`);
                    const commentDownvoteButton = document.querySelector(`.comment-downvote-button[data-comment-id="${commentId}"]`);

                    if (voteType === 'upvote') {
                        if (commentUpvoteButton.classList.contains('active')) {
                            commentUpvoteButton.classList.remove('active');
                            sessionStorage.removeItem(`active_${commentId}`);
                            voteType = 'unvote';
                        } else {
                            commentUpvoteButton.classList.add('active');
                            commentDownvoteButton.classList.remove('active');
                            sessionStorage.setItem(`active_${commentId}`, 'upvote');
                        }
                    } else if (voteType === 'downvote') {
                        if (commentDownvoteButton.classList.contains('active')) {
                            commentDownvoteButton.classList.remove('active');
                            sessionStorage.removeItem(`active_${commentId}`);
                            voteType = 'unvote';
                        } else {
                            commentDownvoteButton.classList.add('active');
                            commentUpvoteButton.classList.remove('active');
                            sessionStorage.setItem(`active_${commentId}`, 'downvote');
                        }
                    }

                    // Manage session storage
                    if (voteType === 'unvote') {
                        // User unvoted, remove the session value
                        sessionStorage.removeItem(`active_${commentId}`);
                        fetch(`/comment/${commentId}/unvote`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                        });
                    } else {
                        // Set session storage for active state
                        sessionStorage.setItem(`active_${commentId}`, voteType);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function applyCInitialActiveState() {
            commentUpvoteButtons.forEach(button => {
                const commentId = button.getAttribute('data-comment-id');
                const activeState = sessionStorage.getItem(`active_${commentId}`);
                if (activeState === 'upvote') {
                    button.classList.add('active');
                }
            });

            commentDownvoteButtons.forEach(button => {
                const commentId = button.getAttribute('data-comment-id');
                const activeState = sessionStorage.getItem(`active_${commentId}`);
                if (activeState === 'downvote') {
                    button.classList.add('active');
                }
            });
        }
    });
</script>

@endsection