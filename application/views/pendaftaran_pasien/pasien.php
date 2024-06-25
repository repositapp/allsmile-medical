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
                        <th width="40">
                           <strong>No.</strong>
                        </th>
                        <th>
                           <strong>Nama Pasien</strong>
                        </th>
                        <th>
                           <strong>Tanggal Lahir</strong>
                        </th>
                        <th>
                           <strong>Sex/Umur</strong>
                        </th>
                        <th>
                           <strong>Kontak</strong>
                        </th>
                        <th class="text-center" width="130">
                           <strong>Aksi</strong>
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1;
                     foreach ($data_pasien as $pasien) : ?>
                        <tr>
                           <td><?= $no; ?></td>
                           <td><?= $pasien['nl_pasien']; ?></td>
                           <td><?= $pasien['tmp_lahir_pasien']; ?>, <?= date('d M Y', strtotime($pasien['tgl_lahir_pasien'])); ?></td>
                           <td><?= $pasien['jk_pasien']; ?>/<?= $pasien['umur_pasien']; ?> Thn</td>
                           <td><?= $pasien['telp_pasien']; ?>, <?= $pasien['email_pasien']; ?>, <?= $pasien['kontak_lain']; ?></td>
                           <td class="text-center">
                              <a href="<?= base_url(); ?>klinik/detail_pasien/<?= $pasien['no_pasien']; ?>" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Lihat Data"><i class="fa fa-search"></i></a>
                              <a href="<?= base_url(); ?>klinik/update_pasien/<?= $pasien['no_pasien']; ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Ubah Data"><i class="fa fa-edit"></i></a>
                              <a href="<?= base_url(); ?>klinik/hapus_pasien/<?= $pasien['id_pasien']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?');" data-toggle="tooltip" data-placement="bottom" title="Hapus Data"><i class="fa fa-trash"></i></a>
                           </td>
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