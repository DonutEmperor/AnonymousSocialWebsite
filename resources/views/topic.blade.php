@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
@endsection

@section("content")
<div class="topic">
    <!-- This is where your content goes -->
    <div class="topiccontent">
        <div class="container">

            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            @foreach($topics as $topic)
                            <h2 class="card-title"> {{$topic->title}} </h2>

                            <br>
                            <p>
                                {{$topic->id}}
                                {{$topic->description}}
                            </p>
                            @endforeach
                            <!-- This is the "create thread" modal -->
                            <button type="button" class="btn btn-primary mb-0 mt-3" data-bs-toggle="modal" data-bs-target="#createThread">
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
                                            <form>
                                                <div class="mb-1">
                                                    <label for="thread-title" class="col-form-label">Title:</label>
                                                    <input type="text" class="form-control" id="recipient-name">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="thread-content" class="col-form-label">Content:</label>
                                                    <textarea class="form-control" id="message-text" style="height: 100px"></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Understood</button>
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
                    <h3>Hot Threads</h3>
                </div>
                <div class="card-body">
                    <!-- Most upvoted thread here -->
                    <div class="media">
                        <div class="media-body">
                            <div class="thread">
                                <h7 class="mt-0"><a href="{{ route('thread') }}">Thread Title 1</a></h7>
                                <p class="mb-0">Posted by User123 | 25 upvotes | 5 downvotes | 10 comments</p>
                                <p>Content of Thread 1... Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.

                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.</p>
                                <button class="btn btn-sm btn-success">^</button>
                                <button class="btn btn-sm btn-danger">v</button>
                                <button class="btn btn-sm btn-info">Comment</button>
                            </div>
                            <br>
                            <div class="thread">
                                <h7 class="mt-0"><a href="#">Thread Title 2</a></h7>
                                <p class="mb-0">Posted by User123 | 20 upvotes | 2 downvotes | 5 comments</p>
                                <p>Content of Thread 2...</p>
                                <button class="btn btn-sm btn-success">^</button>
                                <button class="btn btn-sm btn-danger">v</button>
                                <button class="btn btn-sm btn-info">Comment</button>
                            </div>
                            <br>
                            <div class="thread">
                                <h7 class="mt-0"><a href="#">Thread Title 3</a></h7>
                                <p class="mb-0">Posted by User123 | 18 upvotes | 1 downvote | 2 comments</p>
                                <p>Content of Thread 3...</p>
                                <button class="btn btn-sm btn-success">^</button>
                                <button class="btn btn-sm btn-danger">v</button>
                                <button class="btn btn-sm btn-info">Comment</button>
                            </div>
                            <br>
                            <div class="thread">
                                <h7 class="mt-0"><a href="#">Thread Title 4</a></h7>
                                <p class="mb-0">Posted by User123 | 15 upvotes | 3 downvotes | 7 comments</p>
                                <p>Content of Thread 4...</p>
                                <button class="btn btn-sm btn-success">^</button>
                                <button class="btn btn-sm btn-danger">v</button>
                                <button class="btn btn-sm btn-info">Comment</button>
                            </div>
                            <br>
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
@endsection