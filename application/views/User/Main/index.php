<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Found & Lost - Reuniting People with Their Belongings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #1e2a38;
            --secondary-color: #2ecc71;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --dark-text: #2c3e50;
            --light-text: #7f8c8d;
            --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --hover-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            padding-top: 56px;
        }

        /* Navbar */
        .navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .nav-link {
            font-weight: 500;
            color: var(--dark-text);
            margin: 0 8px;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        /* Hero Section */
        .hero-section {
            background: #1e2a38;
            color: white;
            padding: 80px 0;
            margin-bottom: 40px;
            border-radius: 0 0 20px 20px;
        }

        .hero-title {
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .search-container {
            max-width: 700px;
            margin: 0 auto;
        }

        .search-input {
            border-radius: 50px;
            padding: 15px 25px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .search-btn {
            border-radius: 50px;
            padding: 15px 30px;
            background-color: var(--secondary-color);
            border: none;
            font-weight: 600;
        }

        .search-btn:hover {
            background-color: #27ae60;
        }

        /* Tabs */
        .nav-tabs {
            border: none;
            justify-content: center;
            margin-bottom: 30px;
        }

        .nav-tabs .nav-link {
            color: var(--light-text);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            margin: 0 10px;
            font-weight: 600;
        }

        .nav-tabs .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }

        /* Cards */
        .item-card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            margin-bottom: 25px;
            overflow: hidden;
        }

        .item-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-radius: 12px 12px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark-text);
        }

        .card-text {
            color: var(--light-text);
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-found {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-returned {
            background-color: #d4edda;
            color: #155724;
        }

        .btn-details {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 20px;
            font-weight: 500;
            width: 100%;
        }

        .btn-details:hover {
            background-color: #2980b9;
        }

        /* Filters */
        .filter-section {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
        }

        .filter-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark-text);
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--dark-text);
        }

        /* Modal */
        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            border-bottom: 1px solid #e9ecef;
            padding: 20px 25px;
        }

        .modal-title {
            font-weight: 600;
            color: var(--dark-text);
        }

        .modal-body {
            padding: 25px;
        }

        .item-image {
            width: 100%;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .claim-btn {
            background-color: var(--secondary-color);
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            font-weight: 600;
            width: 100%;
            margin-top: 15px;
        }

        .claim-btn:hover {
            background-color: #27ae60;
        }

        /* Footer */
        .footer {
            background-color: white;
            padding: 40px 0;
            margin-top: 60px;
            border-top: 1px solid #e9ecef;
        }

        .footer-title {
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--dark-text);
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: var(--light-text);
            text-decoration: none;
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section {
                padding: 50px 0;
            }

            .hero-title {
                font-size: 1.8rem;
            }

            .search-input {
                margin-bottom: 15px;
            }

            .filter-section {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-box-open me-2"></i>Found & Lost</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Lost Items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Found Items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">How It Works</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="#" class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#reportLostModal">
                        <i class="fas fa-plus me-1"></i>Report Item
                    </a> 
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="hero-title">Find Your Lost Belongings</h1>
                    <p class="hero-subtitle">Search through our database of lost and found items. Reuniting people with their valuables since 2023.</p>
                    <div class="search-container">
                        <div class="input-group">
                            <input type="text" class="form-control search-input" placeholder="Search lost or found items by name, category, or location...">
                            <button class="btn search-btn" type="button" onclick="loadItems(currentTab)">
                                <i class="fas fa-search me-2"></i> Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <!-- Tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="lost-tab" data-bs-toggle="tab" data-bs-target="#lost" type="button" role="tab">Lost Items</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="found-tab" data-bs-toggle="tab" data-bs-target="#found" type="button" role="tab">Found Items</button>
            </li>
        </ul>

        <!-- Filters -->
        <div class="row">
            <div class="col-lg-3">
                <div class="filter-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="filter-title mb-0">Filters</h5>
                        <button type="button" class="btn btn-sm btn-outline-secondary clear-filters">Clear</button>
                    </div>

                    <form id="filterForm">
                        <!-- Categories -->
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" name="category" id="category">
                                <option value="all">All Categories</option>
                                <?php if (!empty($categories)): ?>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" id="location" placeholder="Enter location">
                        </div>

                        <!-- Date Range -->
                        <div class="mb-3">
                            <label class="form-label">Date Range</label>
                            <input type="date" class="form-control mb-2" name="date_from" id="date_from">
                            <input type="date" class="form-control" name="date_to" id="date_to">
                        </div>

                        <!-- Sort -->
                        <div class="mb-3">
                            <label class="form-label">Sort By</label>
                            <select class="form-select" name="sort_by" id="sort_by">
                                <option value="newest">Newest First</option>
                                <option value="oldest">Oldest First</option>
                                <option value="updated">Recently Updated</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Items Grid -->
            <div class="col-lg-9">
                <div class="tab-content" id="myTabContent">
                    <!-- Lost Items Tab -->
                    <div class="tab-pane fade show active" id="lost" role="tabpanel">
                        <div class="row">
                            <?php if (!empty($lost_items)) : ?>
                                <?php foreach ($lost_items as $item): ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card item-card">
                                            <img src="<?php echo base_url('assets/uploads/' . $item->image); ?>"
                                                class="card-img-top"
                                                alt="<?php echo $item->item_name; ?>">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $item->item_name; ?></h5>

                                                <?php
                                                $statusClass = 'status-pending';
                                                if ($item->status == 'found') $statusClass = 'status-found';
                                                elseif ($item->status == 'returned') $statusClass = 'status-returned';
                                                ?>
                                                <span class="status-badge <?php echo $statusClass; ?>">
                                                    <?php echo ucfirst($item->status); ?>
                                                </span>

                                                <p class="card-text">
                                                    <i class="fas fa-map-marker-alt me-2"></i>
                                                    <?php echo $item->location_lost; ?>
                                                </p>
                                                <p class="card-text">
                                                    <i class="far fa-calendar me-2"></i>
                                                    <?php echo date("M d, Y", strtotime($item->date_lost)); ?>
                                                </p>
                                                <button class="btn btn-details" data-bs-toggle="modal" data-bs-target="#itemModal<?php echo $item->id; ?>">
                                                    View Details
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal for this item -->
                                    <div class="modal fade" id="itemModal<?php echo $item->id; ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><?php echo $item->item_name; ?> Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <img src="<?php echo base_url('assets/uploads/' . $item->image); ?>"
                                                                class="item-image" alt="<?php echo $item->item_name; ?>">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h4><?php echo $item->item_name; ?></h4>
                                                            <span class="status-badge <?php echo $statusClass; ?>">
                                                                <?php echo ucfirst($item->status); ?>
                                                            </span>

                                                            <div class="mt-4">
                                                                <p><strong>Category:</strong> <?php echo $item->category; ?></p>
                                                                <p><strong>Location:</strong>
                                                                    <i class="fas fa-map-marker-alt me-2"></i><?php echo $item->location_lost; ?>
                                                                </p>
                                                                <p><strong>Date Reported:</strong>
                                                                    <i class="far fa-calendar me-2"></i><?php echo date("M d, Y", strtotime($item->date_lost)); ?>
                                                                </p>
                                                                <p><strong>Description:</strong></p>
                                                                <p><?php echo $item->description; ?></p>
                                                            </div>

                                                            <button class="btn claim-btn" data-bs-toggle="modal" data-bs-target="#claimModal">
                                                                <i class="fas fa-hand-holding-usd me-2"></i>Claim This Item
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-12 text-center py-5">
                                    <h4>No lost items to display at the moment</h4>
                                    <p class="text-muted">Check back later for updates</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>


                    <!-- Found Items Tab -->
                    <!-- Found Items Tab -->
                    <div class="tab-pane fade" id="found" role="tabpanel">
                        <div class="row">
                            <?php if (!empty($found_items)) : ?>
                                <?php foreach ($found_items as $item): ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card item-card">
                                            <img src="<?php echo base_url('assets/uploads/' . $item->image); ?>"
                                                class="card-img-top" alt="<?php echo $item->item_name; ?>">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $item->item_name; ?></h5>
                                                <span class="status-badge status-found">Found</span>
                                                <p class="card-text">
                                                    <i class="fas fa-map-marker-alt me-2"></i>
                                                    <?php echo $item->location_lost; ?>
                                                </p>
                                                <p class="card-text">
                                                    <i class="far fa-calendar me-2"></i>
                                                    <?php echo date("M d, Y", strtotime($item->date_lost)); ?>
                                                </p>
                                                <button class="btn btn-details" data-bs-toggle="modal" data-bs-target="#foundItemModal<?php echo $item->id; ?>">
                                                    View Details
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal for found item -->
                                    <div class="modal fade" id="foundItemModal<?php echo $item->id; ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><?php echo $item->item_name; ?> Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <img src="<?php echo base_url('assets/uploads/' . $item->image); ?>"
                                                                class="item-image" alt="<?php echo $item->item_name; ?>">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h4><?php echo $item->item_name; ?></h4>
                                                            <span class="status-badge status-found">Found</span>

                                                            <div class="mt-4">
                                                                <p><strong>Category:</strong> <?php echo $item->category_name; ?></p>
                                                                <p><strong>Location:</strong>
                                                                    <i class="fas fa-map-marker-alt me-2"></i><?php echo $item->location_lost; ?>
                                                                </p>
                                                                <p><strong>Date Reported:</strong>
                                                                    <i class="far fa-calendar me-2"></i><?php echo date("M d, Y", strtotime($item->date_lost)); ?>
                                                                </p>
                                                                <p><strong>Description:</strong></p>
                                                                <p><?php echo $item->description; ?></p>
                                                            </div>

                                                            <button class="btn claim-btn" data-bs-toggle="modal" data-bs-target="#claimModal">
                                                                <i class="fas fa-hand-holding-usd me-2"></i>Claim This Item
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-12 text-center py-5">
                                    <h4>No found items to display at the moment</h4>
                                    <p class="text-muted">Check back later for updates</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="footer-title"><i class="fas fa-box-open me-2"></i>Lost & Found</h5>
                    <p>Helping people reunite with their lost belongings since 2023. Our mission is to create a community where lost items find their way back home.</p>
                </div>
                <div class="col-lg-2 mb-4">
                    <h5 class="footer-title">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Lost Items</a></li>
                        <li><a href="#">Found Items</a></li>
                        <li><a href="#">How It Works</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5 class="footer-title">Support</h5>
                    <ul class="footer-links">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5 class="footer-title">Contact Info</h5>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt me-2"></i>Shah Faisal Colony, Karachi </li>
                        <li><i class="fas fa-phone me-2"></i>0312-2510275</li>
                        <li><i class="fas fa-envelope me-2"></i>arbaznadeem3130@gmail.com</li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p class="mb-0">&copy; 2023 Lost & Found. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Item Details Modal -->
    <div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Item Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://images.unsplash.com/photo-1556656793-08538906a9f8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" class="item-image" alt="Lost Wallet">
                        </div>
                        <div class="col-md-6">
                            <h4>Lost Wallet</h4>
                            <span class="status-badge status-pending">Pending</span>

                            <div class="mt-4">
                                <p><strong>Category:</strong> Wallet</p>
                                <p><strong>Location:</strong> <i class="fas fa-map-marker-alt me-2"></i>Central Park, NYC</p>
                                <p><strong>Date Reported:</strong> <i class="far fa-calendar me-2"></i>May 15, 2023</p>
                                <p><strong>Description:</strong></p>
                                <p>Black leather wallet with multiple credit cards and ID. Contains a photo of a golden retriever. Reward offered for return.</p>
                            </div>

                            <button class="btn claim-btn" data-bs-toggle="modal" data-bs-target="#claimModal"><i class="fas fa-hand-holding-usd me-2"></i>Claim This Item</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Lost Item Modal -->
    <div class="modal fade" id="reportLostModal" tabindex="-1" aria-labelledby="reportLostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportLostModalLabel"><i class="fas fa-plus-circle me-2"></i>Report Lost Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reportLostForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="item_name" class="form-label">Item Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="item_name" name="item_name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                    <select class="form-select" id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        <?php if (!empty($categories)): ?>
                                            <?php foreach ($categories as $cat): ?>
                                                <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Describe the item in detail (color, brand, distinguishing features, etc.)"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_lost" class="form-label">Date Lost <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date_lost" name="date_lost" max="<?= date('Y-m-d') ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="location_lost" class="form-label">Location Lost <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="location_lost" name="location_lost" placeholder="Where did you lose it?" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Item Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept=".jpg,.jpeg,.png">
                            <div class="form-text">Accepted formats: JPG, JPEG, PNG (Max 2MB)</div>
                        </div>

                        <hr class="my-4">
                        <h6 class="mb-3"><i class="fas fa-user me-2"></i>Your Contact Information</h6>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="user_name" class="form-label">Your Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="user_name" name="user_name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="user_email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="user_email" name="user_email" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="user_phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="user_phone" name="user_phone" required>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <small>
                                <i class="fas fa-info-circle me-2"></i>
                                After submitting, you'll receive an OTP via email to verify your report.
                            </small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submitReportBtn">
                        <i class="fas fa-paper-plane me-2"></i>Submit Report
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Claim Modal -->
    <div class="modal fade" id="claimModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Claim Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('User/Main/submit_claim') ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control" placeholder="Enter your full name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Enter your phone number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Proof of Ownership</label>
                            <input type="file" name="proof_of_ownership" class="form-control">
                            <div class="form-text">Upload any documents or photos that prove this item belongs to you.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Additional Details</label>
                            <textarea name="additional_details" class="form-control" rows="3" placeholder="Provide any additional information that can help verify your claim"></textarea>
                        </div>
                        <input type="hidden" name="lost_item_id" value="<?= $item->id ?>">

                        <button type="submit" class="btn claim-btn">Submit Claim</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Add to head section -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Add before closing body tag -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        let currentTab = 'lost'; // Track current active tab
        let searchTimeout;

        // Initialize with all items
        loadItems(currentTab);

        // Tab switching
        $('.nav-tabs .nav-link').on('click', function() {
            currentTab = $(this).attr('id').replace('-tab', '');
            loadItems(currentTab);
        });

        // Real-time search with debouncing
        $('.search-input').on('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                loadItems(currentTab);
            }, 300); // 300ms delay
        });

        // Filter form submission
        $('#filterForm').on('submit', function(e) {
            e.preventDefault();
            loadItems(currentTab);
        });

        // Real-time filter changes
        $('#category, #location, #date_from, #date_to, #sort_by').on('change', function() {
            loadItems(currentTab);
        });

        // Function to load items with filters
        function loadItems(tabType) {
            const searchTerm = $('.search-input').val();
            const category = $('#category').val();
            const location = $('#location').val();
            const date_from = $('#date_from').val();
            const date_to = $('#date_to').val();
            const sort_by = $('#sort_by').val();

            // Show loading indicator
            $(`#${tabType} .row`).html(`
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Loading items...</p>
            </div>
        `);


            $.ajax({
                url: "<?php echo base_url('User/Main/get_filtered_items'); ?>",
                type: "GET",
                data: {
                    tab: tabType,
                    search: searchTerm,
                    category: category,
                    location: location,
                    date_from: date_from,
                    date_to: date_to,
                    sort_by: sort_by
                },
                dataType: "json",
                success: function(data) {
                    let html = "";
                    if (data.length > 0) {
                        data.forEach(item => {
                            // Determine status class
                            let statusClass = 'status-pending';
                            if (item.status === 'Found') statusClass = 'status-found';
                            else if (item.status === 'Returned') statusClass = 'status-returned';

                            // Format date
                            const dateLost = new Date(item.date_lost).toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric'
                            });

                            html += `
                        <div class="col-md-6 col-lg-4">
                            <div class="card item-card">
                                <img src="<?php echo base_url('assets/uploads/'); ?>${item.image}" 
                                     class="card-img-top" alt="${item.item_name}"
                                     onerror="this.src='https://images.unsplash.com/photo-1556656793-08538906a9f8?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'">
                                <div class="card-body">
                                    <h5 class="card-title">${item.item_name}</h5>
                                    <span class="status-badge ${statusClass}">${item.status}</span>
                                    <p class="card-text">
                                        <i class="fas fa-map-marker-alt me-2"></i>${item.location_lost}
                                    </p>
                                    <p class="card-text">
                                        <i class="far fa-calendar me-2"></i>${dateLost}
                                    </p>
                                    <button class="btn btn-details" data-bs-toggle="modal" 
                                            data-bs-target="#itemModal${item.id}">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal for this item -->
                        <div class="modal fade" id="itemModal${item.id}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">${item.item_name} Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="<?php echo base_url('assets/uploads/'); ?>${item.image}" 
                                                     class="item-image" alt="${item.item_name}"
                                                     onerror="this.src='https://images.unsplash.com/photo-1556656793-08538906a9f8?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'">
                                            </div>
                                            <div class="col-md-6">
                                                <h4>${item.item_name}</h4>
                                                <span class="status-badge ${statusClass}">${item.status}</span>
                                                
                                                <div class="mt-4">
                                                    <p><strong>Category:</strong> ${item.category_name || 'Not specified'}</p>
                                                    <p><strong>Location:</strong> 
                                                        <i class="fas fa-map-marker-alt me-2"></i>${item.location_lost}
                                                    </p>
                                                    <p><strong>Date Reported:</strong> 
                                                        <i class="far fa-calendar me-2"></i>${dateLost}
                                                    </p>
                                                    <p><strong>Description:</strong></p>
                                                    <p>${item.description || 'No description provided.'}</p>
                                                </div>
                                                
                                                <button class="btn claim-btn" data-bs-toggle="modal" 
                                                        data-bs-target="#claimModal" data-item-id="${item.id}">
                                                    <i class="fas fa-hand-holding-usd me-2"></i>Claim This Item
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                        });
                    } else {
                        html = `<div class="col-12 text-center py-5">
                                <h4>No items found</h4>
                                <p class="text-muted">Try adjusting your search or filters</p>
                            </div>`;
                    }
                    $(`#${tabType} .row`).html(html);
                },
                error: function(xhr, status, error) {
                    console.error("Error loading items:", error);
                    $(`#${tabType} .row`).html(`
                    <div class="col-12 text-center py-5">
                        <h4>Error loading items</h4>
                        <p class="text-muted">Please try again later</p>
                    </div>
                `);
                }
            });
        }

        // Clear filters functionality
        $('.clear-filters').on('click', function() {
            $('#filterForm')[0].reset();
            $('.search-input').val('');
            loadItems(currentTab);
        });

        // Handle claim button clicks
        $(document).on('click', '.claim-btn', function() {
            const itemId = $(this).data('item-id');
            $('#claimItemId').val(itemId);
        });
        $('#date_lost').attr('max', new Date().toISOString().split('T')[0]);

        // Form submission
        $('#submitReportBtn').on('click', function() {
            const form = $('#reportLostForm')[0];
            const formData = new FormData(form);

            // Basic validation
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            // File validation
            const fileInput = $('#image')[0];
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                const maxSize = 2 * 1024 * 1024; // 2MB

                if (!validTypes.includes(file.type)) {
                    Swal.fire('Error', 'Please upload only JPG, JPEG, or PNG files.', 'error');
                    return;
                }

                if (file.size > maxSize) {
                    Swal.fire('Error', 'File size must be less than 2MB.', 'error');
                    return;
                }
            }

            // Show loading state
            const submitBtn = $(this);
            submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Submitting...');

            // Submit form via AJAX
            $.ajax({
                url: '<?php echo base_url("User/Main/submit_lost_item"); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Close modal
                        $('#reportLostModal').modal('hide');

                        // Show OTP verification dialog
                        showOTPVerification(response.report_id, response.email);
                    } else {
                        Swal.fire('Error', response.message || 'Failed to submit report. Please try again.', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    // Swal.fire('Error', 'An error occurred. Please try again.', 'error');
                },
                complete: function() {
                    submitBtn.prop('disabled', false).html('<i class="fas fa-paper-plane me-2"></i>Submit Report');
                }
            });
        });

        // Reset form when modal is closed
        $('#reportLostModal').on('hidden.bs.modal', function() {
            $('#reportLostForm')[0].reset();
        });
    });

    // OTP Verification Function
    function showOTPVerification(reportId, email) {
        Swal.fire({
            title: 'Verify Your Email',
            html: `
            <p>We've sent a 6-digit OTP to <strong>${email}</strong></p>
            <p>Please check your email and enter the OTP below:</p>
            <input type="text" id="otpInput" class="swal2-input" placeholder="Enter OTP" maxlength="6" style="text-align: center; font-size: 18px; letter-spacing: 8px;">
            <p class="text-muted mt-2" style="font-size: 12px;">Didn't receive OTP? <a href="javascript:void(0)" onclick="resendOTP(${reportId}, '${email}')">Resend</a></p>
        `,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Verify OTP',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const otp = Swal.getPopup().querySelector('#otpInput').value;
                if (!otp || otp.length !== 6) {
                    Swal.showValidationMessage('Please enter a valid 6-digit OTP');
                    return false;
                }
                return otp;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                verifyOTP(reportId, result.value);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // User cancelled - delete the pending report
                deletePendingReport(reportId);
            }
        });
    }

    // Verify OTP
    function verifyOTP(reportId, otp) {
        $.ajax({
            url: '<?php echo base_url("User/Main/verify_otp"); ?>',
            type: 'POST',
            data: {
                report_id: reportId,
                otp: otp
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message || 'Your lost item report has been submitted successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Refresh the page or update item list
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', response.message || 'Invalid OTP. Please try again.', 'error').then(() => {
                        showOTPVerification(reportId, response.email || '');
                    });
                }
            },
            error: function() {
                Swal.fire('Error', 'An error occurred during OTP verification.', 'error');
            }
        });
    }

    // Resend OTP
    function resendOTP(reportId, email) {
        $.ajax({
            url: '<?php echo base_url("User/Main/resend_otp"); ?>',
            type: 'POST',
            data: {
                report_id: reportId
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire('Success', 'OTP has been resent to your email.', 'info');
                } else {
                    Swal.fire('Error', response.message || 'Failed to resend OTP.', 'error');
                }
            }
        });
    }

    // Delete pending report if user cancels OTP verification
    function deletePendingReport(reportId) {
        $.ajax({
            url: '<?php echo base_url("User/Main/delete_pending_report"); ?>',
            type: 'POST',
            data: {
                report_id: reportId
            },
            dataType: 'json'
        });
    }
</script>