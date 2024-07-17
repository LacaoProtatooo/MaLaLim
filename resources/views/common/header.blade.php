
<div class="navbar bg-yellow-300">
  <div class="flex-1">
    <a class="btn btn-ghost text-xl">MaLaLim</a>
  </div>
    
    <button class="btn mr-3" onclick="my_modal_3.showModal()">
      <img src="../storage/cart.png" alt="Shopping Cart" style="width: 20px; height: 20px;" />
    </button>
    </button>
    <dialog id="my_modal_3" class="modal">
      <div class="modal-box">
        <form method="dialog" class="">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        @include('common.cart')
      </div>
    </dialog>

    <button class="btn mr-3" onclick="window.location.href='{{ url('favorites') }}'">Favorites</button>            
    
    <div class="dropdown dropdown-end">
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          {{-- Must Replace this with Registered Photo --}}
          <img
            alt="Profile Picture"
            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
        </div>
      </div>
      <ul
        tabindex="0"
        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
        <li>
          <a class="justify-between">
            Profile
          </a>
        </li>
        <li><a>Settings</a></li>
        <li><a>Logout</a></li>
      </ul>
    </div>
  </div>
</div>