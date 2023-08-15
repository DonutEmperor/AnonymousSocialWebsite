<style>
    body {
        margin-bottom: 80px;
    }

    .footer {
        margin-top: 0;
        padding: 15px 15px;
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
    }
</style>

<div class="footer ">
    <footer class="position-fixed fixed-bottom bg-light">
        <!-- Add your footer content here -->
        © Copyright 2023 CHAD PALACE
        <br>
        <a class="a" href="{{ route('policy') }}">Privacy Policy</a>
        <br>
        <a class="a" href="{{ route('about') }}">About Us</a>
        <br>
    </footer>
</div>

<!-- <script>
    $(document).ready(function() {
        function toggleFooterVisibility() {
            var footer = $(".footer");
            var content = $(".block-content");
            var windowHeight = $(window).height();
            var contentHeight = content.outerHeight();
            var scrollTop = $(window).scrollTop();

            // Calculate the distance from the top of the content to the top of the viewport
            var contentTop = content.offset().top - $(window).scrollTop();

            // Calculate the distance from the bottom of the content to the bottom of the viewport
            var contentBottom = contentTop + contentHeight - windowHeight;

            // Show the footer if the content is shorter than the viewport or the user scrolls to the bottom
            if (contentHeight < windowHeight || scrollTop >= contentBottom) {
                footer.show();
            } else {
                footer.hide();
            }
        }

        // Call the function initially to set the footer visibility
        toggleFooterVisibility();

        // Call the function whenever the window is resized or the content changes
        $(window).on("resize", function() {
            toggleFooterVisibility();
        });

        // Call the function when the user scrolls
        $(window).on("scroll", function() {
            toggleFooterVisibility();
        });
    });
</script> -->
<script>
    $(document).ready(function() {
        function toggleFooterVisibility() {
            var footer = $(".footer");
            var content = $(".block-content");
            var windowHeight = $(window).height();
            var contentHeight = content.outerHeight();
            var scrollTop = $(window).scrollTop();

            // Calculate the distance from the top of the content to the top of the viewport
            var contentTop = content.offset().top - scrollTop;

            // Calculate the distance from the bottom of the content to the bottom of the viewport
            var contentBottom = contentTop + contentHeight - windowHeight;

            // Show the footer if the content is shorter than the viewport or the user scrolls to the bottom
            if (contentHeight < windowHeight || scrollTop >= contentBottom) {
                footer.show();
            } else {
                footer.hide();
            }
        }

        // Call the function initially to set the footer visibility
        toggleFooterVisibility();

        // Call the function whenever the window is resized, the content changes, or the user scrolls
        $(window).on("resize scroll", function() {
            toggleFooterVisibility();
        });
    });
</script>
<!-- <div class="footer position-relative min-vh-100">
    <footer class="position-absolute fixed-bottom" style="height: 2.5rem">
        © Copyright 2023 CHAD PALACE
        <br>
        <a class="a" href="">Privacy Policy</a>
        <br>
        <a class="a" href="{{ route('about') }}">About Us</a>
        <br>
    </footer>
</div> -->
<!-- <script>
    // jQuery to show the footer when scrolling to the bottom of the page or when the content is not long enough
    $(document).ready(function() {
        var footer = $(".footer");
        var content = $(".container");
        var scrollHeight = $(document).height();
        var clientHeight = $(window).height();

        // Set the initial display of the footer based on the content height
        if (content.height() < clientHeight) {
            footer.fadeIn();
        }

        $(window).scroll(function() {
            var scrollPosition = $(window).height() + $(window).scrollTop();

            // Show the footer if scrolled to the bottom or content is not long enough
            if (scrollPosition >= scrollHeight || content.height() < clientHeight) {
                footer.fadeIn();
            } else {
                footer.fadeOut();
            }
        });
    });
</script> -->
<!-- style="padding: 15px 15px;position: absolute;width: 100%;bottom: 0;text-align:center;" -->