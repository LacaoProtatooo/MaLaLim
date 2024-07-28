<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    @include('common.links')
    @vite('resources/js/register.js')
</head>
<body class="bg-gray-100">
    @include('common.header')

    <div class="text-black min-h-screen flex flex-col items-center justify-center bg-gray-100 mt-10">
        <div class="grid md:grid-cols-2 items-center gap-4 max-w-6xl w-full p-4 m-4 rounded-md bg-white shadow-2xl px-10 py-10">
            <div class="md:max-w-md w-full sm:px-6 py-4">
                <div class="mb-12">
                    <h3 class="text-3xl font-bold">Sign in</h3>
                    {{-- Register Here --}}
                    <p class="text-sm mt-4">Don't have an account? <a onclick="document.getElementById('registeruserModal').showModal()" class="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">Register here</a></p>
                </div>
                <form name="loginForm" id="loginForm">
                    @csrf
                    <div>
                        <label class="text-xs block mb-2">Email</label>
                        <div class="relative flex items-center">
                            <input name="email" id="email" type="text" required class="w-full text-sm border-b border-gray-300 focus:border-black px-2 py-3 outline-none" placeholder="Enter email" />
                        </div>
                    </div>
                    <div class="mt-8">
                        <label class="text-xs block mb-2">Password</label>
                        <div class="relative flex items-center">
                            <input name="password" id="password" type="password" required class="w-full text-sm border-b border-gray-300 focus:border-black px-2 py-3 outline-none" placeholder="Enter password" />
                        </div>
                    </div>
                    <div class="mt-12">
                        <button type="submit" class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold bg-yellow-300 rounded-full hover:bg-yellow-400 hover:text-white focus:outline-none">
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
            <div class="md:h-full max-md:mt-10 bg-[#ffffff] rounded-xl lg:p-12 p-8">
                <img src="{{ asset('storage/login-image.png') }}" class="w-full h-full object-contain" alt="login-image" />
            </div>
        </div>
    </div>

    @include('modal.userregister')
    @include('common.footer')
</body>
</html>