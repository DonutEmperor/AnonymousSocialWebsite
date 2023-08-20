@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
@endsection

@section("content")
<div class="topic">
    <!-- This is where your content goes -->
    <div class="topiccontent">
        <div class="container">
            <div class="d-flex justify-content-between">
                <a href="{{ url()->previous() }}" class="btn btn-primary mb-5">Back</a>
                @if(session('success_topic'))
                <div class="alert alert-success mb-4">
                    {{ session('success_topic') }}
                </div>
                @endif
                <!-- This is the "update topic" modal -->
                @foreach($topics as $topic)
                @auth
                <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#updateTopic">
                    Edit Topic
                </button>
                @endauth
                <div class="modal fade" id="updateTopic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateTopicLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="updateTopicLabel">Update topic</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <form action="{{route('topic.update', ['id' =>$topic->id])}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                                    <div class="mb-1">
                                        <label for="topic-title" class="col-form-label">Title:</label>
                                        <input type="text" class="form-control" name="title" placeholder="{{$topic->title}}" required data-validation-required-message="Please enter a title for your topic." maxlength="20" value="{{ old('title') }}">
                                        <div class="invalid-feedback">
                                            Title cannot exceed 20 characters.
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="topic-description" class="col-form-label">Description:</label>
                                        <textarea class="form-control" name="description" placeholder="{{$topic->description}}" style="height: 300px" required data-validation-required-message="Please enter a description for your topic.">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update Topic</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Topic Card Header -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="card">
                        @foreach($topics as $topic)
                        <div class="card-header">
                            <h2 class="card-title"> {{$topic->title}} </h2>
                            <h6>Topic ID: {{$topic->id}}</h6>
                        </div>
                        <div class="card-body">

                            <p class="mt-3">
                                {{$topic->description}}
                            </p>
                            @endforeach
                            <!-- This is the "create thread" modal -->
                            <button type="button" class="btn btn-primary mb-0 mt-3" data-bs-toggle="modal" data-bs-target="#createThread" data-topic-id="{{ $topic->id }}">
                                Create New Thread
                            </button>

                            <div class="modal fade" id="createThread" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createThreadLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="createThreadLabel">Create New Thread</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="{{ route('thread.create') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="topic_id" id="topic_id_input">
                                                <div class="mb-1">
                                                    <label for="thread-title" class="col-form-label">Title:</label>
                                                    <input type="text" class="form-control" name="title" required data-validation-required-message="Please enter a title for your thread." maxlength="50">
                                                    <div class="invalid-feedback">
                                                        Title cannot exceed 50 characters.
                                                    </div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="thread-content" class="col-form-label">Content:</label>
                                                    <textarea class="form-control" name="content" style="height: 300px" required data-validation-required-message="Please enter a content for your thread."></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Create Thread</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Display the topic box at side -->
                <div class="col-md-4 text-md-right">
                    <x-topic-box :topics="$allTopics" />
                </div>
            </div>

            <!-- Success flash session display -->
            @if(session('success_thread'))
            <div class="alert alert-success mt-3">
                {{ session('success_thread') }}
            </div>
            @endif
            <!-- Error flash session display -->
            @error('title')
            <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Topic Threads</h3>
                </div>
                <div class="card-body">
                    <!-- Most upvoted thread here -->
                    <div class="media">
                        <div class="media-body">
                            @foreach($allThreads as $thread)
                            <div class="thread mb-3">
                                <h7 class="mt-0"><a href="{{ route('thread', ['id' => $thread->id]) }}">{{$thread->title}}</a></h7>
                                <!-- <p class="mb-0">{{$thread->upvotes}} upvotes | {{$thread->downvotes}} downvotes </p> -->
                                <p class="mb-0">
                                    <span id="upvotes_{{$thread->id}}">{{$thread->upvotes}}</span> upvotes |
                                    <span id="downvotes_{{$thread->id}}">{{$thread->downvotes}}</span> downvotes |
                                    {{$thread->created_at}}
                                </p>
                                <p style="overflow:hidden;">{{$thread->content}}.</p>
                                <button class="btn btn-sm btn-success upvote-button" data-id="{{$thread->id}}">^</button>
                                <button class="btn btn-sm btn-danger downvote-button" data-id="{{$thread->id}}">v</button>
                                <a class="btn btn-sm btn-warning">Report</a>
                                <a class="btn btn-sm btn-info" href="{{ route('thread', ['id' => $thread->id]) }}">Comment</a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Additional hot threads can be added here -->
                </div>
            </div>

        </div>

    </div>
</div>

@endsection

@section("script")
<!-- This is where your js/other scripts code goes -->

<!-- For CreateThread Modal -->
<script>
    $(document).ready(function() {
        $('#createThread').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var topicId = button.data('topic-id'); // Extract topic ID from data-* attributes
            var modal = $(this);
            modal.find('#topic_id_input').val(topicId); // Populate the hidden input field
        });
    });
</script>

<!-- For the thread content text overflow management -->
<script>
    $(document).ready(function() {
        $('.read-more').on('click', function(e) {
            e.preventDefault();
            $(this).prev('.thread-content').find('.content-preview').toggleClass('d-none');
            $(this).prev('.thread-content').find('.content-full').toggleClass('d-none');
            $(this).text($(this).text() === 'Read more' ? 'Read less' : 'Read more');
        });
    });
</script>

<!-- handle votes clicks -->
<!-- <script>
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
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
</script> -->
<script>
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

        // Apply initial active state during page load
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
                    const upvoteButton = document.querySelector(`.upvote-button[data-id="${threadId}"]`);
                    const downvoteButton = document.querySelector(`.downvote-button[data-id="${threadId}"]`);

                    // ... (Rest of the code for toggling active class)
                    if (voteType === 'upvote') {
                        if (upvoteButton.classList.contains('active')) {
                            upvoteButton.classList.remove('active');
                            sessionStorage.removeItem(`active_${threadId}`);
                            voteType = 'unvote';
                        } else {
                            upvoteButton.classList.add('active');
                            downvoteButton.classList.remove('active');
                            sessionStorage.setItem(`active_${threadId}`, 'upvote');
                        }
                    } else if (voteType === 'downvote') {
                        if (downvoteButton.classList.contains('active')) {
                            downvoteButton.classList.remove('active');
                            sessionStorage.removeItem(`active_${threadId}`);
                            voteType = 'unvote';
                        } else {
                            downvoteButton.classList.add('active');
                            upvoteButton.classList.remove('active');
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
    });
</script>
@endsection