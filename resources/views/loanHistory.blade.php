<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/loanHistory.css') }}">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>


    <div id="fintech-preloader">
    <div class="loader-container">
        <div class="loader-logo">
            <div class="logo-hexagon">
                <span class="iconify" data-icon="ri:shield-flash-line"></span>
            </div>
            <h2 class="loader-brand-name">Nexuist</h2>
        </div>

        <div class="loader-progress-wrapper">
            <div class="loader-progress-bar" id="load-bar">
                <div class="shimmer-effect"></div>
            </div>
        </div>

        <div class="loader-status">
            <span class="status-dot"></span>
            <p id="status-text">Initializing encrypted connection...</p>
        </div>
    </div>
    
    <div class="glow glow-1"></div>
    <div class="glow glow-2"></div>
</div>
<!-- Preloader ends here -->

    @include('layouts.frontend-header-sidebar')

 

        <!-- Main Content -->
         
        
    </div>

    <script src="{{ asset('assets/Frontend/js/loanHistory.js') }}"></script>
</body>

</html>