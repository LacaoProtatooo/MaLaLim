<style>
    .carousel{
        opacity: 0;
        animation: fadeIn 1s ease-in-out forwards;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }
</style>

<div class="carousel w-full">
    <!-- slide1 -->
    <div id="slide1" class="carousel-item relative w-full flex justify-center items-center">
    <div class="card lg:card-side bg-gradient-to-r from-yellow-200 to-yellow-300 shadow-xl h-36 m-5">
            <figure>
                <img
                    src="https://img.daisyui.com/images/stock/photo-1494232410401-ad00d5433cfa.webp"
                    alt="Album"
                />
            </figure>
            <div class="card-body justify-center">
                <h2 class="card-title text-xl">test1</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dapibus magna a
                    ultricies feugiat. Nulla.
                </p>
            </div>
        </div>
        <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
            <a href="#slide4" class="btn btn-circle">❮</a>
            <a href="#slide2" class="btn btn-circle">❯</a>
        </div>
    </div>

    <!-- slide2 -->
    <div id="slide2" class="carousel-item relative w-full flex justify-center items-center">
    <div class="card lg:card-side bg-gradient-to-r from-yellow-200 to-yellow-300 shadow-xl h-36 m-5">
            <figure>
                <img
                    src="https://img.daisyui.com/images/stock/photo-1494232410401-ad00d5433cfa.webp"
                    alt="Album"
                />
            </figure>
            <div class="card-body justify-center">
                <h2 class="card-title text-xl">test2</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dapibus magna a
                    ultricies feugiat. Nulla.
                </p>
            </div>
        </div>
        <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
            <a href="#slide1" class="btn btn-circle">❮</a>
            <a href="#slide3" class="btn btn-circle">❯</a>
        </div>
    </div>

    <!-- slide3 -->
    <div id="slide3" class="carousel-item relative w-full flex justify-center items-center">
    <div class="card lg:card-side bg-gradient-to-r from-yellow-200 to-yellow-300 shadow-xl h-36 m-5">
            <figure>
                <img
                    src="https://img.daisyui.com/images/stock/photo-1494232410401-ad00d5433cfa.webp"
                    alt="Album"
                />
            </figure>
            <div class="card-body justify-center">
                <h2 class="card-title text-xl">test3</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dapibus magna a
                    ultricies feugiat. Nulla.
                </p>
            </div>
        </div>
        <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
            <a href="#slide2" class="btn btn-circle">❮</a>
            <a href="#slide4" class="btn btn-circle">❯</a>
        </div>
    </div>

    <!-- slide4 -->
    <div id="slide4" class="carousel-item relative w-full flex justify-center items-center">
    <div class="card lg:card-side bg-gradient-to-r from-yellow-200 to-yellow-300 shadow-xl h-36 m-5">
            <figure>
                <img
                    src="https://img.daisyui.com/images/stock/photo-1494232410401-ad00d5433cfa.webp"
                    alt="Album"
                />
            </figure>
            <div class="card-body justify-center">
                <h2 class="card-title text-xl">test4</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dapibus magna a
                    ultricies feugiat. Nulla.
                </p>
            </div>
        </div>
        <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
            <a href="#slide3" class="btn btn-circle">❮</a>
            <a href="#slide1" class="btn btn-circle">❯</a>
        </div>
    </div>
</div>