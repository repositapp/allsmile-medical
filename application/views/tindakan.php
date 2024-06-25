<section class="main-content">
   <div class="row">

      <div class="toastr1"></div>

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               <div class="float-right">
                  <a href="#" class="btn btn-primary btn-rounded box-shadow btn-icon" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah Data</a>
               </div>
               Data Tindakan
            </div>

            <div class="card-body">
               <table id="datatable" class="table table-striped dt-responsive table-hover">
                  <thead>
                     <tr>
                        <th width="40">
                           <strong>No.</strong>
                        </th>
                        <th>
                           <strong>Nama Tindakan</strong>
                        </th>
                        <th>
                           <strong>Harga</strong>
                        </th>
                        <th>
                           <strong>Komisi</strong>
                        </th>
                        <th class="text-center" width="130">
                           <strong>Aksi</strong>
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1;
                     foreach ($data_tindakan as $tindakan) : ?>
                        <tr>
                           <td><?= $no; ?></td>
                           <td><?= $tindakan['nm_tindakan']; ?></td>
                           <td>Rp.<?= number_format($tindakan['hg_tindakan'], 0, ".", "."); ?></td>
                           <td>Rp.<?= number_format($tindakan['km_tindakan'], 0, ".", "."); ?></td>
                           <td class="text-center">
                              <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubahData<?= $no; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="bottom" title="Ubah Data"></i></a>
                              <a href="<?= base_url(); ?>klinik/hapus_tindakan_set/<?= $tindakan['id_tindakan']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?');" data-toggle="tooltip" data-placement="bottom" title="Hapus Data"><i class="fa fa-trash"></i></a>
                           </td>
                        </tr>
                        <!-- Modal Ubah Data -->
                        <div id="ubahData<?= $no; ?>" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <form method="post" action="<?= base_url('klinik/tindakan_set'); ?>" enctype="multipart/form-data">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                       <h5 class="modal-title" id="myDefaultModalLabel">Ubah Data</h5>
                                    </div>
                                    <div class="modal-body">
                                       <input type="hidden" name="ubah_data" value="ubah">
                                       <input type="hidden" id="id_tindakan" name="id_tindakan" value="<?= $tindakan['id_tindakan']; ?>">

                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Tindakan</label>
                                          <div class="col-sm-9">
                                             <input type="text" id="nm_tindakan" name="nm_tindakan" class="form-control" autocomplete="off" value="<?= $tindakan['nm_tindakan']; ?>" required>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Harga</label>
                                          <div class="col-sm-9">
                                             <div class="input-group m-b">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" id="hg_tindakan" name="hg_tindakan" class="form-control" autocomplete="off" value="<?= $tindakan['hg_tindakan']; ?>" required>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Komisi</label>
                                          <div class="col-sm-9">
                                             <div class="input-group m-b">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" id="km_tindakan" name="km_tindakan" class="form-control" autocomplete="off" value="<?= $tindakan['km_tindakan']; ?>" required>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-primary">Simpan Data</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     <?php $no++;
                     endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>

      <!-- Modal Tambah Data -->
      <div id="tambahData" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <form method="post" action="<?= base_url('klinik/tindakan_set'); ?>" enctype="multipart/form-data">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                     <h5 class="modal-title" id="myDefaultModalLabel">Tambah Data</h5>
                  </div>
                  <div class="modal-body">
                     <input type="hidden" name="tambah_data" value="tambah">

                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Tindakan</label>
                        <div class="col-sm-9">
                           <input type="text" id="nm_tindakan" name="nm_tindakan" class="form-control" autocomplete="off" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-9">
                           <div class="input-group m-b">
                              <span class="input-group-addon">Rp.</span>
                              <input type="text" id="hg_tindakan" name="hg_tindakan" class="form-control" autocomplete="off" required>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Komisi</label>
                        <div class="col-sm-9">
                           <div class="input-group m-b">
                              <span class="input-group-addon">Rp.</span>
                              <input type="text" id="km_tindakan" name="km_tindakan" class="form-control" autocomplete="off" required>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Simpan Data</button>
                  </div>
               </form>
            </div>
         </div>
      </div>

   </div>


   <footer class="footer">
      <span>Copyright &copy; 2021 Medical</span>
   </footer>
</section>