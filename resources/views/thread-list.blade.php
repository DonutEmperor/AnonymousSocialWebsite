@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
@endsection

@section("content")
<div class="thread-list-content">
    <div class="container">
        <div class="text-center mb-3">
            <h3>Hot Thread</h4>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>Hot Threads</h3>
            </div>
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        @php
                        $displayCount = 0; // Counter for displayed threads
                        @endphp

                        @foreach($threads as $thread)
                        @if($displayCount < 500) <div class="thread mb-3">
                            <h7 class="mt-0"><a href="{{ route('thread', ['id' => $thread->id]) }}">{{ $thread->title }}</a></h7>
                            <p class="mb-0">
                                <span id="upvotes_{{$thread->id}}">{{$thread->upvotes}}</span> upvotes |
                                <span id="downvotes_{{$thread->id}}">{{$thread->downvotes}}</span> downvotes |
                                {{$thread->created_at}}
                            </p>
                            <p>{{ $thread->content }}.</p>
                            <button class="btn btn-sm btn-success upvote-button" data-id="{{$thread->id}}">^</button>
                            <button class="btn btn-sm btn-danger downvote-button" data-id="{{$thread->id}}">v</button>
                            <!-- <a class="btn btn-sm btn-warning">Report</a> -->
                            <a class="btn btn-sm btn-info" href="{{ route('thread', ['id' => $thread->id]) }}">Comment</a>
                    </div>
                    @php
                    $displayCount++;
                    @endphp
                    @else
                    @break
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<!-- This is where your js/other scripts code goes -->
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