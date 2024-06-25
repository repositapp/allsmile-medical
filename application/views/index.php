<?php
$pasien = $this->db->get('pasien');
$dokter = $this->db->get('dokter');
$petugas = $this->db->get_where('user', ['akses' => '3']);
$rm = $this->db->get_where('antrian_pasien', ['sts_antrian' => '4']);
?>
<section class="main-content">
   <div class="row w-no-padding margin-b-30">

      <div class="col-md-3">
         <div class="widget  bg-light">
            <div class="row row-table ">
               <div class="margin-b-10">
                  <h2 class="margin-b-5">Pasien</h2>
                  <p class="text-muted">Total</p>
                  <span class="float-right text-primary widget-r-m"><?= $pasien->num_rows(); ?></span>
               </div>
            </div>
         </div>
      </div>

      <div class="col-md-3">
         <div class="widget  bg-light">
            <div class="row row-table ">
               <div class="margin-b-10">
                  <h2 class="margin-b-5">Dokter</h2>
                  <p class="text-muted">Total</p>
                  <span class="float-right text-indigo widget-r-m"><?= $dokter->num_rows(); ?></span>
               </div>
            </div>
         </div>
      </div>

      <div class="col-md-3">
         <div class="widget  bg-light">
            <div class="row row-table ">
               <div class="margin-b-10">
                  <h2 class="margin-b-5">Petugas</h2>
                  <p class="text-muted">Total</p>
                  <span class="float-right text-success widget-r-m"><?= $petugas->num_rows(); ?></span>
               </div>
            </div>
         </div>
      </div>

      <div class="col-md-3">
         <div class="widget  bg-light">
            <div class="row row-table ">
               <div class="margin-b-10">
                  <h2 class="margin-b-5">Rekam Medis</h2>
                  <p class="text-muted">Total</p>
                  <span class="float-right text-warning widget-r-m"><?= $rm->num_rows(); ?></span>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-md-6">
         <div class="card">
            <div class="card-header card-info">
               PASIEN BERDASARKAN USIA
            </div>
            <div class="card-body">
               <canvas id="myChart"></canvas>
               <?php
               //Inisialisasi nilai variabel awal
               $umur_pasien = "";
               $jumlah = null;
               foreach ($umur as $item) :
                  $umr_pasien = $item['umur_pasien'];
                  $umur_pasien .= "'$umr_pasien'" . ", ";
                  $jum = $item['total'];
                  $jumlah .= "$jum" . ", ";
               endforeach;
               ?>
               <script>
                  var ctx = document.getElementById('myChart').getContext('2d');
                  var chart = new Chart(ctx, {
                     // The type of chart we want to create
                     type: 'bar',
                     // The data for our dataset
                     data: {
                        labels: [<?php echo $umur_pasien; ?>],
                        datasets: [{
                           label: 'PASIEN BERDASARKAN USIA ',
                           backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(175, 238, 239)', 'rgb(240, 248, 254)', 'rgb(251, 235, 217)', 'rgb(0, 255, 254)', 'rgb(115, 255, 216)', 'rgb(0, 0, 255)', 'rgb(138, 43, 226)', 'rgb(165, 42, 42)', 'rgb(95, 158, 160)', 'rgb(127, 255, 1)', 'rgb(210, 105, 30)', 'rgb(251, 127, 80)', 'rgb(100, 149, 237)', 'rgb(225, 248, 220)', 'rgb(220, 20, 60)', 'rgb(62, 254, 255)', 'rgb(29, 139, 139)', 'rgb(184, 134, 11)', 'rgb(19, 100, 0)', 'rgb(189, 183, 107)', 'rgb(85, 107, 47)', 'rgb(251, 140, 1)', 'rgb(139, 5, 0)', 'rgb(233, 150, 122)', 'rgb(143, 188, 144)', 'rgb(72, 61, 139)', 'rgb(47, 79, 79)', 'rgb(48, 206, 209)', 'rgb(249, 19, 147)', 'rgb(34, 139, 35)', 'rgb(249, 0, 255)', 'rgb(218, 165, 32)', 'rgb(173, 255, 48)', 'rgb(240, 255, 240)', 'rgb(205, 92, 92)', 'rgb(240, 230, 140)', 'rgb(230, 230, 250)', 'rgb(254, 240, 245)', 'rgb(173, 216, 230)', 'rgb(240, 128, 128)', 'rgb(224, 255, 255)', 'rgb(144, 238, 144)', 'rgb(119, 136, 153)', 'rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(175, 238, 239)', 'rgb(240, 248, 254)', 'rgb(251, 235, 217)', 'rgb(0, 255, 254)', 'rgb(115, 255, 216)', 'rgb(0, 0, 255)', 'rgb(138, 43, 226)', 'rgb(165, 42, 42)', 'rgb(95, 158, 160)', 'rgb(127, 255, 1)', 'rgb(210, 105, 30)', 'rgb(251, 127, 80)', 'rgb(100, 149, 237)', 'rgb(225, 248, 220)', 'rgb(220, 20, 60)', 'rgb(62, 254, 255)', 'rgb(29, 139, 139)', 'rgb(184, 134, 11)', 'rgb(19, 100, 0)', 'rgb(189, 183, 107)', 'rgb(85, 107, 47)', 'rgb(251, 140, 1)', 'rgb(139, 5, 0)', 'rgb(233, 150, 122)', 'rgb(143, 188, 144)', 'rgb(72, 61, 139)', 'rgb(47, 79, 79)', 'rgb(48, 206, 209)', 'rgb(249, 19, 147)', 'rgb(34, 139, 35)', 'rgb(249, 0, 255)', 'rgb(218, 165, 32)', 'rgb(173, 255, 48)', 'rgb(240, 255, 240)', 'rgb(205, 92, 92)', 'rgb(240, 230, 140)', 'rgb(230, 230, 250)', 'rgb(254, 240, 245)', 'rgb(173, 216, 230)', 'rgb(240, 128, 128)', 'rgb(224, 255, 255)', 'rgb(144, 238, 144)', 'rgb(119, 136, 153)'],
                           borderColor: ['rgb(255, 99, 132)'],
                           data: [<?php echo $jumlah; ?>]
                        }]
                     },
                     // Configuration options go here
                     options: {
                        scales: {
                           yAxes: [{
                              ticks: {
                                 beginAtZero: true
                              }
                           }]
                        }
                     }
                  });
               </script>
            </div>
         </div>
      </div>
      <div class="col-md-6">
         <div class="card">
            <div class="card-header card-info">
               PASIEN BERDASARKAN JENIS KELAMIN
            </div>
            <div class="card-body">
               <canvas id="ChartJK"></canvas>
               <?php
               //Inisialisasi nilai variabel awal
               $jenis_kelamin = "";
               $jumlahJK = null;
               foreach ($jk as $jenkel) :
                  if ($jenkel['jk_pasien'] == "L") {
                     $jkl = "Laki-Laki";
                  } else {
                     $jkl = "Perempuan";
                  }
                  $jenis_kelamin .= "'$jkl'" . ", ";

                  $jum = $jenkel['totalJK'];
                  $jumlahJK .= "$jum" . ", ";
               endforeach;
               ?>
               <script>
                  var ctx = document.getElementById('ChartJK').getContext('2d');
                  var chart = new Chart(ctx, {
                     // The type of chart we want to create
                     type: 'pie',
                     // The data for our dataset
                     data: {
                        labels: [<?php echo $jenis_kelamin; ?>],
                        datasets: [{
                           label: 'PASIEN BERDASARKAN USIA ',
                           backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(175, 238, 239)'],
                           borderColor: ['rgb(255, 99, 132)'],
                           data: [<?php echo $jumlahJK; ?>]
                        }]
                     },
                     // Configuration options go here
                     options: {
                        scales: {
                           yAxes: [{
                              ticks: {
                                 beginAtZero: true
                              }
                           }]
                        }
                     }
                  });
               </script>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-info">
               KUNJUNGAN PASIEN
            </div>
            <div class="card-body">
               <canvas id="ChartKunj"></canvas>
               <?php
               //Inisialisasi nilai variabel awal
               $kun_pasien = "";
               $jumlahKunj = null;
               foreach ($data_kunjungan as $kunjungan) :
                  $kunjungan_pasien = $kunjungan['tgl_kunjungan'];
                  $kun_pasien .= "'$kunjungan_pasien'" . ", ";
                  $jum = $kunjungan['totalKUN'];
                  $jumlahKunj .= "$jum" . ", ";
               endforeach;
               ?>
               <script>
                  var ctx = document.getElementById('ChartKunj').getContext('2d');
                  var chart = new Chart(ctx, {
                     // The type of chart we want to create
                     type: 'line',
                     // The data for our dataset
                     data: {
                        labels: [<?php echo $kun_pasien; ?>],
                        datasets: [{
                           label: 'KUNJUNGAN PASIEN ',
                           backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(175, 238, 239)', 'rgb(240, 248, 254)', 'rgb(251, 235, 217)', 'rgb(0, 255, 254)', 'rgb(115, 255, 216)', 'rgb(0, 0, 255)', 'rgb(138, 43, 226)', 'rgb(165, 42, 42)', 'rgb(95, 158, 160)', 'rgb(127, 255, 1)', 'rgb(210, 105, 30)', 'rgb(251, 127, 80)', 'rgb(100, 149, 237)', 'rgb(225, 248, 220)', 'rgb(220, 20, 60)', 'rgb(62, 254, 255)', 'rgb(29, 139, 139)', 'rgb(184, 134, 11)', 'rgb(19, 100, 0)', 'rgb(189, 183, 107)', 'rgb(85, 107, 47)', 'rgb(251, 140, 1)', 'rgb(139, 5, 0)', 'rgb(233, 150, 122)', 'rgb(143, 188, 144)', 'rgb(72, 61, 139)', 'rgb(47, 79, 79)', 'rgb(48, 206, 209)', 'rgb(249, 19, 147)', 'rgb(34, 139, 35)', 'rgb(249, 0, 255)', 'rgb(218, 165, 32)', 'rgb(173, 255, 48)', 'rgb(240, 255, 240)', 'rgb(205, 92, 92)', 'rgb(240, 230, 140)', 'rgb(230, 230, 250)', 'rgb(254, 240, 245)', 'rgb(173, 216, 230)', 'rgb(240, 128, 128)', 'rgb(224, 255, 255)', 'rgb(144, 238, 144)', 'rgb(119, 136, 153)', 'rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(175, 238, 239)', 'rgb(240, 248, 254)', 'rgb(251, 235, 217)', 'rgb(0, 255, 254)', 'rgb(115, 255, 216)', 'rgb(0, 0, 255)', 'rgb(138, 43, 226)', 'rgb(165, 42, 42)', 'rgb(95, 158, 160)', 'rgb(127, 255, 1)', 'rgb(210, 105, 30)', 'rgb(251, 127, 80)', 'rgb(100, 149, 237)', 'rgb(225, 248, 220)', 'rgb(220, 20, 60)', 'rgb(62, 254, 255)', 'rgb(29, 139, 139)', 'rgb(184, 134, 11)', 'rgb(19, 100, 0)', 'rgb(189, 183, 107)', 'rgb(85, 107, 47)', 'rgb(251, 140, 1)', 'rgb(139, 5, 0)', 'rgb(233, 150, 122)', 'rgb(143, 188, 144)', 'rgb(72, 61, 139)', 'rgb(47, 79, 79)', 'rgb(48, 206, 209)', 'rgb(249, 19, 147)', 'rgb(34, 139, 35)', 'rgb(249, 0, 255)', 'rgb(218, 165, 32)', 'rgb(173, 255, 48)', 'rgb(240, 255, 240)', 'rgb(205, 92, 92)', 'rgb(240, 230, 140)', 'rgb(230, 230, 250)', 'rgb(254, 240, 245)', 'rgb(173, 216, 230)', 'rgb(240, 128, 128)', 'rgb(224, 255, 255)', 'rgb(144, 238, 144)', 'rgb(119, 136, 153)'],
                           borderColor: ['rgb(255, 99, 132)'],
                           data: [<?php echo $jumlahKunj; ?>]
                        }]
                     },
                     // Configuration options go here
                     options: {
                        scales: {
                           yAxes: [{
                              ticks: {
                                 beginAtZero: true
                              }
                           }]
                        }
                     }
                  });
               </script>
            </div>
         </div>
      </div>
   </div>

   <footer class="footer">
      <span>Copyright &copy; 2021 Medical</span>
   </footer>
</section>