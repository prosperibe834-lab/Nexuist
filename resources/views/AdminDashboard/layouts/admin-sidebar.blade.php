<nav class="sidebar" id="sidebar">
    <div class="logo-details">
        <i class='bx bx-cube-alt logo-icon'></i>
        <span class="logo_name">NEXUIST</span>
        <i class='bx bx-chevron-left' id="sidebar-toggle-btn"></i>
    </div>

    <ul class="nav-links">
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <i class='bx bx-grid-alt'></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('users') ? 'active' : '' }}">
            <a href="{{ url('/users') }}">
                <i class='bx bx-user-pin'></i>
                <span class="link_name">Users Management</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/users">Users Management</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('deposits') ? 'active' : '' }}">
            <a href="{{ url('/deposits') }}">
                <i class='bx bx-credit-card'></i>
                <span class="link_name">Deposits</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ url('/deposits') }}">Deposits</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('withdrawals') ? 'active' : '' }}">
            <a href="{{ url('/withdrawals') }}">
                <i class='bx bx-transfer'></i>
                <span class="link_name">Withdrawals</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/withdrawals">Withdrawals</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('AdminDemo') ? 'active' : '' }}">
            <a href="{{ url('/AdminDemo') }}">
                <i class='bx bx-user-circle'></i>
                <span class="link_name">AdminDemo</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/AdminDemo">AdminDemo</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('AdminReferUSer') ? 'active' : '' }}">
            <a href="{{ url('/AdminReferUSer') }}">
                <i class='bx bx-group'></i>
                <span class="link_name">AdminReferUSer</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/AdminReferUSer">AdminReferUSer</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('Adminlivemarket') ? 'active' : '' }}">
            <a href="{{ url('/Adminlivemarket') }}">
                <i class='bx bx-line-chart'></i>
                <span class="link_name">Adminlivemarket</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/Adminlivemarket">Adminlivemarket</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('PremiumInvestment') ? 'active' : '' }}">
            <a href="{{ url('/PremiumInvestment') }}">
                <i class='bx bx-crown'></i>
                <span class="link_name">Premium Investment</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/PremiumInvestment">Premium Investment</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('StockMarket') ? 'active' : '' }}">
            <a href="{{ url('/StockMarket') }}">
                <i class='bx bx-bar-chart-alt-2'></i>
                <span class="link_name">StockMarket</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/StockMarket">StockMarket</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('Crypto') ? 'active' : '' }}">
            <a href="{{ url('/Crypto') }}">
                <i class='bx bx-bitcoin'></i>
                <span class="link_name">Crypto</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/Crypto">Crypto</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('AdminRealEstate') ? 'active' : '' }}">
            <a href="{{ url('/AdminRealEstate') }}">
                <i class='bx bx-building-house'></i>
                <span class="link_name">Real Estate</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/AdminRealEstate">Real Estate</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('ai-bot') ? 'active' : '' }}">
            <a href="/ai-bot">
                <i class='bx bx-bot'></i>
                <span class="link_name">AI Bot Trading</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/ai-bot">AI Bot Trading</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('copy-trading') ? 'active' : '' }}">
            <a href="{{ url('/copy-trading') }}">
                <i class='bx bx-copy-alt'></i>
                <span class="link_name">Copy Trading</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/copy-trading">Copy Trading</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('internal-transfers') ? 'active' : '' }}">
            <a href="{{ url('/internal-transfers') }}">
                <i class='bx bx-transfer-alt'></i>
                <span class="link_name">Internal Transfers</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/internal-transfers">Internal Transfers</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('performance') ? 'active' : '' }}">
            <a href="{{ url('/performance') }}">
                <i class='bx bx-line-chart-down'></i>
                <span class="link_name">Performance History</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/performance">Performance History</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('AdminPortfolio') ? 'active' : '' }}">
            <a href="{{ url('/AdminPortfolio') }}">
                <i class='bx bx-pie-chart-alt-2'></i>
                <span class="link_name">Portfolio Analytics</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/AdminPortfolio">Portfolio Analytics</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('statements') ? 'active' : '' }}">
            <a href="{{ url('/statements') }}">
                <i class='bx bx-file-find'></i>
                <span class="link_name">Account Statements</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/statements">Account Statements</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('kyc') ? 'active' : '' }}">
            <a href="{{ url('/kyc') }}">
                <i class='bx bx-id-card'></i>
                <span class="link_name">KYC Verification</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/kyc">KYC Verification</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('loans') ? 'active' : '' }}">
            <a href="{{ url('/loans') }}">
                <i class='bx bx-money'></i>
                <span class="link_name">Loan Requests</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/loans">Loan Requests</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('admin-notifications') ? 'active' : '' }}">
            <a href="{{ url('/admin-notifications') }}">
                <i class='bx bx-bell'></i>
                <span class="link_name">Notifications</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/admin-notifications">Notifications</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('AdminSupport') ? 'active' : '' }}">
            <a href="{{ url('/AdminSupport') }}">
                <i class='bx bx-support'></i>
                <span class="link_name">Messages & Support</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/AdminSupport">Messages & Support</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('transactions') ? 'active' : '' }}">
            <a href="{{ url('/transactions') }}">
                <i class='bx bx-receipt'></i>
                <span class="link_name">Transaction Logs</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/transactions">Transaction Logs</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('website-settings') ? 'active' : '' }}">
            <a href="{{ url('/website-settings') }}">
                <i class='bx bx-globe'></i>
                <span class="link_name">Website Settings</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/website-settings">Website Settings</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('security') ? 'active' : '' }}">
            <a href="/security">
                <i class='bx bx-shield-quarter'></i>
                <span class="link_name">Security Logs</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/security">Security Logs</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('admin-settings') ? 'active' : '' }}">
            <a href="{{ url('/admin-settings') }}">
                <i class='bx bx-cog'></i>
                <span class="link_name">Admin Settings</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/admin-settings">Admin Settings</a></li>
            </ul>
        </li>

 <li class="{{ request()->is('admin-users') ? 'active' : '' }}">
            <a href="{{ url('/admin-users') }}">
                <i class='bx bxs-user-account'></i>
                <span class="link_name">Admin Users</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/admin-settings">Admiz Users</a></li>
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
