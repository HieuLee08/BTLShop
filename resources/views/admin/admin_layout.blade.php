<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Admin Dashboard</title>
    
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/reset.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/text.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/grid.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/layout.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/nav.css') }}" media="screen" />
    <link href="{{ asset('backend/css/table/demo_page.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <script src="{{ asset('backend/js/jquery-1.6.4.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('backend/js/jquery-ui/jquery.ui.core.min.js') }}"></script>
    <script src="{{ asset('backend/js/jquery-ui/jquery.ui.widget.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/jquery-ui/jquery.ui.accordion.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/jquery-ui/jquery.effects.core.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/jquery-ui/jquery.effects.slide.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/jquery-ui/jquery.ui.mouse.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/jquery-ui/jquery.ui.sortable.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/table/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('backend/js/table/table.js') }}"></script>
    <script src="{{ asset('backend/js/setup.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>
</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft middle">
                    <h1>Dahita Books</h1>
                </div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="{{ asset('backend/img/img-profile.jpg') }}" alt="Profile Pic" />
                    </div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello Admin</li>
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
        
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="#"><span>Report</span></a> </li>
                <li class="ic-form-style"><a href="#"><span>Profile</span></a></li>
                <li class="ic-typography"><a href="#"><span>Change Password</span></a></li>
                <li class="ic-grid-tables"><a href="#"><span>Inbox</span></a></li>
                <li class="ic-charts"><a href="#" target="_blank"><span>Visit Website</span></a></li>
            </ul>
        </div>
        <div class="clear"></div>

        @include('admin.sidebar')

        @yield('admin_content')
        
        <div class="clear"></div>
    </div>
    
    <div class="clear"></div>
    <div id="site_info">
        <p>
            &copy; Copyright <a href="#">Dahita Books</a>. All Rights Reserved.
        </p>
    </div>
</body>
</html>