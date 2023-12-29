<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      @if(auth()->user())
      @if(auth()->user()->role == 'user')
        <x-sidebar.user-sidebar />
      @elseif(auth()->user()->role == 'canteen')
        <x-sidebar.canteen-sidebar />
      @endif
      @endif
      

        <li class="nav-item">
          <a class="nav-link " href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
        </li>
    </ul>

  </aside>