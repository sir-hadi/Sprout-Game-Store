<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'Sprout Landing Page';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/home');
        $this->load->view('templates/auth_footer');
    }

    public function login()
    {
        $data['title'] = 'Sprout Login Page';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }

    public function registration()
    {
        $data['title'] = 'Sprout Registration Page';
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
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
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => 1,
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation! Your account has been registered. Please Login!
          </div>');
            $this->session->set_flashdata('');
            redirect('auth');
        }
    }
}