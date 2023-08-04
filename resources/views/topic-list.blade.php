@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
@endsection

@section("content")
<div class="topic-list-content">
    <!-- This is where your content goes -->
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-primary mb-4">Back</a>
        <div class="row">
            <h2 class="text-center">Topics</h2>

            <div class="col-md-6 offset-md-3"> <!-- Center the column -->
                <div class="row">
                    <ul class="list-group">
                        @foreach($topics as $topic)
                        <li class="list-group-item"><a href="/topic/{{$topic->id}}">{{$topic->title}}</a></li>
                        @endforeach
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