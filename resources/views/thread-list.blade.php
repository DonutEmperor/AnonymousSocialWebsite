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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<!-- This is where your js/other scripts code goes -->
@endsection