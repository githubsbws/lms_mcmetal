<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gallery</title>
    {{-- CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link href="themes/bws/css/vendor.min.css" rel="stylesheet">
    <link href="themes/bws/css/theme-core.css" rel="stylesheet">
    <link href="themes/bws/css/module-essentials.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-material.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-layout.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-sidebar.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-sidebar-skins.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-navbar.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-messages.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-carousel-slick.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-charts.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-maps.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-colors-alerts.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-colors-background.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-colors-buttons.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-colors-text.min.css" rel="stylesheet" />
    <link href="themes/bws/css/font-style.css" rel="stylesheet" />
    <link href="themes/bws/css/custom-font.css" rel="stylesheet" />

    <!--    layerslide-->
    <link href="themes/bws/layerslider/css/layerslider.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="themes/bws/css/sweetalert.css">

    <link href="themes/bws/css/style.css" rel="stylesheet" />
    <!--    layerslide-->

    <!--    jquery   --->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"
        integrity="sha512-ju6u+4bPX50JQmgU97YOGAXmRMrD9as4LE05PdC3qycsGQmjGlfm041azyB1VfCXpkpt1i9gqXCT6XuxhBJtKg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--    jquery   --->
    <!-- css -->
    @vite('resources/css/app2.css')
</head>

<body>
    @yield('temp-html2')
    {{-- CDN script js --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

    <script src="themes/bws/js/vendor-core.min.js"></script>
    <script src="themes/bws/js/vendor-countdown.min.js"></script>
    <script src="themes/bws/js/vendor-tables.min.js"></script>
    <script src="themes/bws/js/vendor-forms.min.js"></script>
    <script src="themes/bws/js/vendor-carousel-slick.min.js"></script>
    <script src="themes/bws/js/vendor-player.min.js"></script>
    <script src="themes/bws/js/vendor-charts-flot.min.js"></script>
    <script src="themes/bws/js/vendor-nestable.min.js"></script>
    <script src="themes/bws/js/module-essentials.min.js"></script>
    <script src="themes/bws/js/module-material.min.js"></script>
    <script src="themes/bws/js/module-layout.min.js"></script>
    <script src="themes/bws/js/module-sidebar.min.js"></script>
    <script src="themes/bws/js/module-carousel-slick.min.js"></script>
    <script src="themes/bws/js/module-player.min.js"></script>
    <script src="themes/bws/js/module-messages.min.js"></script>
    <script src="themes/bws/js/module-maps-google.min.js"></script>
    <script src="themes/bws/js/module-charts-flot.min.js"></script>
    <script src="themes/bws/layerslider/js/greensock.js" type="text/javascript"></script>
    <script src="themes/bws/layerslider/js/layerslider.transitions.js" type="text/javascript"></script>
    <script src="themes/bws/layerslider/js/layerslider.kreaturamedia.jquery.js" rel="stylesheet"></script>


    <script>
        var colors = {
            "danger-color": "#e74c3c",
            "success-color": "#81b53e",
            "warning-color": "#f0ad4e",
            "inverse-color": "#2c3e50",
            "info-color": "#2d7cb5",
            "default-color": "#6e7882",
            "default-light-color": "#cfd9db",
            "purple-color": "#9D8AC7",
            "mustard-color": "#d4d171",
            "lightred-color": "#e15258",
            "body-bg": "#f6f6f6"
        };
        var config = {
            theme: "html",
            skins: {
                "default": {
                    "primary-color": "#42a5f5"
                }
            }
        };
    </script>


</body>

</html>
