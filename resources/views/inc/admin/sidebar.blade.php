<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
    <div class="sidebar-brand-text mx-2">Admin panel</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{ request()->segment(2) == 'dashboard' ? 'active': ''}}">
    <a class="nav-link" href="{{route('admin.dashboard')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <li class="nav-item {{ request()->segment(2) == '' ? 'active': ''}}">
    <a class="nav-link" href="{{route('home.index')}}">
      <i class="fas fa-fw fa-h-square"></i>
      <span>Home</span></a>
  </li>
  
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Product Information
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-bus-alt"></i>
      <span>Products</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Product Bread:</h6>
        <a class="collapse-item" href="{{route('product.index')}}">Manage Products</a>
        <a class="collapse-item" href="{{route('product.create')}}">Add Product</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-people-carry"></i>
      <span>Orders</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Order information:</h6>
        <a class="collapse-item" href="{{route('customer.index')}}">Manage Orders</a>
        <a class="collapse-item" href="{{route('customer.pendingRequest')}}">Manage reviews</a>
      </div>
    </div>
  </li>
  
  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-people-carry"></i>
      <span>Promotions</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Promotion information:</h6>
        <a class="collapse-item" href="{{route('customer.index')}}">Free shipping</a>
        <a class="collapse-item" href="{{route('customer.pendingRequest')}}">Campains</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <li class="nav-item {{ request()->segment(1) == 'my-reservatins' ? 'active': ''}}">
    <a class="nav-link" href="{{route('reservation.index')}}">
      <i class="fas fa-fw fa-ticket-alt"></i>
      <span>Account & settings</span></a>
  </li>

</ul>
<!-- End of Sidebar -->
