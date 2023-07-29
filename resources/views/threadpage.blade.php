@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
@endsection

@section("content")
<div class="thread">
    <!-- This is where your content goes -->
    <div class="threadcontent">
        <div class="row mb-4">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <h3 class="mt-0"><a href="{{ route('thread') }}">#Thread</a></h3>
                            <h6>#Thread-ID</h6>
                            <p>Content of Thread 1... Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.

                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel erat et odio bibendum euismod.</p>
                            <p class="mb-3">25 upvotes | 5 downvotes | #TimeStamp</p>
                            <button class="btn btn-sm btn-success">^</button>
                            <button class="btn btn-sm btn-danger">v</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 text-md-right">
                <x-topic-box />
            </div>
        </div>
        <br>

        <div>
            <h6 class="text-decoration-underline">Comments (10)</h6>
        </div>

        <div class="card col-8">
            <div class="card-body">
                <div class="media">
                    <div class="comment">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Header" id="headerText" value="{{ old('header') }}" required>
                                <label for="header">Header</label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" required>{{ old('comments') }}</textarea>
                                <label for="floatingTextarea2">Comments</label>
                                <br>
                                <button type="submit" class="btn btn-outline-success btn-sm" style="float:right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card col-8 mt-3">
            <div class="card-body">
                <div class="media">
                    <div class="comment">
                        <h6>Yes</h6>
                        <p>
                            POTAOTATPDA
                        </p>
                        <p class="mb-3"> 25 upvotes | 5 downvotes | #TimeStamp </p>
                        <button class="btn btn-sm btn-success">^</button>
                        <button class="btn btn-sm btn-danger">v</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section("script")
<!-- This is where your js/other scripts code goes -->
@endsection