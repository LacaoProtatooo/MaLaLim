<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Home</title>
    @include('common.links')
</head>
<body>
    @include('common.header')

    <div class="w-full mx-auto max-w-screen-xl p-4 md:grid md:grid-cols-4 gap-4 shadow-md">
        @include('common.card')

    </div>

    @foreach ($jewel as $jew )
    {{ $jew->name }}
        @foreach ($jew->colorJewelries as $pivot)
            {{ ($pivot->stocks->quantity) }}
            {{ ($pivot->colors->color) }}
            <br>
        @endforeach
        <br>

    @endforeach


    @include('common.footer')

</body>

</html>
