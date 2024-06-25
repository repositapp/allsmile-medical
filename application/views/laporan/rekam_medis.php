<section class="main-content">
   <div class="row">

      <div class="toastr1"></div>

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               Data Rekam Medis Pasien
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
                           <strong>Nama</strong>
                        </th>
                        <th width="90">
                           <strong>Sex/Umur</strong>
                        </th>
                        <th>
                           <strong>Kunjungan</strong>
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
                              <a href="<?= base_url(); ?>klinik/detail_rekam_medis/<?= $antrian['id_antrian']; ?>"><?= $antrian['no_pendaftaran']; ?></a>
                           </td>
                           <td><?= $antrian['no_pasien']; ?></td>
                           <td><?= $antrian['nl_pasien']; ?></td>
                           <td><?= $antrian['jk_pasien']; ?> / <?= $antrian['umur_pasien']; ?> Thn</td>
                           <td><?= date('d M Y', strtotime($antrian['tgl_kunjungan'])); ?> <?= date('H:i', strtotime($antrian['waktu_kunjungan'])); ?></td>
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