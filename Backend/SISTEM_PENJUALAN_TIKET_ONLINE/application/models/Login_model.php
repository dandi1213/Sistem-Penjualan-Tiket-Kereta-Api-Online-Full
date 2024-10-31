<!-- Login_model.php -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Fungsi untuk melakukan pengecekan login
    public function check_login($username, $password) {
        // Sesuaikan query ini dengan struktur tabel dan kolom di database Anda
        $query = $this->db->get_where('tbl_login', array('username' => $username, 'password' => $password));

        return $query->row(); // Mengembalikan satu baris hasil query
    }

    // Tambahkan fungsi berikut pada Login_model.php
    public function save_user($username, $password, $role)
    {
        // Use appropriate database connection and table name
        $this->db->insert('tbl_login', array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Hash the password
            'role' => $role
        ));
    }

}
?>
