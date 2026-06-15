<?php

use App\Http\Controllers\AdminKycController;
use App\Http\Controllers\Admin\AiBotController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BotInvestmentController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\KycController;
use App\Http\Controllers\RealEstateInvestmentController;
use App\Http\Controllers\RealEstatePropertyController;
use App\Http\Controllers\Admin\RealEstatePropertyController as AdminRealEstatePropertyController;
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
Route::view('/stockMarket', 'stockMarket');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'submit'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 2. Guest Pages
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::view('/signup', 'signup');
    Route::view('/forgot-password', 'forgot-password');
    Route::view('/reset-password', 'reset-password');
    Route::post('/register/submit', [RegisterController::class, 'submit'])->name('register.submit');

    Route::view('/admin-login', 'admin-login');
    Route::view('/admin-signup', 'admin-signup');
    Route::view('/admin-forgot', 'admin-forgot');
    Route::view('/admin-reset', 'admin-reset');
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

    Route::get('/copytrading', [AiBotController::class, 'copyTrading'])->name('copytrading');
    Route::get('/experts', [AiBotController::class, 'experts'])->name('experts');
    Route::get('/copy-trading', [AiBotController::class, 'copyTradingAdmin'])->name('admin.copy-trading');
    Route::view('/wallet', 'wallet');
    Route::view('/deposit', 'depositfunds');
    Route::view('/depositfunds', 'depositfunds');
    Route::view('/withdraw', 'withdraw');
    Route::view('/transactions', 'transactions');
    Route::view('/accountstatement', 'accountstatement');
    Route::view('/signals', 'signals');
    Route::view('/premiumPayment', 'premiumPayment');
    Route::view('/premiumSignals', 'premiumSignals');
    Route::view('/loan', 'loan');
    Route::view('/loanHistory', 'loanHistory');
    Route::view('/profilesetting', 'profilesetting');
    Route::view('/security', 'security');
    Route::view('/verify-account', 'verify-account');
    Route::view('/referUser', 'referUser');
    Route::view('/notifications', 'notifications');
    Route::view('/kyc-form', 'kyc-form');

    // Route::view('/deploybot', 'deploybot');
    Route::get('/deploybot', [BotInvestmentController::class, 'dashboard'])
    ->middleware('auth')
    ->name('deploybot');

    Route::view('/notification', 'notification');

    // Admin
    Route::view('/admin-dashboard', 'AdminDashboard.index')->name('admin.dashboard');
    Route::view('/admin-settings', 'AdminDashboard.admin-settings');
    Route::view('/website-settings', 'AdminDashboard.website-settings');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{id}/balance', [UserController::class, 'updateBalance'])->name('users.updateBalance');
    Route::view('/withdrawals', 'AdminDashboard.withdrawals');
    Route::view('/AdminRealEstate', 'AdminDashboard.AdminRealEstate');

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
    Route::view('/notifications', 'AdminDashboard.notifications');
    Route::view('/AdminSupport', 'AdminDashboard.AdminSupport');
    Route::view('/transactions', 'AdminDashboard.transactions');
    Route::view('/security', 'AdminDashboard.security');
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



