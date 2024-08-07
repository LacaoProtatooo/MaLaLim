<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    
    
</head>
<body class="bg-gray-100">
    @include('common.links') <!-- Include necessary CSS and JavaScript resources -->
    @vite('resources/js/home.js')

    @include('common.header') <!-- Include header component -->
    @include('common.navbar') <!-- Include navbar component -->
    @include('common.banner2')
    

    <div id="jewelry" class="w-full mx-auto max-w-screen-xl p-4 md:grid md:grid-cols-4 gap-4 shadow-md rounded-3xl bg-gray-200 bg-gradient-to-gray from-gray-200 to-gray-100">
        {{-- Content will be dynamically loaded here --}}
    </div>

    @include('common.footer') <!-- Include footer component -->


    @include('common.productview')


</body>
</html>
