<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-behavior: smooth;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kim's Ñuble Taekwondo</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
<button id="scrollTopButton">↑</button>
<x-navigation-menu/>
<main>
    {{ $slot }}
</main>
<x-footer/>
@livewireScripts
<script>
    const scrollTopButton = document.getElementById('scrollTopButton');

    // Mostrar el botón al hacer scroll
    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            scrollTopButton.style.display = 'flex';
        } else {
            scrollTopButton.style.display = 'none';
        }
    });

    // Desplazar al inicio al hacer clic
    scrollTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth',
        });
    });
</script>

</body>

</html>
