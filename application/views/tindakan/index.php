<section class="main-content">
   <div class="row">

      <div class="toastr1"></div>

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               <div class="float-right">
                  <a href="<?= base_url(); ?>klinik/tindakan_pasien" class="btn btn-info btn-rounded box-shadow btn-sm" data-toggle="tooltip" data-placement="bottom" title="Reload Halaman"><i class="icon-reload"></i></a>
               </div>
               Tindakan Pasien
            </div>

            <div class="card-body">
               <table id="datatable" class="table table-striped dt-responsive nowrap table-hover">
                  <thead>
                     <tr>
                        <th width="90">
                           <strong>No. Antrian</strong>
                        </th>
                        <th>
                           <strong>Tanggal Daftar</strong>
                        </th>
                        <th>
                           <strong>No.Pendaftaran</strong>
                        </th>
                        <th>
                           <strong>Nama</strong>
                        </th>
                        <th>
                           <strong>Jenis Layanan</strong>
                        </th>
                        <th class="text-center" width="70">
                           <strong>Aksi</strong>
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($data_pasien as $pasien) : ?>
                        <tr>
                           <td><?= $pasien['no_antrian']; ?></td>
                           <td><?= date('d M Y', strtotime($pasien['tgl_kunjungan'])); ?> <?= date('H:i', strtotime($pasien['waktu_kunjungan'])); ?></td>
                           <td><?= $pasien['no_pendaftaran']; ?></td>
                           <td><?= $pasien['nl_pasien']; ?></td>
                           <td><?= $pasien['jenis_layanan']; ?></td>
                           <td class="text-center">
                              <a href="<?= base_url(); ?>klinik/catatan_tindakan_pasien/<?= $pasien['id_antrian']; ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Tindak Lanjuti"><i class="fa fa-edit"></i></a>
                           </td>
                        </tr>
                     <?php endforeach; ?>
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

<script>
   // Refresh Otomatis
   setInterval(function() {
      $("#reloadTindakan").load("<?= base_url(); ?>klinik/tindakan_pasien");
   }, 300000);
</script>