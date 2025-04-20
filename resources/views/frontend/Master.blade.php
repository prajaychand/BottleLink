<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BottleLink</title>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('style.css') }}" class="rel">

    <style>
        /* Modal Styles */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            text-align: center;
        }

        .modal-button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
        }

        .modal-button.red {
            background-color: red;
        }

        /* Blurring effect */
        .blurred {
            filter: blur(5px);
            pointer-events: none;
        }
    </style>
</head>

<body>
    @include('frontend.Header')

    <!-- Age Confirmation Modal -->
    <div id="ageModal" class="modal">
        <div class="modal-content">
            <h2>Are you over 18 years old?</h2>
            <button id="over18" class="modal-button">Yes, I am over 18</button>
            <button id="under18" class="modal-button red">No, I am under 18</button>
        </div>
    </div>

    <!-- Website Content -->
    <div id="websiteContent" class="container-fluid" style="margin: 0;">
        <div id="websiteMainContent">
            @yield('content')
        </div>
    </div>

    @include('frontend.Footer')

    <!-- Custom Script -->
    <script src="{{ asset('script.js') }}"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

<script>
    // Function to get the value of a specific cookie by name
    function getCookie(name) {
        let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? match[2] : null;
    }

    // Show the modal when the page loads
    window.onload = function() {
        var modal = document.getElementById('ageModal');
        var websiteContent = document.getElementById('websiteContent');

        // Check if the user has already confirmed their age (using a session cookie)
        if (!getCookie('ageConfirmed')) {
            modal.style.display = "block";
            // Apply blur effect to the website content
            websiteContent.classList.add('blurred');
        } else {
            // Remove blur effect if the user has already confirmed
            websiteContent.classList.remove('blurred');
            document.getElementById('websiteMainContent').style.display = "block";
        }
    };

    // When the user clicks "Over 18"
    document.getElementById('over18').onclick = function() {
        // Set a session cookie to remember the user's choice for the current session
        document.cookie = "ageConfirmed=true; path=/";

        // Hide the modal
        document.getElementById('ageModal').style.display = "none";
        // Remove blur effect from the website content
        document.getElementById('websiteContent').classList.remove('blurred');
        // Show the website content
        document.getElementById('websiteMainContent').style.display = "block";
    };

    // When the user clicks "Under 18"
    document.getElementById('under18').onclick = function() {
        // Redirect to Google
        window.location.href = "https://www.google.com";
    };
</script>


</body>

</html>
