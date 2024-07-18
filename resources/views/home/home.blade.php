<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @include('common.links') <!-- Include necessary CSS and JavaScript resources -->
</head>
<body>
    @include('common.header') <!-- Include header component -->
    @include('common.navbar') <!-- Include navbar component -->

    <div id="jewelry" class="w-full mx-auto max-w-screen-xl p-4 md:grid md:grid-cols-4 gap-4 shadow-md">
        {{-- Content will be dynamically loaded here --}}
    </div>

    @include('common.footer') <!-- Include footer component -->

    <!-- Include the compiled JavaScript file before the closing body tag -->
    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
    
    <button class="btn" onclick="my_modal_5.showModal()">View Product</button>
<dialog id="my_modal_5" class="modal">
  <div class="modal-box">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    @include('common.productview')
  </div>
</dialog>

</body>
</html>
