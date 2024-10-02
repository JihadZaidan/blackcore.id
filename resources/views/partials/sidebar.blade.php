@php
  $submenu_user_active = Request::is('admin/users*') || Request::is('admin/admins*');
  $submenu_kategori_active = Request::routeIs('admin.categories.*') || Request::routeIs('admin.tags.*');
@endphp
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item {{ $submenu_user_active ? 'active' : '' }}">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic"
        aria-expanded="{{ $submenu_user_active ? 'true' : 'false' }}" aria-controls="ui-basic">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">User</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Request::is('admin/users*') || Request::is('admin/admin*') ? 'show' : '' }}"
        id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ Request::is('admin/users*') ? 'sub-active' : '' }}">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
              <i class="fas fa-user menu-icon"></i>User</a>
          </li>
          <li class="nav-item {{ Request::is('admin/admins*') ? 'sub-active' : '' }}">
            <a class="nav-link" href="{{ route('admin.admins.index') }}">
              <i class="fas fa-user-tie menu-icon"></i>Admin</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{ Request::routeIs('admin.order.*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.order.index') }}">
        <i class="fas fa-list menu-icon"></i>
        <span class="menu-title">Order</span>
      </a>
    </li>
  
    <li class="nav-item {{ Request::is('admin/products*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.products.index') }}">
        <i class="icon-bag menu-icon"></i>
        <span class="menu-title">Produk</span>
      </a>
    </li>
    <li class="nav-item {{ Request::routeIs('admin.articles.*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.articles.index')}}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Informasi</span>
      </a>
    </li>
    <li class="nav-item {{ $submenu_kategori_active ? 'active' : '' }}">
      <a class="nav-link" data-toggle="collapse" href="#kategori_tag"
        aria-expanded="{{ $submenu_kategori_active ? 'true' : 'false' }}" aria-controls="kategori_tag">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Kategori &amp; Tags</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ $submenu_kategori_active ? 'show' : '' }}"
        id="kategori_tag">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ Request::routeIs('admin.categories.*') ? 'sub-active' : '' }}">
            <a class="nav-link" href="{{ route('admin.categories.index') }}">
              <i class="icon-grid menu-icon"></i>Kategori</a>
          </li>
          <li class="nav-item {{ Request::routeIs('admin.tags.*') ? 'sub-active' : '' }}">
            <a class="nav-link" href="{{ route('admin.tags.index') }}">
              <i class="icon-tag menu-icon"></i>Tags</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{ Request::routeIs('admin.chat.*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.chat.index')}}">
        <i class="fas fa-comments menu-icon"></i>
        <span class="menu-title">Chat</span>
      </a>

    </li>
  </ul>
</nav>
