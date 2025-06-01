<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Sautech ERP System</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
  <style>
    .specific-scroll::-webkit-scrollbar {
      width: 8px;
    }

    /* Scrollbar Thumb */
    .specific-scroll::-webkit-scrollbar-thumb {
      background-color: #1e2a38;
      border-radius: 10px;
      transition: background-color 0.3s ease;
    }

    /* Scrollbar Thumb Hover */
    .specific-scroll::-webkit-scrollbar-thumb:hover {
      background-color: #1e2a38;
    }

    /* Optional: Scrollbar Track Background */
    .specific-scroll::-webkit-scrollbar-track {
      background-color: #1e2a38;
      border-radius: 10px;
    }

    /* Firefox (fallback for full compatibility) */
    .specific-scroll {
      scrollbar-width: thin;
      scrollbar-color: white #1e2a38;
    }

    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f7fa;
      color: #222;
      /* background-color:#1e4d86; */
    }

    .sidebar {
      background-color: #1e2a38;
      height: 100vh;
      overflow: auto;
    }

    header {
      background-color: #1e2a38;
      padding: 20px;
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0;
    }

    header img {
      height: 40px;
    }

    .tabs {
      display: flex;
      flex-direction: column;
      padding-left: 10px;
      padding-top: 10px;
      margin-bottom: 20px;
      /* gap: 10px; */
      /* background: #fff; */
      /* border-bottom: 2px solid #ddd; */
    }

    .tabs a {
      padding: 15px;
      text-align: left;
      font-size: 14px;
      text-decoration: none;
      /* background: #f0f0f0; */
      color: rgb(211, 210, 210);
      font-weight: 600;
      transition: background 0.3s, color 0.3s;
    }

    .tabs a:last-child {
      border-right: none;
    }

    .tabs a.active,
    .tabs a:hover {
      background: #3f5772;
      color: white;
      border-top-left-radius: 10px;
      border-bottom-left-radius: 10px;
    }

    .tabs a.active {
      margin-bottom: 0;
      border-bottom-left-radius: 10px;
    }

    .content {
      padding: 0;
    }

    iframe {
      width: 100%;
      height: 85vh;
      border: none;
      background: #fff;
    }

    .header-title {
      font-size: 18px;
      font-weight: 500;
      color: #ffffff;
      font-family: 'Inter', sans-serif;
      margin: 0;
      letter-spacing: 0.5px;
      text-transform: capitalize;
      border-left: 2px solid #1abc9c;
      padding-left: 12px;
    }

    .logo {
      width: 150px;
      height: auto;
    }

    .container-1 {
      width: 100%;
      padding-left: 20px;
    }

    .logout-btn {
      all: unset;
      width: 70%;
      margin: 0;
      margin-inline: auto;
      margin-block: 20px;
      display: block;
      padding: 10px 20px;
      background-color: white;
      font-weight: 800;
      color: black;
      border-radius: 5px;
      cursor: pointer;
    }

    .sub-tabs {
      background: #3f5772;
      margin-bottom: 20px;
      border-bottom-left-radius: 20px;
    }

    .sub-tabs a {
      font-size: 12px;
      padding: 8px 14px;
      text-decoration: none;
      display: block;
      font-weight: 500;
    }

    .sub-tabs a.active,
    .sub-tabs a:hover {
      color: white;
    }

    .sub-tabs a:last-child {
      padding-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="row p-0 m-0">
    <!-- sidebar -->
   @include('layout.sidebar')

    <!-- content -->
    <div class="content col-md-10 p-0 m-0" style="background: white;">
      @yield('content')
    </div>


  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>
  {{-- <script>
    // Redirect to the first available tabbtn
    document.addEventListener('DOMContentLoaded', () => {
      const frame = document.getElementById("moduleFrame");
      const tabButtons = document.querySelectorAll('.tabbtn');
      const subTabButtons = document.querySelectorAll('.sub-tabbtn');

      // Handle main tabs
      tabButtons.forEach(tab => {
        tab.addEventListener('click', function(e) {
          e.preventDefault();

          // Remove active from all main and sub tabs
          tabButtons.forEach(btn => btn.classList.remove('active'));
          subTabButtons.forEach(btn => btn.classList.remove('active'));
          document.querySelectorAll('.sub-tabs').forEach(sub => sub.style.display = 'none');

          // Activate this main tab
          this.classList.add('active');

          // Show its sub-tabs if exist
          const nextElement = this.nextElementSibling;
          if (nextElement && nextElement.classList.contains('sub-tabs')) {
            nextElement.style.display = 'block';

            // Load first sub-tab if available
            const firstSubTab = nextElement.querySelector('.sub-tabbtn');
            if (firstSubTab) {
              firstSubTab.classList.add('active');
              frame.src = firstSubTab.dataset.src;
              return;
            }
          }

          // Otherwise load main tab content
          frame.src = this.dataset.src;
        });
      });

      // Handle sub-tabs
      subTabButtons.forEach(sub => {
        sub.addEventListener('click', function(e) {
          e.preventDefault();
          subTabButtons.forEach(btn => btn.classList.remove('active'));
          this.classList.add('active');
          frame.src = this.dataset.src;
        });
      });

      // Trigger default tab
      if (tabButtons.length) {
        tabButtons[0].click();
      }
    });
  </script> --}}
</body>

</html>
