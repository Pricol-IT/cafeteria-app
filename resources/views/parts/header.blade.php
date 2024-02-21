<header id="header" class="header fixed-top d-flex align-items-center">
    <i class="bi bi-list toggle-sidebar-btn"></i>&nbsp;
    <div class="d-flex align-items-center text-center justify-content-between">
      <a href="#." class="logo d-flex align-items-center">
        <img src="{{asset('img/pricol_logo.png')}}" alt="180">
        
      </a>
      
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        @if(auth()->user()->role == 'user')
        <li class="nav-item dropdown">
            
          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" onclick="ReadNotification()">
            <i class="bi bi-bell"></i>
            @if(userNotificationsCount() != 0)
            <span class="badge bg-primary badge-number"> {{ userNotificationsCount() }}</span>
            @endif
          </a><!-- End Notification Icon -->
 
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have {{ userNotificationsCount() }} new notifications
              <!-- <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a> -->
            </li>
            @php
                $notifications = userNotifications();
            @endphp
            @forelse($notifications as $notification)

            <li>
              <hr class="dropdown-divider">
            </li>
            @if ($notification->type == 'App\Notifications\WeeklyMenuCreatedNotification')
            
            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <p>{{ $notification->data['message'] }} - <span>{{ $notification->created_at->diffForHumans() }}</span></p>
                
              </div>
            </li>
            
            @endif
            @if ($notification->type == 'App\Notifications\MenuDeleteNotification')
            
            <li class="notification-item">
              <i class="bi bi-check-circle text-danger"></i>
              <div>
                <p>{{ $notification->data['message'] }} - <span>{{ $notification->created_at->diffForHumans() }}</span></p>
                
              </div>
            </li>
            
            @endif
            @if ($notification->type == 'App\Notifications\MonthlyMenuCreatedNotification')
            
            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <p>{{ $notification->data['message'] }} - <span>{{ $notification->created_at->diffForHumans() }}</span></p>
              </div>
            </li>
            
            @endif
            <li>
              <hr class="dropdown-divider">
            </li>
              @empty
              <li>
              <hr class="dropdown-divider">
            </li>
              <li class="notification-item" >No, Notification found!</li>
              <li>
              <hr class="dropdown-divider">
            </li>
            @endforelse

            
            <!-- <li class="dropdown-footer">
              
              <a href="{{ route('markAsRead') }}">Mark as Read</a>

            </li> -->

          </ul><!-- End Notification Dropdown Items -->

        </li>
        @endif
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!-- <img src="{{ asset('assets/img/profile-img.jpg'); }}" alt="Profile" class="rounded-circle"> -->
            <i class="bi bi-person-circle"></i>
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user() ? Auth::user()->name : ''  }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <!-- <li class="dropdown-header">
              <h6>User</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li> -->

            <!-- <li>
              <a class="dropdown-item d-flex align-items-center" href="#.">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li> -->
            <!-- <li>
              <hr class="dropdown-divider">
            </li> -->

            @if(auth()->user()->role == 'user')
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('user.profile')}}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('user.password')}}">
                <i class="bi bi-key "></i>
                <span>Reset Password</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="https://myapp.pricol.co.in/IntranetPortal/Announcements/Cafeteria%20App%20User's%20Manual.pdf">
                <i class="bi bi-question-circle"></i>
                <span>User Guide</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            @endif
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->