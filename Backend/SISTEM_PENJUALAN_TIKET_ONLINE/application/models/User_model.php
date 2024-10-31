<!-- user_model.php -->

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_train_schedules()
    {
        // Query to get train schedules from the 'tbl_kereta' table
        $query = $this->db->get('tbl_kereta');
        return $query->result();
    }

    public function get_stations()
    {
        // Fetch distinct station names from both stasiun_awal and stasiun_akhir columns
        $this->db->distinct();
        $this->db->select('stasiun_awal as station_name');
        $this->db->from('tbl_kereta');

        $query1 = $this->db->get();

        $this->db->distinct();
        $this->db->select('stasiun_akhir as station_name');
        $this->db->from('tbl_kereta');

        $query2 = $this->db->get();

        // Combine and return unique station names
        $stations = array_merge($query1->result_array(), $query2->result_array());

        return $stations;
    }

    public function get_schedules_by_stations($stasiunAwal, $stasiunAkhir)
    {
        // Query to get schedules based on the start and end stations from 'tbl_kereta'
        $this->db->select('*');
        $this->db->from('tbl_kereta');
        $this->db->where('stasiun_awal', $stasiunAwal);
        $this->db->where('stasiun_akhir', $stasiunAkhir);
        $query = $this->db->get();

        return $query->result();
    }

    public function simpan_data_pengguna($userData)
    {
        // Masukkan data pengguna ke dalam tabel 'tbl_pengguna'
        $this->db->insert('tbl_pengguna', $userData);

        // Mendapatkan ID pengguna yang baru saja disimpan
        $pengguna_id = $this->db->insert_id();

        // Jika Anda memerlukan ID pengguna yang baru saja disimpan, Anda dapat mengembalikannya
        return $pengguna_id;
    }

    public function get_kode_kereta_by_schedule_id($scheduleId)
    {
        // Sesuaikan dengan struktur tabel dan kolom pada database Anda
        $this->db->select('kode_kereta');
        $this->db->where('schedule_id', $scheduleId);
        $query = $this->db->get('tbl_kereta'); // Gantilah dengan nama tabel yang sesuai di database Anda

        if ($query->num_rows() > 0) {
            return $query->row()->kode_kereta;
        } else {
            return false;
        }
    }

    public function get_train_info_by_code($kode_kereta)
    {
        // Adjust the query based on your database schema
        $this->db->where('kode_kereta', $kode_kereta);
        $query = $this->db->get('tbl_kereta');

        return $query->row(); // Assuming you expect only one row
    }

    public function simpan_pilihan_kursi($pengguna_id, $kodeKereta, $gerbong, $kursi)
    {
        // Your logic to save the selected gerbong and kursi goes here
        // This method should interact with your database and store the data
        // You need to implement the database interaction based on your requirements
    }

    public function get_user_data_by_id($kode_pengguna)
    {
        // Query to get user data based on the provided $kode_pengguna
        $this->db->where('kode_pengguna', $kode_pengguna);
        $query = $this->db->get('tbl_pengguna');

        // Check if the query was successful
        if ($query->num_rows() > 0) {
            return $query->row(); // Return the user data
        } else {
            return false; // Return false if no data is found
        }
    }

    public function simpan_data_tiket($kode_pengguna, $no_gerbong, $no_kursi, $kode_login)
    {
        // Define data to be inserted into tbl_tiket
        $data = array(
            'kode_pengguna' => $kode_pengguna,
            'no_gerbong' => $no_gerbong,
            'no_kursi' => $no_kursi,
            'kode_login' => $kode_login, // Add this line to store kode_login
        );

        // Insert data into tbl_tiket
        $this->db->insert('tbl_tiket', $data);
    }

    public function update_train_stock($kode_kereta, $newStock)
    {
        // Update the train stock in the database
        $this->db->where('kode_kereta', $kode_kereta);
        $this->db->update('tbl_kereta', ['stok' => $newStock]);
    }

    // User_model.php
    public function get_ticket_data_by_train_code($kode_kereta)
    {
        $this->db->where('kode_kereta', $kode_kereta);
        $query = $this->db->get('tbl_tiket');

        return $query->row();
    }

    public function get_ticket_info()
    {
        // Modify this query to retrieve all ticket information
        $query = $this->db->get('tbl_tiket');

        // Check if there is any result
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    // User_model.php
    public function get_user_info_by_code($kode_pengguna)
    {
        $this->db->where('kode_pengguna', $kode_pengguna);
        $query = $this->db->get('tbl_pengguna');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            // Tampilkan pesan kesalahan jika tidak ada hasil
            echo "Data pengguna tidak ditemukan.";
            return false;
        }
    }

    // User_model.php
    public function get_tiket_data_by_kode_login($kode_login)
    {
        $this->db->where('kode_login', $kode_login);
        $query = $this->db->get('tbl_tiket');

        return $query->row(); // Assuming you expect only one row for a specific kode_login
    }


    public function get_all_tickets_by_kode_login($kode_login)
    {
        $this->db->select('tbl_tiket.*, tbl_pengguna.kode_kereta, tbl_kereta.nama_kereta, tbl_kereta.stasiun_awal, tbl_kereta.stasiun_akhir');
        $this->db->from('tbl_tiket');
        $this->db->join('tbl_pengguna', 'tbl_tiket.kode_pengguna = tbl_pengguna.kode_pengguna');
        $this->db->join('tbl_kereta', 'tbl_pengguna.kode_kereta = tbl_kereta.kode_kereta');
        $this->db->where('tbl_tiket.kode_login', $kode_login);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
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


    public function delete_ticket($kode_tiket)
    {
        // Perform the deletion query
        $this->db->where('kode_tiket', $kode_tiket);
        $this->db->delete('tbl_tiket');
    }
}
?>