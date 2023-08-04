@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
@endsection

@section("content")
<div class="topic">
    <!-- This is where your content goes -->
    <div class="topiccontent">
        <div class="container">
            <a href="{{ url()->previous() }}" class="btn btn-primary mb-4">Back</a>
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

                            <!-- This is the "create thread" modal -->
                            <button type="button" class="btn btn-primary mb-0 mt-3" data-bs-toggle="modal" data-bs-target="#createThread" data-topic-id="{{ $topic->id }}">
                                Create New Thread
                            </button>
                            @endforeach
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
                                                    <input type="text" class="form-control" name="title" required data-validation-required-message="Please enter a title for your thread.">
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

                <div class="col-md-4 text-md-right">
                    <x-topic-box :topics="$allTopics" />
                </div>
            </div>

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
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
</script>
@endsection