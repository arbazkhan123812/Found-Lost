
<style>
    /* Enhanced Dashboard Styles */
    .charts-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin: 24px 0;
    }



    @media (max-width: 1024px) {
        .charts-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .charts-grid {
            gap: 16px;
            margin: 16px 0;
        }
    }

    /* Enhanced Card Styling */
    .chart-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef;
        padding: 24px;
        transition: all 0.3s ease;
        height: fit-content;
    }

    .chart-card:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }

    .top-navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 25px;
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        position: relative;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .navbar-right {
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
    }

    /* Notification Icon */
    .notification-wrapper {
        position: relative;
    }

    .notification-icon {
        position: relative;
        cursor: pointer;
        font-size: 20px;
        color: #555;
        margin-right: 20px;
    }

    .notification-icon:hover {
        color: #1e2a38;
    }

    .badge {
        position: absolute;
        right: -10px;
        background-color: #ff4b5c;
        color: white;
        border-radius: 50%;
        font-size: 11px;
        padding: 2px 5px;
    }

    /* Dropdown Menu */
    .notification-menu {
        display: none;
        position: absolute;
        right: 0;
        top: 35px;
        background: #fff;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        width: 250px;
        z-index: 1000;
        overflow: hidden;
    }

    .notification-menu h6 {
        background: #1e2a38;
        color: white;
        padding: 10px;
        margin: 0;
        font-size: 14px;
    }

    .notification-menu ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .notification-menu ul li {
        padding: 10px 15px;
        font-size: 13px;
        color: #333;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .notification-menu ul li:hover {
        background: #f8f9fa;
    }

    .notification-menu .view-all {
        display: block;
        text-align: center;
        padding: 10px;
        font-size: 13px;
        color: #1e2a38;
        text-decoration: none;
        font-weight: 500;
    }

    .notification-menu .view-all:hover {
        background: #f0f8ff;
    }

    /* Active (show menu) */
    .notification-wrapper.active .notification-menu {
        display: block;
    }


    .chart-card h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f8f9fa;
    }

    .chart-container {
        position: relative;
        height: 350px;
        width: 100%;
    }

    /* Improved Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin: 24px 0;
    }

    .stat-card {
        padding: 24px;
        border-radius: 12px;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-card i {
        font-size: 2rem;
        margin-bottom: 12px;
        opacity: 0.9;
    }

    .stat-card h4 {
        font-size: 2rem;
        font-weight: 700;
        margin: 8px 0;
        color: #2c3e50;
    }

    .stat-card p {
        font-size: 0.9rem;
        color: #6c757d;
        margin: 0;
        font-weight: 500;
    }

    /* Color variants for stat cards */
    .bg-primary-light {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        color: #1565c0;
    }

    .bg-success-light {
        background: linear-gradient(135deg, #e8f5e8, #c8e6c9);
        color: #2e7d32;
    }

    .bg-warning-light {
        background: linear-gradient(135deg, #fff3e0, #ffcc80);
        color: #ef6c00;
    }

    /* Chart.js Customizations */
    .chartjs-tooltip {
        background: rgba(44, 62, 80, 0.95) !important;
        border: none !important;
        border-radius: 6px !important;
        padding: 8px 12px !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    }

    /* Responsive text sizes */
    @media (max-width: 768px) {
        .chart-card h3 {
            font-size: 1.1rem;
        }

        .stat-card h4 {
            font-size: 1.75rem;
        }

        .stat-card i {
            font-size: 1.75rem;
        }
    }
</style>

<div class="main-content" id="mainContent">
    <nav class="top-navbar">
        <button class="mobile-toggle" id="mobileToggle">
            <i class="fas fa-bars"></i>
        </button>

        <span class="navbar-brand mb-0 h5">
            Welcome, <?= $this->session->userdata('admin_name'); ?>
        </span>

        <div class="navbar-right">
            <!-- 🔔 Notification Bell -->
            <div class="notification-wrapper">
                <div class="notification-icon" id="notificationBell">
                    <i class="fas fa-bell"></i>
                    <span class="badge" id="notificationCount"><?= count($notifications); ?></span>
                </div>

                <!-- Dropdown Menu -->
                <div class="notification-menu" id="notificationMenu">
                    <h6>Notifications</h6>
                    <ul>
                        <?php if (!empty($notifications)): ?>
                            <?php foreach ($notifications as $note): ?>
                                <li>
                                    <?php if ($note['type'] == 'lost_item'): ?>
                                        <i class="fas fa-box text-warning"></i>
                                        <span>New lost item: <strong><?= htmlspecialchars($note['title']); ?></strong></span>
                                    <?php elseif ($note['type'] == 'claim'): ?>
                                        <i class="fas fa-file-alt text-info"></i>
                                        <span>New claim by <strong><?= htmlspecialchars($note['title']); ?></strong></span>
                                    <?php endif; ?>
                                    <small style="color:#777; font-size:11px; display:block;">
                                        <?= date("M d, Y h:i A", strtotime($note['created_at'])); ?>
                                    </small>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><i class="fas fa-bell-slash"></i> No recent notifications</li>
                        <?php endif; ?>
                    </ul>
                    <a href="#" class="view-all">View All</a>
                </div>

            </div>

            <a href="<?= base_url('Admin/Auth/logout'); ?>" class="btn btn-sm btn-danger logout-btn">
                <i class="fas fa-power-off"></i> Logout
            </a>
        </div>
    </nav>


    <div class="content-area">
        <div class="demo-card">
            <h3>Dashboard Overview</h3>
            <p>Welcome to the Lost & Found Admin Panel. Here you can manage all system data and analytics.</p>

            <div class="stats-grid">
                <div class="stat-card bg-primary-light">
                    <i class="fas fa-search"></i>
                    <h4><?= $total_lost; ?></h4>
                    <p>Pending Lost Items</p>
                </div>
                <div class="stat-card bg-success-light">
                    <i class="fas fa-box-open"></i>
                    <h4><?= $total_found; ?></h4>
                    <p>Found Items</p>
                </div>
                
            </div>
        </div>

        <div class="charts-grid">
            <div class="chart-card">
                <h3>Reports by Category</h3>
                <div class="chart-container">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <h3>Last 7 Days Activity</h3>
                <div class="chart-container">
                    <canvas id="weeklyChart"></canvas>
                </div>
            </div>
        </div>

        <div class="charts-grid">
            <div class="chart-card">
                <h3>Top 4 Locations Reported</h3>
                <div class="chart-container">
                    <canvas id="locationChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <h3>Status Distribution</h3>
                <div class="chart-container">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // PHP variables to JavaScript
    const categoryData = <?= json_encode($category_data); ?>;
    const weeklyData = <?= json_encode($weekly_data); ?>;
    const locationData = <?= json_encode($location_data); ?>;
    const statusData = <?= json_encode($status_data); ?>;
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

<script>
    // Common chart options for consistency
    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: {
                    font: {
                        size: 12,
                        family: "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"
                    },
                    padding: 15
                }
            },
            tooltip: {
                backgroundColor: 'rgba(44, 62, 80, 0.95)',
                titleFont: {
                    size: 13,
                    weight: '600'
                },
                bodyFont: {
                    size: 12
                },
                padding: 12,
                cornerRadius: 6,
                displayColors: true
            }
        }
    };

    // Color palette for charts
    const colorPalette = {
        primary: ['#3498db', '#2980b9', '#1f618d', '#154360'],
        secondary: ['#2ecc71', '#27ae60', '#229954', '#1e8449'],
        accent: ['#9b59b6', '#8e44ad', '#7d3c98', '#6c3483'],
        status: ['#e74c3c', '#2ecc71', '#f39c12', '#f1c40f']
    };

    // --- CHART 1: Category Distribution (Doughnut Chart) ---
    const ctx1 = document.getElementById('categoryChart');
    if (ctx1) {
        const categoryLabels = categoryData.map(item => item.category_name);
        const categoryCounts = categoryData.map(item => item.item_count);

        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: categoryLabels,
                datasets: [{
                    data: categoryCounts,
                    backgroundColor: colorPalette.primary,
                    borderColor: '#ffffff',
                    borderWidth: 2,
                    hoverBackgroundColor: colorPalette.primary.map(color => color + 'DD'),
                    hoverOffset: 8
                }]
            },
            options: {
                ...commonOptions,
                plugins: {
                    ...commonOptions.plugins,
                    legend: {
                        ...commonOptions.plugins.legend,
                        position: 'right',
                    }
                },
                cutout: '55%'
            }
        });
    }

    // --- CHART 2: Weekly Activity (Bar Chart) ---
    const ctx2 = document.getElementById('weeklyChart');
    if (ctx2) {
        const weeklyLabels = weeklyData.map(item => item.date);
        const weeklyCounts = weeklyData.map(item => item.total_reports);

        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: weeklyLabels,
                datasets: [{
                    label: 'New Reports',
                    data: weeklyCounts,
                    backgroundColor: colorPalette.primary[0],
                    borderColor: colorPalette.primary[1],
                    borderWidth: 1,
                    borderRadius: 6,
                    hoverBackgroundColor: colorPalette.primary[1]
                }]
            },
            options: {
                ...commonOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    }
                },
                plugins: {
                    ...commonOptions.plugins,
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    // --- CHART 3: Top Locations (Horizontal Bar Chart) ---
    const ctx3 = document.getElementById('locationChart');
    if (ctx3) {
        const locationLabels = locationData.map(item => item.location_lost);
        const locationCounts = locationData.map(item => item.report_count);

        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: locationLabels,
                datasets: [{
                    label: 'Reports',
                    data: locationCounts,
                    backgroundColor: colorPalette.accent[0],
                    borderColor: colorPalette.accent[1],
                    borderWidth: 1,
                    borderRadius: 4,
                    hoverBackgroundColor: colorPalette.accent[1]
                }]
            },
            options: {
                ...commonOptions,
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    }
                },
                plugins: {
                    ...commonOptions.plugins,
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    // --- CHART 4: Status Distribution (Polar Area Chart) ---
    const ctx4 = document.getElementById('statusChart');
    if (ctx4) {
        const statusLabels = Object.keys(statusData).slice(1);
        const statusCounts = Object.values(statusData).slice(1);

        new Chart(ctx4, {
            type: 'polarArea',
            data: {
                labels: statusLabels,
                datasets: [{
                    data: statusCounts,
                    backgroundColor: colorPalette.status,
                    borderColor: '#ffffff',
                    borderWidth: 2,
                    hoverBackgroundColor: colorPalette.status.map(color => color + 'DD')
                }]
            },
            options: {
                ...commonOptions,
                plugins: {
                    ...commonOptions.plugins,
                    legend: {
                        ...commonOptions.plugins.legend,
                        position: 'right'
                    }
                },
                scales: {
                    r: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            display: false
                        }
                    }
                }
            }
        });
    }
</script>
<script>
    const bell = document.getElementById('notificationBell');
    const menu = document.getElementById('notificationMenu');
    const wrapper = document.querySelector('.notification-wrapper');

    bell.addEventListener('click', () => {
        wrapper.classList.toggle('active');
    });

    // Close menu if clicked outside
    document.addEventListener('click', (event) => {
        if (!wrapper.contains(event.target)) {
            wrapper.classList.remove('active');
        }
    });
</script>
