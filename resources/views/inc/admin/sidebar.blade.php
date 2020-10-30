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
    <a class="nav-link" href="route('admin.dashboard')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <li class="nav-item {{ request()->segment(2) == '' ? 'active': ''}}">
    <a class="nav-link" href="route('home.index')}}">
      <i class="fas fa-fw fa-h-square"></i>
      <span>Store</span></a>
  </li>
  
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Product Information
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productsCollapse" aria-expanded="true" aria-controls="productsCollapse">
      <i class="fas fa-fw fa-bus-alt"></i>
      <span>Products</span>
    </a>
    <div id="productsCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Product Bread:</h6>
        <a class="collapse-item" href="{{route('product.index')}}">Manage Products</a>
        <a class="collapse-item" href="{{route('product.create')}}">Add Product</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ordersCollapse" aria-expanded="true" aria-controls="ordersCollapse">
      <i class="fas fa-fw fa-people-carry"></i>
      <span>Orders</span>
    </a>
    <div id="ordersCollapse" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Order information:</h6>
        <a class="collapse-item" href="{{route('order.index')}}">Manage Orders</a>
        <a class="collapse-item" href="route('reviews.index')}}">Manage reviews</a>
      </div>
    </div>
  </li>
  
  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#promotionsCollapse" aria-expanded="true" aria-controls="promotionsCollapse">
      <i class="fas fa-fw fa-people-carry"></i>
      <span>Promotions</span>
    </a>
    <div id="promotionsCollapse" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Promotion information:</h6>
        <a class="collapse-item" href="route('freeshipping.index')}}">Free shipping</a>
        <a class="collapse-item" href="route('campaign.index')}}">Campaigns</a>
      </div>
    </div>
  </li>

  <li class="nav-item {{ request()->segment(1) == 'categories' ? 'active': ''}}">
    <a class="nav-link" href="{{route('category.index')}}">
      <i class="fas fa-fw fa-ticket-alt"></i>
      <span>Manage Categories</span></a>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Accounts Information
  </div>


  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#accountsCollapse" aria-expanded="true" aria-controls="accountsCollapse">
      <i class="fas fa-fw fa-people-carry"></i>
      <span>Account & settings</span>
    </a>
    <div id="accountsCollapse" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Accounts information:</h6>
        <a class="collapse-item" href="route('admin.profile')}}">Profile</a>
        <a class="collapse-item" href="route('usermanagement.index')}}">User Management</a>
      </div>
    </div>
  </li>

</ul>
<!-- End of Sidebar -->
