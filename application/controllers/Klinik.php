<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klinik extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('m_klinik');
   }

   // Page Dashboard
   public function index()
   {
      $data['title'] = 'Authentication';

      $this->form_validation->set_rules('username', 'Username', 'required|trim');
      $this->form_validation->set_rules('password', 'Password', 'required|trim');

      if ($this->form_validation->run() == false) {
         $this->load->view('auth', $data);
      } else {
         $this->_auth();
      }
   }

   private function _auth()
   {
      $username = $this->input->post('username');
      $password = $this->input->post('password');

      $user = $this->db->get_where('user', ['username' => $username])->row_array();

      if ($user) {
         if (password_verify($password, $user['password'])) {
            $data = [
               'id_user' => $user['id_user'],
               'akses_user' => $user['akses']
            ];
            $this->session->set_userdata($data);
            redirect('klinik/dashboard');
         } else {
            $this->session->set_flashdata('msg_pass', '<small class="text-danger">Password salah!!</small>');
            redirect('klinik');
         }
      } else {
         $this->session->set_flashdata('msg_user', '<small class="text-danger">Username tidak terdaftar!!</small>');
         redirect('klinik');
      }
   }

   public function logout()
   {
      $this->session->unset_userdata('id_user');
      $this->session->unset_userdata('akses_user');

      redirect('klinik');
   }

   // Page Dashboard
   public function dashboard()
   {
      $data['title'] = 'Dashboard';
      $data['umur'] = $this->m_klinik->getChartUmur();
      $data['jk'] = $this->m_klinik->getChartJK();
      $data['data_kunjungan'] = $this->m_klinik->getChartKunjungan();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('index', $data);
      $this->load->view('templates/footer');
   }

   // Page Pendaftaran
   public function pendaftaran()
   {
      $data['title'] = 'Pendaftaran';
      $data['data_pekerjaan'] = $this->m_klinik->getAllPekerjaan();
      $data['data_dokter'] = $this->m_klinik->getAllDokter();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $data['nomor_pendaftaran'] = $this->m_klinik->nomorPendaftaran();
      $data['nomor_antrian'] = $this->m_klinik->nomorAntrian();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('pendaftaran_pasien/daftar_awal', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('tambah_data') == 'tambah') {
         $insertPendaftar = [
            'no_pasien' => $this->input->post('no_pasien'),
            'nl_pasien' => $this->input->post('nl_pasien'),
            'tmp_lahir_pasien' => $this->input->post('tmp_lahir_pasien'),
            'tgl_lahir_pasien' => $this->input->post('tgl_lahir_pasien'),
            'jk_pasien' => $this->input->post('jk_pasien'),
            'umur_pasien' => $this->input->post('umur_pasien'),
            'telp_pasien' => $this->input->post('telp_pasien'),
            'email_pasien' => $this->input->post('email_pasien'),
            'kontak_lain' => $this->input->post('kontak_lain'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'alamat' => $this->input->post('alamat'),
            'jenis_layanan' => $this->input->post('jenis_layanan'),
            'gol_darah' => $this->input->post('gol_darah'),
            'change_pasien' => $this->input->post('change_pasien')
         ];
         $insertAntrian = [
            'id_dokter' => $this->input->post('id_dokter'),
            'no_pendaftaran' => $this->input->post('no_pendaftaran'),
            'no_pasien' => $this->input->post('no_pasien'),
            'no_antrian' => $this->input->post('no_antrian'),
            'sts_antrian' => 1,
            'tgl_kunjungan' => $this->input->post('tgl_kunjungan'),
            'waktu_kunjungan' => $this->input->post('waktu_kunjungan')
         ];

         $this->m_klinik->addPasien($insertPendaftar, 'pasien');
         $this->m_klinik->addAntrianPasien($insertAntrian, 'antrian_pasien');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Pasien telah masuk ke daftar antrian..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/riwayat_penyakit/' . $this->input->post('no_pendaftaran'));
      }
   }

   public function pasien_terdaftar()
   {
      $data['title'] = 'Pendaftaran';
      $data['data_dokter'] = $this->m_klinik->getAllDokter();
      $data['data_pasien'] = $this->m_klinik->getAllPasien();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $data['nomor_pendaftaran'] = $this->m_klinik->nomorPendaftaran();
      $data['nomor_antrian'] = $this->m_klinik->nomorAntrian();

      if ($this->input->post('cari') == 'search') {
         $keyword = $this->input->post('keyword');

         if ($this->db->get_where('pasien', ['no_pasien' => $keyword])->num_rows() == 0) {
            $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Maaf !",text: "Data yang anda cari tidak ditemukan!!",position: "top-right",loaderBg: "#fff",icon: "error",hideAfter: 10000,stack: 1});});');
            redirect('klinik/pasien_terdaftar');
         } else {
            $data['pasien_search'] = $this->m_klinik->getCariPasien($keyword);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/page', $data);
            $this->load->view('pendaftaran_pasien/terdaftar', $data);
            $this->load->view('templates/footer');
         }
      } else {
         $this->load->view('templates/header', $data);
         $this->load->view('templates/sidebar', $data);
         $this->load->view('templates/page', $data);
         $this->load->view('pendaftaran_pasien/terdaftar', $data);
         $this->load->view('templates/footer');
      }

      if ($this->input->post('tambah_data') == 'tambah') {
         $insertAntrian = [
            'id_dokter' => $this->input->post('id_dokter'),
            'no_pendaftaran' => $this->input->post('no_pendaftaran'),
            'no_pasien' => $this->input->post('no_pasien'),
            'no_antrian' => $this->input->post('no_antrian'),
            'sts_antrian' => 1,
            'tgl_kunjungan' => $this->input->post('tgl_kunjungan'),
            'waktu_kunjungan' => $this->input->post('waktu_kunjungan')
         ];

         $this->m_klinik->addAntrianPasien($insertAntrian, 'antrian_pasien');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Pasien telah masuk ke daftar antrian..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/riwayat_penyakit/' . $this->input->post('no_pendaftaran'));
      }
   }

   public function pembatalan()
   {
      $data['title'] = 'Pendaftaran';
      $data['data_antrian'] = $this->m_klinik->getAllPasienJoinKtp();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('pendaftaran_pasien/pembatalan', $data);
      $this->load->view('templates/footer');
   }

   public function batal_antrian($id)
   {
      $this->m_klinik->pembatalanAntrian($id);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Antrian telah dibatalkan..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('klinik/pembatalan');
   }

   public function riwayat_penyakit($id)
   {
      $data['title'] = 'Pendaftaran';
      $data['pasien'] = $this->m_klinik->getAntrianSetJoinPasien($id);
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('pendaftaran_pasien/riwayat_penyakit', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('tambah_data') == 'tambah') {
         $insertCtt = [
            'id_dokter' => $this->input->post('id_dokter'),
            'id_antrian' => $this->input->post('id_antrian'),
            'no_pasien' => $this->input->post('no_pasien'),
            'riwayat_penyakit' => $this->input->post('riwayat_penyakit'),
            'riwayat_alergi' => $this->input->post('riwayat_alergi'),
            'berat_badan' => $this->input->post('berat_badan'),
            'tinggi_badan' => $this->input->post('tinggi_badan'),
            'tekanan_darah' => $this->input->post('tekanan_darah'),
            'gol_darah' => $this->input->post('gol_darah'),
            'change_catatan' => $this->input->post('change_catatan')
         ];

         $this->m_klinik->addCtt($insertCtt, 'tp_catatan');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Riwayat penyakit pasien telah diinput..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/antrian_set/' . $id);
      }
   }

   public function antrian_set($id)
   {
      $data['title'] = 'Pendaftaran';
      $data['pasien'] = $this->m_klinik->getAntrianSetJoinPasien($id);
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('pendaftaran_pasien/cetak_antrian', $data);
      $this->load->view('templates/footer');
   }

   // Page Master Pasien
   public function pasien()
   {
      $data['title'] = 'Master';
      $data['data_pasien'] = $this->m_klinik->getAllPasien();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('pendaftaran_pasien/pasien', $data);
      $this->load->view('templates/footer');
   }

   public function detail_pasien($id)
   {
      $data['title'] = 'Master';
      $data['pasien'] = $this->m_klinik->getPasienByKTP($id);
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('pendaftaran_pasien/detail', $data);
      $this->load->view('templates/footer');
   }

   public function update_pasien($id)
   {
      $data['title'] = 'Master';
      $data['data_pekerjaan'] = $this->m_klinik->getAllPekerjaan();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $data['pasien'] = $this->m_klinik->getPasienById($id);

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('pendaftaran_pasien/update', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('ubah_data') == 'ubah') {

         $id_pasien = $this->input->post('id_pasien');

         $updatePasien = [
            'no_pasien' => $this->input->post('no_pasien'),
            'nl_pasien' => $this->input->post('nl_pasien'),
            'tmp_lahir_pasien' => $this->input->post('tmp_lahir_pasien'),
            'tgl_lahir_pasien' => $this->input->post('tgl_lahir_pasien'),
            'jk_pasien' => $this->input->post('jk_pasien'),
            'umur_pasien' => $this->input->post('umur_pasien'),
            'telp_pasien' => $this->input->post('telp_pasien'),
            'email_pasien' => $this->input->post('email_pasien'),
            'kontak_lain' => $this->input->post('kontak_lain'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'alamat' => $this->input->post('alamat'),
            'gol_darah' => $this->input->post('gol_darah'),
            'change_pasien' => $this->input->post('change_pasien')
         ];

         $where = array(
            "id_pasien" => $id_pasien
         );

         $this->m_klinik->editPasien($where, $updatePasien, 'pasien');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/pasien');
      }
   }

   public function hapus_pasien($id)
   {
      $this->m_klinik->deletePasien($id);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('klinik/pasien');
   }

   // Page Master Dokter
   public function dokter()
   {
      $data['title'] = 'Master';
      $data['data_dokter'] = $this->m_klinik->getAllDokter();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('dokter/index', $data);
      $this->load->view('templates/footer');
   }

   public function detail_dokter($id)
   {
      $data['title'] = 'Master';
      $data['dokter'] = $this->m_klinik->getDokterJoinKtp($id);
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('dokter/detail', $data);
      $this->load->view('templates/footer');
   }

   public function tambah_dokter()
   {
      $data['title'] = 'Master';
      $data['data_hak_akses'] = $this->m_klinik->getAksesDokter();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $data['kode'] = $this->m_klinik->kodeDokter();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('dokter/add', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('tambah_data') == 'tambah') {
         $insertDokter = [
            'kode_dokter' => $this->input->post('kode_dokter'),
            'ktp' => $this->input->post('ktp'),
            'nm_depan' => $this->input->post('nm_depan'),
            'nm_belakang' => $this->input->post('nm_belakang'),
            'gl_depan' => $this->input->post('gl_depan'),
            'gl_belakang' => $this->input->post('gl_belakang'),
            'tmp_lahir' => $this->input->post('tmp_lahir'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'agama' => $this->input->post('agama'),
            'jk' => $this->input->post('jk'),
            'sip' => $this->input->post('sip'),
            'spesialis' => $this->input->post('spesialis'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'email' => $this->input->post('email')
         ];

         $foto_user = $_FILES['foto_user'];
         if ($foto_user) {
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'jpg|png|gif';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_user')) {
               $foto_user = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         }

         $insertUser = [
            'ktp' => $this->input->post('ktp'),
            'nm_depan' => $this->input->post('nm_depan'),
            'nm_belakang' => $this->input->post('nm_belakang'),
            'telepon' => $this->input->post('telepon'),
            'email' => $this->input->post('email'),
            'foto_user' => $foto_user,
            'username' => $this->input->post('username'),
            'password' =>  password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
            'akses' => $this->input->post('akses'),
            'change_user' => $this->input->post('change_user')
         ];

         $this->m_klinik->addDokter($insertDokter, 'dokter');
         $this->m_klinik->addUser($insertUser, 'user');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/dokter');
      }
   }

   public function update_dokter($id)
   {
      $data['title'] = 'Master';
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $data['dokter'] = $this->m_klinik->getDokterJoinKtp($id);

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('dokter/update', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('ubah_data') == 'ubah') {

         $id_dokter = $this->input->post('id_dokter');
         $id_user = $this->input->post('id_user');
         $old_image = $this->input->post('old_image');
         $foto_user = $_FILES['foto_user'];

         $updateDokter = [
            'ktp' => $this->input->post('ktp'),
            'nm_depan' => $this->input->post('nm_depan'),
            'nm_belakang' => $this->input->post('nm_belakang'),
            'gl_depan' => $this->input->post('gl_depan'),
            'gl_belakang' => $this->input->post('gl_belakang'),
            'tmp_lahir' => $this->input->post('tmp_lahir'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'agama' => $this->input->post('agama'),
            'jk' => $this->input->post('jk'),
            'sip' => $this->input->post('sip'),
            'spesialis' => $this->input->post('spesialis'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'email' => $this->input->post('email')
         ];

         $whereDokter = array(
            "id_dokter" => $id_dokter
         );

         if ($this->input->post('pass') != '') {

            if ($this->input->post('ubah_gambar')) {
               if ($old_image != 'default.jpg') {
                  unlink(FCPATH . 'assets/upload/' . $old_image);
               }

               $config['upload_path'] = './assets/upload/';
               $config['allowed_types'] = 'jpg|png|gif';
               $config['remove_space'] = TRUE;

               $this->load->library('upload', $config);

               if ($this->upload->do_upload('foto_user')) {
                  $foto_user = $this->upload->data('file_name');
               } else {
                  echo "Upload Gagal!!";
                  die();
               }

               $updateUser = [
                  'ktp' => $this->input->post('ktp'),
                  'nm_depan' => $this->input->post('nm_depan'),
                  'nm_belakang' => $this->input->post('nm_belakang'),
                  'telepon' => $this->input->post('telepon'),
                  'email' => $this->input->post('email'),
                  'foto_user' => $foto_user,
                  'username' => $this->input->post('username'),
                  'password' =>  password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
                  'change_user' => $this->input->post('change_user')
               ];

               $whereUser = array(
                  "id_user" => $id_user
               );
            } else {
               $updateUser = [
                  'ktp' => $this->input->post('ktp'),
                  'nm_depan' => $this->input->post('nm_depan'),
                  'nm_belakang' => $this->input->post('nm_belakang'),
                  'telepon' => $this->input->post('telepon'),
                  'email' => $this->input->post('email'),
                  'username' => $this->input->post('username'),
                  'password' =>  password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
                  'change_user' => $this->input->post('change_user')
               ];

               $whereUser = array(
                  "id_user" => $id_user
               );
            }
         } else {
            if ($this->input->post('ubah_gambar')) {
               if ($old_image != 'default.jpg') {
                  unlink(FCPATH . 'assets/upload/' . $old_image);
               }

               $config['upload_path'] = './assets/upload/';
               $config['allowed_types'] = 'jpg|png|gif';
               $config['remove_space'] = TRUE;

               $this->load->library('upload', $config);

               if ($this->upload->do_upload('foto_user')) {
                  $foto_user = $this->upload->data('file_name');
               } else {
                  echo "Upload Gagal!!";
                  die();
               }

               $updateUser = [
                  'ktp' => $this->input->post('ktp'),
                  'nm_depan' => $this->input->post('nm_depan'),
                  'nm_belakang' => $this->input->post('nm_belakang'),
                  'telepon' => $this->input->post('telepon'),
                  'email' => $this->input->post('email'),
                  'foto_user' => $foto_user,
                  'username' => $this->input->post('username'),
                  'change_user' => $this->input->post('change_user')
               ];

               $whereUser = array(
                  "id_user" => $id_user
               );
            } else {
               $updateUser = [
                  'ktp' => $this->input->post('ktp'),
                  'nm_depan' => $this->input->post('nm_depan'),
                  'nm_belakang' => $this->input->post('nm_belakang'),
                  'telepon' => $this->input->post('telepon'),
                  'email' => $this->input->post('email'),
                  'username' => $this->input->post('username'),
                  'change_user' => $this->input->post('change_user')
               ];

               $whereUser = array(
                  "id_user" => $id_user
               );
            }
         }

         $this->m_klinik->editDokter($whereDokter, $updateDokter, 'dokter');
         $this->m_klinik->editUser($whereUser, $updateUser, 'user');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         if ($this->session->userdata('akses_user') == "1") {
            redirect('klinik/dokter');
         } elseif ($this->session->userdata('akses_user') == "2") {
            redirect('klinik/profil');
         } elseif ($this->session->userdata('akses_user') == "3") {
            redirect('klinik/profil');
         }
      }
   }

   public function hapus_dokter($id)
   {
      $data['data_dokter'] = $this->m_klinik->getAllDokter();

      $old_image = $data['user']['foto_user'];
      if ($old_image != 'default.jpg') {
         unlink(FCPATH . 'assets/upload/' . $old_image);
      }

      $this->m_klinik->deleteDokter($id);
      $this->m_klinik->deleteUser($id);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('klinik/dokter');
   }

   // Page Master Tindakan Set
   public function tindakan_set()
   {
      $data['title'] = 'Master';
      $data['data_tindakan'] = $this->m_klinik->getAllTindakan();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('tindakan', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('tambah_data') == 'tambah') {
         $insertTindakan = [
            'nm_tindakan' => $this->input->post('nm_tindakan'),
            'hg_tindakan' => $this->input->post('hg_tindakan'),
            'km_tindakan' => $this->input->post('km_tindakan')
         ];

         $this->m_klinik->addTindakan($insertTindakan, 'tindakan');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/tindakan_set');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_tindakan = $this->input->post('id_tindakan');

         $updateTindakan = [
            'nm_tindakan' => $this->input->post('nm_tindakan'),
            'hg_tindakan' => $this->input->post('hg_tindakan'),
            'km_tindakan' => $this->input->post('km_tindakan')
         ];

         $where = array(
            "id_tindakan" => $id_tindakan
         );

         $this->m_klinik->editTindakan($where, $updateTindakan, 'tindakan');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/tindakan_set');
      }
   }

   public function hapus_tindakan_set($id)
   {
      $this->m_klinik->deletTindakanSet($id);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('klinik/tindakan_set');
   }

   // Page Master Tindakan Set
   public function diagnosa_set()
   {
      $data['title'] = 'Master';
      $data['data_diagnosa'] = $this->m_klinik->getAllDiagnosaSet();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('diagnosa', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('tambah_data') == 'tambah') {
         $insertDiagnosa = [
            'kode_icd' => $this->input->post('kode_icd'),
            'icd' => $this->input->post('icd'),
            'diagnosa' => $this->input->post('diagnosa')
         ];

         $this->m_klinik->addDiagnosaSet($insertDiagnosa, 'diagnosa');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/diagnosa_set');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_diagnosa = $this->input->post('id_diagnosa');

         $updateDiagnosa = [
            'kode_icd' => $this->input->post('kode_icd'),
            'icd' => $this->input->post('icd'),
            'diagnosa' => $this->input->post('diagnosa')
         ];

         $where = array(
            "id_diagnosa" => $id_diagnosa
         );

         $this->m_klinik->editDiagnosaSet($where, $updateDiagnosa, 'diagnosa');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/diagnosa_set');
      }
   }

   public function hapus_diagnosa_set($id)
   {
      $this->m_klinik->deletDiagnosaSet($id);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('klinik/diagnosa_set');
   }

   // Page Master Tindakan Set
   public function obat()
   {
      $data['title'] = 'Master';
      $data['data_obat'] = $this->m_klinik->getAllObat();
      $data['data_ko'] = $this->m_klinik->getAllKategoriObat();
      $data['data_supplier'] = $this->m_klinik->getAllSupplier();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('obat', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('tambah_data') == 'tambah') {
         $insertObat = [
            'kode_obat' => $this->input->post('kode_obat'),
            'nm_obat' => $this->input->post('nm_obat'),
            'satuan' => $this->input->post('satuan'),
            'kategori_obat' => $this->input->post('kategori_obat'),
            'stok' => $this->input->post('stok'),
            'penyuplai' => $this->input->post('penyuplai'),
            'hg_satuan' => $this->input->post('hg_satuan'),
            'change_obat' => $this->input->post('change_obat')
         ];

         $this->m_klinik->addObat($insertObat, 'obat');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/obat');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_obat = $this->input->post('id_obat');

         $updateObat = [
            'kode_obat' => $this->input->post('kode_obat'),
            'nm_obat' => $this->input->post('nm_obat'),
            'satuan' => $this->input->post('satuan'),
            'kategori_obat' => $this->input->post('kategori_obat'),
            'stok' => $this->input->post('stok'),
            'penyuplai' => $this->input->post('penyuplai'),
            'hg_satuan' => $this->input->post('hg_satuan'),
            'change_obat' => $this->input->post('change_obat')
         ];

         $where = array(
            "id_obat" => $id_obat
         );

         $this->m_klinik->editObat($where, $updateObat, 'obat');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/obat');
      }
   }

   public function hapus_obat($id)
   {
      $this->m_klinik->deletObat($id);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('klinik/obat');
   }

   // Page Master Supplier
   public function supplier()
   {
      $data['title'] = 'Master';
      $data['data_supplier'] = $this->m_klinik->getAllSupplier();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('supplier', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('tambah_data') == 'tambah') {
         $insertSupplier = [
            'nm_suplier' => $this->input->post('nm_suplier'),
            'alamat_suplier' => $this->input->post('alamat_suplier'),
            'telp_suplier' => $this->input->post('telp_suplier'),
            'fax_suplier' => $this->input->post('fax_suplier'),
            'email_suplier' => $this->input->post('email_suplier'),
            'web_suplier' => $this->input->post('web_suplier'),
            'change_suplier' => $this->input->post('change_suplier')
         ];

         $this->m_klinik->addSupplier($insertSupplier, 'suplier');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/supplier');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_suplier = $this->input->post('id_suplier');

         $updateSupplier = [
            'nm_suplier' => $this->input->post('nm_suplier'),
            'alamat_suplier' => $this->input->post('alamat_suplier'),
            'telp_suplier' => $this->input->post('telp_suplier'),
            'fax_suplier' => $this->input->post('fax_suplier'),
            'email_suplier' => $this->input->post('email_suplier'),
            'web_suplier' => $this->input->post('web_suplier'),
            'change_suplier' => $this->input->post('change_suplier')
         ];

         $where = array(
            "id_suplier" => $id_suplier
         );

         $this->m_klinik->editSupplier($where, $updateSupplier, 'supplier');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/supplier');
      }
   }

   public function hapus_supplier($id)
   {
      $this->m_klinik->deletSupplier($id);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('klinik/supplier');
   }

   // Page Master User
   public function user()
   {
      $data['title'] = 'User';
      $data['data_user'] = $this->m_klinik->getAllUser();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('user/index', $data);
      $this->load->view('templates/footer');
   }

   public function detail_user($id)
   {
      $data['title'] = 'User';
      $data['user_set'] = $this->m_klinik->getUserByAkses($id);
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('user/detail', $data);
      $this->load->view('templates/footer');
   }

   public function tambah_user()
   {
      $data['title'] = 'User';
      $data['data_hak_akses'] = $this->m_klinik->getAllAkses();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('user/add', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('tambah_data') == 'tambah') {
         $foto_user = $_FILES['foto_user'];
         if ($foto_user) {
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'jpg|png|gif';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_user')) {
               $foto_user = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         }

         $insertUser = [
            'ktp' => $this->input->post('ktp'),
            'nm_depan' => $this->input->post('nm_depan'),
            'nm_belakang' => $this->input->post('nm_belakang'),
            'telepon' => $this->input->post('telepon'),
            'email' => $this->input->post('email'),
            'foto_user' => $foto_user,
            'username' => $this->input->post('username'),
            'password' =>  password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
            'akses' => $this->input->post('akses'),
            'change_user' => $this->input->post('change_user')
         ];
         $this->m_klinik->addUser($insertUser, 'user');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/user');
      }
   }

   public function update_user($id)
   {
      $data['title'] = 'User';
      $data['data_hak_akses'] = $this->m_klinik->getAllAkses();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $data['user_set'] = $this->m_klinik->getUserById($id);

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('user/update', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_user = $this->input->post('id_user');
         $old_image = $this->input->post('old_image');
         $foto_user = $_FILES['foto_user'];

         if ($this->input->post('pass') != '') {

            if ($this->input->post('ubah_gambar')) {
               if ($old_image != 'default.jpg') {
                  unlink(FCPATH . 'assets/upload/' . $old_image);
               }

               $config['upload_path'] = './assets/upload/';
               $config['allowed_types'] = 'jpg|png|gif';
               $config['remove_space'] = TRUE;

               $this->load->library('upload', $config);

               if ($this->upload->do_upload('foto_user')) {
                  $foto_user = $this->upload->data('file_name');
               } else {
                  echo "Upload Gagal!!";
                  die();
               }

               $updateUser = [
                  'ktp' => $this->input->post('ktp'),
                  'nm_depan' => $this->input->post('nm_depan'),
                  'nm_belakang' => $this->input->post('nm_belakang'),
                  'telepon' => $this->input->post('telepon'),
                  'email' => $this->input->post('email'),
                  'foto_user' => $foto_user,
                  'username' => $this->input->post('username'),
                  'password' =>  password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
                  'akses' =>  $this->input->post('hak'),
                  'change_user' => $this->input->post('change_user')
               ];

               $whereUser = array(
                  "id_user" => $id_user
               );
            } else {
               $updateUser = [
                  'ktp' => $this->input->post('ktp'),
                  'nm_depan' => $this->input->post('nm_depan'),
                  'nm_belakang' => $this->input->post('nm_belakang'),
                  'telepon' => $this->input->post('telepon'),
                  'email' => $this->input->post('email'),
                  'username' => $this->input->post('username'),
                  'password' =>  password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
                  'akses' =>  $this->input->post('hak'),
                  'change_user' => $this->input->post('change_user')
               ];

               $whereUser = array(
                  "id_user" => $id_user
               );
            }
         } else {
            if ($this->input->post('ubah_gambar')) {
               if ($old_image != 'default.jpg') {
                  unlink(FCPATH . 'assets/upload/' . $old_image);
               }

               $config['upload_path'] = './assets/upload/';
               $config['allowed_types'] = 'jpg|png|gif';
               $config['remove_space'] = TRUE;

               $this->load->library('upload', $config);

               if ($this->upload->do_upload('foto_user')) {
                  $foto_user = $this->upload->data('file_name');
               } else {
                  echo "Upload Gagal!!";
                  die();
               }

               $updateUser = [
                  'ktp' => $this->input->post('ktp'),
                  'nm_depan' => $this->input->post('nm_depan'),
                  'nm_belakang' => $this->input->post('nm_belakang'),
                  'telepon' => $this->input->post('telepon'),
                  'email' => $this->input->post('email'),
                  'foto_user' => $foto_user,
                  'username' => $this->input->post('username'),
                  'akses' =>  $this->input->post('hak'),
                  'change_user' => $this->input->post('change_user')
               ];

               $whereUser = array(
                  "id_user" => $id_user
               );
            } else {
               $updateUser = [
                  'ktp' => $this->input->post('ktp'),
                  'nm_depan' => $this->input->post('nm_depan'),
                  'nm_belakang' => $this->input->post('nm_belakang'),
                  'telepon' => $this->input->post('telepon'),
                  'email' => $this->input->post('email'),
                  'username' => $this->input->post('username'),
                  'akses' =>  $this->input->post('hak'),
                  'change_user' => $this->input->post('change_user')
               ];

               $whereUser = array(
                  "id_user" => $id_user
               );
            }
         }

         $this->m_klinik->editUser($whereUser, $updateUser, 'user');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/user');
      }
   }

   public function hapus_user($id)
   {
      $data['data_user'] = $this->m_klinik->getAllUser();

      $old_image = $data['user']['foto_user'];
      if ($old_image != 'default.jpg') {
         unlink(FCPATH . 'assets/upload/' . $old_image);
      }

      $this->m_klinik->deleteUser($id);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('klinik/user');
   }

   // Page Tindakan
   public function tindakan_pasien()
   {
      $data['title'] = 'Tindakan';
      $data['data_pasien'] = $this->m_klinik->getAllTindakanPasien();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('tindakan/index', $data);
      $this->load->view('templates/footer');
   }

   public function catatan_tindakan_pasien($id)
   {
      $data['title'] = 'Tindakan';
      $data['pasien'] = $this->m_klinik->getTindakanPasienJoinAntrian($id);
      $data['data_diagnosa'] = $this->m_klinik->getAllDiagnosaSet();
      $data['data_tindakan'] = $this->m_klinik->getAllTindakan();
      $data['data_obat'] = $this->m_klinik->getAllObat();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('tindakan/catatan_tindakan', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('tambah_data') == 'tambah') {
         $updateCatatan = [
            'catatan_dokter' => $this->input->post('catatan_dokter'),
            'change_catatan' => $this->input->post('change_catatan')
         ];

         $whereCatatan = array(
            'id_tp_catatan' => $this->input->post('id_tp_catatan')
         );

         $jumlahDiag = $this->input->post('id_diagnosa');
         $dataDiag = array();

         $indexDiag = 0;
         foreach ($jumlahDiag as $id_diagnosa) {
            array_push($dataDiag, array(
               'id_diagnosa' => $id_diagnosa,
               'id_dokter' => $this->input->post('id_dokter'),
               'id_antrian' => $this->input->post('id_antrian'),
               'no_pasien' => $this->input->post('no_pasien'),
               'ket_diagnosa' => $this->input->post('ket_diagnosa')[$indexDiag],
               'change_diagnosa' => $this->input->post('change_diagnosa')
            ));

            $indexDiag++;
         }

         $jumlahTind = $this->input->post('id_tindakan');
         $dataTind = array();

         $indexTind = 0;
         foreach ($jumlahTind as $id_tindakan) {
            $hg_tind = $this->db->get_where('tindakan', ['id_tindakan' => $id_tindakan])->row_array();
            array_push($dataTind, array(
               'id_tindakan' => $id_tindakan,
               'id_dokter' => $this->input->post('id_dokter'),
               'id_antrian' => $this->input->post('id_antrian'),
               'no_pasien' => $this->input->post('no_pasien'),
               'ket_tindakan' => $this->input->post('ket_tindakan')[$indexTind],
               'hg_tp_tindakan' => $hg_tind['km_tindakan'],
               'change_tindakan' => $this->input->post('change_tindakan')
            ));

            $indexTind++;
         }

         $jumlahResp = $this->input->post('id_obat');
         $dataResp = array();

         $indexResp = 0;
         foreach ($jumlahResp as $id_obat) {
            array_push($dataResp, array(
               'id_obat' => $id_obat,
               'id_dokter' => $this->input->post('id_dokter'),
               'id_antrian' => $this->input->post('id_antrian'),
               'no_pasien' => $this->input->post('no_pasien'),
               'quantity_obat' => $this->input->post('quantity_obat')[$indexResp],
               'aturan_pakai' => $this->input->post('aturan_pakai')[$indexResp],
               'change_resep' => $this->input->post('change_resep')
            ));

            $indexResp++;
         }

         $updateAntrian = [
            'sts_antrian' => 2
         ];

         $whereAntrian = array(
            'id_antrian' => $this->input->post('id_antrian')
         );

         $this->m_klinik->editAntrian($whereAntrian, $updateAntrian, 'antrian_pasien');
         $this->m_klinik->editCatatan($whereCatatan, $updateCatatan, 'tp_catatan');
         $this->m_klinik->addTpDiagnosa($dataDiag, 'tp_diagnosa');
         $this->m_klinik->addTpTindakan($dataTind, 'tp_tindakan');
         $this->m_klinik->addTpResep($dataResp, 'tp_resep');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Pasien telah diperiksa..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/tindakan_pasien');
      }
   }

   // Page Farmasi
   public function antrian_farmasi()
   {
      $data['title'] = 'Farmasi';
      $data['data_antrian'] = $this->m_klinik->getAllAntrianJoinKtp();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      // Data Hitung
      $data['belum_proses'] = $this->db->get_where('antrian_pasien', ['sts_antrian' => 1])->num_rows();
      $data['dalam_proses'] = $this->db->get_where('antrian_pasien', ['sts_antrian' => 3])->num_rows();
      $data['selesai'] = $this->db->get_where('antrian_pasien', ['sts_antrian' => 4])->num_rows();
      $data['batal'] = $this->db->get_where('antrian_pasien', ['sts_antrian' => 5])->num_rows();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('farmasi/antrian_farmasi', $data);
      $this->load->view('templates/footer');
   }

   public function permintaan($id)
   {
      $data['title'] = 'Farmasi';
      $data['antrian_pasien'] = $this->m_klinik->getAntrianFarmasiJoinById($id);
      $data['data_resep'] = $this->m_klinik->getFarmasiResepById($id);
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('farmasi/permintaan_farmasi', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('ubah_data') == 'ubah') {

         $id_obat = $this->input->post('id_obat');
         $jumObat = count($id_obat);
         for ($i = 0; $i < $jumObat; $i++) {
            $updateObat = [
               'stok' => $this->input->post('sisa_stok')[$i]
            ];

            $whereObat = array(
               "id_obat" => $this->input->post('id_obat')[$i]
            );

            $this->m_klinik->editObatStok($whereObat, $updateObat, 'obat');
         }

         $id_antrian = $this->input->post('id_antrian');

         $updateAntrian = [
            'sts_antrian' => $this->input->post('sts_antrian'),
            'tgl_farmasi' => $this->input->post('tgl_farmasi')
         ];

         $where = array(
            "id_antrian" => $id_antrian
         );

         $this->m_klinik->editPermintaan($where, $updateAntrian, 'antrian_pasien');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Permintaan selesai..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/permintaan/' . $id_antrian);
      }
   }

   public function pembayaran()
   {
      $data['title'] = 'Farmasi';
      $data['data_antrian'] = $this->m_klinik->getAllAntrianPembJoinKtp();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('farmasi/pembayaran', $data);
      $this->load->view('templates/footer');
   }

   public function input_pembayaran($id)
   {
      $data['title'] = 'Farmasi';
      $data['antrian_pasien'] = $this->m_klinik->getAntrianFarmasiJoinById($id);
      $data['data_tindakan'] = $this->m_klinik->getFarmasiTindakanById($id);
      $data['data_resep'] = $this->m_klinik->getFarmasiResepById($id);
      $data['harga_resep'] = $this->m_klinik->getFarmasiResepSumById($id);
      $data['harga_tindakan'] = $this->m_klinik->getFarmasiTindakanSumById($id);
      $data['diskon'] = $this->m_klinik->getDiskonBySts();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $data['nomor_invoice'] = $this->m_klinik->nomorInvoiceFarmasi();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('farmasi/jumlah_bayar', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_antrian = $this->input->post('id_antrian');

         $insertTpPembayaran = [
            'no_invoice' => $this->input->post('no_invoice'),
            'id_dokter' => $this->input->post('id_dokter'),
            'id_antrian' => $this->input->post('id_antrian'),
            'no_pasien' => $this->input->post('no_pasien'),
            'jumlah_bayar' => $this->input->post('jumlah_bayar'),
            'diskon' => $this->input->post('diskon'),
            'total_harga' => $this->input->post('total_harga'),
            'tgl_pembayaran' => $this->input->post('tgl_pembayaran'),
            'waktu_bayar' => $this->input->post('waktu_bayar')
         ];

         $updateAntrian = [
            'sts_antrian' => $this->input->post('sts_antrian')
         ];

         $where = array(
            "id_antrian" => $id_antrian
         );

         $this->m_klinik->addPembayaran($insertTpPembayaran, 'tp_pembayaran');
         $this->m_klinik->editPermintaan($where, $updateAntrian, 'antrian_pasien');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Pasien telah melakukan pembayaran. Silahkan Cetak invoice jika diperlukan..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/invoice/' . $id_antrian);
      }
   }

   public function invoice($id)
   {
      $data['title'] = 'Farmasi';
      $data['antrian_pasien'] = $this->m_klinik->getAntrianFarmasiJoinById($id);
      $data['pembayaran'] = $this->m_klinik->getPembayaranFarmasiJoinById($id);
      $data['data_tindakan'] = $this->m_klinik->getFarmasiTindakanById($id);
      $data['data_resep'] = $this->m_klinik->getFarmasiResepById($id);
      $data['harga_resep'] = $this->m_klinik->getFarmasiResepSumById($id);
      $data['harga_tindakan'] = $this->m_klinik->getFarmasiTindakanSumById($id);
      $data['live'] = $this->db->get_where('pasien', ['no_pasien' => $data['antrian_pasien']['no_pasien']])->row_array();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('farmasi/invoice', $data);
      $this->load->view('templates/footer');
   }

   // Page Laporan Rekam Medis
   public function rekam_medis()
   {
      $data['title'] = 'Laporan';
      $data['data_antrian'] = $this->m_klinik->getAllLaporanRM();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('laporan/rekam_medis', $data);
      $this->load->view('templates/footer');
   }

   // Page Laporan Rekam Medis Dokter Komisi
   public function rm_pasien()
   {
      $data['title'] = 'Laporan';
      $data['data_antrian'] = $this->m_klinik->getAllLaporanRMDK();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('laporan/rm', $data);
      $this->load->view('templates/footer');
   }

   // Page Laporan Komisi Dokter
   public function komisi()
   {
      $data['title'] = 'Laporan';
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      if ($this->input->post('cari') == 'search') {
         $keyword1 = $this->input->post('keyword1');
         $keyword2 = $this->input->post('keyword2');
         $keyword3 = $this->input->post('keyword3');
         $data['data_komisi'] = $this->m_klinik->getKomisiDokter($keyword1, $keyword2, $keyword3);
         $data['hg_komisi'] = $this->m_klinik->getThKomisiDokter($keyword3);
         $data['per_awal'] = $keyword1;
         $data['per_akhir'] = $keyword2;

         $this->load->view('templates/header', $data);
         $this->load->view('templates/sidebar', $data);
         $this->load->view('templates/page', $data);
         $this->load->view('laporan/komisi_dokter', $data);
         $this->load->view('templates/footer');
      } else {
         $data['data_dokter'] = $this->m_klinik->getAllDokter();
         $this->load->view('templates/header', $data);
         $this->load->view('templates/sidebar', $data);
         $this->load->view('templates/page', $data);
         $this->load->view('laporan/komisi_dokter', $data);
         $this->load->view('templates/footer');
      }
   }

   // Page Laporan Kunjungan
   public function kunjungan()
   {
      $data['title'] = 'Laporan';
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      if ($this->input->post('cari') == 'search') {
         $keyword1 = $this->input->post('keyword1');
         $keyword2 = $this->input->post('keyword2');
         $data['data_kunjungan'] = $this->m_klinik->getKunjunganPasien($keyword1, $keyword2);
         $data['per_awal'] = $keyword1;
         $data['per_akhir'] = $keyword2;

         $this->load->view('templates/header', $data);
         $this->load->view('templates/sidebar', $data);
         $this->load->view('templates/page', $data);
         $this->load->view('laporan/kunjungan', $data);
         $this->load->view('templates/footer');
      } else {
         $this->load->view('templates/header', $data);
         $this->load->view('templates/sidebar', $data);
         $this->load->view('templates/page', $data);
         $this->load->view('laporan/kunjungan');
         $this->load->view('templates/footer');
      }
   }

   // Page Laporan Kunjungan Dokter Komisi
   public function kj_pasien()
   {
      $data['title'] = 'Laporan';
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      if ($this->input->post('cari') == 'search') {
         $keyword1 = $this->input->post('keyword1');
         $keyword2 = $this->input->post('keyword2');
         $data['data_kunjungan'] = $this->m_klinik->getKjPasienDK($keyword1, $keyword2);
         $data['per_awal'] = $keyword1;
         $data['per_akhir'] = $keyword2;

         $this->load->view('templates/header', $data);
         $this->load->view('templates/sidebar', $data);
         $this->load->view('templates/page', $data);
         $this->load->view('laporan/kunjungan_pasien', $data);
         $this->load->view('templates/footer');
      } else {
         $this->load->view('templates/header', $data);
         $this->load->view('templates/sidebar', $data);
         $this->load->view('templates/page', $data);
         $this->load->view('laporan/kunjungan_pasien');
         $this->load->view('templates/footer');
      }
   }

   // Page Laporan Detail Rekam Medis
   public function detail_rekam_medis($id)
   {
      $data['title'] = 'Laporan';
      $data['antrian_pasien'] = $this->m_klinik->getAntrianFarmasiJoinById($id);
      $data['pembayaran'] = $this->m_klinik->getPembayaranFarmasiJoinById($id);
      $data['data_tindakan'] = $this->m_klinik->getFarmasiTindakanById($id);
      $data['data_resep'] = $this->m_klinik->getFarmasiResepById($id);
      $data['data_diagnosa'] = $this->m_klinik->getFarmasiDiagnosaById($id);
      $data['catatan'] = $this->m_klinik->getFarmasiCatatanById($id);
      $data['harga_resep'] = $this->m_klinik->getFarmasiResepSumById($id);
      $data['harga_tindakan'] = $this->m_klinik->getFarmasiTindakanSumById($id);
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('laporan/detail_rm', $data);
      $this->load->view('templates/footer');
   }

   // Page Settings Kategori Obat
   public function kategori_obat()
   {
      $data['title'] = 'Settings';
      $data['data_kt_obat'] = $this->m_klinik->getAllKategoriObat();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('kt_obat', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('tambah_data') == 'tambah') {
         $insertKategori = [
            'nk_obat' => $this->input->post('nk_obat')
         ];

         $this->m_klinik->addKategori($insertKategori, 'kategori_obat');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/kategori_obat');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_kategori_obat = $this->input->post('id_kategori_obat');

         $updateKategori = [
            'nk_obat' => $this->input->post('nk_obat')
         ];

         $where = array(
            "id_kategori_obat" => $id_kategori_obat
         );

         $this->m_klinik->editKategori($where, $updateKategori, 'kategori_obat');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/kategori_obat');
      }
   }

   public function hapus_kt_obat($id)
   {
      $this->m_klinik->deletKategori($id);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('klinik/kategori_obat');
   }

   // Page Settings Diskon
   public function diskon()
   {
      $data['title'] = 'Settings';
      $data['data_diskon'] = $this->m_klinik->getAllDiskon();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('diskon', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('tambah_data') == 'tambah') {
         $insertDiskon = [
            'ket_diskon' => $this->input->post('ket_diskon'),
            'pers_diskon' => $this->input->post('pers_diskon'),
            'sts_diskon' => 0
         ];

         $this->m_klinik->addDiskon($insertDiskon, 'diskon');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/diskon');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_diskon = $this->input->post('id_diskon');

         $updateDiskon = [
            'ket_diskon' => $this->input->post('ket_diskon'),
            'pers_diskon' => $this->input->post('pers_diskon')
         ];

         $where = array(
            "id_diskon" => $id_diskon
         );

         $this->m_klinik->editDiskon($where, $updateDiskon, 'diskon');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/diskon');
      }

      if ($this->input->post('ubah_sts') == 'ubah') {
         $id_diskon = $this->input->post('id_diskon');

         $updateDiskon = [
            'sts_diskon' => $this->input->post('sts_diskon')
         ];

         $where = array(
            "id_diskon" => $id_diskon
         );

         $this->m_klinik->editDiskon($where, $updateDiskon, 'diskon');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/diskon');
      }
   }

   public function hapus_diskon($id)
   {
      $this->m_klinik->deletDiskon($id);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('klinik/diskon');
   }

   // Page Settings Pekerjaan
   public function pekerjaan()
   {
      $data['title'] = 'Settings';
      $data['data_pekerjaan'] = $this->m_klinik->getAllPekerjaan();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('pekerjaan', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('tambah_data') == 'tambah') {
         $insertPekerjaan = [
            'nm_pekerjaan' => $this->input->post('nm_pekerjaan')
         ];

         $this->m_klinik->addPekerjaan($insertPekerjaan, 'pekerjaan');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/pekerjaan');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_pekerjaan = $this->input->post('id_pekerjaan');

         $updatePekerjaan = [
            'nm_pekerjaan' => $this->input->post('nm_pekerjaan')
         ];

         $where = array(
            "id_pekerjaan" => $id_pekerjaan
         );

         $this->m_klinik->editPekerjaan($where, $updatePekerjaan, 'pekerjaan');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/pekerjaan');
      }
   }

   public function hapus_pekerjaan($id)
   {
      $this->m_klinik->deletPekerjaan($id);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('klinik/pekerjaan');
   }

   // Page Settings Hak Akses
   public function hak_akses()
   {
      $data['title'] = 'Settings';
      $data['data_hak_akses'] = $this->m_klinik->getAllAkses();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('hak_akses', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('tambah_data') == 'tambah') {
         $insertAkses = [
            'kode_akses' => $this->input->post('kode_akses'),
            'akses' => $this->input->post('akses')
         ];

         $this->m_klinik->addAkses($insertAkses, 'hak_akses');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/hak_akses');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_akses = $this->input->post('id_akses');

         $updateAkses = [
            'kode_akses' => $this->input->post('kode_akses'),
            'akses' => $this->input->post('akses')
         ];

         $where = array(
            "id_akses" => $id_akses
         );

         $this->m_klinik->editAkses($where, $updateAkses, 'hak_akses');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/hak_akses');
      }
   }

   public function hapus_Hak_akses($id)
   {
      $this->m_klinik->deletAkses($id);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('klinik/hak_akses');
   }

   // Page Settings Profil
   public function profil()
   {
      $data['title'] = 'Settings';
      $data['data_hak_akses'] = $this->m_klinik->getAllAkses();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('dokter', 'dokter.ktp=user.ktp');
      $this->db->where('user.id_user', $this->session->userdata('id_user'));
      $data['profil'] = $this->db->get()->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('profil_user', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('ubah_data') == 'ubahBiodata') {
         $id_user = $this->input->post('id_user');

         $updateBio = [
            'ktp' =>  $this->input->post('ktp'),
            'nm_depan' =>  $this->input->post('nm_depan'),
            'nm_belakang' =>  $this->input->post('nm_belakang'),
            'telepon' =>  $this->input->post('telepon'),
            'email' =>  $this->input->post('email')
         ];

         $whereBio = array(
            "id_user" => $id_user
         );

         $this->m_klinik->editBiodata($whereBio, $updateBio, 'user');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Password telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/profil');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_user = $this->input->post('id_user');
         $old_password = $this->input->post('old_password');

         $user = $this->db->get_where('user', ['id_user' => $id_user])->row_array();

         if ($user) {
            if (password_verify($old_password, $user['password'])) {
               $update = [
                  'password' =>  password_hash($this->input->post('new_password'), PASSWORD_DEFAULT)
               ];

               $where = array(
                  "id_user" => $id_user
               );

               $this->m_klinik->editProfil($where, $update, 'user');
               $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Password telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
               redirect('klinik/profil');
            } else {
               $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Gagal !",text: "Password salah..",position: "top-right",loaderBg: "#fff",icon: "error",hideAfter: 5000,stack: 1});});');
               redirect('klinik/profil');
            }
         }
      }

      if ($this->input->post('ubah_data') == 'ubahGambar') {
         $id_user = $this->input->post('id_user');
         $old_image = $this->input->post('old_image');
         $foto_user = $_FILES['foto_user'];

         if ($old_image != 'default.jpg') {
            unlink(FCPATH . 'assets/upload/' . $old_image);
         }

         $config['upload_path'] = './assets/upload/';
         $config['allowed_types'] = 'jpg|png|gif';
         $config['remove_space'] = TRUE;

         $this->load->library('upload', $config);

         if ($this->upload->do_upload('foto_user')) {
            $foto_user = $this->upload->data('file_name');
         } else {
            echo "Upload Gagal!!";
            die();
         }

         $updateUser = [
            'foto_user' => $foto_user
         ];

         $whereUser = array(
            "id_user" => $id_user
         );

         $this->m_klinik->editUser($whereUser, $updateUser, 'user');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Foto telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/profil');
      }
   }

   // Page Settings Website
   public function web_settings()
   {
      $data['title'] = 'Settings';
      $data['set_web'] = $this->m_klinik->getWeb();
      $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/page', $data);
      $this->load->view('web_settings', $data);
      $this->load->view('templates/footer');

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_web = $this->input->post('id_web');
         $old_image = $this->input->post('old_image');
         $logo_web = $_FILES['logo_web'];

         if ($this->input->post('ubah_gambar')) {
            if ($old_image != 'default.jpg') {
               unlink(FCPATH . 'assets/upload/' . $old_image);
            }

            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'jpg|png|gif';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('logo_web')) {
               $logo_web = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }

            $update = [
               'nama_klinik' => $this->input->post('nama_klinik'),
               'title_web' => $this->input->post('title_web'),
               'sidebar_title' => $this->input->post('sidebar_title'),
               'email_web' => $this->input->post('email_web'),
               'telepon_web' => $this->input->post('telepon_web'),
               'fax_web' => $this->input->post('fax_web'),
               'fb_web' => $this->input->post('fb_web'),
               'twitter_web' => $this->input->post('twitter_web'),
               'alamat_web' => $this->input->post('alamat_web'),
               'logo_web' => $logo_web
            ];

            $where = array(
               "id_web" => $id_web
            );
         } else {
            $update = [
               'nama_klinik' => $this->input->post('nama_klinik'),
               'title_web' => $this->input->post('title_web'),
               'sidebar_title' => $this->input->post('sidebar_title'),
               'email_web' => $this->input->post('email_web'),
               'telepon_web' => $this->input->post('telepon_web'),
               'fax_web' => $this->input->post('fax_web'),
               'fb_web' => $this->input->post('fb_web'),
               'twitter_web' => $this->input->post('twitter_web'),
               'alamat_web' => $this->input->post('alamat_web')
            ];

            $where = array(
               "id_web" => $id_web
            );
         }

         $this->m_klinik->editWeb($where, $update, 'set_web');
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('klinik/web_settings');
      }
   }
}
