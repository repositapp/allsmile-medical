<section class="main-content">
   <div class="row">

      <div class="toastr1"></div>

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               <div class="float-right">
                  <a href="<?= base_url(); ?>klinik/tambah_user" class="btn btn-primary btn-rounded box-shadow btn-icon"><i class="fa fa-plus"></i> Tambah Data</a>
               </div>
               Data User
            </div>

            <div class="card-body">
               <table id="datatable" class="table table-striped dt-responsive nowrap table-hover">
                  <thead>
                     <tr>
                        <th width="40">
                           <strong>No.</strong>
                        </th>
                        <th>
                           <strong>No.KTP</strong>
                        </th>
                        <th>
                           <strong>Nama User</strong>
                        </th>
                        <th width="130">
                           <strong>Kontak</strong>
                        </th>
                        <th width="130">
                           <strong>Hak Akses</strong>
                        </th>
                        <th class="text-center" width="130">
                           <strong>Aksi</strong>
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1;
                     foreach ($data_user as $user2) : ?>
                        <tr>
                           <td><?= $no; ?></td>
                           <td><?= $user2['ktp']; ?></td>
                           <td><?= $user2['nm_depan']; ?> <?= $user2['nm_belakang']; ?></td>
                           <td><?= $user2['telepon']; ?>, <?= $user2['email']; ?></td>
                           <td><?= $user2['akses']; ?></td>
                           <td class="text-center">
                              <a href="<?= base_url(); ?>klinik/detail_user/<?= $user2['ktp']; ?>" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Lihat Data"><i class="fa fa-search"></i></a>
                              <a href="<?= base_url(); ?>klinik/update_user/<?= $user2['id_user']; ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Ubah Data"><i class="fa fa-edit"></i></a>
                              <a href="<?= base_url(); ?>klinik/hapus_user/<?= $user2['ktp']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?');" data-toggle="tooltip" data-placement="bottom" title="Hapus Data"><i class="fa fa-trash"></i></a>
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