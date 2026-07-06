<?php

use App\Http\Controllers\AdminKycController;
use App\Http\Controllers\Admin\AdminDemoController;
use App\Http\Controllers\Admin\AiBotController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\DemoTradeController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\KycController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PremiumSignalsController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\RealEstateInvestmentController;
use App\Http\Controllers\RealEstatePropertyController;
use App\Http\Controllers\StockInvestmentController;
use App\Http\Controllers\BotInvestmentController;
use App\Http\Controllers\CryptoInvestmentController;
use App\Http\Controllers\StockMarketController;
use App\Http\Controllers\Admin\RealEstatePropertyController as AdminRealEstatePropertyController;
use App\Http\Controllers\Admin\StockMarketController as AdminStockMarketController;
use App\Http\Controllers\AccountStatementController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


/*
|--------------------------------------------------------------------------
| Utility Routes
|--------------------------------------------------------------------------
*/
Route::get('/clear-all', function () {
    Auth::logout();
    Session::flush();
    return redirect('/');
});
// Route for the list of all users
Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);

// Route for the dashboard
Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'dashboard']);

// Route for depositing funds
Route::post('/admin/deposits/update-status', [DepositController::class, 'updateStatus'])->name('deposits.update-status');
Route::get('/deposits', [DepositController::class, 'index'])->name('deposits.index');

Route::middleware(['auth'])->group(function () {
    Route::post('/deposit/store', [DepositController::class, 'store'])->name('deposit.store');
    Route::get('/deposit/history', [DepositController::class, 'index']);
});

Route::post('/kyc/store', [KycController::class, 'store'])
    ->middleware('auth')
    ->name('kyc.store');

Route::get('/kyc', [AdminKycController::class, 'index']);
Route::post('/kyc/{id}/approve',
    [AdminKycController::class, 'approve']);
Route::post('/kyc/{id}/reject',
    [AdminKycController::class, 'reject']);

/*
|--------------------------------------------------------------------------
| 1. Public Pages
|--------------------------------------------------------------------------
*/
Route::view('/explore', 'explore')->name('explore');
Route::view('/support', 'support');
Route::view('/livemarkets', 'livemarkets');
Route::get('/stockMarket', [StockMarketController::class, 'index'])->name('stockMarket.index');
Route::get('/stock-market', [StockMarketController::class, 'index']);

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'submit'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 2. Guest Pages
|--------------------------------------------------------------------------
*/
Route::get('/ref/{code}', function ($code) {
    session(['referral_code' => $code]);
    return redirect('/signup?ref=' . urlencode($code));
});

Route::middleware('guest')->group(function () {
    Route::view('/signup', 'signup');
    Route::view('/forgot-password', 'forgot-password');
    Route::view('/reset-password', 'reset-password');
    Route::post('/register/submit', [RegisterController::class, 'submit'])->name('register.submit');
    

    // Admin auth handlers (backend) - keep these public so POSTs work even if a session exists
});

// Admin auth handlers (backend) available outside of the 'guest' middleware
Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register.submit');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/otp', [AdminAuthController::class, 'sendOtp'])->name('admin-otp');
Route::post('/admin/reset', [AdminAuthController::class, 'resetWithOtp'])->name('admin-reset');
// Public GET routes for admin OTP and reset pages (always accessible)
Route::get('/admin-otp', function () {
    return view('AdminDashboard.admin-otp');
});

Route::get('/admin-reset', function () {
    return view('AdminDashboard.admin-reset');
});

// Also accept the slash-style paths so either URL works
Route::get('/admin/otp', function () {
    return view('AdminDashboard.admin-otp');
});

Route::get('/admin/reset', function () {
    return view('AdminDashboard.admin-reset');
});

// Public route for admin signup (bypass guest middleware so URL always loads)
Route::get('/admin-signup', function () {
    return view('AdminDashboard.admin-signup');
});

// Public route for admin login (show login view even if a user session exists)
Route::get('/admin-login', function () {
    return view('AdminDashboard.admin-login');
});

