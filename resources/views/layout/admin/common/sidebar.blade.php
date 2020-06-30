<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="{{url('/admin/dashboard')}}">
                        <i class="fi-air-play"></i><span class="badge badge-success pull-right"></span> <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);"><i class="fi-target"></i> <span> Category </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{url('admin/category/add')}}">Add</a></li>
                    </ul>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{url('admin/category/show')}}">List</a></li>
                    </ul>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{url('admin/category/trash')}}">Trash</a></li>
                    </ul>
                </li>

                <Li>
                    <a href="javascript: void(0);"><i class="fi-target"></i> <span> Color </span> <span class="menu-arrow"></span></a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{url('admin/color/add')}}">Add</a></li>
                    </ul>


                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{url('admin/color/show')}}">List</a></li>
                    </ul>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{url('admin/color/trash')}}">Trash</a></li>
                    </ul>
                </Li>

                <Li>
                    <a href="javascript: void(0);"><i class="fi-target"></i> <span> Product </span> <span class="menu-arrow"></span></a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{url('admin/product/add')}}">Add</a></li>
                    </ul>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{url('admin/product/show')}}">List</a></li>
                    </ul>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{url('admin/product/trash')}}">Trash</a></li>
                    </ul>
                </li> 

<!--                 <Li>
                    <a href="javascript: void(0);"><i class="fi-target"></i> <span> Users </span> <span class="menu-arrow"></span></a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{url('admin/alladmin')}}">Admin</a></li>
                    </ul>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{url('admin/AllCustomer')}}">Customer</a></li>
                    </ul>
                </li> 
 -->
                <Li>
                    <a href="javascript: void(0);"><i class="fi-target"></i> <span> Order </span> <span class="menu-arrow"></span></a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{url('admin/order/list')}}">List</a></li>
                    </ul>
                </Li>
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
