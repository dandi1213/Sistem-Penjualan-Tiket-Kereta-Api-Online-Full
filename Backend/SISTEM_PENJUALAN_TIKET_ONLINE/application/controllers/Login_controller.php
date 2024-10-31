<!-- Login_controller.php -->

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
    }

    // Fungsi untuk menampilkan formulir login
    public function index()
    {
        $this->load->view('login/login_view');
    }

    // Fungsi untuk memproses login
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Panggil model untuk melakukan pengecekan login
        $user = $this->Login_model->check_login($username, $password);

        if ($user) {
            // Jika login berhasil, atur sesi dan arahkan ke halaman sesuai dengan role
            // Jika login berhasil, atur sesi dan arahkan ke halaman sesuai dengan role
            $this->session->set_userdata('username', $username);
            $this->session->set_userdata('kode_login', $user->kode_login); // Add this line to set kode_login

            if ($user->role == 'admin') {
                redirect('admin_controller/show_trains');
            } elseif ($user->role == 'pengguna') {
                redirect('user_controller/dashboard'); // Redirect to the dashboard
            }
        } else {
            // Jika login gagal, tampilkan pesan kesalahan
            $this->session->set_flashdata('error_message', 'Username atau password salah');
            redirect('login_controller/index'); // Redirect back to the login page
        }
    }

    // Tambahkan fungsi berikut pada Login_controller.php
    public function register()
    {
        $this->load->view('login/register_view');
    }

    public function save_user()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');
        $role = $this->input->post('role');

        // Validate if passwords match
        if ($password !== $confirm_password) {
            // Handle password mismatch (e.g., display an error message)
            $this->session->set_flashdata('error_message', 'Password and Confirm Password must match');

            // Reset confirm_password field in flashdata
            $this->session->set_flashdata('confirm_password', '');

            // Redirect back to registration page
            redirect('login_controller/register');
            return;
        }

        // Panggil model untuk menyimpan data ke database
        $this->db->insert('tbl_login', array(
            'username' => $username,
            'password' => $password, // Store plain text password
            'role' => $role
        ));

        // Setelah menyimpan data, atur pesan berhasil di sesi
        $this->session->set_flashdata('success_message', 'Akun berhasil terdaftar!');

        // Arahkan kembali ke halaman login
        redirect('login_controller/index');
    }
}
?>