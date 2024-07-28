
{{-- CREATE JEWELRY MODAL --}}
<dialog id="creatematerial" class="modal">
    <div class="modal-box">
        <div class="relative bg-white rounded-lg">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="document.getElementById('creatematerial').close()">✕</button>
            <h3 class="text-lg font-bold mb-4"> Create New Jewelry </h3>

            <form class="max-w-md mx-auto" id="materialForm" method="#" action="#" enctype="multipart/form-data">
                @csrf
                {{-- NAME --}}
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="material" id="material" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Material</label>
                </div>
                {{-- DESCRIPTION --}}
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="description" id="description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="description" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description</label>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
            </form>
            <br>
            <div class="image-container">
                <img class="h-auto max-w-lg" id="uploadedImage" src="" alt="Image Preview">
            </div>

            <style>
                .image-container {
                    position: relative;
                    overflow: hidden;
                    max-height: 800px;
                    max-width: 800px;
                }
                .image-container img {
                    width: 100%;
                    height: auto;
                }
            </style>

        </div>
    </div>
</dialog>
