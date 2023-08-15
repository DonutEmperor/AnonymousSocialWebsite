@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
<title>Disclaimer</title>
<style>
    body {
        background-image: none;
        background-color: #F8F9FA;
    }

    .disclaimerpage {
        width: 500px;
        margin: 0 auto;
        padding: 20px;
        background-color: white;
        border-radius: 5px;
    }

    .disclaimercontent {
        margin-top: 20px;
    }

    .alert-warning {
        color: #8a6d3b;
        background-color: #fcf8e3;
        border-color: #faebcc;
    }

    .alert-heading {
        color: #8a6d3b;
    }

    .btn-primary {
        background-color: #8a6d3b;
        color: white;
    }
</style>
@endsection

@section("content")
<div class="disclaimerpage">
    <div class="disclaimercontent">
        <div class="text-center mb-4">
            <img src="/assets/img/palace.png" alt="Logo" style="height: 180px; width: 180px;">
        </div>

        <div class="alert alert-warning">
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
@endsection

@section("script")
<!-- This is where your js/other scripts code goes -->

</script>
@endsection