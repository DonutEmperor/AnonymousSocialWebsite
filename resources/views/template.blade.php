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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

    <!-- cdn - sweetalert
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <style>
        /* CSS Styles for chatbot container */
        .chatbot-container {
            position: fixed;
            bottom: 20px;
            /* Adjust the distance from the bottom as needed */
            right: 20px;
            /* Adjust the distance from the right as needed */
            /* Ensure the chatbot is above other elements */
        }

        .chatbot-icon {
            height: 28px;
            width: 30px;
        }
    </style>
    @yield("head")
</head>

<body>
    <!-- Navbar -->
    @if($navbar == 'without-options')
    <x-navbar-without-options />
    @elseif($navbar == 'mod-navbar')
    <x-moderator-navbar />
    @else

    @endif

    <!-- Content Area -->
    <div class="container-fluid pt-5 mt-5">
        <div class="row">
            <div class="col-12">
                <div class="block-content">
                    <div class="chatbot-container">
                        <!-- Chatbot Modal -->
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#chatbotModal">
                            <img src="/assets/img/chatbot.png" alt="Chatbot Icon" class="chatbot-icon">
                        </button>
                    </div>
                    <div class="modal fade" id="chatbotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="chatbotModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="chatbotModalLabel">Chat with ChatGPT</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Chat -->
                                    <div class="messages">
                                        <div class="left message">
                                            <p>Start chatting with Chat GPT AI below!!</p>
                                        </div>
                                    </div>
                                    <!-- End Chat -->
                                </div>
                                <div class="modal-footer">
                                    <div class="bottom">
                                        <form id="chat-box-form">
                                            <input class="rounded" type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off" style="width: 400px;height:40px">
                                            <button class="btn btn-success" type="submit">Send</button>
                                        </form>
                                    </div>

                                    <!-- <form action="#" method="post">
                                        <div class="input-group">
                                            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat">Send</button>
                                            </span>
                                        </div>
                                    </form> -->

                                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                </div>
                            </div>
                        </div>
                    </div>

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