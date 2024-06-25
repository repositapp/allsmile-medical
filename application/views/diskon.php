<section class="main-content">
   <div class="row">

      <div class="toastr1"></div>

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               <div class="float-right">
                  <a href="#" class="btn btn-primary btn-rounded box-shadow btn-icon" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah Data</a>
               </div>
               Data Diskon
            </div>

            <div class="card-body">
               <table id="datatable" class="table table-striped dt-responsive table-hover">
                  <thead>
                     <tr>
                        <th width="40">
                           <strong>No.</strong>
                        </th>
                        <th>
                           <strong>Keterangan Diskon</strong>
                        </th>
                        <th class="text-center" width="150">
                           <strong>Diskon</strong>
                        </th>
                        <th class="text-center" width="150">
                           <strong>Status</strong>
                        </th>
                        <th class="text-center" width="130">
                           <strong>Aksi</strong>
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1;
                     foreach ($data_diskon as $diskon) : ?>
                        <tr>
                           <td><?= $no; ?></td>
                           <td><?= $diskon['ket_diskon']; ?></td>
                           <td class="text-center">
                              <span class="badge badge-primary"><?= $diskon['pers_diskon']; ?>%</span>
                           </td>
                           <td class="text-center">
                              <?php if ($diskon['sts_diskon'] == 1) { ?>
                                 <span class="badge badge-primary">Aktif</span>
                              <?php } elseif ($diskon['sts_diskon'] == 0) { ?>
                                 <span class="badge badge-danger">Tidak Aktif</span>
                              <?php } ?>
                           </td>
                           <td class="text-center">
                              <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubahData<?= $no; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="bottom" title="Ubah Data"></i></a>
                              <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ubahSts<?= $no; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="bottom" title="Ubah Status"></i></a>
                              <a href="<?= base_url(); ?>klinik/hapus_diskon/<?= $diskon['id_diskon']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?');" data-toggle="tooltip" data-placement="bottom" title="Hapus Data"><i class="fa fa-trash"></i></a>
                           </td>
                        </tr>
                        <!-- Modal Ubah Data -->
                        <div id="ubahData<?= $no; ?>" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <form method="post" action="<?= base_url('klinik/diskon'); ?>" enctype="multipart/form-data">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                       <h5 class="modal-title" id="myDefaultModalLabel">Ubah Data</h5>
                                    </div>
                                    <div class="modal-body">
                                       <input type="hidden" name="ubah_data" value="ubah">
                                       <input type="hidden" id="id_diskon" name="id_diskon" value="<?= $diskon['id_diskon']; ?>">

                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Keterangan</label>
                                          <div class="col-sm-9">
                                             <textarea id="ket_diskon" name="ket_diskon" class="form-control" rows="3" required><?= $diskon['ket_diskon']; ?></textarea>
                                          </div>
                                       </div>

                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Persenan</label>
                                          <div class="col-sm-9">
                                             <div class="input-group m-b">
                                                <input type="text" id="pers_diskon" name="pers_diskon" class="form-control form-control-rounded" value="<?= $diskon['pers_diskon']; ?>">
                                                <span class="input-group-addon">%</span>
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
                        <!-- Modal Ubah Status -->
                        <div id="ubahSts<?= $no; ?>" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <form method="post" action="<?= base_url('klinik/diskon'); ?>" enctype="multipart/form-data">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                       <h5 class="modal-title" id="myDefaultModalLabel">Ubah Status</h5>
                                    </div>
                                    <div class="modal-body">
                                       <input type="hidden" name="ubah_sts" value="ubah">
                                       <input type="hidden" id="id_diskon" name="id_diskon" value="<?= $diskon['id_diskon']; ?>">

                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Status</label>
                                          <div class="col-sm-9">
                                             <select id="sts_diskon" name="sts_diskon" class="form-control m-b" required>
                                                <option <?php if ($diskon['sts_diskon'] == '1') {
                                                            echo "selected";
                                                         } ?> value="1">Aktif</option>
                                                <option <?php if ($diskon['sts_diskon'] == '0') {
                                                            echo "selected";
                                                         } ?> value="0">Tidak Aktif</option>
                                             </select>
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
               <form method="post" action="<?= base_url('klinik/diskon'); ?>" enctype="multipart/form-data">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                     <h5 class="modal-title" id="myDefaultModalLabel">Tambah Data</h5>
                  </div>
                  <div class="modal-body">
                     <input type="hidden" name="tambah_data" value="tambah">

                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                           <textarea id="ket_diskon" name="ket_diskon" class="form-control" rows="3" required></textarea>
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Persenan</label>
                        <div class="col-sm-9">
                           <div class="input-group m-b">
                              <input type="text" id="pers_diskon" name="pers_diskon" class="form-control form-control-rounded">
                              <span class="input-group-addon">%</span>
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