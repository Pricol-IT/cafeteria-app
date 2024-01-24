<li class="nav-item">
  <a class="nav-link " href="{{route('user.index')}}">
    <i class='bx bxs-calendar'></i>
    <span>User Details </span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link " href="{{route('auto_booking.index')}}">
    <i class='bx bxs-calendar'></i>
    <span>Auto Booking </span>
  </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-reports" data-bs-toggle="collapse" href="#">
      <i class="bx bxs-calendar"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icons-reports" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{route('admin.reports')}}">
          <i class="bi bi-circle"></i><span>Over All Reports</span>
        </a>
      </li>
      <li>
        <a href="{{route('admin.detailreports')}}">
          <i class="bi bi-circle"></i><span>Day Reports</span>
        </a>
      </li>
      <li>
        <a href="{{route('admin.detailallreports')}}">
          <i class="bi bi-circle"></i><span>Monthly Reports</span>
        </a>
      </li>
    </ul>
  </li>