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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/loans.css') }}">
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

        @include('AdminDashboard.layouts.admin-sidebar')


    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <i class='bx bx-menu' id="mobile-hamburger-btn"></i>
                <h1 id="page-title-display">Loan</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->

<div class="loans-container">
    
    <div class="page-header">
        <div class="page-title">
            <h1>Loan Management System</h1>
            <p>Monitor customer lines of credit, evaluate applicant risk tiers, and coordinate repayments.</p>
        </div>
        <div>
            <button class="nexuist-btn">
                <i class="bx bx-bell"></i> Active Application Alerts <span style="background:#ef4444; padding:2px 6px; border-radius:50%; font-size:10px;">3</span>
            </button>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card stat-primary">
            <div class="stat-info">
                <span class="stat-label">Total Active Loans</span>
                <div class="stat-value">412</div>
                <span class="stat-subtext">Portfolio Distribution</span>
            </div>
            <div class="stat-icon-wrapper"><i class="bx bx-file-find"></i></div>
        </div>

        <div class="stat-card stat-warning">
            <div class="stat-info">
                <span class="stat-label">Pending Requests</span>
                <div class="stat-value">18</div>
                <span class="stat-subtext">Requires immediate review</span>
            </div>
            <div class="stat-icon-wrapper"><i class="bx bx-time-five"></i></div>
        </div>

        <div class="stat-card stat-success">
            <div class="stat-info">
                <span class="stat-label">Total Repayments</span>
                <div class="stat-value">$1,894,200</div>
                <span class="stat-subtext">Recovered safely to pool</span>
            </div>
            <div class="stat-icon-wrapper"><i class="bx bx-check-shield"></i></div>
        </div>

        <div class="stat-card stat-danger">
            <div class="stat-info">
                <span class="stat-label">Total Borrowed Vol</span>
                <div class="stat-value">$3,450,000</div>
                <span class="stat-subtext">Outstanding market risk</span>
            </div>
            <div class="stat-icon-wrapper"><i class="bx bx-trending-up"></i></div>
        </div>
    </div>

    <div class="analytics-calculator-grid">
        <div class="panel-card">
            <div class="panel-title"><i class="bx bx-bar-chart-alt-2" style="color:var(--secondary-color)"></i> Loan Portfolio Performance</div>
            <div id="loanAnalyticsChart"></div>
        </div>

        <div class="panel-card">
            <div class="panel-title"><i class="bx bx-calculator" style="color:var(--primary-color)"></i> Core Estimation Engine</div>
            <div class="calc-group">
                <label>Principal Amount ($)</label>
                <div class="input-wrapper">
                    <i class="bx bx-dollar"></i>
                    <input type="number" id="calcAmount" class="calc-input" value="25000" oninput="runLiveCalculator()">
                </div>
            </div>
            <div class="calc-group">
                <label>Duration (Months)</label>
                <div class="input-wrapper">
                    <i class="bx bx-calendar"></i>
                    <input type="number" id="calcDuration" class="calc-input" value="12" oninput="runLiveCalculator()">
                </div>
            </div>
            <div class="calc-group">
                <label>Interest Rate (% Annual)</label>
                <div class="input-wrapper">
                    <i class="bx bx-percentage"></i>
                    <input type="number" id="calcRate" class="calc-input" value="6.5" oninput="runLiveCalculator()">
                </div>
            </div>

            <div class="calc-results">
                <div class="calc-res-item"><span>Monthly Repayment:</span><span id="resMonthly">$2,219.00</span></div>
                <div class="calc-res-item"><span>Total Interest:</span><span id="resInterest">$1,625.00</span></div>
                <div class="calc-res-item"><span>Projected ROI Match:</span><span id="resROI" style="color:var(--secondary-color)">8.4% Net</span></div>
            </div>
        </div>
    </div>

    <div class="filter-action-bar">
        <div class="search-box">
            <i class="bx bx-search"></i>
            <input type="text" placeholder="Search loans by Username, UID, or Loan ID Reference...">
        </div>
        <div class="filter-options">
            <select class="filter-select">
                <option value="">Filter by Status (All)</option>
                <option value="pending">Pending Review</option>
                <option value="active">Active Track</option>
                <option value="paid">Fully Settled</option>
                <option value="overdue">Overdue Alerts</option>
            </select>
            <select class="filter-select">
                <option value="">Sort by Date (Newest)</option>
                <option value="oldest">Oldest Request</option>
                <option value="highest">Highest Allocation</option>
            </select>
        </div>
    </div>

    <div class="table-responsive-wrapper">
        <div class="table-header-area">
            <div style="font-weight: 600; font-size: 1.05rem;">Active Real-time Loan Registries</div>
        </div>
        <div class="nexuist-table-container">
            <table class="nexuist-table">
                <thead>
                    <tr>
                        <th>User Profile</th>
                        <th>Loan Amount</th>
                        <th>Duration / Term</th>
                        <th>Interest Rate</th>
                        <th>Due Repay Date</th>
                        <th>Status</th>
                        <th>Administrative Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="user-meta-cell">
                                <div class="user-avatar-placeholder" style="background:#ef4444">AM</div>
                                <div>
                                    <div style="font-weight:600;">Alexander Mercer</div>
                                    <div class="user-uid-tag">#NEX-10942</div>
                                </div>
                            </div>
                        </td>
                        <td><strong style="color:var(--text-primary);">$45,000.00</strong></td>
                        <td>18 Months</td>
                        <td>7.2%</td>
                        <td>2026-06-15</td>
                        <td><span class="badge badge-overdue"><i class="bx bx-error-circle"></i> Overdue</span></td>
                        <td>
                            <div class="action-btn-row">
                                <button class="table-action-btn" title="View Verification Profile" onclick="loadUserReview('Alexander Mercer')"><i class="bx bx-user-pin"></i></button>
                                <button class="table-action-btn btn-approve" title="Mark Asset as Settled"><i class="bx bx-check-circle"></i></button>
                                <button class="table-action-btn btn-reject" title="Issue Suspension Trigger"><i class="bx bx-block"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-meta-cell">
                                <div class="user-avatar-placeholder" style="background:var(--accent-color)">SK</div>
                                <div>
                                    <div style="font-weight:600;">Sophia Kovac</div>
                                    <div class="user-uid-tag">#NEX-10811</div>
                                </div>
                            </div>
                        </td>
                        <td><strong style="color:var(--text-primary);">$12,500.00</strong></td>
                        <td>6 Months</td>
                        <td>5.0%</td>
                        <td>2026-11-20</td>
                        <td><span class="badge badge-pending"><i class="bx bx-loader-quarter bx-spin"></i> Pending</span></td>
                        <td>
                            <div class="action-btn-row">
                                <button class="table-action-btn" title="View Verification Profile" onclick="loadUserReview('Sophia Kovac')"><i class="bx bx-user-pin"></i></button>
                                <button class="table-action-btn btn-approve" title="Approve Request Asset"><i class="bx bx-check"></i></button>
                                <button class="table-action-btn btn-reject" title="Reject Request"><i class="bx bx-x"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="workflow-split-grid">
        
        <div class="panel-card profile-review-card">
            <div class="panel-title"><i class="bx bx-shield-quarter" style="color:#ef4444"></i> Underwriting Review & Verification Deck</div>
            <p style="font-size:0.85rem; color:var(--text-secondary); margin-top:-1rem;">Currently assessing metrics for: <span id="reviewTargetName" style="color:var(--secondary-color); font-weight:600;">Alexander Mercer</span></p>
            
            <div class="data-segment-row">
                <div>
                    <div class="data-item-label">Credit Score Metric</div>
                    <div class="data-item-val" style="color:#10b981">742 (Low Risk)</div>
                </div>
                <div>
                    <div class="data-item-label">Wallet Balance</div>
                    <div class="data-item-val">$84,250.00</div>
                </div>
                <div>
                    <div class="data-item-label">Platform Investments</div>
                    <div class="data-item-val">$120,400.00</div>
                </div>
            </div>

            <div class="data-segment-row">
                <div>
                    <div class="data-item-label">Verified Income Declared</div>
                    <div class="data-item-val">$14,200 / mo</div>
                </div>
                <div>
                    <div class="data-item-label">KYC Profile File Docs</div>
                    <div class="data-item-val" style="color:var(--primary-color); cursor:pointer;"><i class="bx bx-link-external"></i> Passport_ID.pdf</div>
                </div>
            </div>

            <div style="background:rgba(239, 68, 68, 0.08); border: 1px solid rgba(239, 68, 68, 0.2); border-radius:10px; padding:1rem;">
                <div style="font-size:0.85rem; font-weight:600; color:#f87171; display:flex; align-items:center; gap:0.4rem; margin-bottom:0.25rem;">
                    <i class="bx bx-error"></i> Risk Indicators & Active Triggers
                </div>
                <div style="font-size:0.8rem; color:var(--text-secondary);">
                    User missed their initial repayment grace path cycle on 2026-05-15. External verification records indicate stable liquidity holdings inside platform crypto system pools. Alternate liquidation recovery tools remain fully deployable.
                </div>
            </div>

            <div style="display:flex; gap:0.75rem; flex-wrap:wrap; margin-top:0.5rem;">
                <button class="nexuist-btn" style="background:#10b981;"><i class="bx bx-check"></i> Authorize / Approve</button>
                <button class="nexuist-btn btn-danger-outline"><i class="bx bx-minus-circle"></i> Terminate / Reject</button>
                <button class="nexuist-btn" style="background:var(--bg-hover); color:var(--text-primary); border:1px solid var(--glass-border);"><i class="bx bx-time"></i> Term Ext.</button>
            </div>
        </div>

        <div class="panel-card">
            <div class="panel-title"><i class="bx bx-history" style="color:var(--secondary-color)"></i> Sinking Repayment Log Stream</div>
            <div style="background:var(--bg-main); padding:1rem; border-radius:8px; margin-bottom:1rem; display:flex; justify-content:space-between; font-size:0.85rem;">
                <span>Unrecovered Bal: <strong>$45,000.00</strong></span>
                <span style="color:#ef4444;">Interest Factor: <strong>+ $3,240.00</strong></span>
            </div>

            <div class="timeline-stream">
                <div class="timeline-node node-success">
                    <div class="timeline-meta">2026-04-15 &bull; 14:32 UTC</div>
                    <div class="timeline-txt">Successful Escrow Payment Cycle #2 cleared via System Hot Wallet Allocation.</div>
                </div>
                <div class="timeline-node node-success">
                    <div class="timeline-meta">2026-03-15 &bull; 09:11 UTC</div>
                    <div class="timeline-txt">Successful Escrow Payment Cycle #1 cleared via System Hot Wallet Allocation.</div>
                </div>
                <div class="timeline-node node-warning">
                    <div class="timeline-meta">2026-02-18 &bull; 11:00 UTC</div>
                    <div class="timeline-txt">Initial Loan Disbursal Contract Executed under Key ID Registry #NEX-10942.</div>
                </div>
            </div>
        </div>

    </div>

</div>
    </main>

    <script src="{{ asset('assets/AdminDashboard/js/loans.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</body>

</html>