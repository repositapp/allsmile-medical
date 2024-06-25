<?php
if (!$this->session->userdata('id_user')) {
   redirect('klinik/logout');
}
$klinik = $this->db->get('set_web')->row_array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title><?= $klinik['title_web']; ?> | <?= $title; ?></title>
   <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/upload/<?= $klinik['logo_web']; ?>">

   <!-- Common Plugins -->
   <link href="<?= base_url(); ?>assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

   <!-- Vector Map Css-->
   <link href="<?= base_url(); ?>assets/lib/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />

   <!-- Chart C3 -->
   <link href="<?= base_url(); ?>assets/lib/chart-c3/c3.min.css" rel="stylesheet">
   <link href="<?= base_url(); ?>assets/lib/chartjs/chartjs-sass-default.css" rel="stylesheet">

   <!-- DataTables -->
   <link href="<?= base_url(); ?>assets/lib/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
   <link href="<?= base_url(); ?>assets/lib/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css">
   <link href="<?= base_url(); ?>assets/lib/toast/jquery.toast.min.css" rel="stylesheet">

   <!-- Bootstrap Datepicker -->
   <link href="<?= base_url(); ?>assets/lib/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

   <!-- Sweet Alerts -->
   <link href="<?= base_url(); ?>assets/lib/sweet-alerts2/sweetalert2.min.css" rel="stylesheet">
   <script src="<?= base_url(); ?>assets/lib/sweet-alerts2/sweetalert2.min.js"></script>

   <!-- Custom Css-->
   <link href="<?= base_url(); ?>assets/scss/style.css" rel="stylesheet">
   <link href="<?= base_url(); ?>assets/scss/select_style.css" rel="stylesheet">
   <link href="<?= base_url(); ?>assets/scss/print.css" rel="stylesheet">

   <!-- ckEditor -->
   <script type="text/javascript" src="<?php echo base_url() ?>assets/lib/ckeditor/ckeditor.js"></script>

   <!-- Chart JS -->
   <script type="text/javascript" src="<?php echo base_url() ?>assets/lib/chartjs/Chart.js"></script>

   <!-- Select -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">

</head>

<body id="reloadTindakan">

   <div class="top-bar primary-top-bar">
      <div class="container-fluid">
         <div class="row">
            <div class="col">
               <a class="admin-logo" href="<?= base_url(); ?>">
                  <h1 style="color:#8353fa;">
                     <img alt="" src="<?= base_url(); ?>assets/upload/<?= $klinik['logo_web']; ?>" class="logo-icon margin-r-10" width="35" height="30">
                     <?= $klinik['sidebar_title']; ?>
                  </h1>
               </a>
               <div class="left-nav-toggle">
                  <a href="#" class="nav-collapse"><i class="fa fa-bars"></i></a>
               </div>
               <div class="left-nav-collapsed">
                  <a href="#" class="nav-collapsed"><i class="fa fa-bars"></i></a>
               </div>
               <ul class="list-inline top-right-nav">
                  <li class="dropdown avtar-dropdown">
                     <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <img alt="" class="rounded-circle" src="<?= base_url(); ?>assets/upload/<?= $user['foto_user']; ?>" width="40" height="37">
                        <?= $user['nm_depan']; ?>
                     </a>
                     <ul class="dropdown-menu top-dropdown">
                        <li>
                           <a class="dropdown-item" href="<?= base_url(); ?>klinik/profil"><i class="icon-user"></i> Profile</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                           <a class="dropdown-item" href="<?= base_url(); ?>klinik/logout"><i class="icon-logout"></i> Logout</a>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>