  <li class="nav-item">
    <a class="nav-link " href="{{route('menu_master.index')}}">
      <i class='bx bxs-category'></i>
      <span>Special Menu Master </span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{route('menu_selection.index')}}">
      <i class='bx bxs-category'></i>
      <span>Special Menu Selection </span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{route('canteen.today')}}">
      <i class='bx bxs-category'></i>
      <span>Today Meal Count </span>
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
  <a class="nav-link " href="{{route('canteen.reports')}}" oncontextmenu="return false;">
    <i class='bx bxs-calendar'></i>
    <span>Reports</span>
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