<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHAD PALACE</title>
    <link rel="icon" type="image/x-icon" href="/assets/img/palace.png">

    <!-- cdn - jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" type="text/javascript"></script>

    <!-- cdn - bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- css -->
    <link rel="stylesheet" href="/assets/css/styles.css">

    <!-- cdn - sweetalert
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

    @yield("head")
</head>

<body>
    <!-- Navbar -->
    @if($navbar == 'without-options')
    <x-navbar-without-options />
    @elseif($navbar == 'logged-in-with-options')
    <x-navbar-with-options />
    @else

    @endif

    <!-- Content Area -->
    <div class="container-fluid pt-5 mt-5">

        <div class="row">
            <div class="col-12">
                <div class="block-content">
                    @yield("content")
                </div>
                <!-- cdn - bootstrap js -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
            </div>
        </div>


    </div>

    @if ($footer == 'true')
    <x-footer />
    @else
    <!-- nothing -->
    @endif

    @yield("script")
</body>


</html>