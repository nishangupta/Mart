<ul class="list-group">
  <li class="list-group-item bg-light">
    Hello, {{auth()->user()->name}}
  </li>
  <li class="list-group-item-action list-group-item">
    <a href="{{route('user.index')}}" >
      <i class="fas fa-user-circle text-primary"></i> My Account
    </a>
  </li>
  <li class="list-group-item-action list-group-item">
    <a href="{{route('cart.index')}}">
      <i class="fas fa-shopping-cart text-primary"></i> Cart
    </a>
  </li>
  <li class="list-group-item-action list-group-item">
    <a href="{{route('myOrder.index')}}">
      <i class="fas fa-cart-plus text-primary"></i> Orders
    </a>
  </li>
  <li class="list-group-item-action list-group-item">
    <a href="{{route('myCancellation.index')}}">
      <i class="fas fa-window-close text-primary"></i> Cancellations
    </a>
  </li>
  <li class="list-group-item-action list-group-item">
    <a href="{{route('account.logout')}}">
      <i class="fas fa-sign-out-alt text-primary"></i> Logout
    </a>
  </li>
</ul>
