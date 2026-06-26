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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/investment-plans.css') }}">
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
            <li class="active">
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
                <a href="copy-trading">
                    <i class='bx bx-copy-alt'></i>
                    <span class="link_name">Copy Trading</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="copy-trading">Copy Trading</a></li>
                </ul>
            </li>
            <li>
                <a href="internal-transfers">
                    <i class='bx bx-transfer-alt'></i>
                    <span class="link_name">Internal Transfers</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="internal-transfers">Internal Transfers</a></li>
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
                <a href="statements">
                    <i class='bx bx-file-find'></i>
                    <span class="link_name">Account Statements</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="statements">Account Statements</a></li>
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
                <a href="loans">
                    <i class='bx bx-money'></i>
                    <span class="link_name">Loan Requests</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="loans">Loan Requests</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/admin-notifications') }}">
                    <i class='bx bx-bell'></i>
                    <span class="link_name">Notifications</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/admin-notifications">Notifications</a></li>
                </ul>
            </li>
            <li>
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
                <h1 id="page-title-display">Investment Plans</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
        <div class="nex-admin-module">

```
<!-- DASHBOARD STATS -->
<div class="stats-grid">

    <div class="stat-card">
        <h3>Total Experts</h3>
        <span>25</span>
    </div>

    <div class="stat-card">
        <h3>Active Experts</h3>
        <span>19</span>
    </div>

    <div class="stat-card">
        <h3>Featured Experts</h3>
        <span>8</span>
    </div>

    <div class="stat-card">
        <h3>Total Copiers</h3>
        <span>4,823</span>
    </div>

    <div class="stat-card">
        <h3>Managed Assets</h3>
        <span>$2.8M</span>
    </div>

</div>

<!-- ACTION BAR -->
<div class="action-bar">

    <button class="nex-btn primary" onclick="openExpertModal()">
        + Create Expert
    </button>

    <button class="nex-btn secondary" onclick="openPlanModal()">
        + Create Plan
    </button>

    <input type="text" id="expertSearch"
        placeholder="Search expert, strategy, country">

    <select>
        <option>All Countries</option>
        <option>USA</option>
        <option>UK</option>
        <option>Nigeria</option>
    </select>

    <select>
        <option>Risk Level</option>
        <option>Low</option>
        <option>Medium</option>
        <option>High</option>
    </select>

</div>

<!-- EXPERTS TABLE -->
<div class="table-wrapper">

    <div class="table-header">
        <h2>Copy Trading Experts</h2>
    </div>

    <table class="admin-table">

        <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Country</th>
                <th>ROI</th>
                <th>Win Rate</th>
                <th>Followers</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td>
                    <img src="https://i.pravatar.cc/50?img=5">
                </td>

                <td>John Carter</td>

                <td>USA</td>

                <td class="success">18.4%</td>

                <td>92%</td>

                <td>2,340</td>

                <td>
                    <span class="badge active">
                        Active
                    </span>
                </td>

                <td>

                    <button class="table-btn view">
                        View
                    </button>

                    <button class="table-btn edit">
                        Edit
                    </button>

                    <button class="table-btn delete">
                        Delete
                    </button>

                </td>
            </tr>

        </tbody>

    </table>

</div>

<!-- INVESTMENT PLANS -->
<div class="table-wrapper">

    <div class="table-header">
        <h2>Investment Plans</h2>
    </div>

    <table class="admin-table">

        <thead>

            <tr>

                <th>Image</th>

                <th>Name</th>

                <th>Category</th>

                <th>Price</th>

                <th>ROI</th>

                <th>Status</th>

                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

            <tr>

                <td>
                    <img src="https://picsum.photos/60">
                </td>

                <td>Bitcoin Growth Plan</td>

                <td>Crypto</td>

                <td>$5,000</td>

                <td>25%</td>

                <td>
                    <span class="badge active">
                        Active
                    </span>
                </td>

                <td>

                    <button class="table-btn view">
                        View
                    </button>

                    <button class="table-btn edit">
                        Edit
                    </button>

                    <button class="table-btn delete">
                        Delete
                    </button>

                </td>

            </tr>

        </tbody>

    </table>

</div>
```

</div>

<!-- CREATE EXPERT MODAL -->

<div class="nex-modal" id="expertModal">

```
<div class="modal-content">

    <h2>Create Expert</h2>

    <input type="file">

    <input type="text" placeholder="Full Name">

    <input type="text" placeholder="Country">

    <input type="text" placeholder="Strategy">

    <input type="number" placeholder="ROI">

    <input type="number" placeholder="Win Rate">

    <textarea placeholder="Biography"></textarea>

    <div class="modal-actions">

        <button class="nex-btn primary">
            Save Expert
        </button>

        <button class="nex-btn danger"
            onclick="closeExpertModal()">
            Cancel
        </button>

    </div>

</div>
```

