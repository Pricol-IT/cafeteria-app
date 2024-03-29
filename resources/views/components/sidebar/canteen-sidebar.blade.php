  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-navn" data-bs-toggle="collapse" href="#">
      <i class="bx bx-category"></i><span>Special Meal</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icons-navn" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{route('menu_master.index')}}">
          <i class="bi bi-circle"></i><span>Menu Master</span>
        </a>
      </li>
      <li>
        <a href="{{route('menu_selection.index')}}">
          <i class="bi bi-circle"></i><span>Menu Selection</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{route('si_menu.index')}}">
      <i class='bx bxs-category'></i>
      <span>South Indian </span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{route('banner_menu.index')}}">
      <i class='bx bxs-category'></i>
      <span>Banner Menu</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{route('price_master.index')}}">
      <i class='bx bxs-category'></i>
      <span>Price Master </span>
    </a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
      <i class="bx bx-category"></i><span>Delivery</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{route('canteen.deliverySpm')}}">
          <i class="bi bi-circle"></i><span>Special Meal</span>
        </a>
      </li>
      <li>
        <a href="{{route('canteen.deliverySim')}}">
          <i class="bi bi-circle"></i><span>South Indian Meal</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-reports" data-bs-toggle="collapse" href="#">
      <i class="bx bxs-calendar"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icons-reports" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{route('canteen.reports')}}">
          <i class="bi bi-circle"></i><span>Over All Reports</span>
        </a>
      </li>
      <li>
        <a href="{{route('canteen.detailreports')}}">
          <i class="bi bi-circle"></i><span>Day Reports</span>
        </a>
      </li>
      <li>
        <a href="{{route('canteen.detailallreports')}}">
          <i class="bi bi-circle"></i><span>Monthly Reports</span>
        </a>
      </li>
    </ul>
  </li>
  
<li class="nav-item">
    <a class="nav-link " href="{{route('canteen.today')}}">
      <i class='bx bxs-category'></i>
      <span>Today Meal Count </span>
    </a>
  </li>
<li class="nav-item">
  <a class="nav-link " href="{{route('canteen.livereport')}}" oncontextmenu="return false;">
    <i class='bx bxs-calendar'></i>
    <span>Live Count</span>
  </a>
</li>

  <!-- <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
      <i class="bx bx-trip"></i><span>Trip</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{route('canteen.dashboard')}}">
          <i class="bi bi-circle"></i><span>Add Trip</span>
        </a>
      </li>
      <li>
        <a href="{{route('canteen.dashboard')}}">
          <i class="bi bi-circle"></i><span>My Trip</span>
        </a>
      </li>
    </ul>
  </li> -->