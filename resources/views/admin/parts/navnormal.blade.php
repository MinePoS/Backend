       <li class="@if(\Request::is('admin/dashboard')) active @endif"><a href="{{Route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

        @if(\Auth::user()->can('list product') || \Auth::user()->can('create product'))
                <li class="treeview @if(\Request::is('admin/products*')) active @endif">
                  <a href="#">
                    <i class="fa fa-folder-open"></i> <span>Products</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    @if(\Auth::user()->can('create product'))
                    <li><a href=""><i class="fa fa-plus"></i> Create Products</a></li>
                    @endif
                    @if(\Auth::user()->can('list product'))
                    <li><a href=""><i class="fa fa-list"></i> Manage Products</a></li>
                    @endif
                  </ul>
                </li>
        @endif

        @if(\Auth::user()->can('list category') || \Auth::user()->can('create category'))
                <li class="treeview @if(\Request::is('admin/catagories*')) active @endif">
                  <a href="#">
                    <i class="fa fa-th-large"></i> <span>Categories</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    @if(\Auth::user()->can('create category'))
                    <li><a href="{{Route('admin.Categories.new')}}"><i class="fa fa-plus"></i> Create Category</a></li>
                    @endif
                    @if(\Auth::user()->can('list category'))
                    <li><a href="{{Route('admin.Categories')}}"><i class="fa fa-list"></i> Manage Categories</a></li>
                    @endif
                  </ul>
                </li>
        @endif

        @if(\Auth::user()->can('list coupons') || \Auth::user()->can('create coupons'))
                <li class="treeview @if(\Request::is('admin/coupons*')) active @endif">
                  <a href="#">
                    <i class="fa fa-tags"></i> <span>Coupons</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    @if(\Auth::user()->can('create coupons'))
                    <li><a href=""><i class="fa fa-plus"></i> Create Coupons</a></li>
                    @endif
                    @if(\Auth::user()->can('list coupons'))
                    <li><a href=""><i class="fa fa-list"></i> Manage Coupons</a></li>
                    @endif
                  </ul>
                </li>
        @endif

        @if(\Auth::user()->can('list order') || \Auth::user()->can('create order'))
                <li class="treeview @if(\Request::is('admin/orders*')) active @endif">
                  <a href="#">
                    <i class="fa fa-credit-card-alt"></i> <span>Orders</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    @if(\Auth::user()->can('create order'))
                    <li><a href=""><i class="fa fa-plus"></i> Create Orders</a></li>
                    @endif
                    @if(\Auth::user()->can('list order'))
                    <li><a href="{{Route('admin.order')}}"><i class="fa fa-list"></i> Manage Orders</a></li>
                    @endif
                  </ul>
                </li>
        @endif

        @if(\Auth::user()->can('list servers') || \Auth::user()->can('create server'))
                <li class="treeview @if(\Request::is('admin/servers*')) active @endif">
                  <a href="#">
                    <i class="fa fa-server"></i> <span>Servers</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    @if(\Auth::user()->can('create server'))

                    <li><a href="{{Route('admin.server.new')}}"><i class="fa fa-plus"></i> Create Server</a></li>
                    @endif
                    @if(\Auth::user()->can('list servers'))
                    <li><a href="{{Route('admin.servers')}}"><i class="fa fa-list"></i> Manage Servers</a></li>
                    @endif
                  </ul>
                </li>
        @endif

        @if(\Auth::user()->can('list users') || \Auth::user()->can('create user'))
                <li class="treeview @if(\Request::is('admin/users*')) active @endif">
                  <a href="#">
                    <i class="fa fa-user"></i> <span>Users</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  
                  <ul class="treeview-menu">
                    @if(\Auth::user()->can('create user'))
                    <li><a href="{{Route('admin.users.new')}}"><i class="fa fa-plus"></i> Create User</a></li>
                    @endif
                    @if(\Auth::user()->can('list users'))
                    <li><a href="{{Route('admin.users')}}"><i class="fa fa-list"></i> Manage Users</a></li>
                    @endif
                  </ul>
                </li>
        @endif

         @if(\Auth::user()->can('create new role') || \Auth::user()->can('view roles'))

                <li class="treeview @if(\Request::is('admin/roles*')) active @endif" >
                  <a href="#">
                    <i class="fa fa-users" aria-hidden="true"></i> <span>Roles</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  
                  <ul class="treeview-menu">
                    @if(\Auth::user()->can('create new role'))
                    <li><a href="{{Route('admin.roles.new')}}"><i class="fa fa-plus"></i> Create Role</a></li>
                    @endif
                    @if(\Auth::user()->can('view roles'))
                    <li><a href="{{Route('admin.roles')}}"><i class="fa fa-list"></i> Manage Roles</a></li>
                    @endif
                  </ul>
                </li>
        @endif