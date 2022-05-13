<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.15
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Bagus Budi Setyawan">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- Icons-->
    <link rel="icon" type="image/ico" href="./img/favicon.ico" sizes="any" />
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @stack('csses')
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed">
    <script>
      if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
        var wrapper = document.getElementsByClassName('app')[0];
        wrapper.className += ' sidebar-lg-show';
      }
    </script>
    @include('layouts.partials.header')
    <div class="app-body">
      @include('layouts.partials.sidebar')
      <main class="main">
        <!-- Breadcrumb-->
        @yield('breadcrumb')
        <div class="container-fluid">
          <div class="pt-2">
            @yield('content')
          </div>
        </div>
      </main>
    </div>
    @include('layouts.partials.footer')
    @yield('modals')
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <!-- Plugins and scripts required by this view-->
    @stack('scripts')
    @yield('script')
    @yield('modals')
  </body>
</html>
