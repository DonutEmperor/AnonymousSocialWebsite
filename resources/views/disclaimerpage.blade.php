@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
@endsection

@section("content")
<div class="disclaimerpage">
    <!-- This is where your content goes -->
    <div class="disclaimercontent">
        <div class="container py-5">
            <!-- Logo -->
            <div class="text-center mb-4">
                <img src="/assets/img/palace.png" alt="Logo" style="height: 180px; width: 180px;">
            </div>

            <div class="alert alert-warning" style="background-color: white;">
                <h4 class="alert-heading">Disclaimer</h4>
                <p>
                    This website contains information about a fictional project and is intended for educational purposes only. Any resemblance to real projects, entities, or individuals is purely coincidental.
                </p>
                <hr>
                <p class="mb-0">
                    By continuing to use this website, you acknowledge that this is not a real project and agree to the terms of this disclaimer.
                </p>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('home')}}" class="btn btn-primary">I Understand</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<!-- This is where your js/other scripts code goes -->
<style type="text/css">
    body {
        background-image: none;
        background-color: #212529;
    }
</style>

<script>

</script>
@endsection