</div>

<!-- CREATE PLAN MODAL -->

<div class="nex-modal" id="planModal">

```
<div class="modal-content">

    <h2>Create Plan</h2>

    <input type="text" placeholder="Plan Name">

    <input type="number" placeholder="Price">

    <input type="number" placeholder="ROI">

    <textarea placeholder="Description"></textarea>

    <div class="modal-actions">

        <button class="nex-btn primary">
            Save Plan
        </button>

        <button class="nex-btn danger"
            onclick="closePlanModal()">
            Cancel
        </button>

    </div>

</div>
```

</div>

<div class="toast" id="toast">
    Expert Created Successfully
</div>







<!-- Real esate  -->
<!-- =======================================
     REAL ESTATE MANAGEMENT SECTION
======================================= -->

<div class="table-wrapper">

```
<div class="table-header">
    <h2>
        <i class="bx bx-building-house"></i>
        Real Estate Management
    </h2>

    <button class="nex-btn primary"
        onclick="openRealEstateModal()">
        + Add Property
    </button>
</div>

<table class="admin-table">

    <thead>

        <tr>

            <th>Property</th>

            <th>Location</th>

            <th>Value</th>

            <th>Rental Yield</th>

            <th>Units</th>

            <th>Status</th>

            <th>Actions</th>

        </tr>

    </thead>

    <tbody id="propertyTable">

        <tr>

            <td>Dubai Marina Tower</td>

            <td>Dubai UAE</td>

            <td>$850,000</td>

            <td>12%</td>

            <td>28</td>

            <td>
                <span class="badge active">
                    Active
                </span>
            </td>

            <td>

                <button class="table-btn view">
                    View
                </button>

                <button class="table-btn edit">
                    Edit
                </button>

                <button class="table-btn delete">
                    Delete
                </button>

            </td>

        </tr>

    </tbody>

</table>
```

</div>

<!-- =======================================
     AI BOT MANAGEMENT
======================================= -->

<div class="table-wrapper">

```
<div class="table-header">

    <h2>
        AI Trading Bots
    </h2>

    <button class="nex-btn secondary"
        onclick="openBotModal()">
        + Create Bot
    </button>

</div>

<table class="admin-table">

    <thead>

        <tr>

            <th>Bot Name</th>

            <th>Strategy</th>

            <th>Accuracy</th>

            <th>Monthly ROI</th>

            <th>Status</th>

            <th>Actions</th>

        </tr>

    </thead>

    <tbody>

        <tr>

            <td>Nex AI Alpha</td>

            <td>Scalping</td>

            <td>92%</td>

            <td>18%</td>

            <td>
                <span class="badge active">
                    Running
                </span>
            </td>

            <td>

                <button class="table-btn view">
                    View
                </button>

                <button class="table-btn edit">
                    Edit
                </button>

                <button class="table-btn delete">
                    Delete
                </button>

            </td>

        </tr>

    </tbody>

</table>
```

</div>

<!-- =======================================
     PREMIUM SIGNALS
======================================= -->

<div class="table-wrapper">

```
<div class="table-header">

    <h2>
        Premium Signals
    </h2>

    <button class="nex-btn primary"
        onclick="openSignalModal()">
        + Create Signal
    </button>

</div>

<table class="admin-table">

    <thead>

        <tr>

            <th>Name</th>

            <th>Trading Type</th>

            <th>Success Rate</th>

            <th>Price</th>

            <th>Status</th>

            <th>Actions</th>

        </tr>

    </thead>

    <tbody>

        <tr>

            <td>Breakout Signals</td>

            <td>Forex</td>

            <td>88%</td>

            <td>$250</td>

            <td>

                <span class="badge active">
                    Active
                </span>

            </td>

            <td>

                <button class="table-btn view">
                    View
                </button>

                <button class="table-btn edit">
                    Edit
                </button>

                <button class="table-btn delete">
                    Delete
                </button>

            </td>

        </tr>

    </tbody>

</table>
```

</div>

<!-- =======================================
     REAL ESTATE MODAL
======================================= -->

<div class="nex-modal" id="realEstateModal">

