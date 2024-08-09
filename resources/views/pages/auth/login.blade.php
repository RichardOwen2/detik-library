<!DOCTYPE html>
<html lang="en">

<head>
    <title>DETIK LIBRARY</title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{{ asset('metronic') }}/media/logos/favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('metronic') }}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('metronic') }}/css/style.bundle.css" rel="stylesheet" type="text/css" />
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url('metronic/media/auth/bg10.jpeg');
            }

            [data-bs-theme="dark"] body {
                background-image: url('metronic/media/auth/bg10-dark.jpeg');
            }
        </style>
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <img class="theme-light-show mx-auto mw-200 w-150px w-lg-500px mb-10 mb-lg-20"
                        src="{{ asset('logo/logo_black.png') }}" alt="" />
                    <img class="theme-dark-show mx-auto mw-200 w-150px w-lg-500px mb-10 mb-lg-20"
                        src="{{ asset('logo/logo_white.png') }}" alt="" />
                    {{-- <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-4">
                        Pelayanan Terbaik, Kepuasan Terjamin
                    </h1>
                    <div class="text-gray-600 fs-base text-center fw-semibold">
                        Berikan yang terbaik kepada pelanggan, pastikan proses yang mulus, dan pastikan kepuasan mereka.
                    </div> --}}
                </div>
            </div>
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            <form class="form w-100" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="text-center mb-11">
                                    <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Email" name="email" autocomplete="off"
                                        class="form-control bg-transparent @if (session('error')) is-invalid @endif" />
                                </div>
                                <div class="fv-row mb-3">
                                    <input type="password" placeholder="Password" name="password" autocomplete="off"
                                        class="form-control bg-transparent @if (session('error')) is-invalid @endif" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Email atau password salah</strong>
                                        </span>
                                </div>
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                        <span class="indicator-label">Sign In</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var hostUrl = "assets/";
    </script>
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
</body>

</html>
