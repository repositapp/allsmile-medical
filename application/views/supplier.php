<?php
date_default_timezone_set('Asia/Makassar');
$tanggalwaktu = date("Y-m-d H:i:s");
?>
<section class="main-content">
   <div class="row">

      <div class="toastr1"></div>

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               <div class="float-right">
                  <a href="#" class="btn btn-primary btn-rounded box-shadow btn-icon" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah Data</a>
               </div>
               Data Supplier
            </div>

            <div class="card-body">
               <table id="datatable" class="table table-striped dt-responsive table-hover">
                  <thead>
                     <tr>
                        <th width="40">
                           <strong>No.</strong>
                        </th>
                        <th>
                           <strong>Supplier</strong>
                        </th>
                        <th width="300">
                           <strong>Kontak</strong>
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
                     foreach ($data_supplier as $supplier) : ?>
                        <tr>
                           <td><?= $no; ?></td>
                           <td><?= $supplier['nm_suplier']; ?></td>
                           <td>Telp : <?= $supplier['telp_suplier']; ?>, Fax : <?= $supplier['fax_suplier']; ?>, Email : <?= $supplier['email_suplier']; ?>, Web : <?= $supplier['web_suplier']; ?></td>
                           <td><?= $supplier['alamat_suplier']; ?></td>
                           <td class="text-center">
                              <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubahData<?= $no; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="bottom" title="Ubah Data"></i></a>
                              <a href="<?= base_url(); ?>klinik/hapus_supplier/<?= $supplier['id_suplier']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?');" data-toggle="tooltip" data-placement="bottom" title="Hapus Data"><i class="fa fa-trash"></i></a>
                           </td>
                        </tr>
                        <!-- Modal Ubah Data -->
                        <div id="ubahData<?= $no; ?>" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <form method="post" action="<?= base_url('klinik/supplier'); ?>" enctype="multipart/form-data">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                       <h5 class="modal-title" id="myDefaultModalLabel">Ubah Data</h5>
                                    </div>
                                    <div class="modal-body">
                                       <input type="hidden" name="ubah_data" value="ubah">
                                       <input type="hidden" id="id_suplier" name="id_suplier" value="<?= $supplier['id_suplier']; ?>">
                                       <input type="hidden" id="change_suplier" name="change_suplier" value="<?= $tanggalwaktu; ?>">

                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Supplier</label>
                                          <div class="col-sm-9">
                                             <input type="text" id="nm_suplier" name="nm_suplier" value="<?= $supplier['nm_suplier']; ?>" class="form-control" autocomplete="off" required>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Telepon</label>
                                          <div class="col-sm-9">
                                             <input type="text" id="telp_suplier" name="telp_suplier" value="<?= $supplier['telp_suplier']; ?>" class="form-control" autocomplete="off" required>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Fax</label>
                                          <div class="col-sm-9">
                                             <input type="text" id="fax_suplier" name="fax_suplier" value="<?= $supplier['fax_suplier']; ?>" class="form-control" autocomplete="off" required>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Email</label>
                                          <div class="col-sm-9">
                                             <input type="Email" id="email_suplier" name="email_suplier" value="<?= $supplier['email_suplier']; ?>" class="form-control" autocomplete="off" required>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Website</label>
                                          <div class="col-sm-9">
                                             <input type="text" id="web_suplier" name="web_suplier" value="<?= $supplier['web_suplier']; ?>" class="form-control" autocomplete="off" required>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Alamat</label>
                                          <div class="col-sm-9">
                                             <textarea id="alamat_suplier" name="alamat_suplier" class="form-control" rows="3" required><?= $supplier['alamat_suplier']; ?></textarea>
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
               <form method="post" action="<?= base_url('klinik/supplier'); ?>" enctype="multipart/form-data">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                     <h5 class="modal-title" id="myDefaultModalLabel">Tambah Data</h5>
                  </div>
                  <div class="modal-body">
                     <input type="hidden" name="tambah_data" value="tambah">
                     <input type="hidden" id="change_suplier" name="change_suplier" value="<?= $tanggalwaktu; ?>">

                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Supplier</label>
                        <div class="col-sm-9">
                           <input type="text" id="nm_suplier" name="nm_suplier" class="form-control" autocomplete="off" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Telepon</label>
                        <div class="col-sm-9">
                           <input type="text" id="telp_suplier" name="telp_suplier" class="form-control" autocomplete="off" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Fax</label>
                        <div class="col-sm-9">
                           <input type="text" id="fax_suplier" name="fax_suplier" class="form-control" autocomplete="off" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                           <input type="Email" id="email_suplier" name="email_suplier" class="form-control" autocomplete="off" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Website</label>
                        <div class="col-sm-9">
                           <input type="text" id="web_suplier" name="web_suplier" class="form-control" autocomplete="off" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                           <textarea id="alamat_suplier" name="alamat_suplier" class="form-control" rows="3" required></textarea>
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