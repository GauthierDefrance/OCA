<head>

    <meta charset="UTF-8">
    <title>@yield('title', "default_title")</title>

    <meta name="description" content="@yield("meta_desc")">
    <meta name="author" content="@yield("meta_author")">
    <link rel="apple-touch-icon" sizes="180x180" href="{{url("img/apple-touch-icon.png")}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url("img/favicon-32x32.png")}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url("img/favicon-16x16.png")}}">
    <link rel="manifest" href="{{url("img/site.webmanifest")}}">

    @stack('styles')

    <!--- <script src="/js/app.js" defer></script> le defer est important ! --->
    @stack("scripts")

</head>