/*
|--------------------------------------------------------------------------
| 3. Protected Dashboard Pages
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Route::view('/', 'index')->name('dashboard');
    Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');
    Route::view('/portfolio', 'portfolio')->name('portfolio');
    Route::view('/performance', 'performance');
    Route::view('/demo', 'demo');
    
    // Demo Trading Routes
    Route::view('/demoTrade', 'demoTrade')->name('demo.trade');
    Route::view('/demoLive', 'demoLive')->name('demo.live');
    Route::view('/demoHistory', 'demoHistory')->name('demo.history');
    Route::post('/api/demo/trade', [DemoTradeController::class, 'store'])->name('demo.trade.store');
    Route::get('/api/demo/history', [DemoTradeController::class, 'history'])->name('demo.trade.history');
    Route::post('/api/demo/trade/{id}/close', [DemoTradeController::class, 'close'])->name('demo.trade.close');
    Route::get('/api/demo/dashboard', [DemoTradeController::class, 'dashboard'])->name('demo.dashboard');
    Route::post('/api/demo/reset', [DemoTradeController::class, 'reset'])->name('demo.reset');
    Route::post('/api/trades', [TradeController::class, 'store'])->name('trades.store');
    Route::get('/api/portfolio', [PortfolioController::class, 'index'])->name('portfolio.data');
    Route::get('/api/admin/portfolio', [PortfolioController::class, 'adminIndex'])->name('admin.portfolio.data');
    Route::get('/api/account/statement', [AccountStatementController::class, 'data'])->name('account.statement.data');
    
    // AdminDemo Route
    Route::get('/AdminDemo', [AdminDemoController::class, 'index'])->name('admin.demo');
    
    Route::view('/invest', 'invest');
    Route::view('/plans', 'plans');
    Route::view('/investment-plans', 'investment-plans');
    Route::view('/cryptoInvest', 'cryptoInvest');
    Route::view('/cryptocurrencies', 'cryptocurrencies');
    Route::view('/realestate', 'realestate');
    Route::view('/myRealEstateinvestment', 'myRealEstateinvestment');

    // Route::view('/botTrading', 'botTrading');
    Route::get('/botTrading', [AiBotController::class, 'botTrading']);
    Route::post('/bot/invest/{id}', [BotInvestmentController::class, 'invest'])->name('bot.invest');
    Route::post('/stock-market/invest', [StockInvestmentController::class, 'invest'])->name('stockmarket.invest');
    Route::post('/crypto/invest', [CryptoInvestmentController::class, 'invest'])->name('crypto.invest');

    Route::get('/copytrading', [AiBotController::class, 'copyTrading'])->name('copytrading');
    Route::get('/experts', [AiBotController::class, 'experts'])->name('experts');
    Route::get('/copy-trading', [AiBotController::class, 'copyTradingAdmin'])->name('admin.copy-trading');
    Route::view('/wallet', 'wallet');
    Route::view('/deposit', 'depositfunds');
    Route::view('/depositfunds', 'depositfunds');
    Route::view('/withdraw', 'withdraw');
    Route::view('/transactions', 'transactions');
    Route::get('/accountstatement', [AccountStatementController::class, 'index'])->name('account.statement');
    Route::view('/signals', 'signals');
    Route::view('/premiumPayment', 'premiumPayment');
    Route::get('/premiumSignals', [PremiumSignalsController::class, 'index'])->name('premium.signals');
    Route::view('/loan', 'loan');
    Route::view('/loanHistory', 'loanHistory');
    Route::get('/profilesetting', [UserController::class, 'profileSetting']);
    Route::post('/profilesetting', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::view('/security', 'security');
    Route::view('/verify-account', 'verify-account');
    Route::get('/referUser', [ReferralController::class, 'userDashboard']);
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
    Route::post('/notifications/{id}/toggle-read', [NotificationController::class, 'toggleRead'])->name('notifications.toggleRead');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::view('/kyc-form', 'kyc-form');
    Route::view('/settlement', 'settlement');

    // Route::view('/deploybot', 'deploybot');
    Route::get('/deploybot', [BotInvestmentController::class, 'dashboard'])
    ->middleware('auth')
    ->name('deploybot');

    Route::get('/notification', [NotificationController::class, 'index'])->name('notification.index');

    // Admin
    Route::view('/admin-dashboard', 'AdminDashboard.index')->name('admin.dashboard');
    Route::view('/admin-settings', 'AdminDashboard.admin-settings');
    Route::view('/website-settings', 'AdminDashboard.website-settings');
    Route::get('/admin-users', [UserController::class, 'adminUsersPage'])->name('admin.users');
    Route::get('/api/admin-users', [UserController::class, 'adminUsersData'])->name('admin.users.data');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{id}/balance', [UserController::class, 'updateBalance'])->name('users.updateBalance');
    Route::view('/withdrawals', 'AdminDashboard.withdrawals');
    Route::view('/AdminRealEstate', 'AdminDashboard.AdminRealEstate');
    Route::get('/PremiumInvestment', [AiBotController::class, 'premiumInvestmentDashboard'])->name('admin.premium.dashboard');

    Route::get('/api/real-estate/properties', [RealEstatePropertyController::class, 'index']);
    Route::get('/api/real-estate/properties/{slug}', [RealEstatePropertyController::class, 'show']);
    Route::post('/api/real-estate/invest', [RealEstateInvestmentController::class, 'invest'])->name('realestate.invest');
    Route::get('/api/real-estate/portfolio', [RealEstateInvestmentController::class, 'portfolio'])->name('realestate.portfolio');
    Route::get('/api/real-estate/investments', [RealEstateInvestmentController::class, 'index'])->name('realestate.investments.index');
    Route::get('/api/real-estate/investments/{id}', [RealEstateInvestmentController::class, 'show'])->name('realestate.investments.show');

    // Route::view('/ai-bot', 'AdminDashboard.ai-bot');
    Route::get('/ai-bot', [AiBotController::class, 'index'])
    ->name('admin.ai-bot');

    Route::view('/internal-transfers', 'AdminDashboard.internal-transfers');
    Route::view('/statements', 'AdminDashboard.statements');
    // Route::view('/kyc', 'AdminDashboard.kyc');
    Route::view('/loans', 'AdminDashboard.loans');

    // Route::view('/deposits', 'AdminDashboard.deposits');

    Route::view('/investment-plans', 'AdminDashboard.investment-plans');
    Route::view('/Adminperformance', 'AdminDashboard.Adminperformance');
    Route::view('/AdminPortfolio', 'AdminDashboard.AdminPortfolio');
    Route::view('/admin-notifications', 'AdminDashboard.notifications')->name('admin.notifications');
    Route::view('/AdminSupport', 'AdminDashboard.AdminSupport');
    Route::view('/transactions', 'AdminDashboard.transactions');
    Route::view('/security', 'AdminDashboard.security');
    Route::get('/AdminReferUSer', [ReferralController::class, 'adminDashboard']);
    Route::get('/StockMarket', [AdminStockMarketController::class, 'index'])->name('admin.stockmarket');
    Route::post('/admin/stock-market/plans', [AdminStockMarketController::class, 'storePlan'])->name('admin.stockmarket.plan.store');
    Route::post('/admin/stock-market/plans/{id}/toggle', [AdminStockMarketController::class, 'toggleStatus'])->name('admin.stockmarket.plan.toggle');
    Route::post('/admin/crypto/plans', [App\Http\Controllers\Admin\CryptoController::class, 'storePlan'])->name('admin.crypto.plan.store');
    Route::post('/admin/crypto/plans/{id}/toggle', [App\Http\Controllers\Admin\CryptoController::class, 'toggleStatus'])->name('admin.crypto.plan.toggle');
    Route::delete('/admin/crypto/plans/{id}', [App\Http\Controllers\Admin\CryptoController::class, 'destroy'])->name('admin.crypto.plan.destroy');
    Route::view('/Crypto', 'AdminDashboard.Crypto');
});

Route::get('/kyc', [AdminKycController::class, 'index'])->name('kyc.index');

Route::post('/kyc/{id}/approve', [AdminKycController::class, 'approve']);

Route::post('/kyc/{id}/reject', [AdminKycController::class, 'reject']);

Route::get('/admin/kyc/data', [AdminKycController::class, 'getKycData']);

Route::get('/admin/kyc/data', [AdminKycController::class, 'getKycData'])
    ->name('admin.kyc.data');

Route::post('/admin/kyc/{id}/status', [AdminKycController::class, 'updateStatus']);

// Investment Routes
Route::prefix('admin')->group(function () {

    Route::get('/bots', [AiBotController::class, 'index'])
        ->name('admin.bots.index');

    Route::post('/bots/store', [AiBotController::class, 'store'])
        ->name('admin.bots.store');

    Route::post('/premium/package', [AiBotController::class, 'store'])
        ->name('admin.premium.package.store');

    Route::post('/premium/live-signal', [AiBotController::class, 'broadcastLiveSignal'])
        ->name('admin.premium.live-signal');

    Route::post('/premium/subscriber/{investment}/toggle', [AiBotController::class, 'togglePremiumSubscriberStatus'])
        ->name('admin.premium.subscriber.toggle');

    Route::delete('/premium/subscriber/{investment}', [AiBotController::class, 'deletePremiumSubscriber'])
        ->name('admin.premium.subscriber.delete');

    Route::get('/bots/edit/{id}', [AiBotController::class, 'edit'])
        ->name('admin.bots.edit');

    Route::post('/bots/update/{id}', [AiBotController::class, 'update'])
        ->name('admin.bots.update');

    Route::delete('/bots/delete/{id}', [AiBotController::class, 'destroy'])
        ->name('admin.bots.delete');

    Route::get('/real-estate/properties', [AdminRealEstatePropertyController::class, 'index'])
        ->name('admin.realestate.properties.index');
    Route::get('/real-estate/properties/stats', [AdminRealEstatePropertyController::class, 'stats'])
        ->name('admin.realestate.properties.stats');
    Route::get('/real-estate/investments', [AdminRealEstatePropertyController::class, 'investments'])
        ->name('admin.realestate.investments.index');
    Route::post('/real-estate/properties', [AdminRealEstatePropertyController::class, 'store'])
        ->name('admin.realestate.properties.store');
    Route::post('/real-estate/properties/{id}', [AdminRealEstatePropertyController::class, 'update'])
        ->name('admin.realestate.properties.update');
    Route::delete('/real-estate/properties/{id}', [AdminRealEstatePropertyController::class, 'destroy'])
        ->name('admin.realestate.properties.destroy');
    Route::post('/real-estate/properties/{id}/toggle-status', [AdminRealEstatePropertyController::class, 'toggleStatus'])
        ->name('admin.realestate.properties.toggle-status');
    Route::get('/real-estate/properties/{id}', [AdminRealEstatePropertyController::class, 'show'])
        ->name('admin.realestate.properties.show');

    Route::post('/copy-trading/traders', [AiBotController::class, 'storeAdminTrader'])
        ->name('admin.copy-trading.traders.store');

    Route::post('/copy-trading/calibrate', [AiBotController::class, 'calibrateTrader'])
        ->name('admin.copy-trading.calibrate');

    Route::post('/copy-trading/profit-adjust', [AiBotController::class, 'manualProfitAdjustment'])
        ->name('admin.copy-trading.profit-adjust');

    Route::post('/copy-trading/notify', [AiBotController::class, 'broadcastNotification'])
        ->name('admin.copy-trading.notify');

    Route::get('/copy-trading/data', [AiBotController::class, 'copyTradingAdminData'])
        ->name('admin.copy-trading.data');
});

// Investment Search and Filter Routes
Route::get(
    '/admin/bots/search',
    [AiBotController::class, 'search']
);

Route::get(
    '/admin/bots/filter',
    [AiBotController::class, 'filter']
);

// Remove duplicate invest route - it's now in auth middleware above

Route::get(
    '/admin/bots/sort/{type}',
    [AiBotController::class, 'sort']
);

// Public feed for recent bot deployments (deploy2)
Route::get('/deploy2', function () {
    $deploys = \App\Models\BotInvestment::with('bot', 'user')
        ->latest()
        ->take(50)
        ->get();

    return view('deploy2', compact('deploys'));
});

