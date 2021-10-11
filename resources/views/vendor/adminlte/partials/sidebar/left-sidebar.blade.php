<aside class="main-sidebar" style="background: #fff; box-shadow: 2px 2px 10px #b2bec3">

    
    <div class="brand" style="text-align: center; padding: 10px 10px;">
        <img src="public/image/icons/Green Apple Transparent.png" style="width: 70%;">
    </div>

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>

    <style>
        .sidebar-mini.sidebar-collapse .main-sidebar .brand img {
            content: url('public/image/icons/GA_logo.png');
        }

        .sidebar-mini.sidebar-collapse .main-sidebar:hover .brand img{
            content: url('public/image/icons/SmartADMIN_logo.png');
        }

        .sidebar-mini.sidebar-collapse .sidebar nav {
            margin: 4px;
        }

        .sidebar-mini.sidebar-collapse .sidebar nav ul .nav-item .nav-link {
            width: 100%;
        }


        .sidebar {
            margin-top: 10px;
        }

        .sidebar nav {
            margin-left: 10px;
        }



        .sidebar nav ul .nav-item .nav-link {
            width: 100%;
        }

        .sidebar nav ul li a i {
            color: rgba(16, 183, 203, 1);
            margin-right: 20px;
        }

        .sidebar nav ul li a p i {
            margin-right: 20px;
        }

        .sidebar nav .nav .nav-link {
            color: rgba(153, 153, 153, 1);
        }

        .sidebar nav .nav .nav-link:hover {
            color: #2980b9;
        }

        .sidebar nav .nav .nav-link.active {
            background: none;
            font-weight: 600;
            color: #2980b9;
        }



    </style>

</aside>
