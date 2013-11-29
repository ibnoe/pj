<!DOCTYPE html>
<html>
<head>
	<title><?php echo $judul;?></title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/todc-bootstrap.css" />
   	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css" />
</head>
<body>
	<div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Access Denied</h1>
        <p>Anda Tidak Memiliki Hak Akses untuk Mengakses Halaman Ini</p>
        <p><?php echo anchor('', 'Go to home', array('class' => 'button')); ?></p>
      </div>

      <hr>

      <footer>
        <p>&copy; Pelita Jaya 2013</p>
      </footer>

    </div>
</body>
</html>