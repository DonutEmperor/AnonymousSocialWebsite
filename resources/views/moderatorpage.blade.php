@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
@endsection

@section("content")
<div class="">
    <!-- This is where your content goes -->
    <div class="container ">

        <div class="text-center mb-3">
            <h3>Mod Page</h4>
        </div>

        <!-- Display Report-List Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Report List</h5>
            </div>
            @if(session('login-success'))
            <div class="alert alert-success m-4">
            {{ session('login-success') }}
            </div>
            @elseif(session('success_topic'))
            <div class="alert alert-success m-4">
                {{ session('success_topic') }}
            </div>
            @elseif(session('topic-delete-success'))
            <div class="alert alert-success m-4">
                {{ session('topic-delete-success') }}
            </div>
            @elseif(session('success_thread'))
            <div class="alert alert-success m-4">
                {{ session('success_thread') }}
            </div>
            @elseif(session('thread-delete-success'))
            <div class="alert alert-success m-4">
                {{ session('thread-delete-success') }}
            </div>
            @elseif(session('success_comment'))
            <div class="alert alert-success m-4">
                {{ session('success_comment') }}
            </div>
            @elseif(session('comment-delete-success'))
            <div class="alert alert-success m-4">
                {{ session('comment-delete-success') }}
            </div>
            @endif

            <!-- Display Content Card -->
            <div class="card m-4 mt-1">

                <div class="d-flex justify-content-center ">
                    <a class="btn btn-success m-2 mb-0" onclick="showSection('topics')">Topics</a>
                    <a class="btn btn-success m-2 mb-0" onclick="showSection('threads')">Threads</a>
                    <a class="btn btn-success m-2 mb-0" onclick="showSection('comments')">Comments</a>
                </div>

                <!-- Topic Section -->
                <div class="card-body">
                    <div id="topicsSection">
                        <div class="card-header mb-2">
                            <h5>Topics</h5>
                        </div>
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    @foreach($allTopics as $topic)
                                    <div class="topic mb-3 bg-secondary bg-opacity-10 p-2 rounded">
                                        <h6 class="mt-0">
                                            ID : {{$topic->id}}
                                        </h6>
                                        <h6 class="mt-0">
                                            Topic-ID : {{$topic->board_id}}
                                        </h6>
                                        <h6 class="mt-0">
                                            Topic-Title : {{$topic->title}}
                                        </h6>
                                        <h6 class="mt-0">
                                            Topic-Description : {{$topic->description}}
                                        </h6>

                                        <!-- Edit Topic Modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateTopic{{$topic->id}}">
                                            Edit Topic
                                        </button>

                                        <div class="modal fade" id="updateTopic{{$topic->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateTopicLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="updateTopicLabel">Update topic</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form action="{{route('mod-topic.update', ['id' =>$topic->id])}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                                                            <div class="mb-1">
                                                                <label for="topic-title" class="col-form-label">Title:</label>
                                                                <input type="text" class="form-control" name="title" required maxlength="20" value="{{ old('title', $topic->title) }}">
                                                                <div class="invalid-feedback">
                                                                    Title cannot exceed 20 characters.
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="topic-description" class="col-form-label">Description:</label>
                                                                <textarea class="form-control" name="description" style="height: 300px" required>{{ old('description', $topic->description) }}</textarea>
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

                                        <!-- Delete Topic Button -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmTopicDelete{{ $topic->id }}">
                                            Delete Topic
                                        </button>

                                        <!-- Confirmation Modal -->
                                        <div class="modal fade" id="confirmTopicDelete{{ $topic->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmTopicDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmTopicDeleteLabel">Confirm Deletion</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this topic?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('mod-topic.delete', ['id' => $topic->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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

                    <!-- Thread Section  -->
                    <div id="threadsSection" style="display: none;">
                        <div class="card-header mb-2">
                            <h5>Threads</h5>
                        </div>

                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    @foreach($allThreads as $thread)
                                    @if($thread->downvotes >= 5)
                                    <div class="thread mb-3 bg-secondary bg-opacity-10 p-2 rounded">
                                        <h6 class="mt-0">
                                            ID : {{$thread->id}}
                                        </h6>
                                        <h6 class="mt-0">
                                            Topic-ID : {{$thread->topic_id}}
                                        </h6>
                                        <h6 class="mt-0">
                                            Thread-Title : {{$thread->title}}
                                        </h6>
                                        <h6 class="mt-0">
                                            Thread-Content : {{$thread->content}}
                                        </h6>
                                        <h6 class="mt-0">
                                            Thread-Created-At : {{$thread->created_at}}
                                        </h6>
                                        <h6 class="mt-0">
                                            Thread-Updated-At : {{$thread->updated_at}}
                                        </h6>
                                        <h6 class="mt-0">
                                            Thread-Upvotes : {{$thread->upvotes}}
                                        </h6>
                                        <h6 class="mt-0 text-danger">
                                            Thread-Downvotes : {{$thread->downvotes}}
                                        </h6>
                                        <h6 class="mt-0">
                                            Thread-Report-Counts : {{$thread->report_count}}
                                        </h6>
                                        <!-- Edit Thread Modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateThread{{$thread->id}}">
                                            Edit Thread
                                        </button>
                                        <div class="modal fade" id="updateThread{{$thread->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateThreadLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="updateThreadLabel">Update thread</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form action="{{route('mod-thread.update', ['id' =>$thread->id])}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="thread_id" value="{{ $thread->id }}">
                                                            <div class="mb-1">
                                                                <label for="thread-title" class="col-form-label">Title:</label>
                                                                <input type="text" class="form-control" name="title" required maxlength="50" value="{{ old('title', $thread->title) }}">
                                                                <div class="invalid-feedback">
                                                                    Title cannot exceed 50 characters.
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="thread-content" class="col-form-label">Content:</label>
                                                                <textarea class="form-control" name="content" style="height: 300px" required>{{ old('content', $thread->content) }}</textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Update Thread</button>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Thread Button -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmThreadDelete{{ $thread->id }}">
                                            Delete Thread
                                        </button>
                                        <!-- Confirmation Modal -->
                                        <div class="modal fade" id="confirmThreadDelete{{ $thread->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmThreadDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmThreadDeleteLabel">Confirm Deletion</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this thread?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('mod-thread.delete', ['id' => $thread->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comment Section -->
                    <div id="commentsSection" style="display: none;">
                        <div class="card-header mb-2">
                            <h5>Comments</h5>
                        </div>

                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    @foreach($allComments as $comment)
                                    @if($comment->downvotes >= 5)
                                    <div class="comment mb-3 bg-secondary bg-opacity-10 p-2 rounded">
                                        <h6 class="mt-0">
                                            ID : {{$comment->id}}
                                        </h6>
                                        <h6 class="mt-0">
                                            Thread-ID : {{$comment->thread_id}}
                                        </h6>
                                        <h6 class="mt-0">
                                            Comment-Body : {{$comment->body}}
                                        </h6>
                                        <h6 class="mt-0">
                                            Comment-Created-At : {{$comment->created_at}}
                                        </h6>
                                        <h6 class="mt-0">
                                            Comment-Updated-At : {{$comment->updated_at}}
                                        </h6>
                                        <h6 class="mt-0">
                                            Comment-Upvotes : {{$comment->upvotes}}
                                        </h6>
                                        <h6 class="mt-0 text-danger">
                                            Comment-Downvotes : {{$comment->downvotes}}
                                        </h6>
                                        <h6 class="mt-0">
                                            Comment-Report-Counts : {{$comment->report_count}}
                                        </h6>

                                        <!-- Edit Comment Modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateComment{{$comment->id}}">
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
                                                        <form action="{{ route('mod-comment.update', ['id' => $comment->id]) }}" method="POST">
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

                                        <!-- Delete Comment Button -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmCommentDelete{{ $comment->id }}">
                                            Delete Comment
                                        </button>
                                        <!-- Confirmation Modal -->
                                        <div class="modal fade" id="confirmCommentDelete{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmCommentDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmCommentDeleteLabel">Confirm Deletion</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this comment?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('mod-comment.delete', ['id' => $comment->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section("script")
<!-- This is where your js/other scripts code goes -->
<script>
    function showSection(section) {
        document.getElementById('topicsSection').style.display = 'none';
        document.getElementById('threadsSection').style.display = 'none';
        document.getElementById('commentsSection').style.display = 'none';

        document.getElementById(section + 'Section').style.display = 'block';
    }
</script>
@endsection