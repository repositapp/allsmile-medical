<?php

class M_klinik extends CI_Model
{
   // Data Chart
   public function getChartKunjungan()
   {
      $this->db->select('tgl_kunjungan');
      $this->db->select('count(*) as totalKUN');
      $this->db->from('antrian_pasien');
      $this->db->group_by('tgl_kunjungan');
      return $this->db->get()->result_array();
   }

   public function getChartUmur()
   {
      $this->db->select('umur_pasien');
      $this->db->select('count(*) as total');
      $this->db->from('pasien');
      $this->db->group_by('umur_pasien');
      return $this->db->get()->result_array();
   }

   public function getChartJK()
   {
      $this->db->select('jk_pasien');
      $this->db->select('count(*) as totalJK');
      $this->db->from('pasien');
      $this->db->group_by('jk_pasien');
      return $this->db->get()->result_array();
   }

   // Data Pendaftaran
   public function nomorPendaftaran()
   {
      $this->db->select('RIGHT(antrian_pasien.no_pendaftaran,3) as no_pendaftaran', FALSE);
      $this->db->order_by('no_pendaftaran', 'DESC');
      $this->db->limit(1);
      $query = $this->db->get('antrian_pasien');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->no_pendaftaran) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
      $kodetampil = "PN." . date('dmy') . '.' . date('Hi') . '.' . $batas;
      return $kodetampil;
   }

   public function nomorAntrian()
   {
      date_default_timezone_set('Asia/Makassar');
      $tanggalwaktu = date("Y-m-d");
      $this->db->select('RIGHT(antrian_pasien.no_antrian,3) as no_antrian', FALSE);
      $this->db->where('tgl_kunjungan', $tanggalwaktu);
      $this->db->order_by('no_antrian', 'DESC');
      $this->db->limit(1);
      $query = $this->db->get('antrian_pasien');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->no_antrian) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
      $nomortampil = $batas;
      return $nomortampil;
   }

   public function getPasienJoinKtp($id)
   {
      $this->db->select('*');
      $this->db->from('pasien');
      $this->db->join('antrian_pasien', 'antrian_pasien.no_pasien=pasien.no_pasien');
      $this->db->join('dokter', 'dokter.id_dokter=antrian_pasien.id_dokter');
      $this->db->where('pasien.no_pasien', $id);
      return $this->db->get()->row_array();
   }

   public function getAntrianSetJoinPasien($id)
   {
      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('pasien', 'pasien.no_pasien=antrian_pasien.no_pasien');
      $this->db->join('dokter', 'dokter.kode_dokter=antrian_pasien.id_dokter');
      $this->db->where('antrian_pasien.no_pendaftaran', $id);
      return $this->db->get()->row_array();
   }

   public function getAllPasienJoinKtp()
   {
      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('pasien', 'pasien.no_pasien=antrian_pasien.no_pasien');
      $this->db->where('antrian_pasien.sts_antrian', '1');
      $this->db->or_where('antrian_pasien.sts_antrian', '5');
      $this->db->order_by('antrian_pasien.sts_antrian', 'ASC');
      return $this->db->get()->result_array();
   }

   public function getCariPasien($keyword)
   {
      $this->db->where('no_pasien', $keyword);
      return $this->db->get('pasien')->row_array();
   }

   public function addPasien($insertPendaftar)
   {
      $this->db->insert('pasien', $insertPendaftar);
   }

   public function addAntrianPasien($insertAntrian)
   {
      $this->db->insert('antrian_pasien', $insertAntrian);
   }

   public function addCtt($insertCtt)
   {
      $this->db->insert('tp_catatan', $insertCtt);
   }

   public function pembatalanAntrian($id)
   {
      $this->db->where('no_pasien', $id);
      $this->db->update('antrian_pasien', ['sts_antrian' => '5']);
   }

   // Data Pasien
   public function getAllPasien()
   {
      $this->db->select('*');
      $this->db->from('pasien');
      $this->db->join('pekerjaan', 'pekerjaan.id_pekerjaan=pasien.pekerjaan');
      $this->db->order_by('pasien.id_pasien', 'DESC');
      return $this->db->get()->result_array();
   }

   public function getPasienByKTP($id)
   {
      $this->db->select('*');
      $this->db->from('pasien');
      $this->db->join('pekerjaan', 'pekerjaan.id_pekerjaan=pasien.pekerjaan');
      $this->db->where('no_pasien', $id);
      return $this->db->get()->row_array();
   }

   public function getPasienById($id)
   {
      $this->db->select('*');
      $this->db->from('pasien');
      $this->db->where('no_pasien', $id);
      return $this->db->get()->row_array();
   }

   public function editPasien($where, $updatePasien)
   {
      $this->db->where($where);
      $this->db->update('pasien', $updatePasien);
   }

   public function deletePasien($id)
   {
      $this->db->where('id_pasien', $id);
      $this->db->delete('pasien');
   }

   // Data Dokter And User
   public function getAllDokter()
   {
      $this->db->order_by('id_dokter', 'DESC');
      return $this->db->get('dokter')->result_array();
   }

   public function getAllUser()
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('hak_akses', 'hak_akses.kode_akses=user.akses');
      // $this->db->not_like('user.id_user', $this->session->userdata('id_user'));
      $this->db->order_by('user.id_user', 'DESC');
      return $this->db->get()->result_array();
   }

   public function getDokterJoinKtp($id)
   {
      $this->db->select('*');
      $this->db->from('dokter');
      $this->db->join('user', 'user.ktp=dokter.ktp');
      $this->db->where('dokter.ktp', $id);
      return $this->db->get()->row_array();
   }

   public function getUserByAkses($id)
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('hak_akses', 'hak_akses.kode_akses=user.akses');
      $this->db->where('ktp', $id);
      return $this->db->get()->row_array();
   }

   public function getUserById($id)
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->where('id_user', $id);
      return $this->db->get()->row_array();
   }

   public function kodeDokter()
   {
      $this->db->select('RIGHT(dokter.kode_dokter,3) as kode_dokter', FALSE);
      $this->db->order_by('kode_dokter', 'DESC');
      $this->db->limit(1);
      $query = $this->db->get('dokter');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->kode_dokter) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
      $kodetampil = "KD-" . date('dmy') . '-' . $batas;
      return $kodetampil;
   }

   public function addDokter($insertDokter)
   {
      $this->db->insert('dokter', $insertDokter);
   }

   public function addUser($insertUser)
   {
      $this->db->insert('user', $insertUser);
   }

   public function editDokter($whereDokter, $updateDokter)
   {
      $this->db->where($whereDokter);
      $this->db->update('dokter', $updateDokter);
   }

   public function editUser($whereUser, $updateUser)
   {
      $this->db->where($whereUser);
      $this->db->update('user', $updateUser);
   }

   public function deleteDokter($id)
   {
      $this->db->where('ktp', $id);
      $this->db->delete('dokter');
   }

   public function deleteUser($id)
   {
      $this->db->where('ktp', $id);
      $this->db->delete('user');
   }

   // Data Tindakan
   public function getAllTindakan()
   {
      $this->db->order_by('id_tindakan', 'DESC');
      return $this->db->get('tindakan')->result_array();
   }

   public function addTindakan($insertTindakan)
   {
      $this->db->insert('tindakan', $insertTindakan);
   }

   public function editTindakan($where, $updateTindakan)
   {
      $this->db->where($where);
      $this->db->update('tindakan', $updateTindakan);
   }

   public function deletTindakanSet($id)
   {
      $this->db->where('id_tindakan', $id);
      $this->db->delete('tindakan');
   }

   // Data Diagnosa Set
   public function getAllDiagnosaSet()
   {
      $this->db->order_by('id_diagnosa', 'DESC');
      return $this->db->get('diagnosa')->result_array();
   }

   public function addDiagnosaSet($insertDiagnosa)
   {
      $this->db->insert('diagnosa', $insertDiagnosa);
   }

   public function editDiagnosaSet($where, $updateDiagnosa)
   {
      $this->db->where($where);
      $this->db->update('diagnosa', $updateDiagnosa);
   }

   public function deletDiagnosaSet($id)
   {
      $this->db->where('id_diagnosa', $id);
      $this->db->delete('diagnosa');
   }

   // Data Obat
   public function getAllObat()
   {
      $this->db->select('*');
      $this->db->from('obat');
      $this->db->join('kategori_obat', 'kategori_obat.id_kategori_obat=obat.kategori_obat');
      $this->db->order_by('id_obat', 'DESC');
      return $this->db->get()->result_array();
   }

   public function addObat($insertObat)
   {
      $this->db->insert('obat', $insertObat);
   }

   public function editObat($where, $updateObat)
   {
      $this->db->where($where);
      $this->db->update('obat', $updateObat);
   }

   public function deletObat($id)
   {
      $this->db->where('id_obat', $id);
      $this->db->delete('obat');
   }

   // Data Supplier
   public function getAllSupplier()
   {
      $this->db->order_by('id_suplier', 'DESC');
      return $this->db->get('supplier')->result_array();
   }

   public function addSupplier($insertSupplier)
   {
      $this->db->insert('supplier', $insertSupplier);
   }

   public function editSupplier($where, $updateSupplier)
   {
      $this->db->where($where);
      $this->db->update('supplier', $updateSupplier);
   }

   public function deletSupplier($id)
   {
      $this->db->where('id_suplier', $id);
      $this->db->delete('supplier');
   }

   // Data Tindakan Pasien
   public function getAllTindakanPasien()
   {
      date_default_timezone_set('Asia/Makassar');
      $tanggalwaktu = date("Y-m-d");

      $dokter_id = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
      $ktp = $dokter_id['ktp'];
      $dokter = $this->db->get_where('dokter', ['ktp' => $ktp])->row_array();
      $id_dokter = $dokter['kode_dokter'];

      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('pasien', 'pasien.no_pasien=antrian_pasien.no_pasien');
      $this->db->where('antrian_pasien.tgl_kunjungan', $tanggalwaktu);
      $this->db->where('antrian_pasien.sts_antrian', '1');
      $this->db->where('antrian_pasien.id_dokter', $id_dokter);
      return $this->db->get()->result_array();
   }

   public function getTindakanPasienJoinAntrian($id)
   {
      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('pasien', 'pasien.no_pasien=antrian_pasien.no_pasien');
      $this->db->join('dokter', 'dokter.kode_dokter=antrian_pasien.id_dokter');
      $this->db->join('tp_catatan', 'tp_catatan.id_antrian=antrian_pasien.id_antrian');
      $this->db->where('antrian_pasien.id_antrian', $id);
      return $this->db->get()->row_array();
   }

   public function editCatatan($whereCatatan, $updateCatatan)
   {
      $this->db->where($whereCatatan);
      $this->db->update('tp_catatan', $updateCatatan);
   }

   public function addTpDiagnosa($dataDiag)
   {
      $this->db->insert_batch('tp_diagnosa', $dataDiag);
   }

   public function addTpTindakan($dataTind)
   {
      $this->db->insert_batch('tp_tindakan', $dataTind);
   }

   public function addTpResep($dataResp)
   {
      $this->db->insert_batch('tp_resep', $dataResp);
   }

   public function editAntrian($whereAntrian, $updateAntrian)
   {
      $this->db->where($whereAntrian);
      $this->db->update('antrian_pasien', $updateAntrian);
   }

   // Data Farmasi
   public function nomorInvoiceFarmasi()
   {
      $this->db->select('RIGHT(tp_pembayaran.no_invoice,3) as no_invoice', FALSE);
      $this->db->order_by('no_invoice', 'DESC');
      $this->db->limit(1);
      $query = $this->db->get('tp_pembayaran');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->no_invoice) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
      $kodetampil = "INV." . date('dmy') . '.' . date('Hi') . '.' . $batas;
      return $kodetampil;
   }

   public function getAllAntrianJoinKtp()
   {
      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('pasien', 'pasien.no_pasien=antrian_pasien.no_pasien');
      $this->db->join('dokter', 'dokter.kode_dokter=antrian_pasien.id_dokter');
      $this->db->where('antrian_pasien.sts_antrian', '2');
      $this->db->order_by('antrian_pasien.id_antrian', 'ASC');
      return $this->db->get()->result_array();
   }

   public function getAllAntrianPembJoinKtp()
   {
      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('pasien', 'pasien.no_pasien=antrian_pasien.no_pasien');
      $this->db->join('dokter', 'dokter.kode_dokter=antrian_pasien.id_dokter');
      $this->db->where('antrian_pasien.sts_antrian', '3');
      $this->db->or_where('antrian_pasien.sts_antrian', '4');
      $this->db->order_by('antrian_pasien.id_antrian', 'DESC');
      return $this->db->get()->result_array();
   }

   public function getAntrianFarmasiJoinById($id)
   {
      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('pasien', 'pasien.no_pasien=antrian_pasien.no_pasien');
      $this->db->join('dokter', 'dokter.kode_dokter=antrian_pasien.id_dokter');
      $this->db->where('antrian_pasien.id_antrian', $id);
      return $this->db->get()->row_array();
   }

   public function getFarmasiResepById($id)
   {
      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('tp_resep', 'tp_resep.id_antrian=antrian_pasien.id_antrian');
      $this->db->join('obat', 'obat.id_obat=tp_resep.id_obat');
      $this->db->where('antrian_pasien.id_antrian', $id);
      return $this->db->get()->result_array();
   }

   public function getFarmasiDiagnosaById($id)
   {
      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('tp_diagnosa', 'tp_diagnosa.no_pasien=antrian_pasien.no_pasien');
      $this->db->join('diagnosa', 'diagnosa.id_diagnosa=tp_diagnosa.id_diagnosa');
      $this->db->where('antrian_pasien.id_antrian', $id);
      return $this->db->get()->result_array();
   }

   public function getFarmasiCatatanById($id)
   {
      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('tp_catatan', 'tp_catatan.id_antrian=antrian_pasien.id_antrian');
      $this->db->where('antrian_pasien.id_antrian', $id);
      return $this->db->get()->row_array();
   }

   public function getFarmasiResepSumById($id)
   {
      $this->db->select_sum('(obat.hg_satuan*tp_resep.quantity_obat)', 'total_resep');
      $this->db->from('antrian_pasien');
      $this->db->join('tp_resep', 'tp_resep.id_antrian=antrian_pasien.id_antrian');
      $this->db->join('obat', 'obat.id_obat=tp_resep.id_obat');
      $this->db->where('antrian_pasien.id_antrian', $id);
      return $this->db->get()->row_array();
   }

   public function getFarmasiTindakanById($id)
   {
      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('tp_tindakan', 'tp_tindakan.id_antrian=antrian_pasien.id_antrian');
      $this->db->join('tindakan', 'tindakan.id_tindakan=tp_tindakan.id_tindakan');
      $this->db->where('antrian_pasien.id_antrian', $id);
      return $this->db->get()->result_array();
   }

   public function getFarmasiTindakanSumById($id)
   {
      $this->db->select_sum('tindakan.hg_tindakan', 'total_tindakan');
      $this->db->from('antrian_pasien');
      $this->db->join('tp_tindakan', 'tp_tindakan.id_antrian=antrian_pasien.id_antrian');
      $this->db->join('tindakan', 'tindakan.id_tindakan=tp_tindakan.id_tindakan');
      $this->db->where('antrian_pasien.id_antrian', $id);
      return $this->db->get()->row_array();
   }

   public function getPembayaranFarmasiJoinById($id)
   {
      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('tp_pembayaran', 'tp_pembayaran.id_antrian=antrian_pasien.id_antrian');
      $this->db->join('diskon', 'diskon.id_diskon=tp_pembayaran.diskon');
      $this->db->where('antrian_pasien.id_antrian', $id);
      return $this->db->get()->row_array();
   }

   // Laporan Rekam Medis
   public function getAllLaporanRM()
   {
      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('pasien', 'pasien.no_pasien=antrian_pasien.no_pasien');
      $this->db->join('dokter', 'dokter.kode_dokter=antrian_pasien.id_dokter');
      $this->db->where('antrian_pasien.sts_antrian', '4');
      $this->db->order_by('antrian_pasien.id_antrian', 'DESC');
      return $this->db->get()->result_array();
   }

   // Laporan Rekam Medis
   public function getAllLaporanRMDK()
   {
      $dokter_id = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
      $ktp = $dokter_id['ktp'];
      $dokter = $this->db->get_where('dokter', ['ktp' => $ktp])->row_array();
      $id_dokter = $dokter['kode_dokter'];

      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('pasien', 'pasien.no_pasien=antrian_pasien.no_pasien');
      $this->db->join('dokter', 'dokter.kode_dokter=antrian_pasien.id_dokter');
      $this->db->where('antrian_pasien.sts_antrian', '4');
      $this->db->where('antrian_pasien.id_dokter', $id_dokter);
      $this->db->order_by('antrian_pasien.id_antrian', 'DESC');
      return $this->db->get()->result_array();
   }

   public function getDiskonBySts()
   {
      $this->db->select('*');
      $this->db->from('diskon');
      $this->db->where('sts_diskon', '1');
      return $this->db->get();
   }

   public function editObatStok($whereObat, $dataObat)
   {
      $this->db->where($whereObat);
      $this->db->update('obat', $dataObat);
   }

   public function editPermintaan($where, $updateAntrian)
   {
      $this->db->where($where);
      $this->db->update('antrian_pasien', $updateAntrian);
   }

   public function addPembayaran($insertTpPembayaran)
   {
      $this->db->insert('tp_pembayaran', $insertTpPembayaran);
   }

   // Data Laporan Komisi Dokter
   public function getKomisiDokter($keyword1, $keyword2, $keyword3)
   {
      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('pasien', 'pasien.no_pasien=antrian_pasien.no_pasien');
      $this->db->join('tp_tindakan', 'tp_tindakan.no_pasien=antrian_pasien.no_pasien');
      $this->db->where('antrian_pasien.tgl_kunjungan >=', $keyword1);
      $this->db->where('antrian_pasien.tgl_kunjungan <=', $keyword2);
      $this->db->where('antrian_pasien.id_dokter', $keyword3);
      $this->db->where('antrian_pasien.sts_antrian', "4");
      return $this->db->get()->result_array();
   }

   // Data Laporan Komisi Dokter Get Total
   public function getThKomisiDokter($keyword3)
   {
      $this->db->select_sum('hg_tp_tindakan', 'total_hg_tindakan');
      $this->db->from('tp_tindakan');
      $this->db->where('id_dokter', $keyword3);
      return $this->db->get()->row_array();
   }

   // Data Laporan Kunjungan
   public function getKunjunganPasien($keyword1, $keyword2)
   {
      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('pasien', 'pasien.no_pasien=antrian_pasien.no_pasien');
      $this->db->where('antrian_pasien.tgl_kunjungan >=', $keyword1);
      $this->db->where('antrian_pasien.tgl_kunjungan <=', $keyword2);
      $this->db->where('antrian_pasien.sts_antrian', "4");
      return $this->db->get()->result_array();
   }

   // Data Laporan Kunjungan Dokter Komisi
   public function getKjPasienDK($keyword1, $keyword2)
   {
      $dokter_id = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
      $ktp = $dokter_id['ktp'];
      $dokter = $this->db->get_where('dokter', ['ktp' => $ktp])->row_array();
      $id_dokter = $dokter['id_dokter'];

      $this->db->select('*');
      $this->db->from('antrian_pasien');
      $this->db->join('pasien', 'pasien.no_pasien=antrian_pasien.no_pasien');
      $this->db->where('antrian_pasien.tgl_kunjungan >=', $keyword1);
      $this->db->where('antrian_pasien.tgl_kunjungan <=', $keyword2);
      $this->db->where('antrian_pasien.id_dokter', $id_dokter);
      $this->db->where('antrian_pasien.sts_antrian', "4");
      return $this->db->get()->result_array();
   }

   // Data Kategori Obat
   public function getAllKategoriObat()
   {
      $this->db->order_by('id_kategori_obat', 'DESC');
      return $this->db->get('kategori_obat')->result_array();
   }

   public function addKategori($insertAkses)
   {
      $this->db->insert('kategori_obat', $insertAkses);
   }

   public function editKategori($where, $updateKategori)
   {
      $this->db->where($where);
      $this->db->update('kategori_obat', $updateKategori);
   }

   public function deletKategori($id)
   {
      $this->db->where('id_kategori_obat', $id);
      $this->db->delete('kategori_obat');
   }

   // Data Diskon
   public function getAllDiskon()
   {
      $this->db->not_like('id_diskon', '0');
      $this->db->order_by('sts_diskon', 'DESC');
      return $this->db->get('diskon')->result_array();
   }

   public function addDiskon($insertDiskon)
   {
      $this->db->insert('diskon', $insertDiskon);
   }

   public function editDiskon($where, $updateDiskon)
   {
      $this->db->where($where);
      $this->db->update('diskon', $updateDiskon);
   }

   public function deletDiskon($id)
   {
      $this->db->where('id_diskon', $id);
      $this->db->delete('diskon');
   }

   // Data Pekerjaan
   public function getAllPekerjaan()
   {
      // $this->db->order_by('id_pekerjaan', 'DESC');
      return $this->db->get('pekerjaan')->result_array();
   }

   public function addPekerjaan($insertPekerjaan)
   {
      $this->db->insert('pekerjaan', $insertPekerjaan);
   }

   public function editPekerjaan($where, $updatePekerjaan)
   {
      $this->db->where($where);
      $this->db->update('pekerjaan', $updatePekerjaan);
   }

   public function deletPekerjaan($id)
   {
      $this->db->where('id_pekerjaan', $id);
      $this->db->delete('pekerjaan');
   }

   // Data Akses
   public function getAllAkses()
   {
      // $this->db->order_by('id_akses', 'DESC');
      return $this->db->get('hak_akses')->result_array();
   }

   // Data Akses Dokter
   public function getAksesDokter()
   {
      $this->db->not_like('kode_akses', '1');
      return $this->db->get('hak_akses')->result_array();
   }

   public function addAkses($insertAkses)
   {
      $this->db->insert('hak_akses', $insertAkses);
   }

   public function editAkses($where, $updateAkses)
   {
      $this->db->where($where);
      $this->db->update('hak_akses', $updateAkses);
   }

   public function deletAkses($id)
   {
      $this->db->where('id_akses', $id);
      $this->db->delete('hak_akses');
   }

   // Data Profil
   public function editProfil($where, $update)
   {
      $this->db->where($where);
      $this->db->update('user', $update);
   }

   public function editBiodata($whereBio, $updateBio)
   {
      $this->db->where($whereBio);
      $this->db->update('user', $updateBio);
   }

   // Data Webs
   public function getWeb()
   {
      return $this->db->get('set_web')->row_array();
   }

   public function editWeb($where, $update)
   {
      $this->db->where($where);
      $this->db->update('set_web', $update);
   }
}
