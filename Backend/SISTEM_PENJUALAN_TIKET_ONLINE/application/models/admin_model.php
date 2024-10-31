<!-- admin_model.php -->

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // Fungsi untuk mendapatkan data kereta
    public function get_all_trains()
    {
        $query = $this->db->get('tbl_kereta'); // Sesuaikan dengan nama tabel Anda
        return $query->result(); // Mengembalikan hasil query dalam bentuk array objek
    }

    // Tambahkan fungsi save_train pada Admin_model.php
    public function save_train($nama_kereta, $stasiun_awal, $stasiun_akhir, $harga, $stok, $jadwal_berangkat, $jadwal_sampai)
    {
        // Ambil kode_kereta terakhir
        $last_kode_kereta = $this->db->select('kode_kereta')->order_by('kode_kereta', 'DESC')->limit(1)->get('tbl_kereta')->row();

        if ($last_kode_kereta) {
            // Jika ada data kereta, tambahkan 1 ke kode_kereta terakhir
            $new_kode_kereta = $last_kode_kereta->kode_kereta + 1;
        } else {
            // Jika tidak ada data kereta, set kode_kereta ke 1
            $new_kode_kereta = 1;
        }

        $data = array(
            'kode_kereta' => $new_kode_kereta, // Menyertakan kode_kereta yang baru ditentukan
            'nama_kereta' => $nama_kereta,
            'stasiun_awal' => $stasiun_awal,
            'stasiun_akhir' => $stasiun_akhir,
            'harga' => $harga,
            'stok' => $stok,
            'jadwal_berangkat' => $jadwal_berangkat,
            'jadwal_sampai' => $jadwal_sampai
        );

        $this->db->insert('tbl_kereta', $data);

        // Mengembalikan kode_kereta yang baru ditambahkan
        return $new_kode_kereta;
    }



    // Fungsi untuk mendapatkan nomor terakhir yang digunakan
    public function get_last_kode_kereta()
    {
        $query = $this->db->query("SELECT MAX(kode_kereta) AS last_kode FROM tbl_kereta");
        $row = $query->row();

        return ($row) ? $row->last_kode : 0;
    }

    public function get_train_by_code($kode_kereta)
    {
        // Ambil data kereta berdasarkan kode_kereta
        return $this->db->get_where('tbl_kereta', array('kode_kereta' => $kode_kereta))->row();
    }

    public function update_train($kode_kereta, $nama_kereta, $stasiun_awal, $stasiun_akhir, $harga, $stok)
    {
        $data = array(
            'nama_kereta' => $nama_kereta,
            'stasiun_awal' => $stasiun_awal,
            'stasiun_akhir' => $stasiun_akhir,
            'harga' => $harga,
            'stok' => $stok
        );

        $this->db->where('kode_kereta', $kode_kereta);
        $this->db->update('tbl_kereta', $data);
    }


    public function delete_train($kode_kereta)
    {
        // Hapus data kereta berdasarkan kode_kereta
        $this->db->delete('tbl_kereta', array('kode_kereta' => $kode_kereta));
    }

    // Inside Admin_model.php
    public function get_all_tickets()
    {
        $this->db->select('tbl_tiket.kode_tiket, tbl_tiket.kode_pengguna, tbl_pengguna.nama_pengguna, tbl_pengguna.kode_kereta, tbl_kereta.nama_kereta, tbl_kereta.stasiun_awal, tbl_kereta.stasiun_akhir, tbl_kereta.harga');
        $this->db->from('tbl_tiket');
        $this->db->join('tbl_pengguna', 'tbl_tiket.kode_pengguna = tbl_pengguna.kode_pengguna');
        $this->db->join('tbl_kereta', 'tbl_pengguna.kode_kereta = tbl_kereta.kode_kereta');
        $query = $this->db->get();

        return $query->result();
    }


    public function get_user_by_code($kode_pengguna)
    {
        $query = $this->db->get_where('tbl_pengguna', array('kode_pengguna' => $kode_pengguna));
        return $query->row();
    }

    public function delete_transaction($kode_tiket)
    {
        $this->db->where('kode_tiket', $kode_tiket);
        $this->db->delete('tbl_tiket'); // Replace 'transactions_table' with your actual table name
    }
    
    
}
?>