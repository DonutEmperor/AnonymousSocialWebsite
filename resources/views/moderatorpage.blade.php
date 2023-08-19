@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
@endsection

@section("content")
<div class="">
    <!-- This is where your content goes -->
    <div class="container ">
        @if(session('login-success'))
        <div class="alert alert-success">
            {{ session('login-success') }}
        </div>
        @endif

        <div class="text-center mb-3">
            <!-- @auth
            <div class="d-flex justify-content-center">
                <div class="alert alert-info col-md-4" role="alert">
                    <h6 class="">Logged in as: {{ auth()->user()->username }} (Moderator)</h6>
                </div>
            </div>
            @endauth -->
            <h3>Mod Page</h4>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5>Report List</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="media">
                <div class="media-body">

                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section("script")
<!-- This is where your js/other scripts code goes -->
@endsection