@vite('resources/js/carousel.js')
@if (Auth::check() && Auth::user()->role && Auth::user()->role->title === 'customerplus')
    <div id="carous" class="carousel-container relative w-full p-3">
        <!-- Carousel content goes here -->
    </div>
@endif





