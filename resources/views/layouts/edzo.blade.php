<html lang="hu">
    <head>
        <meta charset="UTF-8" />
        <meta name="description" content="Edzo oldal" />
        <meta name="author" content="Bogdán Gábor" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../js/ajax.js"></script>
        <script src="../js/edzoIdopont.js"></script>
        {{-- <script src="../js/edzoIdopontok.js"></script> --}}
        <script src="../js/edzo.js"></script>
        @yield('css')
        <link href="../css/EdzoCss/header.css" rel="stylesheet" type="text/css" />
        <link href="../css/EdzoCss/body.css" rel="stylesheet" type="text/css" />
        <link href="../css/EdzoCss/kartya.css" rel="stylesheet" type="text/css" />
        <title>Edzo felulet</title>
    </head>
    <body>
        @yield('content')
    </body>
</html>