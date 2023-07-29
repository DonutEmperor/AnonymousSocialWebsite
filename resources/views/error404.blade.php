@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
@endsection

@section("content")
<div class="error-page">
    <!-- This is where your content goes -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h1 class="display-1">404</h1>
                <h2 class="display-4">Page Not Found</h2>
                <p class="lead">The requested page could not be found.</p>
                <a href="{{ route('home') }}" class="btn btn-primary">Go Home</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<!-- This is where your js/other scripts code goes -->
@endsection