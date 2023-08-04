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
                                <p class="mb-0">{{ $thread->upvotes }} upvotes | {{ $thread->downvotes }} downvotes</p>
                                <p>{{ $thread->content }}.</p>
                                <button class="btn btn-sm btn-success">^</button>
                                <button class="btn btn-sm btn-danger">v</button>
                                <button class="btn btn-sm btn-warning">Report</button>
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
@endsection