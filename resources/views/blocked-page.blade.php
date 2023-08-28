@extends("template")

@section("head")
<!-- This is where your head goes (jk) this is where the stuff you want to put in your head goes -->
<style>
    body {
        background-color: #F8F9FA;
    }

    .carousel-fade-in .carousel-item {
        opacity: 0;
        transition: opacity 1s ease-out;

    }

    .carousel-fade-in .carousel-item.active {
        opacity: 1;
    }
</style>
@endsection

@section("content")
<div class="blocked-page">
    <!-- This is where your content goes -->
    <div class="blocked-content d-flex justify-content-center">
        <div id="carouselControlsNoTouching" class="carousel slide carousel-dark" data-bs-ride="carousel">
            <div class="carousel-inner carousel-fade-in">
                <div class="carousel-item active" data-bs-interval="2000">

                    <img class="" src="/assets/img/pepe-gif.gif" alt="NO" style="height: 380px;width:450px">

                </div>
                <div class="carousel-item" data-bs-interval="2000">

                    <img class="" src="/assets/img/meow-slap.gif" alt="NO" style="height: 380px;width:450px">

                </div>
                <div class="carousel-item" data-bs-interval="2000">

                    <img class="" src="/assets/img/cute-pepe-punch.gif" alt="NO" style="height: 380px;width:450px">

                </div>
                <div class="carousel-item" data-bs-interval="3000">

                    <img class="" src="/assets/img/beat-up-slipa.gif" alt="NO" style="height: 380px;width:450px">

                </div>
            </div>
        </div>

    </div>
    <div class="blocked-text mb-5">
        <h1 class="text-center  ">
            YOU'RE BLOCKED :D
        </h1>
        <p class="text-center">
            We're not sorry, but you have been blocked from accessing our platform due to a violation of our community guidelines.
        </p>
        <p class="text-center">Our guidelines are in place to ensure a safe and respectful environment for all users.</p>
        <p class="text-center">Unfortunately, your actions have broken these rules, and as a result, we have had to restrict your access to the platform.</p>
        <p class="text-center">If you believe this decision was made in error or would like to appeal, please contact our support team.</p>
    </div>
</div>
</div>
@endsection

@section("script")
<!-- This is where your js/other scripts code goes -->
@endsection