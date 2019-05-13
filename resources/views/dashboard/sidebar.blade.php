<nav class="side-navbar">
  <!-- Sidebar Header-->
  <div class="sidebar-header d-flex align-items-center">
    <div class="avatar"><img src="{{ asset('img/avatar-1.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
    <div class="title">
      <h1 class="h4">{{ auth()->guard('admin')->user()->username }}</h1>
    </div>
  </div>
  

  <ul class="list-unstyled">
    <li class="{{ $segment == null ? 'active' : '' }}"><a href="{{ route('dashboard') }}"> <i class="icon-home"></i>Home </a></li>
  
    <li class="{{ in_array($segment, ['categories']) ? 'active' : '' }}">
      <a href="{{ route('dashboard.categories') }}">
         <i class="fa fa-list fa-lg"></i>
         <span class="px-2">Categories</span> 
      </a>
    </li>


    <li class="{{ in_array($segment, ['clients', 'services', 'branches']) ? 'active' : '' }}">
      <a href="{{ route('dashboard.clients') }}">
         <i class="fa fa-users-cog fa-lg"></i>
         <span class="px-2">Clients</span> 
      </a>
    </li>


    <li class="{{ in_array($segment, ['users']) ? 'active' : '' }}">
      <a href="#">
         <i class="fa fa-user-friends fa-lg"></i>
         <span class="px-2">Users</span> 
      </a>
    </li>
    
  </ul>

</nav>
