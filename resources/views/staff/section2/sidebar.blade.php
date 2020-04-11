        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="./assets/img/admin-avatar.png" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong">{{ucfirst(auth()->user()->name)}}</div><small>{{ucfirst(auth()->user()->role)}}</small></div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="{{route((auth()->user()->role))}}"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="heading">FEATURES</li>
                    
                    <li>
                        <a href="{{route('setmenu.index')}}"><i class="sidebar-item-icon fa fa-circle"></i>
                            <span class="nav-label">Set Menu</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('viewOrder.index')}}"><i class="sidebar-item-icon fa fa-circle"></i>
                            <span class="nav-label">View Order</span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>