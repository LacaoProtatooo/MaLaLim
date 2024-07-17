<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @include('common.links')
</head>
<body>
    @include('common.header')
    @include('common.navbar')

    <div class="w-full mx-auto max-w-screen-xl p-4 md:grid md:grid-cols-4 gap-4 shadow-md">
        @include('common.card')
    </div>

    <button class="btn" onclick="my_modal_5.showModal()">View Product</button>
    <dialog id="my_modal_5" class="modal">
      <div class="modal-box">
        <form method="dialog">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        @include('common.productview')
      </div>
    </dialog>
    @include('common.footer')
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
