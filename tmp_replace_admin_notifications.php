<?php
$base = __DIR__ . '/resources/views/AdminDashboard';
$patterns = [
    "url('/notifications')" => "url('/admin-notifications')",
    "href=\"/notifications\"" => "href=\"/admin-notifications\"",
    "href='/notifications'" => "href='/admin-notifications'",
    "href=\"notifications\"" => "href=\"admin-notifications\"",
    "href='notifications'" => "href='admin-notifications'",
];
$changed = [];
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($base));
foreach ($iterator as $file) {
    if (! $file->isFile() || $file->getExtension() !== 'php') {
        continue;
    }
    $path = $file->getPathname();
    $content = file_get_contents($path);
    $updated = $content;
    foreach ($patterns as $search => $replace) {
        $updated = str_replace($search, $replace, $updated);
    }
    if ($updated !== $content) {
        file_put_contents($path, $updated);
        $changed[] = $path;
    }
}
echo "Updated files:\n" . implode("\n", $changed) . "\n";
