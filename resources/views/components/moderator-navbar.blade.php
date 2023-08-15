<nav class="navbar navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img class="logo-chad-palace" src="/assets/img/palace.png" alt="" width="50" height="45">
        </a>
        <!-- <h1><a class="navbar-brand" href="">CHAD PALACE</a></h1> -->
        <form class="form-inline">
            <div class="row">
                <div class="col">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                </div>
                <div class="col-auto">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                </div>
                <div class="col-auto">
                    <a class="btn btn-outline-primary" href="{{route('logout')}}">Logout</a>
                </div>
            </div>
        </form>
    </div>
</nav>