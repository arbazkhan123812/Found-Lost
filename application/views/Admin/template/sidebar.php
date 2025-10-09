
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost & Found Admin Panel</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --sidebar-bg: #1e2a38;
            --sidebar-text: #e9ecef;
            --sidebar-hover: #2c3e50;
            --accent-color: #3498db;
            --active-bg: #3498db;
            --active-text: #ffffff;
            --border-radius: 8px;
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            transition: all var(--transition-speed);
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar.collapsed .logo-text,
        .sidebar.collapsed .nav-text {
            display: none;
        }

        .logo-section {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            font-size: 24px;
            color: var(--accent-color);
        }

        .logo-text {
            font-size: 20px;
            font-weight: 600;
            color: white;
            margin: 0;
            transition: opacity var(--transition-speed);
        }

        .nav-container {
            flex: 1;
            padding: 15px 0;
            overflow-y: auto;
        }

        .nav-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--sidebar-text);
            text-decoration: none;
            transition: all var(--transition-speed);
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
            margin: 5px 15px 5px 0;
        }

        .nav-item:hover {
            background-color: var(--sidebar-hover);
            color: white;
        }

        .nav-item.active {
            background-color: var(--active-bg);
            color: var(--active-text);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .nav-icon {
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        .nav-text {
            font-weight: 500;
            transition: opacity var(--transition-speed);
        }

        .toggle-btn {
            position: absolute;
            bottom: 20px;
            right: 15px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: var(--sidebar-text);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all var(--transition-speed);
        }

        .toggle-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Main Content Area */
        .main-content {
            margin-left: 260px;
            transition: margin-left var(--transition-speed);
            min-height: 100vh;
        }

        .main-content.expanded {
            margin-left: 70px;
        }

        .top-navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-area {
            padding: 25px;
        }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 20px;
            color: var(--sidebar-bg);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block;
            }
        }

        /* Demo Content Styling */
        .demo-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 20px;
        }

        .demo-card h3 {
            color: var(--sidebar-bg);
            margin-bottom: 15px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .stat-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 15px;
            text-align: center;
        }

        .stat-card i {
            font-size: 24px;
            color: var(--accent-color);
            margin-bottom: 10px;
        }

        .stat-card h4 {
            margin: 0;
            font-size: 24px;
            color: var(--sidebar-bg);
        }

        .stat-card p {
            margin: 5px 0 0;
            color: #6c757d;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo-section">
            <i class="fas fa-box logo-icon"></i>
            <h4 class="logo-text">Lost&Found</h4>
        </div>

        <div class="nav-container">
            <a href="<?= base_url('Admin/Main'); ?>"
                class="nav-item <?= ($this->uri->segment(2) == '') ? 'active' : '' ?>">
                <i class="fas fa-home nav-icon"></i>
                <span class="nav-text">Dashboard</span>
            </a>

            <a href="<?= base_url('Admin/Main/lostitems'); ?>"
                class="nav-item <?= ($this->uri->segment(3) == 'lostitems') ? 'active' : '' ?>">
                <i class="fas fa-search nav-icon"></i>
                <span class="nav-text">Lost Items</span>
            </a>

            <a href="<?= base_url('Admin/Main/founditems'); ?>"
                class="nav-item <?= ($this->uri->segment(3) == 'founditems') ? 'active' : '' ?>">
                <i class="fas fa-box-open nav-icon"></i>
                <span class="nav-text">Found Items</span>
            </a>

            <a href="<?= base_url('Admin/Main/admins'); ?>"
                class="nav-item <?= ($this->uri->segment(3) == 'admins') ? 'active' : '' ?>">
                <i class="fas fa-users nav-icon"></i>
                <span class="nav-text">Admins</span>
            </a>
            <a href="<?= base_url('Admin/Main/categories'); ?>"
                class="nav-item <?= ($this->uri->segment(3) == 'categories') ? 'active' : '' ?>">
                <i class="fas fa-list nav-icon"></i>
                <span class="nav-text">categories</span>
            </a>
            <a href="<?= base_url('Admin/Main/claim_requests'); ?>"
                class="nav-item <?= ($this->uri->segment(3) == 'claim_requests') ? 'active' : '' ?>">
                <i class="fas fa-list nav-icon"></i>
                <span class="nav-text">Claim Requests</span>
            </a>

            <a href="#" class="nav-item">
                <i class="fas fa-user nav-icon"></i>
                <span class="nav-text">Users</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-chart-bar nav-icon"></i>
                <span class="nav-text">Reports</span>
            </a>
            <a href="<?= base_url('Admin/Auth/logout'); ?>" class="nav-item">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                <span class="nav-text">Logout</span>
            </a>
        </div>

        <button class="toggle-btn" id="toggleSidebar">
            <i class="fas fa-chevron-left"></i>
        </button>
    </div>

    <!-- Main Content -->


    <!-- Bootstrap JS and Popper.js -->

    <script>
        // Toggle sidebar collapse/expand
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleIcon = this.querySelector('i');

            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');

            if (sidebar.classList.contains('collapsed')) {
                toggleIcon.classList.remove('fa-chevron-left');
                toggleIcon.classList.add('fa-chevron-right');
            } else {
                toggleIcon.classList.remove('fa-chevron-right');
                toggleIcon.classList.add('fa-chevron-left');
            }
        });

        // Mobile toggle for sidebar
        document.getElementById('mobileToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('mobile-open');
        });

        // Set active nav item
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.nav-item').forEach(nav => {
                    nav.classList.remove('active');
                });
                this.classList.add('active');

                // Close sidebar on mobile after selection
                if (window.innerWidth < 992) {
                    document.getElementById('sidebar').classList.remove('mobile-open');
                }
            });
        });
    </script>
</body>

</html>