@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
@endsection

@section("content")
<div class="homepage">
    <!-- This is where your content goes -->
    <div class="homecontent">
        <div class="container">

            <!-- Row with "What's this" and "Topics" -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">What is CHAD PALACE?</h2>
                            <p class="card-text">
                                CHAD PALACE is an anonymous social website for people to express their thoughts and opinions without the fear of cyber threats or judgment.
                            </p>
                            <p>
                                What can you do:
                            </p>
                            <p>
                                1. Look into interested topics.
                            </p>
                            <p>
                                2. Create a new thread in the selected topic to start a discussion.
                            </p>
                            <p>
                                3. Comment on other thread to engage in a discussion.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-right">
                    <x-topic-box :topics="$allTopics" />
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Hot Threads</h3>
                </div>
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            @php
                            $displayCount = 0; // Counter for displayed threads
                            @endphp

                            @foreach($allThreads as $thread)
                            @if($displayCount < 5) <div class="thread mb-3">
                                <h7 class="mt-0"><a href="{{ route('thread', ['id' => $thread->id]) }}">{{ $thread->title }}</a></h7>
                                <p class="mb-0">
                                    <span id="upvotes_{{$thread->id}}">{{$thread->upvotes}}</span> upvotes |
                                    <span id="downvotes_{{$thread->id}}">{{$thread->downvotes}}</span> downvotes |
                                    {{$thread->created_at}}
                                </p>
                                <p>{{ $thread->content }}.</p>
                                <button class="btn btn-sm btn-success upvote-button" data-id="{{$thread->id}}">^</button>
                                <button class="btn btn-sm btn-danger downvote-button" data-id="{{$thread->id}}">v</button>
                                <a class="btn btn-sm btn-warning">Report</a>
                                <a class="btn btn-sm btn-info" href="{{ route('thread', ['id' => $thread->id]) }}">Comment</a>
                        </div>
                        @php
                        $displayCount++;
                        @endphp
                        @else
                        @break
                        @endif
                        @endforeach

                        @if(count($allThreads) > 5)
                        <p>And {{ count($allThreads) - 5 }} more hot threads...</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h3>News</h3>
            </div>
            <div class="card-body">
                <div class="media">
                    <img class="logo-chad-palace" src="/assets/img/palace.png" alt="" width="150" height="135">
                    <br>
                    <br>
                    <div class="media-body">
                        <h7 class="mt-0"><a href="#">News Title</a></h7>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.
                        </p>
                    </div>
                </div>
                <!-- Additional news items can be added here -->
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h3>FAQ</h3>
            </div>
            <div class="card-body">
                <!-- FAQ content goes here -->
                <p>Frequently Asked Questions:</p>
                <ul>
                    <li>How do I create an account?</li>
                    <li>How can I reset my password?</li>
                    <li>What are the community guidelines?</li>
                    <!-- Additional FAQs can be added here -->
                </ul>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h3>Contact Us</h3>
            </div>
            <div class="card-body">
                <p>If you have any questions or need support, feel free to contact us.</p>
                <ul class="list-unstyled">
                    <li>Email: support@example.com</li>
                    <li>Phone: +1 (123) 456-7890</li>
                </ul>
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
                    if (voteType === 'upvote') {
                        if (upvoteButton.classList.contains('active')) {
                            upvoteButton.classList.remove('active');
                            voteType = 'unvote';
                        } else {
                            upvoteButton.classList.add('active');
                            downvoteButton.classList.remove('active');
                        }
                    } else if (voteType === 'downvote') {
                        if (downvoteButton.classList.contains('active')) {
                            downvoteButton.classList.remove('active');
                            voteType = 'unvote';
                        } else {
                            downvoteButton.classList.add('active');
                            upvoteButton.classList.remove('active');
                        }
                    }

                    if (voteType === 'unvote') {
                        // User unvoted, remove the session value and set cookie
                        Cookies.remove(`vote_${threadId}`);
                        Cookies.remove(`active_${threadId}`);
                        fetch(`/thread/${threadId}/unvote`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                        });
                    } else {
                        // Set cookie for the vote and active state
                        Cookies.set(`vote_${threadId}`, voteType);
                        Cookies.set(`active_${threadId}`, voteType);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
</script>
<script></script>
@endsection