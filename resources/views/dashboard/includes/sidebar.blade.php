<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link {{ $segment == null ? 'active' : '' }}" href="{{ route('admin.dashboard.index') }}">
                    <i class="icon-home"></i> {{ __('lang.dashboard') }} 
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $segment == 'services' ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
                    <i class="icon-layers"></i> {{ __('lang.services') }} 
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $segment == 'blogs' ? 'active' : '' }}" href="{{ route('admin.blogs.index') }}">
                    <i class="icon-book-open"></i> {{ __('lang.blogs') }} 
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $segment == 'sliders' ? 'active' : '' }}" href="{{ route('admin.sliders.index') }}">
                    <i class="icon-eyeglass"></i> {{ __('lang.sliders') }} 
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $segment == 'infos' ? 'active' : '' }}" href="{{ route('admin.infos.index') }}">
                    <i class="icon-info"></i> {{ __('lang.infos') }}
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link {{ $segment == 'settings' ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                    <i class="icon-settings"></i> {{ __('lang.settings') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $segment == 'contactus' ? 'active' : '' }}" href="{{ route('admin.contactus.index') }}">
                    <i class="icon-emotsmile"></i> {{ __('lang.contactus') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $segment == 'users' ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="icon-people"></i> {{ __('lang.users') }} 
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $segment == 'admins' ? 'active' : '' }}" href="{{ route('admin.admins.index') }}">
                    <i class="icon-diamond"></i> {{ __('lang.admins') }} 
                </a>
            </li>

        </ul>
    </nav>
</div>

  {{--   <li class="{{ $segment == null ? 'active' : '' }}"><a href="{{ route('dashboard') }}"> <i class="icon-home"></i>Home </a></li>
  
    <li class="{{ in_array($segment, ['categories']) ? 'active' : '' }}">
      <a href="{{ route('dashboard.categories') }}">
         <i class="fa fa-list fa-lg"></i>
         <span class="px-2">Categories</span> 
      </a>
    </li>
 --}}
