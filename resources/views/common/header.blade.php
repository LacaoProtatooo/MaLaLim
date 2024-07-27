
<div class="navbar bg-gradient-to-b from-yellow-300 to-gray-100">
  <div class="flex-1">
  <a class="btn btn-ghost text-xl" onclick="window.location.href='{{ route('home') }}'">
    <img class="w-15 h-11" src="{{asset('storage/login-image.png')}}" alt="MaLaLim" />
  </a>
  </div>

  {{-- LOGIN :: USER PROFILE --}}
  @if(!Auth::user())
  <button class="btn w-24 h-5 bg-yellow-50 rounded-md shadow-md hover:bg-yellow-100" onclick="window.location.href='{{ url('login') }}'">LOGIN</button>
  @else
  <a class="btn btn-ghost text-xl">{{ Auth::user()->fname }}</a>
    <div class="dropdown dropdown-end">
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          @if (Auth::check())
              @php
                  $imagePath = Auth::user()->image_path ? asset(Auth::user()->image_path) : 'https://www.svgrepo.com/show/530585/user.svg';
              @endphp
          @else
              @php
                  $imagePath = 'https://www.svgrepo.com/show/530585/user.svg';
              @endphp
          @endif

          <img alt="Profile Picture" src="{{ $imagePath }}" />
        </div>
      </div>
      <ul tabindex="0"class="menu menu-sm dropdown-content bg-gray-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
        {{-- PROFILE --}}
        <li> <a href="{{ route('customer.profile') }}" id="profileLink" class="justify-between hover:bg-yellow-200"> Profile </a></li>
        <li> <a class="justify-between Urders hover:bg-yellow-200"> Orders </a></li>
        {{-- LOGOUT --}}
        <li><a class="justify-between Urders hover:bg-yellow-200"href="#" id="logoutLink">Logout</a></li>

      </ul>
    </div>
  @endif
</div>

</div>
