<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('trangchu')}}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Quản lý điểm</div>
      </a>

      <!-- Divider -->


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->

      <!-- Nav Item - Pages Collapse Menu -->
      @if($userLogin->super_admin == 0 || $userLogin->super_admin == 1)
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-cog"></i>
          <span>Thiết lập</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{url('admin/kihoc')}}">Thiết lập năm học</a>
            <a class="collapse-item" href="{{url('admin/monhoc')}}">Thiết lập môn học</a>
            <a class="collapse-item" href="{{url('admin/users/danhsachnguoidung')}}">Quản lý người dùng</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
      @endif

      <!-- Nav Item - Utilities Collapse Menu -->

      <!-- Divider -->
      

      <!-- Heading -->

      <!-- Nav Item - Pages Collapse Menu -->
      



      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/lophoc')}}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Quản lý lớp học</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/diem')}}">
          <i class="fas fa-fw fa-table"></i>
          <span>Điểm</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="false" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Thống kê</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{url('admin/thongkelop')}}">Thống kê học lực theo lớp</a>
            <a class="collapse-item" href="{{url('admin/thongkekhoi')}}">Thống kê học lực theo khối</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>