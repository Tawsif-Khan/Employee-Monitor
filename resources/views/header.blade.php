<!-- Navbar-->
<header class="main-header-top hidden-print">
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <div class="top-nav lft-nav">
            <li>
                <a href="{{ url('/') }}">
                    <i class="ti-files"> </i><span> Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ url('employees') }}">
                    <i class="ti-files"> </i><span> Employees</span>
                </a>
            </li>

            <li>
                <a href="{{ url('settings') }}">
                    <i class="ti-files"> </i><span> Settings</span>
                </a>
            </li>
            <!-- User Menu-->
            <li class="dropdown">
                <a href="#!" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">
                    <span><img class="img-circle " src="{{ asset('assets/images/avatar-1.png') }}" style="width:40px;" alt="User Image"></span>
                    <span>{{ Auth::user()->name }}<i class=" ti-arrow-circle-down m-l-10"></i></span>

                </a>
                <ul class="dropdown-menu settings-menu">

                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-logout"></i> Logout</a></li>

                    <form id="logout-form" action="{{ route('logout') }}" method="post" class="hidden">
                        @csrf
                    </form>
                </ul>
            </li>
            </ul>
        </div>
    </nav>
</header>
