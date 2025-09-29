<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Register - <?= $this->config->item('site_name') ?></title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/CIT-LOGO.png" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <style>
    body {
      background-color: #0072b5;
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .register-card {
      background: #fff;
      color: #333;
      padding: 2.5rem;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 450px;
      position: relative;
      overflow: hidden;
      animation: fadeIn 0.8s ease-in-out;
    }

    .register-card::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 120px;
      border-bottom-left-radius: 50% 30%;
      border-bottom-right-radius: 50% 30%;
      z-index: 0;
    }

    .register-card img {
      max-width: 100px;
      margin-bottom: 10px;
      position: relative;
      z-index: 1;
      margin-top: 5px;
    }

    .register-card h4 {
      font-weight: 600;
      margin-bottom: 5px;
      color: #333;
    }

    .form-control {
      background-color: #f8f9fa;
      border: 1px solid #ced4da;
      color: #333;
    }

    .form-control:focus {
      border-color: #0072b5;
      box-shadow: 0 0 0 0.2rem rgba(0, 114, 181, 0.25);
    }

    .btn-primary {
      background-color: #0072b5;
      border-color: #0072b5;
      border-radius: 6px;
      padding: 0.6rem;
      font-weight: 600;
    }

    .btn-primary:hover {
      background-color: #03164a;
      border-color: #03164a;
    }
  </style>
</head>

<body>

  <div class="register-card text-center">
    <h4>Admin Registration</h4>
    <p>Create your admin account</p>

    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <?= validation_errors('<div class="alert alert-danger">','</div>'); ?>

    <?= form_open('Admin/Auth/register'); ?>

      <div class="form-group text-left">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?= set_value('username'); ?>" placeholder="Enter username" required>
      </div>

      <div class="form-group text-left">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" value="<?= set_value('email'); ?>" placeholder="Enter email" required>
      </div>

      <div class="form-group text-left">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Enter password" required>
      </div>

      <div class="form-group text-left">
        <label for="cpassword">Confirm Password</label>
        <input type="password" class="form-control" name="cpassword" placeholder="Confirm password" required>
      </div>

      <button type="submit" class="btn btn-primary btn-block">Register</button>

    <?= form_close(); ?>
  </div>

  <!-- Bootstrap + jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
