@php
    $prefix = Request::route() -> getPrefix();
    $route = Route::current() -> getName();

    // $uri = Route::getFacadeRoot() -> current() -> uri();
    $uri = URL::current();

@endphp

@if(Session::get('page') == 'all')
  @php
      echo 'done';
  @endphp
@endif

{{-- {{Session::get('page')}}
{{$route}} --}}


<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item {{ ($route == 'admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{url('admin/dashboard')}}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      @if(Auth::guard('admin') -> user() -> type == 'vendor')
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Vendor Settings</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/update-vendor-details/personal')}}">Personal Details</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/update-vendor-details/business')}}">Business Details</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/update-vendor-details/bank')}}">Bank Details</a></li>
          </ul>
        </div>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Admin Settings</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{ ($route == 'update.admin.password') ? 'active' : '' }}" href="{{url('admin/update-password')}}">Update Password</a></li>
            <li class="nav-item"> <a class="nav-link {{ ($route == 'update.admin.details') ? 'active' : '' }}" href="{{url('admin/update-details')}}">Update Details</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#admin-management" aria-expanded="false" aria-controls="admin-management">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Admin Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="admin-management">
          <ul class="nav flex-column sub-menu">
         
            <li class="nav-item"> 
              <a class="nav-link {{ ($uri == 'http://127.0.0.1:8000/admin/all-sub-admin') ? 'active' : '' }}" href="{{url('admin/all-sub-admin')}}">Sub-Admin</a>
            </li>
            <li class="nav-item"> 
              <a class="nav-link {{ ($uri == 'http://127.0.0.1:8000/admin/all-admin') ? 'active' : '' }}" href="{{url('admin/all-admin')}}">Admin</a>
            </li>
            <li class="nav-item"> 
              <a class="nav-link" href="{{url('admin/all-vendor')}}">Vendor</a>
            </li>
            <li class="nav-item"> 
              <a class="nav-link @if(Session::get('page') === 'all-admin-data') active @endif" href="{{url('admin/all')}}">All</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#user-management" aria-expanded="false" aria-controls="user-management">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">User Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="user-management">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="">Users</a></li>
            <li class="nav-item"> <a class="nav-link" href="">Subscribers</a></li>
          </ul>
        </div>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <i class="icon-columns menu-icon"></i>
          <span class="menu-title">Form elements</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
          <i class="icon-bar-graph menu-icon"></i>
          <span class="menu-title">Charts</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="charts">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
          <i class="icon-grid-2 menu-icon"></i>
          <span class="menu-title">Tables</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
          <i class="icon-contract menu-icon"></i>
          <span class="menu-title">Icons</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="icons">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="icon-head menu-icon"></i>
          <span class="menu-title">User Pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
          <i class="icon-ban menu-icon"></i>
          <span class="menu-title">Error pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="error">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/documentation/documentation.html">
          <i class="icon-paper menu-icon"></i>
          <span class="menu-title">Documentation</span>
        </a>
      </li>
    </ul>
  </nav>