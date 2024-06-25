<section class="main-content">
   <div class="row">

      <div class="toastr1"></div>

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               Data Pasien
            </div>

            <div class="card-body">
               <table id="datatable" class="table table-striped dt-responsive nowrap table-hover">
                  <thead>
                     <tr>
                        <th width="90">
                           <strong>No.Antrian</strong>
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
                        <th>
                           <strong>Status Antrian</strong>
                        </th>
                        <th class="text-center" width="70">
                           <strong>Aksi</strong>
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($data_antrian as $antrian) : ?>
                        <tr>
                           <td><?= $antrian['no_antrian']; ?></td>
                           <td><?= date('d M Y', strtotime($antrian['tgl_kunjungan'])); ?> <?= date('H:i', strtotime($antrian['waktu_kunjungan'])); ?></td>
                           <td><?= $antrian['no_pendaftaran']; ?></td>
                           <td><?= $antrian['nl_pasien']; ?></td>
                           <td><?= $antrian['jenis_layanan']; ?></td>
                           <td>
                              <?php if ($antrian['sts_antrian'] == "1") { ?>
                                 <div class="text-success">Proses</div>
                              <?php } elseif ($antrian['sts_antrian'] == "5") { ?>
                                 <div class="text-danger">Telah Dibatalkan</div>
                              <?php } ?>
                           </td>
                           <td class="text-center">
                              <?php if ($antrian['sts_antrian'] == "1") { ?>
                                 <a href="<?= base_url(); ?>klinik/batal_antrian/<?= $antrian['no_pasien']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin membatalkan antrian ini?');" data-toggle="tooltip" data-placement="bottom" title="Pembatalan Antrian"><i class="icon-close"></i></a>
                              <?php } elseif ($antrian['sts_antrian'] == "5") { ?>
                                 <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Pembatalan Antrian" disabled><i class="icon-close"></i></button>
                              <?php } ?>
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