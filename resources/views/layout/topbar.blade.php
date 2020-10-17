<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->

            <!-- Nav Item - Alerts -->

            <!-- Nav Item - User Information -->
            @if(isset($userLogin))
        <li class="nav-item dropdown no-arrow">

            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$userLogin->name}}</span>
            <img class="img-profile rounded-circle" src="{{asset('img/userlogo.png')}}">
            </a>
        </li>
         @else
                ádasdasdasdasd
        @endif
          </ul>
          <div class="topbar-divider d-none d-sm-block"></div>
          <form action="{{ route('admin.logout') }}" method="POST" id="logout-form">
            {!!csrf_field() !!}
            <input type="hidden" name="check" value="">
            <button type="submit" class="btn btn-default btn-sm" style="color: black;" ><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Đăng xuất</button>
          </form>

        </nav>