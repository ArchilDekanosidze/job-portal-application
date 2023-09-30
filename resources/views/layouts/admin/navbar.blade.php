<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/dashboard">Tech Jobs</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('user.profile')}}">Settings</a></li>
                        <li><a class="dropdown-item" href="{{route('subscribe')}}">Subscription</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <form id="form-logout" action="{{ route('logout') }}" method="post">@csrf
                                <button type="submit" class="dropdown-item" id="logout">Logout</button>
                            </form>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>

        <script>
		let logout = document.getElementById('logout');
		let form = document.getElementById('form-logout');
		logout.addEventListener('click', function() {
			form.submit();
		})
	</script>