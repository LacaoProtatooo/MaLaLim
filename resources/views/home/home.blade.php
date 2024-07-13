<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Home</title>
</head>
<body>
    @include('common.header')

    <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between shadow-md">
        <div class="w-full md:w-1/5 p-2"> <!-- First column -->
            Content for the first column
          </div>
          <div class="w-full md:w-1/5 p-2"> <!-- Second column -->
            Content for the second column
          </div>
          <div class="w-full md:w-1/5 p-2"> <!-- Third column -->
            Content for the third column
          </div>
          <div class="w-full md:w-1/5 p-2"> <!-- Fourth column -->
            Content for the fourth column
          </div>
          <div class="w-full md:w-1/5 p-2"> <!-- Fifth column -->
            Content for the fifth column
          </div>
    </div>

    @include('common.footer')
</body>
</html>
