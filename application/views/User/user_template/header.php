<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Admin Panel'; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body { background: #f4f6f9; font-family: 'Inter', sans-serif; }
    .sidebar { height: 100vh; background: #0072b5; color: #fff; position: fixed; width: 220px; top: 0; left: 0; padding-top: 20px; }
    .sidebar a { display:block; padding:10px 15px; color:#fff; text-decoration:none; border-radius:6px; margin-bottom:8px; }
    .sidebar a:hover { background:#03164a; }
    .content { margin-left:220px; padding:20px; }
    .navbar { border-radius:8px; margin-bottom:20px; }
  </style>
</head>
<body>


