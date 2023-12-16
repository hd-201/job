<div class="main-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar">
  <div class="sidebar-header">
    <a href="/" class="sidebar-brand">
      Kenna<span>Tech</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Home</li>
      <li class="nav-item">
        <a href="/" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Công việc</span>
        </a>
      </li>
      <li class="nav-item nav-category">Quản lý</li>
      <li class="nav-item">
        <a href="{{ route('staff') }}" class="nav-link">
          <i class="link-icon" data-feather="user"></i>
          <span class="link-title">Nhân viên</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('team') }}" class="nav-link">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Nhóm</span>
        </a>
      </li>
    </ul>
  </div>
</nav>
<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Theme:</h6>
            <a class="theme-item" href="demo1/dashboard.html">
                <img src="{{ asset('assets/images/screenshots/light.jpg') }}" alt="light theme">
            </a>
            <h6 class="text-muted mb-2">Dark Theme:</h6>
            <a class="theme-item active" href="demo2/dashboard.html">
                <img src="{{ asset('assets/images/screenshots/dark.jpg') }}" alt="light theme">
            </a>
        </div>
    </div>
</nav>