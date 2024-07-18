
<div class="navbar bg-yellow-300">
  <div class="flex-1">
    <a class="btn btn-ghost text-xl" onclick="window.location.href='{{ route('home') }}'">MaLaLim</a>
  </div>
    
          
    
  {{-- LOGIN :: USER PROFILE --}}
  @if (!Auth::user())
    <button class="btn" onclick="window.location.href='{{ url('login') }}'">LOGIN</button>
  @else  
    <div class="dropdown dropdown-end">
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          {{-- Must Replace this with Registered Photo --}}
          <img
            alt="Profile Picture"
            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
        </div>
      </div>
      <ul tabindex="0"class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
        <li>
          <a class="justify-between">
            Profile
          </a>
        </li>
        <li><a>Settings</a></li>

        {{-- LOGOUT --}}
        <li><a href="#" id="logoutLink">Logout</a></li>
        
      </ul>
    </div>
  @endif
  
</div>