<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Example</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class=" text-gray-900">
    <footer class="bg-white rounded-lg shadow m-4">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between shadow-md">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 
                <a href="{{route('welcome')}}" class="hover:underline">MaLaLim™</a>. All Rights Reserved.
            </span>
            <ul class="flex space-x-4 items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                <li>
               <a href="{{route('about')}}" class="hover:underline">About</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Catergories</a>
                </li>
                <li>
                    <a href="{{route('welcome')}}"" class="hover:underline">Home</a>
                </li>
                <li>
                    <a href="{{route('contact')}}"" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
    </footer>
</body>
</html>