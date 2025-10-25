<?php
/**
 * Error Layout
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Error</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <?= $this->Html->css('error-pages') ?>
    <?= $this->fetch('css') ?>
</head>
<body class="hold-transition login-page">
<div class="login-box" style="width: 100%; margin-top: 50px;">
    <div class="card card-outline card-danger">
        <div class="card-header text-center">
            <a href="/" class="h1"><b>CakePHP</b></a>
        </div>
        <div class="card-body">
            <?= $this->fetch('content') ?>
        </div>
    </div>
</div>
</body>
</html>
