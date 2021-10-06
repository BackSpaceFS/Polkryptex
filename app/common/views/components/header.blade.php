<!doctype html>
<html lang="@option('language', 'en')">

<head>
  <meta charset="utf-8">
  <meta http-equiv="Cache-control" content="private">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">
  <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="msapplication-starturl" content="/">
  <title>@option('sitename', 'Polkryptex'){{ isset($title) ? ' - ' . $title : '' }}</title>
  <link rel="icon" href="{!! $base_url . 'favicon.ico?v=' . $version !!}" />
  <link rel="manifest" href="@asset('m.webmanifest'){!! '?v=' . $version !!}">
  <link type="text/css" rel="stylesheet" href="@asset('bundle.min.css'){!! '?v=' . $version !!}" crossorigin="anonymous" />

  <script>
    window.app = @json( $js_data, JSON_PRETTY_PRINT );
  </script>

  <script src="@asset('bundle.js'){!! '?v=' . $version !!}" crossorigin="anonymous" defer></script>

</head>

<body class="{{ implode(' ', $body_classes) }}">

  @include('components.cookie')

  <div id="app">