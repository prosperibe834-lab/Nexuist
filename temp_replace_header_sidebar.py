from pathlib import Path

files = [
    'resources/views/accountstatement.blade.php',
    'resources/views/botTrading.blade.php',
    'resources/views/copytrading.blade.php',
    'resources/views/cryptoInvest.blade.php',
    'resources/views/demo.blade.php',
    'resources/views/demoHistory.blade.php',
    'resources/views/demoLive.blade.php',
    'resources/views/demoTrade.blade.php',
    'resources/views/deploybot.blade.php',
    'resources/views/depositfunds.blade.php',
    'resources/views/experts.blade.php',
    'resources/views/index.blade.php',
    'resources/views/internal-transfer.blade.php',
    'resources/views/kyc-form.blade.php',
    'resources/views/livemarkets.blade.php',
    'resources/views/loan.blade.php',
    'resources/views/loanHistory.blade.php',
    'resources/views/myRealEstateInvestment.blade.php',
    'resources/views/notification.blade.php',
    'resources/views/portfolio.blade.php',
    'resources/views/premiumPayment.blade.php',
    'resources/views/premiumSignals.blade.php',
    'resources/views/profilesetting.blade.php',
    'resources/views/realestate.blade.php',
    'resources/views/referUser.blade.php',
    'resources/views/settlement.blade.php',
    'resources/views/stockMarket.blade.php',
    'resources/views/support.blade.php',
    'resources/views/verify-account.blade.php',
    'resources/views/withdraw.blade.php',
]

start = '<header class="top-header">'
end = '</aside>'

for rel in files:
    path = Path(rel)
    if not path.exists():
        print(f'MISSING {rel}')
        continue
    text = path.read_text(encoding='utf-8')
    if start not in text or end not in text:
        print(f'FAIL {rel} missing start/end markers')
        continue
    si = text.index(start)
    ei = text.index(end, si) + len(end)
    block = text[si:ei]
    if "@include('layouts.frontend-header-sidebar')" in block:
        print(f'SKIP {rel} already included')
        continue
    new_text = text[:si] + "@include('layouts.frontend-header-sidebar')\n\n" + text[ei:]
    path.write_text(new_text, encoding='utf-8')
    print(f'UPDATED {rel}')
