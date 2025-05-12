<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-base-url" content="{{ url('api/v1') }}">
    <title>@yield('title')</title>
  </head>
  <body>
    <div id="app"></div>
    @vite(['resources/js/app.js']) {{-- 👈 ici, Vue peut se monter sur #app --}}
  </body>
</html>
