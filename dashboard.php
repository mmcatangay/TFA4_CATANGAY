<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
</head>
<body>
    <h1>POS Dashboard</h1>
    <p>Welcome, <?= esc($username) ?>.</p>
    <p><a href="<?= site_url('customers') ?>">Customer Accounts</a></p>
    <p><a href="<?= site_url('users') ?>">User Accounts</a></p>
    <p><a href="<?= site_url('logout') ?>">Logout</a></p>
</body>
</html>
