<section class="main-content">
   <div class="row">

      <div class="toastr1"></div>

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               <div class="float-right">
                  <a href="<?= base_url(); ?>klinik/tambah_dokter" class="btn btn-primary btn-rounded box-shadow btn-icon"><i class="fa fa-plus"></i> Tambah Data</a>
               </div>
               Data Dokter
            </div>

            <div class="card-body">
               <table id="datatable" class="table table-striped dt-responsive nowrap table-hover">
                  <thead>
                     <tr>
                        <th width="40">
                           <strong>No.</strong>
                        </th>
                        <th>
                           <strong>Nama Dokter</strong>
                        </th>
                        <th>
                           <strong>Spesialis</strong>
                        </th>
                        <th>
                           <strong>Telepon</strong>
                        </th>
                        <th>
                           <strong>Alamat</strong>
                        </th>
                        <th class="text-center" width="130">
                           <strong>Aksi</strong>
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1;
                     foreach ($data_dokter as $dokter) : ?>
                        <tr>
                           <td><?= $no; ?></td>
                           <td><?= $dokter['gl_depan']; ?> <?= $dokter['nm_depan']; ?> <?= $dokter['nm_belakang']; ?>, <?= $dokter['gl_belakang']; ?></td>
                           <td><?= $dokter['spesialis']; ?></td>
                           <td><?= $dokter['telepon']; ?></td>
                           <td><?= substr($dokter['alamat'], 0, 30); ?>..</td>
                           <td class="text-center">
                              <a href="<?= base_url(); ?>klinik/detail_dokter/<?= $dokter['ktp']; ?>" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Lihat Data"><i class="fa fa-search"></i></a>
                              <a href="<?= base_url(); ?>klinik/update_dokter/<?= $dokter['ktp']; ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Ubah Data"><i class="fa fa-edit"></i></a>
                              <a href="<?= base_url(); ?>klinik/hapus_dokter/<?= $dokter['ktp']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?');" data-toggle="tooltip" data-placement="bottom" title="Hapus Data"><i class="fa fa-trash"></i></a>
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