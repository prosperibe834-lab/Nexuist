<?php
// Simple test script to register and login an admin via the local dev server.
$base = 'http://127.0.0.1:8000';
$cookieFile = __DIR__ . '/cookies.txt';

function get($url, $cookieFile){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

function post($url, $data, $cookieFile){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $res = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    return [$info, $res];
}

// 1. Fetch signup page to get CSRF token
$html = get($base . '/admin-signup', $cookieFile);
if (!preg_match('/name="_token" value="([^"]+)"/', $html, $m)) {
    echo "Unable to find CSRF token\n";
    exit(1);
}
$token = $m[1];
echo "Found token: $token\n";

// 2. Register
$data = [
    '_token' => $token,
    'username' => 'admin_test_' . rand(1000,9999),
    'fullname' => 'Admin Test',
    'email' => 'admintest'.rand(1000,9999).'@example.test',
    'phone' => '+1234567890',
    'country' => 'United States',
    'password' => 'secret123',
    'password_confirmation' => 'secret123',
    'admin_pin' => '921340',
];
list($info, $res) = post($base . '/admin/register', $data, $cookieFile);
echo "Register HTTP status: " . ($info['http_code'] ?? 'n/a') . "\n";
echo substr($res, 0, 800) . "\n";

// Fetch signup page after register to see validation errors
$html_after = get($base . '/admin-signup', $cookieFile);
echo "Signup page after register:\n" . substr($html_after, 0, 800) . "\n";

// 3. Fetch login page to get fresh token
$html = get($base . '/admin-login', $cookieFile);
if (!preg_match('/name="_token" value="([^"]+)"/', $html, $m)) {
    echo "Unable to find CSRF token on login page\n";
    exit(1);
}
$token = $m[1];
echo "Found login token: $token\n";

// 4. Login
$data = [
    '_token' => $token,
    'login_identity' => $data['email'],
    'password' => 'secret123',
    'admin_pin' => '921340',
];
list($info, $res) = post($base . '/admin/login', $data, $cookieFile);
echo "Login HTTP status: " . ($info['http_code'] ?? 'n/a') . "\n";

// Print a snippet of response to see redirection
echo substr($res, 0, 400) . "\n";

echo "Test complete\n";
