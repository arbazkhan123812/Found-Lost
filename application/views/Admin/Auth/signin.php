<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login - <?= $this->config->item('site_name') ?></title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/CIT-LOGO.png" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <style>
    body {
    background: #1e2a38;      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .login-card {
      background: #fff;
      color: #333;
      padding: 2.5rem;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 420px;
      position: relative;
      overflow: hidden;
      animation: fadeIn 0.8s ease-in-out;
    }

    .login-card::before {
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

    .login-card img {
      max-width: 100px;
      margin-bottom: 10px;
      position: relative;
      z-index: 1;
      margin-top: 5px;
    }

    .btn-primary {
    background: #1e2a38;      border-color: #0072b5;
      border-radius: 6px;
      padding: 0.6rem;
      font-weight: 600;
    }

    .btn-primary:hover {
      background-color: #0072b5;
      border-color: #03164a;
    }
  </style>
</head>
<body>

  <div class="login-card text-center">
    <h4>Welcome Back</h4>
    <p>Sign in to your Admin Panel</p>

    <?php if ($this->session->flashdata('error_msg')): ?>
      <div class="alert alert-danger"><?= $this->session->flashdata('error_msg'); ?></div>
    <?php endif; ?>

    <?= form_open('Admin/Auth/login'); ?>

      <div class="form-group text-left">
        <label for="username">Username or Email</label>
        <input type="text" class="form-control" name="username" placeholder="Enter username or email" required autofocus>
      </div>

      <div class="form-group text-left">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Enter password" required>
      </div>

      <button type="submit" class="btn btn-primary btn-block">Login</button>

    <?= form_close(); ?>

   
  </div>

</body>
</html>
