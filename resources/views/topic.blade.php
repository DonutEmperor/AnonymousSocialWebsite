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
                            <h2 class="card-title"> #Topic Name </h2>
                            <br>
                            <p>
                                This is the topic description.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 text-md-right">
                    <div class="card">
                        <div class="card-header">
                            <h3>Topics</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group" style="max-height: 130px; overflow-y: auto;">
                                <!-- Existing topics with links -->
                                <li class="list-group-item"><a href="#">Topic 1</a></li>
                                <li class="list-group-item"><a href="#">Topic 2</a></li>
                                <li class="list-group-item"><a href="#">Topic 3</a></li>
                                <li class="list-group-item"><a href="#">Topic 4</a></li>
                                <li class="list-group-item"><a href="#">Topic 2</a></li>
                                <li class="list-group-item"><a href="#">Topic 3</a></li>
                                <li class="list-group-item"><a href="#">Topic 4</a></li>
                                <li class="list-group-item"><a href="#">Topic 2</a></li>
                                <li class="list-group-item"><a href="#">Topic 3</a></li>
                                <li class="list-group-item"><a href="#">Topic 4</a></li>
                                <!-- Additional topics will be added here as they grow -->
                            </ul>
                        </div>
                    </div>
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