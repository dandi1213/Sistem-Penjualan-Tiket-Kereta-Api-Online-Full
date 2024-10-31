<!-- User_controller.php -->

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model'); // Change 'user_model' to 'User_model'
    }

    public function dashboard()
    {
        $this->load->view('user/dashboard');
    }

    public function lihat_jadwal()
    {
        // Mengambil data jadwal kereta dari model
        $data['schedules'] = $this->User_model->get_train_schedules(); // Sesuaikan dengan fungsi di model

        // Memuat view dengan data yang diteruskan
        $this->load->view('user/lihat_jadwal', $data);
    }

    public function pemesanan()
    {
        // Mendapatkan data stasiun dari model
        $data['stations'] = $this->User_model->get_stations();

        // Memuat halaman pemesanan.php dengan data stasiun
        $this->load->view('user/pemesanan', $data);
    }

    public function cari_tiket()
    {
        // Mendapatkan stasiun awal dan akhir dari form
        $stasiunAwal = $this->input->post('stasiunAwal');
        $stasiunAkhir = $this->input->post('stasiunAkhir');
    
        // Menggunakan data stasiun untuk mendapatkan jadwal dari model
        $data['schedules'] = $this->User_model->get_schedules_by_stations($stasiunAwal, $stasiunAkhir);
    
        // Check if there are tickets available
        if (empty($data['schedules'])) {
            // If no tickets are found, load the regular view and pass a flag
            $data['noTicketsFound'] = true;
            $this->load->view('user/pilih_tiket', $data);
        } else {
            // If tickets are found, load the regular view
            $this->load->view('user/pilih_tiket', $data);
        }
    }


    public function pilih_tiket()
    {
        $stasiunAwal = $this->input->post('stasiunAwal');
        $stasiunAkhir = $this->input->post('stasiunAkhir');
        $data['schedules'] = $this->user_model->get_schedules_by_stations($stasiunAwal, $stasiunAkhir);
        $this->load->view('user/pilih_tiket', $data);
    }

    // User_controller.php
    public function detail_kereta($kode_kereta)
    {
        // Mendapatkan informasi kereta berdasarkan kode_kereta dari model
        $data['train_info'] = $this->User_model->get_train_info_by_code($kode_kereta);
        $data['username'] = $this->session->userdata('username');
        $data['kode_login'] = $this->session->userdata('kode_login');

        // Cek apakah data kereta ditemukan
        if ($data['train_info']) {
            // Menyiapkan data yang akan dilewatkan ke view 'user/detail_kereta'
            $this->load->view('user/form_data_diri', $data);
        } else {
            // Jika data kereta tidak ditemukan, Anda dapat mengarahkan pengguna ke halaman lain atau menampilkan pesan kesalahan
            echo "Data Kereta Tidak Ditemukan";
        }
    }


    public function simpan_data_pengguna()
    {
        // Mengambil data dari formulir
        $namaLengkap = $this->input->post('namaLengkap');
        $nik = $this->input->post('nik');
        $noTelepon = $this->input->post('noTelepon');
        $tanggalBerangkat = $this->input->post('tanggalBerangkat');
        $jumlahTiket = $this->input->post('jumlahTiket');
        $kodeKereta = $this->input->post('kodeKereta');

        // Membuat array data pengguna
        $userData = array(
            'nama_pengguna' => $namaLengkap,
            'nik' => $nik,
            'no_telepon' => $noTelepon,
            'tanggal_berangkat' => $tanggalBerangkat,
            'jumlah_tiket' => $jumlahTiket,
            'kode_kereta' => $kodeKereta,
        );

        // Menyimpan data pengguna ke dalam tabel 'tbl_pengguna' melalui model
        $pengguna_id = $this->User_model->simpan_data_pengguna($userData);

        // Jika Anda membutuhkan ID pengguna yang baru saja disimpan, Anda dapat menggunakannya
        // $pengguna_id dapat digunakan untuk operasi lanjutan, jika diperlukan

        // Menyiapkan data yang akan dilewatkan ke view 'user/pilih_kursi'
        $data['pengguna_id'] = $pengguna_id;
        $data['kodeKereta'] = $kodeKereta; // Add this line to pass $kodeKereta to the view

        // Redirect atau tampilkan halaman sukses, sesuai dengan kebutuhan Anda
        $this->load->view('user/pilih_kursi', $data);
    }

    public function simpan_pilihan_kursi()
    {
        // Mendapatkan data dari formulir
        $no_gerbong = $this->input->post('gerbong');
        $no_kursi = $this->input->post('kursi');
        $kode_pengguna = $this->input->post('kode_pengguna');

        // Menyimpan data pengguna ke dalam variabel
        $data['no_gerbong'] = $no_gerbong;
        $data['no_kursi'] = $no_kursi;
        $data['kode_pengguna'] = $kode_pengguna;
        $data['username'] = $this->session->userdata('username'); // Add this line to pass username
        $data['kode_login'] = $this->session->userdata('kode_login'); // Add this line to pass kode_login

        // Mendapatkan data pengguna berdasarkan kode_pengguna
        $userData = $this->User_model->get_user_data_by_id($kode_pengguna);

        // Jika data pengguna ditemukan, tambahkan ke array data
        if ($userData) {
            $data['nama_pengguna'] = $userData->nama_pengguna;
            $data['nik'] = $userData->nik;
            $data['no_telepon'] = $userData->no_telepon;
            $data['tanggal_berangkat'] = $userData->tanggal_berangkat;
            $data['jumlah_tiket'] = $userData->jumlah_tiket;
            $data['kode_kereta'] = $userData->kode_kereta;

            // Mendapatkan data kereta berdasarkan kode_kereta
            $trainData = $this->User_model->get_train_info_by_code($userData->kode_kereta);

            // Jika data kereta ditemukan, tambahkan ke array data
            if ($trainData) {
                $data['nama_kereta'] = $trainData->nama_kereta;
                $data['stasiun_awal'] = $trainData->stasiun_awal;
                $data['stasiun_akhir'] = $trainData->stasiun_akhir;
                $data['harga'] = $trainData->harga;
            }
        }

        // Tampilkan halaman pilihan_kursi.php dengan data no_gerbong, no_kursi, data pengguna, dan data kereta
        $this->load->view('user/detail_pesanan', $data);
    }


    // User_controller.php

    public function bayar_tiket()
    {
        // Mendapatkan data dari formulir
        $kode_pengguna = $this->input->post('kode_pengguna');
        $no_gerbong = $this->input->post('no_gerbong');
        $no_kursi = $this->input->post('no_kursi');
        $kode_login = $this->input->post('kode_login'); // Add this line to get kode_login

        // Menyimpan data tiket ke dalam tabel 'tbl_tiket' melalui model
        $this->User_model->simpan_data_tiket($kode_pengguna, $no_gerbong, $no_kursi, $kode_login);

        // Mengurangi stok tiket pada kereta
        $this->update_train_stock($kode_pengguna);

        // Menyiapkan data yang akan dilewatkan ke view 'user/transaksi_berhasil'
        $data['kode_pengguna'] = $kode_pengguna;
        $data['no_gerbong'] = $no_gerbong;
        $data['no_kursi'] = $no_kursi;

        // Load the view to display the successful transaction
        $this->load->view('user/transaksi_berhasil', $data);
    }

    public function transaksi_berhasil(){
        $this->load->view('user/transaksi_berhasil');
    }


    // Function to update train stock vqgqwqwwh
    private function update_train_stock($kode_pengguna)
    {
        // Get the user data using the provided $kode_pengguna
        $userData = $this->User_model->get_user_data_by_id($kode_pengguna);

        if ($userData) {
            // Get the train data using the train code from user data
            $trainData = $this->User_model->get_train_info_by_code($userData->kode_kereta);

            if ($trainData) {
                // Update the train stock in the database
                $newStock = $trainData->stok - $userData->jumlah_tiket;

                // Make sure the stock doesn't go below zero
                $newStock = max(0, $newStock);

                $this->User_model->update_train_stock($trainData->kode_kereta, $newStock);
            }
        }
    }

    // User_controller.php
    public function tiket_saya()
    {
        // Assuming $kode_login is available in your session or from somewhere else
        $kode_login = $this->session->userdata('kode_login'); // Replace with the actual source of kode_login

        // Get tiket data based on kode_login from the tbl_tiket table
        $data['tiket_data'] = $this->User_model->get_tiket_data_by_kode_login($kode_login);

        // If you have a method to get all tickets based on kode_login, use it
        $data['all_tickets'] = $this->User_model->get_all_tickets_by_kode_login($kode_login);

        $this->load->view('user/tiket_saya', $data);
    }

    public function delete_ticket()
    {
        // Get the kode_tiket from the POST data
        $kode_tiket = $this->input->post('kode_tiket');
    
        // Perform the deletion in your model
        $success = $this->User_model->delete_ticket($kode_tiket);
    
        if ($success) {
            // Redirect to the Tiket Saya page after successful deletion
            redirect('user_controller/tiket_saya');
        } else {
            // Handle the error scenario, display an error message, or redirect as needed
            // You can add an error message to the redirect URL, e.g., redirect('user_controller/tiket_saya?error=1');
            redirect('user_controller/tiket_saya');
        }
    }
    
    
}

?>