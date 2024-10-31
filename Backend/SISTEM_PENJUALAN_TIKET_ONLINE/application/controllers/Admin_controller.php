<!-- Admin_controller.php -->

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function show_trains()
    {
        // Cek apakah pengguna sudah login
        if (!$this->session->userdata('username')) {
            // Jika belum login, redirect ke halaman login
            redirect('login_controller');
        }

        // Panggil model Admin_model untuk mendapatkan data kereta
        $data['trains'] = $this->Admin_model->get_all_trains();

        // Load view untuk menampilkan tabel kereta
        $this->load->view('admin/dashboard', $data);
    }

    // Tambahkan fungsi add_train pada Admin_controller.php
    public function add_train()
    {
        // Jika tombol "Back to Dashboard" diklik, langsung kembali ke halaman dashboard
        if ($this->input->post('back_to_dashboard')) {
            redirect('admin_controller/show_trains');
            return;
        }

        // Load view untuk menampilkan halaman tambah kereta
        $this->load->view('admin/tambah_kereta');
    }

    // Tambahkan fungsi save_train pada Admin_controller.php
    public function save_train()
    {
        $nama_kereta = $this->input->post('nama_kereta');
        $stasiun_awal = $this->input->post('stasiun_awal');
        $stasiun_akhir = $this->input->post('stasiun_akhir');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');
        $jadwal_berangkat = $this->input->post('jadwal_berangkat');
        $jadwal_sampai = $this->input->post('jadwal_sampai');

        $new_kode_kereta = $this->Admin_model->save_train($nama_kereta, $stasiun_awal, $stasiun_akhir, $harga, $stok, $jadwal_berangkat, $jadwal_sampai);

        redirect('admin_controller/show_trains');
    }

    // Fungsi untuk menampilkan halaman edit kereta
    public function edit_train($kode_kereta)
    {
        // Cek apakah pengguna sudah login
        if (!$this->session->userdata('username')) {
            // Jika belum login, redirect ke halaman login
            redirect('login_controller');
        }

        // Panggil model Admin_model untuk mendapatkan data kereta berdasarkan kode_kereta
        $data['train'] = $this->Admin_model->get_train_by_code($kode_kereta);

        // Load view untuk menampilkan halaman edit kereta
        $this->load->view('admin/edit_kereta', $data);
    }

    // Fungsi untuk menghandle update data kereta
    public function update_train()
    {
        $kode_kereta = $this->input->post('kode_kereta');
        $nama_kereta = $this->input->post('nama_kereta');
        $stasiun_awal = $this->input->post('stasiun_awal');
        $stasiun_akhir = $this->input->post('stasiun_akhir');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');
        $jadwal_berangkat = $this->input->post('jadwal_berangkat');
        $jadwal_sampai = $this->input->post('jadwal_sampai');

        $this->Admin_model->update_train($kode_kereta, $nama_kereta, $stasiun_awal, $stasiun_akhir, $harga, $stok, $jadwal_berangkat, $jadwal_sampai);

        redirect('admin_controller/show_trains');
    }

    // Fungsi untuk menghapus data kereta
    public function delete_train($kode_kereta)
    {
        // Panggil model Admin_model untuk menghapus data kereta
        $this->Admin_model->delete_train($kode_kereta);

        // Redirect kembali ke halaman admin setelah hapus
        redirect('admin_controller/show_trains');
    }

    public function show_transactions()
    {
        // Cek apakah pengguna sudah login
        if (!$this->session->userdata('username')) {
            // Jika belum login, redirect ke halaman login
            redirect('login_controller');
        }

        // Retrieve existing data from the session
        $transactions_from_session = $this->session->userdata('transactions');

        // Panggil model Admin_model untuk mendapatkan data tiket
        $transactions_from_db = $this->Admin_model->get_all_tickets();

        // Check if $transactions_from_session is set and is an array
        if (is_array($transactions_from_session)) {
            // Check if there are new transactions from the database
            $new_transactions = array_udiff($transactions_from_db, $transactions_from_session, function ($a, $b) {
                return $a->kode_tiket - $b->kode_tiket;
            });

            if (!empty($new_transactions)) {
                // Merge existing data with new data from the database
                $updated_transactions = array_merge($transactions_from_session, $new_transactions);

                // Update the session with the merged data
                $this->session->set_userdata('transactions', $updated_transactions);
            } else {
                // If there are no new transactions, use the data from the session
                $updated_transactions = $transactions_from_session;
            }
        } else {
            // If $transactions_from_session is not an array, set $updated_transactions to the entire $transactions_from_db
            $updated_transactions = $transactions_from_db;

            // Update the session with the data from the database
            $this->session->set_userdata('transactions', $updated_transactions);
        }

        // Retrieve data from the session
        $data['transactions'] = $updated_transactions;

        // Load view untuk menampilkan halaman data transaksi
        $this->load->view('admin/data_transaksi', $data);
    }

    // Inside Admin_controller.php
    public function delete_transaction($kode_tiket)
    {
        // Hapus data dari database
        $this->Admin_model->delete_transaction($kode_tiket);

        // Hapus data dari session
        $transactions_from_session = $this->session->userdata('transactions');

        // Cari index data yang akan dihapus dari session
        $index_to_remove = array_search($kode_tiket, array_column($transactions_from_session, 'kode_tiket'));

        // Hapus data dari session
        if ($index_to_remove !== false) {
            unset($transactions_from_session[$index_to_remove]);
            $this->session->set_userdata('transactions', $transactions_from_session);
        }

        // Redirect kembali ke halaman data transaksi
        redirect('admin_controller/show_transactions');
    }
}
?>