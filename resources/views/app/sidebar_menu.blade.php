    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="visually-hidden-focusable">Skip to main content</a>

    <!-- Required DOM elements for dashboard.js -->
    <div class="search-backdrop" id="searchBackdrop"></div>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-brand">
                <h5>
                    <i class="bi bi-mortarboard-fill"></i>
                    Roomify
                </h5>
                <button class="sidebar-close" id="sidebarClose">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="menu-section">
                <div class="menu-section-title">Main</div>
                <ul class="nav flex-column">
                    {{-- <li class="nav-item">
                        <a class="nav-link has-submenu " href="javascript:void(0)" data-bs-toggle="collapse"
                            data-bs-target="#dashboardSubmenu" aria-expanded="false">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                        <ul id="dashboardSubmenu" class="submenu collapse  list-unstyled">
                            <li><a class="nav-link active" href="index.html">Dashboard v.1</a></li>
                            <li><a class="nav-link " href="index-1.html">Dashboard v.2</a></li>
                            <li><a class="nav-link " href="index-2.html">Dashboard v.3</a></li>
                            <li><a class="nav-link " href="analytics.html">Analytics</a></li>
                            <li><a class="nav-link " href="widgets.html">Widgets</a></li>
                        </ul>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="events.html">
                            <i class="bi bi-calendar-event"></i>
                            <span>All Listings</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="menu-section">
                <div class="menu-section-title">Communication</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link " href="events.html">
                            <i class="bi bi-calendar-event"></i>
                            <span>Messages</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="menu-section">
                <div class="menu-section-title">Support</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link " href="events.html">
                            <i class="bi bi-calendar-event"></i>
                            <span>Contact Admin</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="menu-section">
                <div class="menu-section-title">Account</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('verification') }}">
                            <i class="bi bi-calendar-event"></i>
                            <span>Verification</span>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link " href="events.html">
                            <i class="bi bi-calendar-event"></i>
                            <span>My Listings</span>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link " href="events.html">
                            <i class="bi bi-calendar-event"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="events.html">
                            <i class="bi bi-calendar-event"></i>
                            <span>Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>