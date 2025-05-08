<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BottleLink</title>

    <!-- Bootstrap CSS (Latest version only) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        /* Modal Styles */
        .modal {
            display: none;
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

    <!-- Toast for Success Message -->
    @if (session()->has('success'))
        <div class="toast-container position-fixed" style="z-index: 11; right: 1rem; bottom: 80px;">
            <div class="toast align-items-center text-white bg-success border-0 show" role="alert"
                 aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body fs-5">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Toast for Errors -->
    @if ($errors->any())
        <div class="toast-container position-fixed" style="z-index: 11; right: 1rem; bottom: 80px;">
            <div class="toast align-items-center text-white bg-danger border-0 show" role="alert"
                 aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body fs-5">
                        {{ $errors->first() }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Scripts -->
    <script src="{{ asset('script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            crossorigin="anonymous"></script>

    <!-- JavaScript for Age Modal -->
    <script>
        function getCookie(name) {
            let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
            return match ? match[2] : null;
        }

        window.onload = function () {
            var modal = document.getElementById('ageModal');
            var websiteContent = document.getElementById('websiteContent');

            if (!getCookie('ageConfirmed')) {
                modal.style.display = "block";
                websiteContent.classList.add('blurred');
            } else {
                websiteContent.classList.remove('blurred');
                document.getElementById('websiteMainContent').style.display = "block";
            }
        };

        document.getElementById('over18').onclick = function () {
            document.cookie = "ageConfirmed=true; path=/";
            document.getElementById('ageModal').style.display = "none";
            document.getElementById('websiteContent').classList.remove('blurred');
            document.getElementById('websiteMainContent').style.display = "block";
        };

        document.getElementById('under18').onclick = function () {
            window.location.href = "https://www.google.com";
        };
    </script>

    <!-- JavaScript to Show Bootstrap Toasts -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toastElList = [].slice.call(document.querySelectorAll('.toast'));
            toastElList.map(function (toastEl) {
                const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
                toast.show();
            });
        });
    </script>
</body>

</html>
