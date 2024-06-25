<section class="main-content">
   <div class="row">

      <div class="toastr1"></div>

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               <div class="float-right">
                  <a href="#" class="btn btn-primary btn-rounded box-shadow btn-icon" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah Data</a>
               </div>
               Data Diagnosa
            </div>

            <div class="card-body">
               <table id="datatable" class="table table-striped dt-responsive table-hover">
                  <thead>
                     <tr>
                        <th width="40">
                           <strong>No.</strong>
                        </th>
                        <th>
                           <strong>Kode ICD</strong>
                        </th>
                        <th>
                           <strong>ICD</strong>
                        </th>
                        <th>
                           <strong>Diagnosa</strong>
                        </th>
                        <th class="text-center" width="130">
                           <strong>Aksi</strong>
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1;
                     foreach ($data_diagnosa as $diagnosa) : ?>
                        <tr>
                           <td><?= $no; ?></td>
                           <td><?= $diagnosa['kode_icd']; ?></td>
                           <td><?= $diagnosa['icd']; ?></td>
                           <td><?= $diagnosa['diagnosa']; ?></td>
                           <td class="text-center">
                              <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubahData<?= $no; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="bottom" title="Ubah Data"></i></a>
                              <a href="<?= base_url(); ?>klinik/hapus_diagnosa_set/<?= $diagnosa['id_diagnosa']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?');" data-toggle="tooltip" data-placement="bottom" title="Hapus Data"><i class="fa fa-trash"></i></a>
                           </td>
                        </tr>
                        <!-- Modal Ubah Data -->
                        <div id="ubahData<?= $no; ?>" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <form method="post" action="<?= base_url('klinik/diagnosa_set'); ?>" enctype="multipart/form-data">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                       <h5 class="modal-title" id="myDefaultModalLabel">Ubah Data</h5>
                                    </div>
                                    <div class="modal-body">
                                       <input type="hidden" name="ubah_data" value="ubah">
                                       <input type="hidden" id="id_diagnosa" name="id_diagnosa" value="<?= $diagnosa['id_diagnosa']; ?>">

                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Kode ICD</label>
                                          <div class="col-sm-9">
                                             <input type="text" id="kode_icd" name="kode_icd" class="form-control" autocomplete="off" value="<?= $diagnosa['kode_icd']; ?>" required>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">ICD</label>
                                          <div class="col-sm-9">
                                             <input type="text" id="icd" name="icd" class="form-control" autocomplete="off" value="<?= $diagnosa['icd']; ?>" required>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Diagnosa</label>
                                          <div class="col-sm-9">
                                             <input type="text" id="diagnosa" name="diagnosa" class="form-control" autocomplete="off" value="<?= $diagnosa['diagnosa']; ?>" required>
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
               <form method="post" action="<?= base_url('klinik/diagnosa_set'); ?>" enctype="multipart/form-data">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                     <h5 class="modal-title" id="myDefaultModalLabel">Tambah Data</h5>
                  </div>
                  <div class="modal-body">
                     <input type="hidden" name="tambah_data" value="tambah">

                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Kode ICD</label>
                        <div class="col-sm-9">
                           <input type="text" id="kode_icd" name="kode_icd" class="form-control" autocomplete="off" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">ICD</label>
                        <div class="col-sm-9">
                           <input type="text" id="icd" name="icd" class="form-control" autocomplete="off" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Diagnosa</label>
                        <div class="col-sm-9">
                           <input type="text" id="diagnosa" name="diagnosa" class="form-control" autocomplete="off" required>
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