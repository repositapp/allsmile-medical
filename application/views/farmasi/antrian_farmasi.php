<section class="main-content">
   <div class="row">

      <div class="toastr1"></div>
      <div class="col">
         <div class="widget bg-light padding-0">
            <div class="row row-table">
               <div class="col-xs-4 text-center padding-15 bg-warning">
                  <em class="icon-shuffle fa-3x"></em>
               </div>
               <div class="col-xs-8 padding-15 text-right">
                  <h2 class="mv-0"><?= $belum_proses; ?></h2>
                  <div class="margin-b-0 text-muted">Belum Proses</div>
               </div>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="widget bg-light padding-0">
            <div class="row row-table">
               <div class="col-xs-4 text-center padding-15 bg-info">
                  <em class="icon-login fa-3x"></em>
               </div>
               <div class="col-xs-8 padding-15 text-right">
                  <h2 class="mv-0"><?= $dalam_proses; ?></h2>
                  <div class="margin-b-0 text-muted">Dalam Proses</div>
               </div>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="widget bg-light padding-0">
            <div class="row row-table">
               <div class="col-xs-4 text-center padding-15 bg-success">
                  <em class="icon-check fa-3x"></em>
               </div>
               <div class="col-xs-8 padding-15 text-right">
                  <h2 class="mv-0"><?= $selesai; ?></h2>
                  <div class="margin-b-0 text-muted">Selesai</div>
               </div>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="widget bg-light padding-0">
            <div class="row row-table">
               <div class="col-xs-4 text-center padding-15 bg-danger">
                  <em class="icon-close fa-3x"></em>
               </div>
               <div class="col-xs-8 padding-15 text-right">
                  <h2 class="mv-0"><?= $batal; ?></h2>
                  <div class="margin-b-0 text-muted">Batal</div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               <div class="float-right">
                  <a href="<?= base_url(); ?>klinik/antrian_farmasi" class="btn btn-info btn-rounded box-shadow btn-sm" data-toggle="tooltip" data-placement="bottom" title="Reload Halaman"><i class="icon-reload"></i></a>
               </div>
               Data Pasien
            </div>

            <div class="card-body">
               <table id="datatable" class="table table-striped dt-responsive nowrap table-hover">
                  <thead>
                     <tr>
                        <th width="40">
                           <strong>No.</strong>
                        </th>
                        <th>
                           <strong>No.Pendaftaran</strong>
                        </th>
                        <th>
                           <strong>No.Pasien</strong>
                        </th>
                        <th>
                           <strong>Tanggal</strong>
                        </th>
                        <th>
                           <strong>Nama</strong>
                        </th>
                        <th width="90">
                           <strong>Sex/Umur</strong>
                        </th>
                        <th>
                           <strong>Dokter</strong>
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1;
                     foreach ($data_antrian as $antrian) : ?>
                        <tr>
                           <td><?= $no; ?></td>
                           <td>
                              <a href="<?= base_url(); ?>klinik/permintaan/<?= $antrian['id_antrian']; ?>"><?= $antrian['no_pendaftaran']; ?></a>
                           </td>
                           <td><?= $antrian['no_pasien']; ?></td>
                           <td><?= date('d M Y', strtotime($antrian['tgl_kunjungan'])); ?> <?= date('H:i', strtotime($antrian['waktu_kunjungan'])); ?></td>
                           <td><?= $antrian['nl_pasien']; ?></td>
                           <td><?= $antrian['jk_pasien']; ?> / <?= $antrian['umur_pasien']; ?> Thn</td>
                           <td><?= $antrian['gl_depan']; ?> <?= $antrian['nm_depan']; ?> <?= $antrian['nm_belakang']; ?></td>
                        </tr>
                     <?php $no++;
                     endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>

   </div>


   <footer class="footer">
      <span>Copyright &copy; 2021 Medical</span>
   </footer>
</section>