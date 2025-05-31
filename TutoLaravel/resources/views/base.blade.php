<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title")</title>
</head>
<body>

<header>
    <h1>@yield("Main_Title")</h1>
</header>

<main>
    @yield("Main_Content")
</main>

<footer>
    <p>&copy; 2025 Mon Site</p>
</footer>

</body>

</html>