```
<div class="modal-content">

    <h2>Add Property</h2>

    <input type="text"
        placeholder="Property Name">

    <input type="text"
        placeholder="Location">

    <input type="text"
        placeholder="Address">

    <input type="number"
        placeholder="Property Value">

    <input type="text"
        placeholder="Rental Yield">

    <input type="text"
        placeholder="Expected Appreciation">

    <input type="number"
        placeholder="Available Units">

    <input type="file" multiple>

    <input type="file">

    <textarea
        placeholder="Property Description"></textarea>

    <div class="modal-actions">

        <button class="nex-btn primary">
            Save Property
        </button>

        <button class="nex-btn danger"
            onclick="closeRealEstateModal()">
            Cancel
        </button>

    </div>

</div>
```

</div>

<!-- =======================================
     AI BOT MODAL
======================================= -->

<div class="nex-modal" id="botModal">

```
<div class="modal-content">

    <h2>Create AI Bot</h2>

    <input type="text"
        placeholder="Bot Name">

    <input type="text"
        placeholder="Strategy Type">

    <input type="number"
        placeholder="Monthly Return">

    <input type="number"
        placeholder="Accuracy Rate">

    <textarea
        placeholder="Bot Description"></textarea>

    <div class="modal-actions">

        <button class="nex-btn primary">
            Save Bot
        </button>

        <button class="nex-btn danger"
            onclick="closeBotModal()">
            Cancel
        </button>

    </div>

</div>
```

</div>

<!-- =======================================
     SIGNAL MODAL
======================================= -->

<div class="nex-modal" id="signalModal">

```
<div class="modal-content">

    <h2>Create Signal</h2>

    <input type="text"
        placeholder="Signal Name">

    <input type="text"
        placeholder="Trading Type">

    <input type="number"
        placeholder="Success Rate">

    <input type="number"
        placeholder="Signal Price">

    <textarea
        placeholder="Signal Description"></textarea>

    <div class="modal-actions">

        <button class="nex-btn primary">
            Save Signal
        </button>

        <button class="nex-btn danger"
            onclick="closeSignalModal()">
            Cancel
        </button>

    </div>

</div>
```

</div>







<!-- Investment -->
 <!-- ==========================================
     INVESTMENT SUBSCRIPTIONS MANAGEMENT
========================================== -->

<div class="table-wrapper">

```
<div class="table-header">

    <h2>
        Investment Subscriptions
    </h2>

    <div class="subscription-stats">

        <span class="badge active">
            Active: 124
        </span>

        <span class="badge pending">
            Pending: 31
        </span>

        <span class="badge completed">
            Completed: 420
        </span>

    </div>

</div>

<table class="admin-table">

    <thead>

        <tr>

            <th>User</th>

            <th>Plan</th>

            <th>Amount</th>

            <th>Start Date</th>

            <th>End Date</th>

            <th>Profit</th>

            <th>Status</th>

            <th>Actions</th>

        </tr>

    </thead>

    <tbody id="subscriptionTable">

        <tr>

            <td>John Doe</td>

            <td>Bitcoin Growth Plan</td>

            <td>$5,000</td>

            <td>2026-06-01</td>

            <td>2026-09-01</td>

            <td class="success">$1,250</td>

            <td>
                <span class="badge active">
                    Active
                </span>
            </td>

            <td>

                <button class="table-btn approve">
                    Approve
                </button>

                <button class="table-btn warning">
                    Cancel
                </button>

                <button class="table-btn complete">
                    Complete
                </button>

                <button class="table-btn view">
                    Details
                </button>

            </td>

        </tr>

    </tbody>

</table>
```

</div>

<!-- ==========================================
     SUBSCRIPTION DETAIL MODAL
========================================== -->

<div class="nex-modal" id="subscriptionModal">

```
<div class="modal-content modal-lg">

    <h2>
        Investment Details
    </h2>

    <div class="details-grid">

        <div class="detail-box">
            <label>User</label>
            <span id="subUser">John Doe</span>
        </div>

        <div class="detail-box">
            <label>Plan</label>
            <span id="subPlan">Bitcoin Growth Plan</span>
        </div>

        <div class="detail-box">
            <label>Amount Invested</label>
            <span id="subAmount">$5,000</span>
        </div>

        <div class="detail-box">
            <label>Current Profit</label>
            <span id="subProfit">$1,250</span>
        </div>

        <div class="detail-box">
            <label>Status</label>
            <span id="subStatus">Active</span>
        </div>

        <div class="detail-box">
            <label>Duration</label>
            <span id="subDuration">90 Days</span>
        </div>

    </div>

    <div class="modal-actions">

        <button class="nex-btn primary">
            Update Investment
        </button>

        <button class="nex-btn danger"
            onclick="closeSubscriptionModal()">
            Close
        </button>

    </div>

</div>
```

