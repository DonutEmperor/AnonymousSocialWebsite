<div class="card">
    <div class="card-header">
        <h5><a style="text-decoration: none;color:black" href="{{ route('topic-list') }}">Topics</a></h5>
    </div>
    <div class="card-body">
        <ul class="list-group" style="max-height: 200px; overflow-y: auto;">
            <!-- Existing topics with links -->
            @foreach($topics as $topic)
            <li class="list-group-item"><a href="{{ route('topic', ['id' => $topic->id]) }}">{{$topic->title}}</a></li>
            @endforeach
            <!-- Additional topics will be added here as they grow -->
        </ul>
    </div>
</div>