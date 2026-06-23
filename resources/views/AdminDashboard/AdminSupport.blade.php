<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/support.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.NEXUIST_BASE_URL = @json(url(''));
    </script>
</head>

<body>

    <!-- Preloader starts here -->

    <div id="nexuist-preloader">
        <div class="loader-terminal-box">
            <i class='bx bx-cube-alt loader-brand-icon'></i>
            <div class="glow-bars-container">
                <div class="glow-bar"></div>
                <div class="glow-bar"></div>
                <div class="glow-bar"></div>
            </div>
            <span class="loader-status-text">CONNECTING TO SECURE NODE...</span>
        </div>
    </div>

    <!-- Preloader ends here -->

    <nav class="sidebar" id="sidebar">
        <div class="logo-details">
            <i class='bx bx-cube-alt logo-icon'></i>
            <span class="logo_name">NEXUIST</span>
            <i class='bx bx-chevron-left' id="sidebar-toggle-btn"></i>
        </div>

        <ul class="nav-links">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/users') }}">
                    <i class='bx bx-user-pin'></i>
                    <span class="link_name">Users Management</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/users">Users Management</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/deposits') }}">
                    <i class='bx bx-credit-card'></i>
                    <span class="link_name">Deposits</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/deposits') }}">Deposits</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/withdrawals') }}">
                    <i class='bx bx-transfer'></i>
                    <span class="link_name">Withdrawals</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/withdrawals">Withdrawals</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/investment-plans') }}">
                    <i class='bx bx-layer'></i>
                    <span class="link_name">Investment Plans</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/investment-plans">Investment Plans</a></li>
                </ul>
            </li>
            <li>
                <a href="/ai-bot">
                    <i class='bx bx-bot'></i>
                    <span class="link_name">AI Bot Trading</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/ai-bot">AI Bot Trading</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/copy-trading') }}">
                    <i class='bx bx-copy-alt'></i>
                    <span class="link_name">Copy Trading</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/copy-trading">Copy Trading</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/internal-transfers') }}">
                    <i class='bx bx-transfer-alt'></i>
                    <span class="link_name">Internal Transfers</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/internal-transfers">Internal Transfers</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/performance') }}">
                    <i class='bx bx-line-chart-down'></i>
                    <span class="link_name">Performance History</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/performance">Performance History</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/portfolio') }}">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="link_name">Portfolio Analytics</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/portfolio">Portfolio Analytics</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/statements') }}">
                    <i class='bx bx-file-find'></i>
                    <span class="link_name">Account Statements</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/statements">Account Statements</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/kyc') }}">
                    <i class='bx bx-id-card'></i>
                    <span class="link_name">KYC Verification</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/kyc">KYC Verification</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/loans') }}">
                    <i class='bx bx-money'></i>
                    <span class="link_name">Loan Requests</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/loans">Loan Requests</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/notifications') }}">
                    <i class='bx bx-bell'></i>
                    <span class="link_name">Notifications</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/notifications">Notifications</a></li>
                </ul>
            </li>
            <li class="active">
                <a href="{{ url('/support') }}">
                    <i class='bx bx-support'></i>
                    <span class="link_name">Messages & Support</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/support">Messages & Support</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/transactions') }}">
                    <i class='bx bx-receipt'></i>
                    <span class="link_name">Transaction Logs</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/transactions">Transaction Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/website-settings') }}">
                    <i class='bx bx-globe'></i>
                    <span class="link_name">Website Settings</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/website-settings">Website Settings</a></li>
                </ul>
            </li>
            <li>
                <a href="/security">
                    <i class='bx bx-shield-quarter'></i>
                    <span class="link_name">Security Logs</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/security">Security Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/admin-settings') }}">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Admin Settings</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/admin-settings">Admin Settings</a></li>
                </ul>
            </li>

            <li class="control-items">
                <div class="mode-toggle-wrapper">
                    <div class="mode-text-wrapper">
                        <i class='bx bx-moon mode-icon-indicator'></i>
                        <span class="link_name mode-label">Dark Mode</span>
                    </div>
                    <div class="toggle-switch-track">
                        <span class="switch-thumb"></span>
                    </div>
                </div>
            </li>

            <li class="logout-item">
                <a href="logout.html">
                    <i class='bx bx-log-out-circle'></i>
                    <span class="link_name">Logout</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="logout.html">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <i class='bx bx-menu' id="mobile-hamburger-btn"></i>
                <h1 id="page-title-display">Support</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->


    <!-- </main> -->

    <div class="support-container">

        <div class="support-header">
            <div class="header-title-block">
                <h1>Customer Support Desk</h1>
                <p>Manage complaints, prioritize customer support tickets, and chat with users in real-time.</p>
            </div>
            <div class="alert-pill-badge">
                <i class="bx bx-error-alt"></i> <span>2 Critical Priority Alerts Pending</span>
            </div>
        </div>

        <div class="support-stats-grid">
            <div class="support-stat-card border-primary">
                <div class="card-metric-info">
                    <span class="metric-label">Total Support Tickets</span>
                    <span class="metric-value">{{ $stats['totalTickets'] ?? 0 }}</span>
                    <span class="metric-trend"><i class="bx bx-trending-up"></i> +{{ $stats['weeklyTrend'] ?? 0 }}% this week</span>
                </div>
                <div class="card-icon-box bg-primary-glow"><i class="bx bx-cabinet"></i></div>
            </div>

            <div class="support-stat-card border-warning">
                <div class="card-metric-info">
                    <span class="metric-label">Open Tickets</span>
                    <span class="metric-value" id="stat-open-count">{{ $stats['openTickets'] ?? 0 }}</span>
                    <span class="metric-trend color-warning">Requires response</span>
                </div>
                <div class="card-icon-box bg-warning-glow"><i class="bx bx-folder-open"></i></div>
            </div>

            <div class="support-stat-card border-success">
                <div class="card-metric-info">
                    <span class="metric-label">Resolved Tickets</span>
                    <span class="metric-value">{{ $stats['resolvedTickets'] ?? 0 }}</span>
                    <span class="metric-trend color-success"><i class="bx bx-check-double"></i> {{ $stats['resolutionRate'] ?? 0 }}% rate</span>
                </div>
                <div class="card-icon-box bg-success-glow"><i class="bx bx-badge-check"></i></div>
            </div>

            <div class="support-stat-card border-danger">
                <div class="card-metric-info">
                    <span class="metric-label">High Priority Tiers</span>
                    <span class="metric-value">{{ $stats['highPriorityTickets'] ?? 0 }}</span>
                    <span class="metric-trend color-danger">VIP & Risk Escalations</span>
                </div>
                <div class="card-icon-box bg-danger-glow"><i class="bx bx-shield-quarter"></i></div>
            </div>
        </div>

        <div class="filter-console-wrapper">
            <div class="search-input-box">
                <i class="bx bx-search"></i>
                <input type="text" id="ticketSearch"
                    placeholder="Search by username, UID tag, or Ticket Reference ID...">
            </div>
            <div class="filter-dropdown-group">
                <select class="console-select" id="statusFilter">
                    <option value="">All Statuses</option>
                    <option value="Open">Open</option>
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Resolved">Resolved</option>
                    <option value="Escalated">Escalated</option>
                </select>
                <select class="console-select" id="categoryFilter">
                    <option value="">All Categories</option>
                    <option value="Deposit Issues">Deposit Issues</option>
                    <option value="Withdrawal Issues">Withdrawal Issues</option>
                    <option value="KYC Verification">KYC Verification</option>
                    <option value="Loan Complaints">Loan Complaints</option>
                    <option value="Account Restrictions">Account Restrictions</option>
                    <option value="Security Reports">Security Reports</option>
                </select>
                <select class="console-select" id="priorityFilter">
                    <option value="">All Priorities</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>
        </div>

        <div class="table-frame-container">
            <div class="table-inner-scroller">
                <table class="fintech-support-table">
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>User Profile</th>
                            <th>Subject & Category</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Submission Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="ticketTableBody">
                        @forelse ($tickets as $ticket)
                            @php
                                $user = $ticket->user ?? null;
                                $initials = strtoupper(substr($ticket->name, 0, 1) . (strpos($ticket->name, ' ') !== false ? substr(strrchr($ticket->name, ' '), 1, 1) : ''));
                                $statusClass = 'status-badge s-' . strtolower(str_replace(' ', '-', $ticket->status));
                                $priorityClass = 'priority-badge p-' . strtolower($ticket->priority ?? 'medium');
                            @endphp
                            <tr data-user="{{ $ticket->name }}" data-uid="#NEX-{{ $ticket->id }}" onclick="selectTicket('TCK-{{ $ticket->id }}')">
                                <td><span class="ticket-id-tag">TCK-{{ $ticket->id }}</span></td>
                                <td>
                                    <div class="user-profile-cell">
                                        <div class="avatar-circle-placeholder">{{ $initials }}</div>
                                        <div>
                                            <div class="profile-fullname">{{ $ticket->name }}</div>
                                            <div class="profile-uid">#NEX-{{ $ticket->user_id ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="ticket-subject-text">{{ $ticket->subject }}</div>
                                    <div class="ticket-cat-sub">{{ $ticket->category ?? 'General' }}</div>
                                </td>
                                <td><span class="{{ $priorityClass }}">{{ $ticket->priority ?? 'Medium' }}</span></td>
                                <td><span class="{{ $statusClass }}">{{ $ticket->status }}</span></td>
                                <td class="date-cell-text">{{ $ticket->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <button class="table-control-btn" title="Interact with Case"><i
                                            class="bx bx-message-square-detail"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 20px;">No support tickets found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="split-workflow-layout">

            <div class="workflow-card-panel">
                <div class="panel-heading-title">
                    <i class="bx bx-detail color-secondary"></i> Case Evaluation Deck
                </div>

                <div class="deck-account-details">
                    <div class="details-row-grid">
                        <div>
                            <div class="detail-label">Current Client</div>
                            <div class="detail-value" id="deck-username">Marcus Vance</div>
                        </div>
                        <div>
                            <div class="detail-label">Account Restriction Status</div>
                            <div class="detail-value text-success" id="deck-status">Active (Unrestricted)</div>
                        </div>
                    </div>

                    <div class="details-row-grid">
                        <div>
                            <div class="detail-label">Wallet Collateral</div>
                            <div class="detail-value">$14,850.00</div>
                        </div>
                        <div>
                            <div class="detail-label">TX Hash / Reference</div>
                            <div class="detail-value font-mono text-secondary">TXN-902188412-NEX</div>
                        </div>
                    </div>
                </div>

                <div class="complaint-narrative-box">
                    <div class="detail-label">Full Customer Complaint Message</div>
                    <p id="deck-complaint">
                        I initiated an external USDT deposit of $5,000 via the TRC-20 network over 4 hours ago. The
                        blockchain transaction status shows as successful, but my main Nexuist dashboard balance hasn't
                        updated. Please check the transaction log.
                    </p>
                </div>

                <div class="attachment-preview-box">
                    <div class="detail-label">Uploaded Proof / Screenshots</div>
                    <div class="attachment-link-item">
                        <i class="bx bx-image-alt"></i> <span>blockchain_receipt_screenshot.png</span>
                    </div>
                </div>

                <div class="admin-action-matrix">
                    <button class="action-btn-trigger bg-success" onclick="modifyActiveTicketStatus('Resolved')"><i
                            class="bx bx-check-shield"></i> Mark Resolved</button>
                    <button class="action-btn-trigger bg-primary" onclick="modifyActiveTicketStatus('In Progress')"><i
                            class="bx bx-refresh"></i> In Progress</button>
                    <button class="action-btn-trigger bg-warning" onclick="modifyActiveTicketStatus('Escalated')"><i
                            class="bx bx-git-branch"></i> Escalate Case</button>
                    <button class="action-btn-trigger btn-outline-danger" onclick="suspendUserAccount()"><i
                            class="bx bx-user-x"></i> Suspend User</button>
                </div>
            </div>

            <div class="workflow-card-panel chat-panel-flex">
                <div class="panel-heading-title spec-chat-header">
                    <div class="chat-header-user-info">
                        <i class="bx bx-comment-dots color-primary"></i>
                        <div>
                            <div style="font-weight: 600;" id="chat-header-title">Live Chat Stream: TCK-9902</div>
                            <div style="font-size: 0.75rem; color: var(--text-secondary);">Direct Admin-to-User
                                Communication Interface</div>
                        </div>
                    </div>
                    <span class="live-activity-dot"></span>
                </div>

                <div class="chat-message-stream-window" id="chatMessageStream">
                    <div class="chat-bubble-row user-bubble">
                        <div class="bubble-content-text">
                            Hello, I really need help with my deposit issue. It has been outstanding for hours and my
                            trading bot is paused.
                            <div class="bubble-timestamp-meta">15:32 PM &bull; <i
                                    class="bx bx-check-double text-secondary"></i></div>
                        </div>
                    </div>

                    <div class="chat-bubble-row admin-bubble">
                        <div class="bubble-content-text">
                            Welcome to Nexuist Support Desk. I am tracking your TRC-20 transaction payload right now.
                            Please hold on while we sync with the local node infrastructure.
                            <div class="bubble-timestamp-meta">15:35 PM &bull; Seen <i class="bx bx-check-double"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="chat-input-transmission-bar">
                    <button class="chat-utility-btn" title="Attach Document Screenshot"><i
                            class="bx bx-paperclip"></i></button>
                    <input type="text" id="chatInputField"
                        placeholder="Type your secure operational reply message here...">
                    <button class="chat-send-btn" id="chatSendButton"><i class="bx bx-send"></i></button>
                </div>
            </div>

        </div>
    </div>
    </main>
    <script src="{{ asset('assets/AdminDashboard/js/support.js') }}"></script>
</body>

</html>