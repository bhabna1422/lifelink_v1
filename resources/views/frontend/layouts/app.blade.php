<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - IRCTC helicopter Service for Chardham Yatra</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Themenix.com">
    <link href="{{ asset('frontend/assets/img/logos/favicon.png') }}" rel="shortcut icon" type="image/png">
    <link href="{{ asset('frontend/assets/css/theme-1.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/theme-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/theme-3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/pkg.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Optional: Bootstrap CSS (already included in theme likely) -->
</head>

<body>

    {{-- @include Preloader if needed --}}
    {{-- @include('frontend.layouts.preloader') --}}

    <!-- Header -->
    @include('frontend.layouts.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('frontend.layouts.footer')

    <!-- Scripts -->
    @include('frontend.layouts.script')

    <!-- WhatsApp Floating Icon -->
    <a href="https://wa.me/919672832691" target="_blank" class="whatsapp-float" aria-label="Chat on WhatsApp">
        <img src="{{ asset('frontend/assets/img/wp.png') }}" alt="WhatsApp Chat" />
    </a>

    <!-- WhatsApp Float Styling -->
    <style>
        .whatsapp-float {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
            /* background: #25d366; */
            border-radius: 50%;
            padding: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .whatsapp-float img {
            width: 40px;
            height: 40px;
        }
    </style>

    <!-- Warning Modal -->
    <!-- <div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="warningLabel">⚠️ Beware of Fake Tours!</h5>
          </div>
          <div class="modal-body">
            Please ensure you're booking only through our official website. Avoid fake agents or unauthorized sources for Char Dham helicopter services.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Understood</button>
          </div>
        </div>
      </div>
    </div> -->

    <!-- Show Modal Once Per Session -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (!sessionStorage.getItem("warningModalShown")) {
                var warningModal = new bootstrap.Modal(document.getElementById('warningModal'), {
                    backdrop: 'static',
                    keyboard: false
                });
                warningModal.show();
                sessionStorage.setItem("warningModalShown", "true");
            }
        });
    </script>

</body>
</html>
