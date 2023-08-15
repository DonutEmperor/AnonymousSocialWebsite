@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
@endsection

@section("content")
<div class="thread">
    <!-- This is where your content goes -->
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-primary mb-4">Back</a>
        <div class="row mb-4">
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

        <div>
            <h6 class="text-decoration-underline">Comments({{$commentCount}})</h6>
        </div>

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

        @if(session('success_comment'))
        <div class="alert alert-success mt-3">
            {{ session('success_comment') }}
        </div>
        @endif

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