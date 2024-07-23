
<div class="navbar bg-yellow-300">
  <div class="flex-1">
    <a class="btn btn-ghost text-xl" onclick="window.location.href='{{ route('home') }}'">MaLaLim</a>
  </div>



  {{-- LOGIN :: USER PROFILE --}}
  @if (!Auth::user())
    <button class="btn" onclick="window.location.href='{{ url('login') }}'">LOGIN</button>
  @else
  <a class="btn btn-ghost text-xl">{{ Auth::user()->fname }}</a>
    <div class="dropdown dropdown-end">
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          {{-- Must Replace this with Registered Photo --}}
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
      <ul tabindex="0"class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
        {{-- PROFILE --}}
        <li> <a href="{{ route('customer.profile') }}" id="profileLink" class="justify-between"> Profile </a></li>
        <li> <a class="justify-between Urders"> Orders </a></li>
        {{-- LOGOUT --}}
        <li><a href="#" id="logoutLink">Logout</a></li>

      </ul>
    </div>
  @endif

</div>
