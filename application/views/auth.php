<?php
if ($this->session->userdata('id_user')) {
   redirect('klinik/dashboard');
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

   <!-- Custom Css-->
   <link href="<?= base_url(); ?>assets/scss/style.css" rel="stylesheet">
   <style type="text/css">
      html,
      body {
         height: 100%;
      }
   </style>
</head>

<body class="bg-image">

   <div class="misc-wrapper">
      <div class="misc-content">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-sm-6 col-xl-4 ">
                  <div class="misc-box">
                     <div class="misc-header text-center">
                        <img alt="" src="<?= base_url(); ?>assets/upload/<?= $klinik['logo_web']; ?>" class="logo-icon margin-r-10" width="35" height="30">
                     </div>
                     <form role="form" method="post" action="<?= base_url('klinik'); ?>">
                        <div class="form-group">
                           <label for="exampleuser1">Username</label>
                           <div class="group-icon">
                              <input id="exampleuser1" name="username" type="text" placeholder="Username" class="form-control" value="<?= set_value('username'); ?>" autocomplete="off" autofocus>
                              <span class="icon-user text-muted icon-input"></span>
                              <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                              <?= $this->session->flashdata('msg_user'); ?>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="thresholdconfig">Password</label>
                           <div class="group-icon">
                              <input id="thresholdconfig" name="password" type="password" placeholder="Password" class="form-control">
                              <span class="icon-lock text-muted icon-input"></span>
                           </div>
                           <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                           <?= $this->session->flashdata('msg_pass'); ?>
                           <div class="checkbox checkbox-primary" style="margin-top: -1rem;">
                              <input type="checkbox" onclick="Toggle()" id="show-hide" name="show-hide">
                              <label for="show-hide"> Show Password </label>
                           </div>
                        </div>
                        <button class="btn btn-block btn-primary btn-rounded box-shadow">Login</button>
                     </form>
                     <div class="text-center mt-3">
                        <p>Copyright &copy; 2018 Medical</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Common Plugins -->
   <script src="<?= base_url(); ?>assets/lib/jquery/dist/jquery.min.js"></script>
   <script src="<?= base_url(); ?>assets/lib/bootstrap/js/bootstrap.min.js"></script>
   <script src="<?= base_url(); ?>assets/lib/pace/pace.min.js"></script>
   <script src="<?= base_url(); ?>assets/lib/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
   <script src="<?= base_url(); ?>assets/lib/slimscroll/jquery.slimscroll.min.js"></script>
   <script src="<?= base_url(); ?>assets/lib/nano-scroll/jquery.nanoscroller.min.js"></script>
   <script src="<?= base_url(); ?>assets/lib/metisMenu/metisMenu.min.js"></script>
   <script src="<?= base_url(); ?>assets/js/custom.js"></script>

   <script>
      function Toggle() {
         var temp = document.getElementById("thresholdconfig");
         if (temp.type === "password") {
            temp.type = "text";
         } else {
            temp.type = "password";
         }
      }
   </script>

</body>

</html>