<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/Frontend/image/NexuistLogo.png.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/notification.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

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
        <div class="notifications-container">
            <div class="noti-header">
                <div class="noti-title-area">
                    <h2>Notifications <span class="noti-badge" id="unread-count">{{ $unreadCount }}</span></h2>
                    <p>Your personal notification center for staying updated with important system alerts and messages.
                    </p>
                </div>
                <div class="noti-header-actions">
                    <button class="action-btn secondary-btn" id="mark-all-read-btn">
                        <i class="bx bx-check-double"></i> Mark all as read
                    </button>
                </div>
            </div>

            <div class="noti-controls">
                <div class="filter-tabs">
                    <button class="tab-btn active" data-filter="all">All</button>
                    <button class="tab-btn" data-filter="unread">Unread</button>
                    <button class="tab-btn" data-filter="read">Read</button>
                </div>

                <div class="search-wrapper">
                    <i class="bx bx-search search-icon"></i>
                    <input type="text" id="noti-search" placeholder="Search notifications, IPs, or assets...">
                </div>
                
            </div>

            <div class="noti-list" id="notifications-wrapper">
                @if($notifications->isEmpty())
                    <div class="noti-empty">
                        <p>No notifications found. Any activity like login, deposit, trade, or profile updates will appear here.</p>
                    </div>
                @else
                    @foreach($notifications as $notification)
                        @php
                            $tagClasses = [
                                'Login' => 'tag-login',
                                'Deposit' => 'tag-success',
                                'Deposit Approved' => 'tag-success',
                                'Deposit Rejected' => 'tag-error',
                                'Crypto Trade' => 'tag-success',
                                'Stock Trade' => 'tag-success',
                                'Profile Update' => 'tag-registration',
                            ];
                            $tagClass = $tagClasses[$notification->type] ?? 'tag-default';
                        @endphp
                        <div class="noti-item {{ $notification->status === 'unread' ? 'unread' : '' }}"
                             data-id="{{ $notification->id }}"
                             data-status="{{ $notification->status }}">
                            <div class="noti-item-left">
                                <div class="icon-avatar {{ $notification->status === 'unread' ? 'login-status' : 'registration-status' }}">
                                    <i class="bx bx-bell"></i>
                                </div>
                                <div class="noti-details">
                                    <div class="noti-main-text">
                                        <span class="noti-type-tag {{ $tagClass }}">{{ $notification->type }}</span>
                                        <p class="noti-message">{{ $notification->message }}</p>
                                    </div>
                                    <div class="noti-meta">
                                        <span class="meta-time"><i class="bx bx-time-five"></i> {{ $notification->created_at->format('Y-m-d H:i:s') }}</span>
                                        <span class="meta-relative">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="noti-item-actions">
                                <button class="icon-action-btn view-btn" title="View details"><i class="bx bx-show"></i></button>
                                <button class="icon-action-btn read-toggle-btn" title="{{ $notification->status === 'unread' ? 'Mark as read' : 'Mark as unread' }}">
                                    <i class="bx {{ $notification->status === 'unread' ? 'bx-check' : 'bx-undo' }}"></i>
                                </button>
                                <button class="icon-action-btn delete-btn" title="Delete"><i class="bx bx-trash"></i></button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="noti-footer">
                <p id="showing-count-text">Showing 3 of 3 notifications</p>
            </div>
        </div>

    </div>

    <script src="{{ asset('assets/Frontend/js/notification.js') }}"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

</body>

</html>