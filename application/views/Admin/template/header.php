<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Admin Panel'; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      background: #f4f6f9;
      font-family: 'Inter', sans-serif;
      transition: opacity 0.3s ease-in-out;
    }

    body.fade-out {
      opacity: 0;
    }

    .sidebar {
      height: 100vh;
      background: #0072b5;
      color: #fff;
      position: fixed;
      width: 220px;
      top: 0;
      left: 0;
      padding-top: 20px;
    }

    .sidebar a {
      display: block;
      padding: 10px 15px;
      color: #fff;
      text-decoration: none;
      border-radius: 6px;
      margin-bottom: 8px;
    }

    .sidebar a:hover {
      background: #03164a;
    }

    .content {
      margin-left: 220px;
      padding: 20px;
    }

    .navbar {
      border-radius: 8px;
      margin-bottom: 20px;
    }

    /* ✅ Loader Overlay CSS */
    #loaderOverlay {
      position: fixed;
      inset: 0;
      background: rgba(255, 255, 255, 1);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      transition: opacity 0.3s ease;
    }

    #loaderOverlay.hidden {
      opacity: 0;
      pointer-events: none;
    }

    .spinner {
      width: 60px;
      height: 60px;
      border: 5px solid #ccc;
      border-top-color: #0072b5;
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>

<body>
  <!-- ✅ Loader must be inside <body>, not before <html> -->
  <div id="loaderOverlay">
    <div class="spinner"></div>
  </div>


  <script>
  const loader = document.getElementById('loaderOverlay');

  function hideLoader() {
    if (loader) loader.classList.add('hidden');
    document.body.classList.remove('fade-out');
  }

  // ✅ Loader visible before unload
  window.addEventListener('beforeunload', () => {
    document.body.classList.add('fade-out');
    if (loader) loader.classList.remove('hidden');
  });

  // ✅ Page load fresh
  document.addEventListener('DOMContentLoaded', hideLoader);

  // ✅ Page restore from back/forward cache
  window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
      hideLoader();
    }
  });
</script>

</body>
</html>
