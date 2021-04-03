<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- document.querySelector('meta[name="csrf-token"]').content; --}}

    {{-- STYLES --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body class="antialiased">
    <div id="app">
        @if (Auth::check())
            {{-- <mainapp :user="{{ Auth::user() }}" :role="{{ Auth::user()->role }}" :permission="{{ Auth::user()->role->permission }}" /> --}}
            <mainapp :user="{{ Auth::user() }}" :role="{{ Auth::user()->role }}"
                :permission="{{ Auth::user()->role->permission }}" />
        @else
            <mainapp :user="false" />

        @endif
    </div>
    {{-- SCRIPTS --}}
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
