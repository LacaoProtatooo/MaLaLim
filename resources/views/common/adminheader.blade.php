

<div class="navbar bg-gradient-to-b from-yellow-300 to-gray-100">
    <div class="flex-1">
      <div class="text-center">
        <a href="#" class="btn btn-ghost text-xl" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation">
          <img src="{{asset('storage/logo.png')}}" alt="MaLaLim" class="w-15 h-11">
        </a>
      </div>
    </div>
    
    {{-- LOGIN :: ADMIN PROFILE --}}
    @if (!Auth::user())
      <button class="btn" onclick="window.location.href='{{ url('login') }}'">LOGIN</button>
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
          <li> <a href="{{ route('admin.profile') }}" id="profileLink" class="justify-between hover:bg-yellow-200"> Profile </a></li>
          {{-- LOGOUT --}}
          <li><a href="#" id="logoutLink" class="justify-between hover:bg-yellow-200">Logout</a></li>
  
        </ul>
      </div>
    @endif
</div>



  