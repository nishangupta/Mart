<section class="top-banner bg-light my-0 py-2">
  <div class="container-fluid">
      <ul class="top-banner-list small">
        <li>
          <a href="">Call us:+4222022</a>
        </li>
        <li>
          <a href="{{route('register')}}">Sign up</a>
        </li>
        <li>
          <a href="{{route('login')}}">Login</a>
        </li>
        <li class="active">
          <a href="">Track my order</a>
        </li>
      </ul>
  </div>
</section>

<header class="section-header sticky-top my-0 py-0">
  <section class="header-main border-bottom">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-3 col-sm-6 col-md-3 col-5"> 
                <a href="{{route('shop.index')}}" class="brand-wrap" data-abc="true">
                      {{-- <img class="logo" width="50px" src="{{asset('logo.png')}}">  --}}
                      <span class="logo">Mart</span> 
                </a> </div>
              <div class="col-lg-6 col-sm-8 col-md-6  col-xl-5  d-none d-md-block">
                  <form action="#" class="search-wrap">
                      <div class="input-group w-100"> <input type="text" class="form-control search-form" style="width:55%;" placeholder="Search">
                          <div class="input-group-append"> <button class="btn btn-primary search-button" type="submit"> <i class="fa fa-search"></i> </button> </div>
                      </div>
                  </form>
              </div>
              <div class="col-lg-3 col-sm-6 col-md-3 col-xl-4 col-7">
                  <div class="d-flex justify-content-end">
                    <a class="nav-link nav-user-img text-white" href="#"> <i class="fas fa-shopping-cart"></i></a>
                    <a class="nav-link nav-user-img text-white" href="{{route('login')}}"> LOGIN</a>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <nav class="navbar navbar-expand-md navbar-main border-bottom shadow bg-light">
      <div class="container">
          <form class="d-md-none my-2">
              <div class="input-group"> 
                  <input type="search" name="search" class="form-control" placeholder="Search" required="">
                  <div class="input-group-append"> 
                    <button type="submit" class="btn btn-secondary"> <i class="fa fa-search"></i> </button> 
                  </div>
              </div>
          </form> 
          <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#dropdown6" aria-expanded="false"> <span class="navbar-toggler-icon"></span> </button>
          <div class="navbar-collapse collapse" id="dropdown6" style="">
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown" data-abc="true" aria-expanded="false">Laptops</a>
                      <div class="dropdown-menu"> <a class="dropdown-item" href="" data-abc="true">Lenovo</a> <a class="dropdown-item" href="" data-abc="true">Dell</a> <a class="dropdown-item" href="" data-abc="true">HP</a> <a class="dropdown-item" href="" data-abc="true">Apple</a> </div>
                  </li>
                  <li class="nav-item"> <a class="nav-link" href="" data-abc="true">Refurbished Mobile</a> </li>
                  <li class="nav-item"> <a class="nav-link" href="" data-abc="true">Accessories & Peripheral</a> </li>
                  <li class="nav-item"> <a class="nav-link" href="" data-abc="true">Blog</a> </li>
                  <li class="nav-item"> <a class="nav-link" href="" data-abc="true">Support</a> </li>
              </ul>
          </div>
      </div>
  </nav>
</header>
