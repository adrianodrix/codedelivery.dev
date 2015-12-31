<!DOCTYPE html>
<html lang="pt-br" ng-app="app">
<head>
  <meta charset="utf-8" />
  <title>Code Delivery</title>
  <meta name="description" content="App Delivery" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  @if(Config::get('app.debug'))

    <link href="{{ asset('build/css/vendor/animate.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('build/libs/assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">


    <link href="{{ asset('build/css/vendor/loading-bar.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('build/css/vendor/angular-material.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('build/css/vendor/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('build/css/material-design-icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('build/css/font.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('build/css/app.css') }}" rel="stylesheet" type="text/css">

  @else
    <link href="{{ elixir('css/all.css') }}" rel="stylesheet">
  @endif
</head>
<body>
<!--[if lt IE 10]>
<p>You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="app" ui-view ng-controller="AppCtrl"></div>

<!-- Scripts -->
@if(Config::get('app.debug'))
  <!-- jQuery -->
  <script src="{{ asset('build/js/vendor/jquery.min.js') }}"></script>
  <script src="{{ asset('build/js/vendor/bootstrap.min.js') }}"></script>
  <script src="{{ asset('build/js/vendor/query-string.js') }}"></script>

  <!-- Angular -->
  <script src="{{ asset('build/js/vendor/angular.min.js') }}"></script>
  <script src="{{ asset('build/js/vendor/angular-animate.min.js') }}"></script>
  <script src="{{ asset('build/js/vendor/angular-aria.min.js') }}"></script>
  <script src="{{ asset('build/js/vendor/angular-cookies.min.js') }}"></script>
  <script src="{{ asset('build/js/vendor/angular-messages.min.js') }}"></script>
  <script src="{{ asset('build/js/vendor/angular-resource.min.js') }}"></script>
  <script src="{{ asset('build/js/vendor/angular-sanitize.min.js') }}"></script>
  <script src="{{ asset('build/js/vendor/angular-touch.min.js') }}"></script>
  <script src="{{ asset('build/js/vendor/angular-material.min.js') }}"></script>
  <script src="{{ asset('build/js/vendor/angular-locale_pt-br.js') }}"></script>
  <script src="{{ asset('build/js/vendor/angular-oauth2.min.js') }}"></script>


  <!-- Vendor -->
  <script src="{{ asset('build/js/vendor/angular-ui-router.min.js') }}"></script>
  <script src="{{ asset('build/js/vendor/ngStorage.min.js') }}"></script>
  <script src="{{ asset('build/js/utils/ui-utils.js') }}"></script>

  <!-- bootstrap -->
  <script src="{{ asset('build/js/vendor/ui-bootstrap-tpls.min.js') }}"></script>


  <!-- lazyload -->
  <script src="{{ asset('build/js/vendor/ocLazyLoad.min.js') }}"></script>


  <!-- loading-bar -->
  <script src="{{ asset('build/js/vendor/loading-bar.min.js') }}"></script>


  <!-- App -->
  <script src="{{ asset('build/js/initial.js') }}"></script>
  <script src="{{ asset('build/js/config/config.js') }}"></script>
  <script src="{{ asset('build/js/config/config.lazyload.js') }}"></script>
  <script src="{{ asset('build/js/config/config.router.js') }}"></script>
  <script src="{{ asset('build/js/app.ctrl.js') }}"></script>

  <script src="{{ asset('build/js/directives/lazyload.js') }}"></script>
  <script src="{{ asset('build/js/directives/ui-jp.js') }}"></script>
  <script src="{{ asset('build/js/directives/ui-nav.js') }}"></script>
  <script src="{{ asset('build/js/directives/ui-fullscreen.js') }}"></script>
  <script src="{{ asset('build/js/directives/ui-scroll.js') }}"></script>
  <script src="{{ asset('build/js/directives/ui-toggle.js') }}"></script>
  <script src="{{ asset('build/js/filters/fromnow.js') }}"></script>
  <script src="{{ asset('build/js/services/ngstore.js') }}"></script>
  <script src="{{ asset('build/js/services/ui-load.js') }}"></script>

  <!-- Controllers -->
  <script src="{{ asset('build/js/controllers/loginController.js') }}"></script>
  <script src="{{ asset('build/js/controllers/categoryController.js') }}"></script>
  <script src="{{ asset('build/js/controllers/productController.js') }}"></script>
  <script src="{{ asset('build/js/controllers/clientController.js') }}"></script>
  <script src="{{ asset('build/js/controllers/orderController.js') }}"></script>
  <script src="{{ asset('build/js/controllers/couponController.js') }}"></script>

  <!-- Services -->
  <script src="{{ asset('build/js/services/entities/userService.js') }}"></script>
  <script src="{{ asset('build/js/services/entities/categoryService.js') }}"></script>
  <script src="{{ asset('build/js/services/entities/productService.js') }}"></script>
  <script src="{{ asset('build/js/services/entities/clientService.js') }}"></script>
  <script src="{{ asset('build/js/services/entities/orderService.js') }}"></script>
  <script src="{{ asset('build/js/services/entities/couponService.js') }}"></script>

@else
  <script src="{{ elixir('js/all.js') }}"></script>
@endif


</body>
</html>