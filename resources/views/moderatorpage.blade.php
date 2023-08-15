@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
@endsection

@section("content")
<div class="">
    <!-- This is where your content goes -->
    <div class="container">
        @if(session('login-success'))
        <div class="alert alert-success">
            {{session('login-success')}}
        </div>
        @endif

        <h1 class="text-center">Mod Page</h1>
    </div>

</div>
@endsection

@section("script")
<!-- This is where your js/other scripts code goes -->
@endsection