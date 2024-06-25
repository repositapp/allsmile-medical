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
               Data Obat
            </div>

            <div class="card-body">
               <table id="datatable" class="table table-striped dt-responsive table-hover">
                  <thead>
                     <tr>
                        <th width="40">
                           <strong>No.</strong>
                        </th>
                        <th>
                           <strong>Kode Obat</strong>
                        </th>
                        <th>
                           <strong>Nama Obat</strong>
                        </th>
                        <th>
                           <strong>Kategori</strong>
                        </th>
                        <th class="text-center">
                           <strong>Stok</strong>
                        </th>
                        <th class="text-center" width="130">
                           <strong>Aksi</strong>
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1;
                     foreach ($data_obat as $obat) : ?>
                        <tr>
                           <td><?= $no; ?></td>
                           <td><?= $obat['kode_obat']; ?></td>
                           <td><?= $obat['nm_obat']; ?></td>
                           <td><?= $obat['nk_obat']; ?></td>
                           <td class="text-center">
                              <?php if ($obat['stok'] <= 5) { ?>
                                 <span class="badge badge-danger"><?= $obat['stok']; ?></span>
                              <?php } elseif ($obat['stok'] >= 6) { ?>
                                 <span class="badge badge-success"><?= $obat['stok']; ?></span>
                              <?php } ?>
                           </td>
                           <td class="text-center">
                              <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubahData<?= $no; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="bottom" title="Ubah Data"></i></a>
                              <a href="<?= base_url(); ?>klinik/hapus_obat/<?= $obat['id_obat']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?');" data-toggle="tooltip" data-placement="bottom" title="Hapus Data"><i class="fa fa-trash"></i></a>
                           </td>
                        </tr>
                        <!-- Modal Ubah Data -->
                        <div id="ubahData<?= $no; ?>" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <form method="post" action="<?= base_url('klinik/obat'); ?>" enctype="multipart/form-data">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                       <h5 class="modal-title" id="myDefaultModalLabel">Ubah Data</h5>
                                    </div>
                                    <div class="modal-body">
                                       <input type="hidden" name="ubah_data" value="ubah">
                                       <input type="hidden" id="id_obat" name="id_obat" value="<?= $obat['id_obat']; ?>">
                                       <input type="hidden" id="change_obat" name="change_obat" value="<?= $tanggalwaktu; ?>">

                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Kode Obat</label>
                                          <div class="col-sm-9">
                                             <input type="text" id="kode_obat" name="kode_obat" class="form-control" autocomplete="off" value="<?= $obat['kode_obat']; ?>" required>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Nama Obat</label>
                                          <div class="col-sm-9">
                                             <input type="text" id="nm_obat" name="nm_obat" class="form-control" autocomplete="off" value="<?= $obat['nm_obat']; ?>" required>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Satuan</label>
                                          <div class="col-sm-9">
                                             <input type="text" id="satuan" name="satuan" class="form-control" autocomplete="off" value="<?= $obat['satuan']; ?>" required>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Kategori Obat</label>
                                          <div class="col-sm-9">
                                             <select id="kategori_obat" name="kategori_obat" class="form-control m-b" required>
                                                <?php foreach ($data_ko as $kategori) : ?>
                                                   <option <?php if ($kategori["id_kategori_obat"] == $obat["kategori_obat"]) {
                                                               echo 'selected';
                                                            } ?> value="<?= $kategori['id_kategori_obat']; ?>"><?= $kategori['nk_obat']; ?></option>
                                                <?php endforeach; ?>
                                                <option <?php if ($obat['kategori_obat'] == '-') {
                                                            echo 'selected';
                                                         } ?>>-</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Stok</label>
                                          <div class="col-sm-9">
                                             <input type="text" id="stok" name="stok" class="form-control" autocomplete="off" value="<?= $obat['stok']; ?>" required>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Supplier</label>
                                          <div class="col-sm-9">
                                             <select id="penyuplai" name="penyuplai" class="form-control m-b" required>
                                                <?php foreach ($data_supplier as $supplier) : ?>
                                                   <option <?php if ($obat["penyuplai"] == $supplier["id_suplier"]) {
                                                               echo 'selected';
                                                            } ?> value="<?= $supplier['id_suplier']; ?>"><?= $supplier['nm_suplier']; ?></option>
                                                <?php endforeach; ?>
                                                <option <?php if ($obat['penyuplai'] == '-') {
                                                            echo 'selected';
                                                         } ?>>-</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-3 col-form-label">Harga Satuan</label>
                                          <div class="col-sm-9">
                                             <div class="input-group m-b">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" id="hg_satuan" name="hg_satuan" class="form-control" autocomplete="off" value="<?= $obat['hg_satuan']; ?>" required>
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
               <form method="post" action="<?= base_url('klinik/obat'); ?>" enctype="multipart/form-data">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                     <h5 class="modal-title" id="myDefaultModalLabel">Tambah Data</h5>
                  </div>
                  <div class="modal-body">
                     <input type="hidden" name="tambah_data" value="tambah">
                     <input type="hidden" id="change_obat" name="change_obat" value="<?= $tanggalwaktu; ?>">

                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Kode Obat</label>
                        <div class="col-sm-9">
                           <input type="text" id="kode_obat" name="kode_obat" class="form-control" autocomplete="off" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Nama Obat</label>
                        <div class="col-sm-9">
                           <input type="text" id="nm_obat" name="nm_obat" class="form-control" autocomplete="off" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Satuan</label>
                        <div class="col-sm-9">
                           <input type="text" id="satuan" name="satuan" class="form-control" autocomplete="off" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Kategori Obat</label>
                        <div class="col-sm-9">
                           <select id="kategori_obat" name="kategori_obat" class="form-control m-b" required>
                              <?php foreach ($data_ko as $kategori) : ?>
                                 <option value="<?= $kategori['id_kategori_obat']; ?>"><?= $kategori['nk_obat']; ?></option>
                              <?php endforeach; ?>
                              <option>-</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Stok</label>
                        <div class="col-sm-9">
                           <input type="text" id="stok" name="stok" class="form-control" autocomplete="off" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Supplier</label>
                        <div class="col-sm-9">
                           <select id="penyuplai" name="penyuplai" class="form-control m-b" required>
                              <?php foreach ($data_supplier as $supplier) : ?>
                                 <option value="<?= $supplier['id_suplier']; ?>"><?= $supplier['nm_suplier']; ?></option>
                              <?php endforeach; ?>
                              <option>-</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">Harga Satuan</label>
                        <div class="col-sm-9">
                           <div class="input-group m-b">
                              <span class="input-group-addon">Rp.</span>
                              <input type="text" id="hg_satuan" name="hg_satuan" class="form-control" autocomplete="off" required>
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