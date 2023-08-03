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
                            <h2 class="card-title">What's this</h2>
                            <br>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.

                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.
                            </p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.</p>
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
                            @foreach($allThreads as $thread)
                            <div class="thread">
                                <h7 class="mt-0"><a href="{{ route('thread', ['id' => $thread->id]) }}">{{$thread->title}}</a></h7>
                                <p class="mb-0">{{$thread->upvotes}} upvotes | {{$thread->downvotes}} downvotes | 10 comments</p>
                                <p>{{$thread->content}}.</p>
                                <button class="btn btn-sm btn-success">^</button>
                                <button class="btn btn-sm btn-danger">v</button>
                                <button class="btn btn-sm btn-warning">Report</button>
                                <a class="btn btn-sm btn-info" href="{{ route('thread', ['id' => $thread->id]) }}">Comment</a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Additional hot threads can be added here -->
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
@endsection