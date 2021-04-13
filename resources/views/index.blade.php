<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

        <title>Larablog | Aloware Test Project</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <link rel="stylesheet" href="{{ mix('css/app.css') }}"></script>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-dark bg-dark">
                <span class="navbar-brand mb-0 h1">LaraBlog | Aloware</span>
            </nav>
            <div class="container">
                <Blog />
            </div>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
