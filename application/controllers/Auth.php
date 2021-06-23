<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    /**
     * Pada kelas controller auth ini akan mengatur beberapa fungsionalitas dari web,
     * Mulai dari halaman utama, login, registrasi dan logout.
     * Data yang diolah merupakan database yang diambil melalui database.php yang kemudian 
     * Akan ditambah database nya berupa customer baru melalui registrasi. Selain itu 
     * Ada juga data berupa templates view dari header, halaman utama dan footer .
     * @author Aditya Ramadhan
     * @version 1.0
     * @since 2021 - 02 - 20
     */

    /** 
     * Method construct ini digunakan karena dalam setiap method yang ada di class ini 
     * akan menggunakan library form validation, sehingga dibuatlah function construct 
     * agar dalam setiap method tidak perlu lagi memanggil library form validation
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    /** 
     * Method index ini digunakan untuk membuat sebuah halaman utama dengan 
     * menghubungkan views yang telah dibuat, yaitu header, body, dan footer dari
     * halaman utama
     */
    public function index()
    {
        $data['title'] = 'Sprout Landing Page';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }

    /** 
     * Method login ini digunakan untuk mengecek dari inputan user mulai dari kebenaran 
     * penulisan masing-masing form validation yang disediakan, dan kebenaran data user
     * yang berkaitan dengan database
     */
    public function login()
    {
        /** trim berfungsi untuk meremove white space yang ada dalam form validations
         * required untuk mengecek agar tidak empty string
         * valid email, mengecek apakah input yang dimasukkan sesuai dengan inputan email yang valid
         */
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        /** mengecek kondisi jika form validation bernilai false, 
         * maka user masih berada dihalamn login, jika true, maka masuk ke fungsi login
         */

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Sprout Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }
    /** 
     * Method private login ini digunakan untuk mengecek dari inputan user terkait kesamaan
     * atau kecocokan input yang dimasukkan oleh user dengan database
     */
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            //usernya ada
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('user');
                    } else if ($user['role_id'] == 2) {
                        redirect('developer');
                    } else if ($user['role_id'] == 3) {
                        redirect('admin');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong password!
                    </div>');
                    redirect('auth/login');
                }
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email is not registered!
            </div>');
            redirect('auth/login');
        }
    }
    /** 
     * Method registration ini digunakan untuk user melakukan registrasi 
     * yang sesuai dengan library form validation dan menset rules yang terkait dengan
     * masing-masing field form
     */
    public function registration()
    {
        $data['title'] = 'Sprout Registration Page';
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        /** trim berfungsi untuk meremove white space yang ada dalam form validations
         * required untuk mengecek agar tidak empty string
         * valid email, mengecek apakah input yang dimasukkan sesuai dengan inputan email yang valid
         * is_unique untuk mengecek kedalam database melalui code igniter bahwa email harus unik
         * dan jika email sama dan sudah ada dalam database akan diberikan alert email sudah teregistrasi
         */
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password doesnt match!',
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[6]|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = "Sprout Register Page";
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 1,
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation! Your account has been registered. Please Login!
            </div>');
            $this->session->set_flashdata('');
            redirect('auth/login');
        }
    }
    /** 
     * Method logout ini digunakan untuk user melakukan logout
     * atau mengeluarkan akunnya dari akses web akun milik user
     */
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You have been logout!
            </div>');
        redirect('auth/login');
    }
}
