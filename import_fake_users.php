<?php

require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$users = json_decode(file_get_contents('fake_users.json'), true);

foreach ($users as $data) {
    unset($data['id']);

    App\Models\User::firstOrCreate(
        ['email' => $data['email']],
        $data
    );
}

echo "done\n";
