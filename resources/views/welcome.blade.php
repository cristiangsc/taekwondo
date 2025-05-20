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



</body>
</html>