</div>

<!-- ==========================================
     BULK ACTIONS BAR
========================================== -->

<div class="action-bar">

```
<button class="nex-btn primary"
    onclick="bulkApprove()">
    Bulk Approve
</button>

<button class="nex-btn secondary"
    onclick="bulkComplete()">
    Bulk Complete
</button>

<button class="nex-btn danger"
    onclick="bulkDelete()">
    Bulk Delete
</button>
```

</div>






<!--  -->
<!-- ==========================================
     ANALYTICS DASHBOARD
========================================== -->

<div class="analytics-grid">

```
<div class="analytics-card">

    <h3>Total Revenue</h3>

    <h1>$2,450,000</h1>

    <span class="positive">
        +18.5% This Month
    </span>

</div>

<div class="analytics-card">

    <h3>Total Investments</h3>

    <h1>1,284</h1>

    <span class="positive">
        +12.4% This Month
    </span>

</div>

<div class="analytics-card">

    <h3>Active Plans</h3>

    <h1>45</h1>

    <span class="positive">
        +5 New Plans
    </span>

</div>

<div class="analytics-card">

    <h3>Total Experts</h3>

    <h1>25</h1>

    <span class="positive">
        +3 New Experts
    </span>

</div>
```

</div>

<!-- ==========================================
     ADVANCED FILTERS
========================================== -->

<div class="advanced-filters">

```
<h2>
    Advanced Filters
</h2>

<div class="filter-row">

    <input
        type="text"
        placeholder="Search Plan Name">

    <input
        type="text"
        placeholder="Search Expert">

    <select>

        <option>
            All Categories
        </option>

        <option>
            Crypto Investment
        </option>

        <option>
            Stock Market
        </option>

        <option>
            Real Estate
        </option>

        <option>
            AI Trading Bots
        </option>

        <option>
            Premium Signals
        </option>

    </select>

    <select>

        <option>
            ROI Filter
        </option>

        <option>
            Highest ROI
        </option>

        <option>
            Lowest ROI
        </option>

    </select>

    <button class="nex-btn primary">

        Apply Filters

    </button>

</div>
```

</div>

<!-- ==========================================
     FEATURED PLANS
========================================== -->

<div class="table-wrapper">

```
<div class="table-header">

    <h2>

        Featured Plans

    </h2>

</div>

<table class="admin-table">

    <thead>

        <tr>

            <th>Plan</th>

            <th>Category</th>

            <th>ROI</th>

            <th>Featured</th>

            <th>Popular</th>

            <th>Premium</th>

            <th>Actions</th>

        </tr>

    </thead>

    <tbody>

        <tr>

            <td>
                Bitcoin Growth Plan
            </td>

            <td>
                Crypto
            </td>

            <td>
                25%
            </td>

            <td>

                <input
                    type="checkbox"
                    checked>

            </td>

            <td>

                <input
                    type="checkbox"
                    checked>

            </td>

            <td>

                <input
                    type="checkbox">

            </td>

            <td>

                <button
                    class="table-btn edit">

                    Update

                </button>

            </td>

        </tr>

    </tbody>

</table>
```

</div>

<!-- ==========================================
     REVENUE CHART AREA
========================================== -->

<div class="chart-section">

```
<div class="chart-card">

    <h2>
        Monthly Revenue
    </h2>

    <canvas
        id="revenueChart">
    </canvas>

</div>

<div class="chart-card">

    <h2>
        Investment Growth
    </h2>

    <canvas
        id="investmentChart">
    </canvas>

</div>
```

</div>

<!-- ==========================================
     EXPERT PERFORMANCE TABLE
========================================== -->

<div class="table-wrapper">

```
<div class="table-header">

    <h2>

        Expert Performance

    </h2>

</div>

<table class="admin-table">

    <thead>

        <tr>

            <th>Expert</th>

            <th>ROI</th>

            <th>Followers</th>

            <th>Copiers</th>

            <th>AUM</th>

            <th>Performance</th>

        </tr>

    </thead>

    <tbody>

        <tr>

            <td>
                John Carter
            </td>

            <td>
                18%
            </td>

            <td>
                4,520
            </td>

            <td>
                1,240
            </td>

            <td>
                $450K
            </td>

            <td>

                <span class="badge active">

                    Excellent

                </span>

            </td>

        </tr>

    </tbody>

</table>
```

</div>


    </main>

    <script src="{{ asset('assets/AdminDashboard/js/investment-plans.js') }}"></script>
</body>

</html>