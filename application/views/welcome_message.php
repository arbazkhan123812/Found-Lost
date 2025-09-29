<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Portal Navigation</title>
	<!-- Bootstrap 5 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<style>
		body {
    background: #1e2a38;			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}

		.portal-container {
			max-width: 900px;
			width: 100%;
			padding: 20px;
		}

		.portal-header {
			text-align: center;
			margin-bottom: 50px;
			color: white;
		}

		.portal-header h1 {
			font-size: 3rem;
			font-weight: 700;
			margin-bottom: 15px;
			text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
		}

		.portal-header p {
			font-size: 1.2rem;
			opacity: 0.9;
		}

		.portal-card {
			background: white;
			border-radius: 15px;
			padding: 40px 30px;
			text-align: center;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
			transition: all 0.3s ease;
			height: 100%;
			border: none;
		}

		.portal-card:hover {
			transform: translateY(-10px);
			box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
		}

		.portal-icon {
			font-size: 4rem;
			margin-bottom: 25px;
			background: linear-gradient(135deg, #00288a 0%, #000000 100%);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			background-clip: text;
		}

		.portal-card h3 {
			color: #333;
			font-weight: 700;
			margin-bottom: 15px;
			font-size: 1.8rem;
		}

		.portal-card p {
			color: #666;
			font-size: 1rem;
			line-height: 1.6;
			margin-bottom: 25px;
		}

		.btn-portal {
			background: linear-gradient(135deg, #00288a 0%, #000000 100%);
			color: white;
			border: none;
			padding: 12px 30px;
			border-radius: 50px;
			font-weight: 600;
			font-size: 1.1rem;
			transition: all 0.3s ease;
			text-decoration: none;
			display: inline-block;
		}

		.btn-portal:hover {
			transform: scale(1.05);
			color: white;
			box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
		}

		/* Responsive adjustments */
		@media (max-width: 768px) {
			.portal-header h1 {
				font-size: 2.2rem;
			}

			.portal-header p {
				font-size: 1rem;
			}

			.portal-card {
				padding: 30px 20px;
				margin-bottom: 20px;
			}

			.portal-icon {
				font-size: 3rem;
			}
		}

		@media (max-width: 576px) {
			.portal-container {
				padding: 15px;
			}

			.portal-header {
				margin-bottom: 30px;
			}

			.portal-header h1 {
				font-size: 1.8rem;
			}
		}
	</style>
</head>

<body>
	<div class="portal-container">
		<!-- Header Section -->
		<div class="portal-header">
			<h1><i class="fas fa-door-open me-3"></i>Welcome to Portal</h1>
			<p>Choose your access portal to continue</p>
		</div>

		<!-- Portal Cards Section -->
		<div class="row g-4">
			<!-- Admin Portal Card -->
			<div class="col-md-6">
				<div class="portal-card">
					<div class="portal-icon">
						<i class="fas fa-user-shield"></i>
					</div>
					<h3>Admin Portal</h3>
					<p>Access the administrative dashboard to manage users, view analytics, and control system settings. Full administrative privileges required.</p>
					<a href="<?= base_url('Admin/Main/index') ?>" class="btn btn-portal">
						<i class="fas fa-sign-in-alt me-2"></i>Enter Admin Portal
					</a>
				</div>
			</div>

			<!-- User Portal Card -->
			<div class="col-md-6">
				<div class="portal-card">
					<div class="portal-icon">
						<i class="fas fa-user"></i>
					</div>
					<h3>User Portal</h3>
					<p>Access the user dashboard to manage your profile, submit requests, and interact with system features. Available for all registered users.</p>
					<a href="<?= base_url('User/Main/index') ?>" class="btn btn-portal">
						<i class="fas fa-sign-in-alt me-2"></i>Enter User Portal
					</a>
				</div>
			</div>
		</div>

		<!-- Footer Note -->
		<div class="text-center mt-5">
			<p class="text-white opacity-75">
				<i class="fas fa-info-circle me-2"></i>
				Need help? Contact system administrator
			</p>
		</div>
	</div>

	<!-- Bootstrap & Popper JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>