<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      @if(Auth::guard('admin')->check())
      
        <x-sidebar.admin-sidebar />
      
      @endif
      

        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
          </a>
          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
        </li>
    </ul>

  </aside>