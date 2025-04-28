<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Maa kali Stores</title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="<?=base_url()?>assets/favicon.png" type="image/png">

  <style>
    .navbar{
      position: sticky;
    top: 0;
    z-index: 4;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Grocery App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?=  site_url('backup/export_database')?>">Backup</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($this->uri->segment(1) == 'customer') ? 'active' : '' ?>" href="<?= site_url('customer') ?>">Customer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($this->uri->segment(1) == 'product') ? 'active' : '' ?>" href="<?= site_url('product') ?>">Item</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($this->uri->segment(1) == 'invoice') ? 'active' : '' ?>" href="<?= site_url('invoice') ?>">Bill</a>
        </li>
       
      </ul>
    </div>
  </div>
</nav>

<!-- Optionally include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
