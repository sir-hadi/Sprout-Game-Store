<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Developer extends CI_Controller
{
    /**
     * Pada kelas controller Developer ini akan mengatur beberapa fungsi yang akan dipanggil dari sisi Developer,
     * Mulai dari halaman utama developer, formgamerequest, my publishedgame / revenue dan uploadimage game.
     * Data yang diolah merupakan database yang diambil melalui database.php yang kemudian 
     * Akan ditambah database nya berupa database developer itu sendiri. Selain itu 
     * Ada juga data berupa templates view dari header, halaman utama dan footer untuk developer.
     * @author Aditya Ramadhan
     * @version 1.0
     * @since 2021 - 02 - 20
     */

    /** 
     * Method construct ini digunakan karena dalam setiap method yang ada di class ini 
     * akan menggunakan model DeveloperModel, sehingga dibuatlah function construct 
     * agar dalam setiap method tidak perlu lagi memanggil model berkalikali
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DeveloperModel');
        // $this->load->model('Model_game');
    }
    /** 
     * Method index ini digunakan untuk membuat sebuah halaman utama dengan 
     * menghubungkan views yang telah dibuat, yaitu header, body, dan footer dari
     * halaman utama developer
     */
    public function index()
    {
        $data['title'] = 'Create Game Request';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user'] && $data['user']['role_id'] == 2) {
            $this->load->view('templates/header_developer', $data);
            $this->load->view('developer/index');
            $this->load->view('templates/auth_footer');
        } else {
            redirect('auth/logout');
        }
    }

    /** 
     * Method formGameRequest ini digunakan untuk developer mengirimkan data request game ke 
     * database game yang nantinya akan masuk dan dibolehkan oleh admin
     */
    public function formGameRequest()
    {
        $data['title'] = 'Sprout User Page';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['developer'] = $this->db->get_where('developer', ['id_user' => $data['user']['id_user']])->row_array();
        if ($data['user'] && $data['user']['role_id'] == 2) {
            $this->load->view('templates/header_developer', $data);
            $this->load->view('developer/formGameRequest', $data);
            $this->load->view('templates/auth_footer');
        } else {
            redirect('auth/logout');
        }
    }
    /** 
     * Method gameRequest ini digunakan untuk developer mengirimkan data request game ke 
     * database game yang nantinya akan masuk dan dibolehkan oleh admin
     */
    public function gameRequest()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['developer'] = $this->db->get_where('developer', ['id_user' => $data['user']['id_user']])->row_array();
        $data['game'] = $this->db->get_where('game', ['developer_id' => $data['developer']['developer_id']])->row_array();

        $this->form_validation->set_rules('developer_id', 'Developer ID', 'required|trim');
        $this->form_validation->set_rules('gameName', 'Game Name', 'required|trim');
        $this->form_validation->set_rules('price', 'Price', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');

        if ($data['user'] && $data['user']['role_id'] == 2) {
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header_developer', $data);
                $this->load->view('developer/formGameRequest', $data);
                $this->load->view('templates/auth_footer');
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal Membeli Game<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </div>');
            } else {
                $this->DeveloperModel->makeGameRequest();
                redirect('developer/uploadImageGame');
            }
        } else {
            redirect('auth');
        }
    }
    /** 
     * Method uploadImageGame ini digunakan untuk developer mengirimkan data image
     * ke database game yang nantinya akan masuk dan masuk list request game di halaman admin
     */
    public function uploadImageGame()
    {
        $config['upload_path']          =  './assets/img/game'; //isi dengan nama folder temoat menyimpan gambar
        $config['allowed_types']        =  'jpg|png'; //isi dengan format/tipe gambar yang diterima
        $config['max_size']             = '2048';  //isi dengan ukuran maksimum yang bisa di upload
        $config['max_width']            =  '3024'; //isi dengan lebar maksimum gambar yang bisa di upload
        $config['max_height']           = '3024'; //isi dengan panjang maksimum gambar yang bisa di upload

        $this->load->library('upload', $config);

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['developer'] = $this->db->get_where('developer', ['id_user' => $data['user']['id_user']])->row_array();
        // $data['game'] = $this->db->get_where('game', ['developer_id' => $data['developer']['developer_id']])->row_array();
        $latestRow = $this->db->select("*")->limit(1)->order_by('game_id', "DESC")->get("game")->row_array();

        if ($data['user'] && $data['user']['role_id'] == 2) {
            if (!$this->upload->do_upload('image_new')) {
                // $data['error'] = $this->upload->display_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert"><a>', '</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                $data['title'] = 'Upload Game\'s Image';
                $this->load->view('templates/header_developer', $data);
                $this->load->view('developer/uploadImageGame', $data);
                $this->load->view('templates/auth_footer');
            } else {

                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
                $this->db->where('game_id', $latestRow['game_id']); //$latestRow['game_id']);
                $this->db->update('game');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Foto Profile Berhasil Di Update<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> </div>');
                redirect('developer');
            }
        }
    }
    /** 
     * Method myPublishedGames ini digunakan untuk developer menerima
     * data game yang dia miliki beserta transaksi yang telah dilakukan terhadap game yang 
     * dimiiki developer
     */
    public function myPublishedGames()
    {
        $data['title'] = 'My Published Games';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['transactions'] = $this->db->get('transaction')->result_array();
        $data['games'] = $this->DeveloperModel->myPublishedGames();

        $this->load->view('templates/header_developer', $data);
        $this->load->view('developer/myPublishedGame', $data);
        $this->load->view('templates/auth_footer');
    }
}
