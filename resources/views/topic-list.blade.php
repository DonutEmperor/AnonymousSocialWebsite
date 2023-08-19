@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
@endsection

@section("content")
<div class="topic-list-content">
    <!-- This is where your content goes -->
    <div class="container">
        <div class="d-flex justify-content-between">
            <a href="{{ url()->previous() }}" class="btn btn-primary mb-4">Back</a>
            @if(session('success_topic'))
            <div class="alert alert-success">
                {{ session('success_topic') }}
            </div>
            @elseif($errors->has('title'))
            <div class="alert alert-danger">
                {{ $errors->first('title') }}
            </div>
            @endif
            <!-- This is the "create topic" modal -->
            @auth
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createTopic">
                Create Topic
            </button>
            @endauth
            <div class="modal fade" id="createTopic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createTopicLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createTopicLabel">Create New topic</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="{{ route('topic.create') }}" method="POST">
                                @csrf
                                <div class="mb-1">
                                    <label for="topic-title" class="col-form-label">Title:</label>
                                    <input type="text" class="form-control" name="title" required data-validation-required-message="Please enter a title for your topic." maxlength="20" value="{{ old('title') }}">
                                    <div class="invalid-feedback">
                                        Title cannot exceed 20 characters.
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="topic-description" class="col-form-label">Description:</label>
                                    <textarea class="form-control" name="description" style="height: 300px" required data-validation-required-message="Please enter a description for your topic.">{{ old('description') }}</textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Create topic</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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