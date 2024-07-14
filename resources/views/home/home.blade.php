<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    @include('common.header')

    <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between shadow-md">
        <div class="w-full md:w-1/5 p-2"> <!-- First column -->
        @include('common.card')
          </div>
          <div class="w-full md:w-1/5 p-2"> <!-- Second column -->
          @include('common.card')
          </div>
          <div class="w-full md:w-1/5 p-2"> <!-- Third column -->
          @include('common.card')
          </div>
          <div class="w-full md:w-1/5 p-2"> <!-- Fourth column -->
          @include('common.card')
          </div>
          <div class="w-full md:w-1/5 p-2"> <!-- Fifth column -->
          @include('common.card')
          </div>
    </div>

    @include('common.footer')
</body>
</html>
