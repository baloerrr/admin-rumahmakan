<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Brand/Title -->
    <a class="navbar-brand m-0 font-weight-bold text-primary" href="#">Rumah Makan</a>

    <!-- Navbar Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Links -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('galery.index') }}">Galery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tentang-kami.index') }}">Tentang Kami</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('menu.index') }}">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ulasan.index') }}">Ulasan</a>
            </li>

            <!-- User Dropdown -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <div
                        style="width: 35px; height: 35px; padding: 10px; border: 1px solid #ccc; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                        <i class="fas fa-user" style="font-size: 18px;"></i>
                    </div>
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                </a>

                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('setting') }}">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
