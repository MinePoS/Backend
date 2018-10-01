       <li class="nav-item"><a href="{{Route('admin.dashboard')}}" class="nav-link @if(\Request::is('admin/dashboard')) active @endif"><i class="fa fa-dashboard nav-icon"></i> <span>Dashboard</span></a></li>

        @if(\Auth::user()->can('list product') || \Auth::user()->can('create product'))
                <li class="nav-item has-treeview @if(\Request::is('admin/products*')) active @endif">
                  <a class="nav-link" href="#">
                    <i class="nav-icon fa fa-folder-open"></i>
          <p>
            Products
            <i class="right fa fa-angle-left"></i>
          </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: none;">
                    @if(\Auth::user()->can('create product'))
                    <li class="nav-item"><a class="nav-link" href="{{Route('admin.products.new')}}"><i class="fa fa-plus nav-icon"></i> <p>Create Products</p></a></li>
                    @endif
                    @if(\Auth::user()->can('list product'))
                    <li class="nav-item"><a class="nav-link" href="{{Route('admin.products')}}"><i class="fa fa-list nav-icon"></i><p> Manage Products</p></a></li>
                    @endif
                  </ul>
                </li>
        @endif

        @if(\Auth::user()->can('list category') || \Auth::user()->can('create category'))
                <li class="nav-item has-treeview @if(\Request::is('admin/catagories*')) active @endif">
                  <a class="nav-link" href="#">
                    <i class="fa fa-th-large nav-icon"></i> 
          <p>
            Categories
            <i class="right fa fa-angle-left"></i>
          </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: none;">
                    @if(\Auth::user()->can('create category'))
                    <li class="nav-item"><a class="nav-link" href="{{Route('admin.Categories.new')}}"><i class="fa fa-plus nav-icon"></i> Create Category</a></li>
                    @endif
                    @if(\Auth::user()->can('list category'))
                    <li class="nav-item"><a class="nav-link" href="{{Route('admin.Categories')}}"><i class="fa fa-list nav-icon"></i> Manage Categories</a></li>
                    @endif
                  </ul>
                </li>
        @endif

        @if(\Auth::user()->can('list coupons') || \Auth::user()->can('create coupons'))
                <li class="nav-item has-treeview @if(\Request::is('admin/coupons*')) active @endif">
                  <a class="nav-link" href="#">
                    <i class="fa fa-tags nav-icon"></i>
                    <p>
            Coupons
            <i class="right fa fa-angle-left"></i>
          </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: none;">
                    @if(\Auth::user()->can('create coupons'))
                    <li class="nav-item"><a class="nav-link" href=""><i class="fa fa-plus nav-icon"></i> Create Coupons</a></li>
                    @endif
                    @if(\Auth::user()->can('list coupons'))
                    <li class="nav-item"><a class="nav-link" href=""><i class="fa fa-list nav-icon"></i> Manage Coupons</a></li>
                    @endif
                  </ul>
                </li>
        @endif

        @if(\Auth::user()->can('list order') || \Auth::user()->can('create order'))
                <li class="nav-item has-treeview @if(\Request::is('admin/orders*')) active @endif">
                  <a class="nav-link" href="#">
                    <i class="fa fa-credit-card nav-icon"></i>
                    <p>
            Orders
            <i class="right fa fa-angle-left"></i>
          </p>
                  </a>
          <ul class="nav nav-treeview" style="display: none;">
                    @if(\Auth::user()->can('create order'))
                    <li class="nav-item"><a class="nav-link" href=""><i class="fa fa-plus nav-icon"></i> Create Orders</a></li>
                    @endif
                    @if(\Auth::user()->can('list order'))
                    <li class="nav-item"><a class="nav-link" href="{{Route('admin.order')}}"><i class="fa fa-list nav-icon"></i> Manage Orders</a></li>
                    @endif
                  </ul>
                </li>
        @endif

        @if(\Auth::user()->can('list servers') || \Auth::user()->can('create server'))
                <li class="nav-item has-treeview @if(\Request::is('admin/servers*')) active @endif">
                  <a class="nav-link" href="#">
                    <i class="fa fa-server nav-icon"></i>
                    <p>
            Servers
            <i class="right fa fa-angle-left"></i>
          </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: none;">
                    @if(\Auth::user()->can('create server'))

                    <li class="nav-item"> <a class="nav-link" href="{{Route('admin.server.new')}}"><i class="fa fa-plus nav-icon"></i> Create Server</a></li>
                    @endif
                    @if(\Auth::user()->can('list servers'))
                    <li class="nav-item"><a class="nav-link" href="{{Route('admin.servers')}}"><i class="fa fa-list nav-icon"></i> Manage Servers</a></li>
                    @endif
                  </ul>
                </li>
        @endif

        @if(\Auth::user()->can('list users') || \Auth::user()->can('create user'))
                <li class="nav-item has-treeview @if(\Request::is('admin/users*')) active @endif">
                  <a class="nav-link" href="#">
                    <i class="fa fa-user nav-icon"></i>
                    <p>
            Users
            <i class="right fa fa-angle-left"></i>
          </p>
                  </a>
                  
                  <ul class="nav nav-treeview" style="display: none;">
                    @if(\Auth::user()->can('create user'))
                    <li class="nav-item"><a class="nav-link" href="{{Route('admin.users.new')}}"><i class="fa fa-plus nav-icon"></i> Create User</a></li>
                    @endif
                    @if(\Auth::user()->can('list users'))
                    <li class="nav-item"><a class="nav-link" href="{{Route('admin.users')}}"><i class="fa fa-list nav-icon"></i> Manage Users</a></li>
                    @endif
                  </ul>
                </li>
        @endif

         @if(\Auth::user()->can('create new role') || \Auth::user()->can('view roles'))

                <li class="nav-item has-treeview @if(\Request::is('admin/roles*')) active @endif" >
                  <a class="nav-link" href="#">
                    <i class="fa fa-users nav-icon" aria-hidden="true"></i>
                   <p>
            Roles
            <i class="right fa fa-angle-left"></i>
          </p>
                  </a>
                  
                  <ul class="nav nav-treeview" style="display: none;">
                    @if(\Auth::user()->can('create new role'))
                    <li class="nav-item"><a class="nav-link" href="{{Route('admin.roles.new')}}"><i class="fa fa-plus nav-icon"></i> Create Role</a></li>
                    @endif
                    @if(\Auth::user()->can('view roles'))
                    <li class="nav-item"><a class="nav-link" href="{{Route('admin.roles')}}"><i class="fa fa-list nav-icon"></i> Manage Roles</a></li>
                    @endif
                  </ul>
                </li>
        @endif