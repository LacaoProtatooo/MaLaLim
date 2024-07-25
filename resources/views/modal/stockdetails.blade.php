{{-- DETAILS: EDIT STOCK | JEWELRY VARIANT MODAL --}}
<dialog id="editstockmodal" class="modal">
    <div class="modal-box">
        <div class="relative bg-white rounded-lg">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="document.getElementById('editstockmodal').close()">✕</button>
            <h3 class="text-lg font-bold mb-4">Jewelry Stock Details</h3>
        
            <form class="max-w-md mx-auto" id="stockeditForm" method="post" action="#" enctype="multipart/form-data">
                {{-- Variant number --}}
                <div class="relative z-0 w-full mb-5 group">
                    <input disabled type="text" name="stockno" id="stockno" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="stockno" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jewelry Variant Entry</label>
                </div>
                {{-- Jewelry No. | Name --}}
                <div class="relative z-0 w-full mb-5 group">
                    <input disabled type="text" name="jewelry" id="jewelryedit" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="jewelry" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jewelry Name</label>
                </div>
                {{-- Color --}}
                <div class="relative z-0 w-full mb-5 group">
                    <input disabled type="text" name="color" id="coloredit" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="color" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Color Variant</label>
                </div>
                {{-- Stock --}}
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="stock" id="stockedit" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="stock" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Stock Quantity</label>
                </div>
                {{-- created at --}}
                <div class="relative z-0 w-full mb-5 group">
                    <input disabled type="text" name="created_at" id="createdatedit" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="created_at" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jewelry Variant Listed Date</label>
                </div>

                {{-- IMAGE PATH | CAPABLE OF MULTIPLE BUT 1 is enough --}}
                <button type="button" id="showFileInput" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload Images</button>
                <input type="file" id="file_input_edit" name="images[]" accept="image/*" multiple hidden>
                <input type="hidden" name="image_path" id="image_pathedit" />

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
            </form>
            
            <br>
            <div class="image-container">
                <div id="uploadedImagesEdit" class="flex flex-wrap"></div> <!-- Container for multiple image previews -->
            </div>
            
            <style>
                .image-container {
                    position: relative;
                    overflow: hidden;
                    max-height: 800px;
                    max-width: 800px;
                }
                .image-container img {
                    max-height: 200px;
                    max-width: 200px;
                    margin-right: 10px;
                    margin-bottom: 10px;
                }
            </style>
        </div>
    </div>
</dialog>