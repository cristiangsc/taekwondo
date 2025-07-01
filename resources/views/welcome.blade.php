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

</head>
<body>
<button id="scrollTopButton">↑</button>
<x-navigation-menu/>
<x-carousel/>
<x-about-section/>
<x-valores-card/>
<x-noticias-destacadas/>
<x-alianzas/>
<x-latest-gallery-images/>
<x-faq/>
<x-testimonials/>
<x-contact-form/>
<x-footer/>

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
