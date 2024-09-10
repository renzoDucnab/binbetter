<div class="navbar-horizontal nav-dashboard">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-default navbar-dropdown p-0 py-lg-2">
            <div class="d-flex d-lg-block justify-content-between align-items-center w-100 w-lg-0 py-2 px-4 px-md-2 px-lg-0">
                <span class="d-lg-none">Menu</span>
                <!-- Button -->
                <button class="navbar-toggler collapsed ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar top-bar mt-0"></span>
                    <span class="icon-bar middle-bar"></span>
                    <span class="icon-bar bottom-bar"></span>
                </button>
            </div>
            <!-- Collapse -->
            <div class="collapse navbar-collapse px-6 px-lg-0" id="navbar-default">
                <ul class="navbar-nav">
                    @if(Auth::check())

                    @if(Auth::user()->role === 'Superadmin')
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('home') }}" data-bs-display="static">Dashboard</a>
                    </li>

                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('message.index') }}" data-bs-display="static">Messages</a>
                    </li> -->

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('service.index') }}" data-bs-display="static">Services</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarSettings" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-display="static">User Management</a>
                        <ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarSettings">
                            <li>
                                <a class="dropdown-item" href="{{ route('lgu.index') }}">LGU</a>
                                <a class="dropdown-item" href="{{ route('ngo.index') }}">NGO</a>
                                <a class="dropdown-item" href="{{ route('resident.index') }}">Residents</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarSettings" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-display="static">Settings</a>
                        <ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarSettings">
                            <li>
                                <a class="dropdown-item" href="{{ route('generalsettings') }}">General Settings</a>
                                <a class="dropdown-item" href="{{ route('subscription.index') }}">Subscription Settings</a>
                            </li>
                        </ul>
                    </li>
                    @else

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('home') }}" data-bs-display="static">Dashboard</a>
                    </li>
                    @if(Auth::user()->role === 'Resident')
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('postreport.index') }}" data-bs-display="static">Post Report</a>
                    </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('message.index') }}" data-bs-display="static">Messages</a>
                    </li>

                    @endif

                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>