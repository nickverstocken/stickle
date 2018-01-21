<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great|Open+Sans+Condensed:300,700" rel="stylesheet">

    </head>
    <body>
        <div class="container-fluid">
            @yield('content')
        </div>
<script src="{{ URL::asset('js/app.js') }}" type="text/javascript"></script>
        @if ($errors->any())
          @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            <script>
                showError('Fout', '{{ join('\n', $errors->all())}}');
            </script>

        @endif

    </body>
</html>
