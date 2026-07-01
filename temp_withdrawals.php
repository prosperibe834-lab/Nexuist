<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$rows = Illuminate\Support\Facades\DB::table('withdrawals')->orderByDesc('id')->take(20)->get();
echo count($rows) . "\n";
foreach ($rows as $row) {
    echo $row->id . "\t" . $row->transaction_id . "\t" . $row->user_id . "\t" . $row->status . "\t" . $row->amount . "\t" . (isset($row->wallet_address) ? $row->wallet_address : '') . "\t" . $row->created_at . "\t" . $row->updated_at . "\n";
}
