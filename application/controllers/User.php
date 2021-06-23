<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
* Representasikan Controller User
* yang bertindak sebagai flow antara semua aksi pada dari view dan model.
* semua aksi sesuai dengann functional requirement, selain itu saat terpanggil
* dia menyusun dan get data user mulai dari session dan profile info, serta 
* mengambil data dari game dengan memanggil model game
*
* @author Abdullah Hadi
* @version 1.2
* @since 2021-06-15
*/

class User extends CI_Controller
{

    /**
     * load Model user
     * load Model game
     * model yang di load akan di gunakan untuk mengambil data
     * di database
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('Model_game');
    }

    /**
     * menyusun view dan mengisi view dengan data yang di dapatkan
     * dari model game dan session user
     */
    public function index()
    {
        $data['title'] = 'Sprout User Page';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['games'] = $this->db->get('game')->result_array();
        // Jika user ada akan menampilkan view dengan user yang sudah login sebelumnya
        if ($data['user']) {
            // Berdasarkan role akan 
            if ($data['user']['role_id'] == 1) {
                $this->load->view('templates/header_user', $data);
                $this->load->view('user/index', $data);
                $this->load->view('templates/auth_footer');
            } else if ($data['user']['role_id'] == 2) {
                redirect('developer');
            }
        // Jika user tidak ada akan mengembalikan ke paga login
        } else {
            redirect('auth');
        }
    }

    /**
     * Menampilkan view edit profile untuk user, dimana setiap role akun akan 
     * memiliki tampilan berbeda sedikit, serta menyesuaikan data yang 
     * di ambil dari model
     */
    public function editProfile()
    {
        $data['title'] = 'Edit Profile Page';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('name', 'Name', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');

        if ($data['user']) {
            if ($this->form_validation->run() == false) {
                if ($data['user']['role_id'] == 1) {
                    $this->load->view('templates/header_user', $data);
                } else if ($data['user']['role_id'] == 2) {
                    $this->load->view('templates/header_developer', $data);
                }
  
                $this->load->view('user/editProfile');
                $this->load->view('templates/auth_footer');
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Akun Gagal Dirubah<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </div>');
            } else {
                $this->UserModel->updateProfile($data['user']['id_user']);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Akun Berhasil Dirubah<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </div>');
                if ($data['user']['role_id'] == 1) {
                    redirect('user');
                } else if ($data['user']['role_id'] == 2) {
                    redirect('developer');
                }
            }
        } else {
            redirect('auth');
        }
    }

    /**
     * Menampilkan Page my game serta mengambil data dari model game yang dimiliki user terntentu
     */
    public function myGame()
    {

        $data['title'] = 'My Games';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //id user

        $this->db->select('*');
        $this->db->from('game');
        $this->db->join('transaction', 'game.game_id = transaction.game_id');
        $condition = "transaction.id_user = " . $data['user']['id_user'];
        // $this->db->where('usergame', ['id_user' => $data['user']['id_user']]);
        $this->db->where($condition);
        $data['games'] = $this->db->get()->result_array(); //data Array

        // $data['myId'] = $this->db->get_where('userGame', ['id_user' => $data['user']['id_user']])->row_array(); // id game
        // $data['games'] = $this->db->get_where(['game',['game_id' => $data['myId']['']] ]);

        if ($data['user']['role_id'] == 1) {
            $this->load->view('templates/header_user', $data);
        } else if ($data['user']['role_id'] == 2) {
            $this->load->view('templates/header_developer', $data);
        }
        $this->load->view('user/myGame', $data);
        $this->load->view('templates/auth_footer');
    }


    /**
     * Melakukan proses pembelian game kepada user pada game yang tersedia
     */
    public function buyGame()
    {
        $data['title'] = 'Buy Games';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['games'] = $this->Model_game->tampil_data();
        $this->form_validation->set_rules('game_id', 'Game', 'required|trim');

        if ($data['user']) {
            if ($this->form_validation->run() == false) {
                if ($data['user']['role_id'] == 1) {
                    $this->load->view('templates/header_user', $data);
                } else if ($data['user']['role_id'] == 2) {
                    $this->load->view('templates/header_developer', $data);
                }
                $this->load->view('user/buyGame', $data);
                $this->load->view('templates/auth_footer');
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal Membeli Game<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </div>');
            } else {
                $this->UserModel->buyNewGame();
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Game Berhasil dibeli<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </div>');
                if ($data['user']['role_id'] == 1) {
                    redirect('user');
                } else if ($data['user']['role_id'] == 2) {
                    redirect('developer');
                }
            }
        } else {
            redirect('auth');
        }
    }

    /**
     * Mengembalikan data transaksi user
     */
    public function myTransactions()
    {
        $data['title'] = 'My Transactions';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //id user

        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->join('game', 'transaction.game_id = game.game_id ');
        $condition = "transaction.id_user = " . $data['user']['id_user'];
        $this->db->where($condition);
        $data['transactions'] = $this->db->get()->result_array(); //data Array

        if ($data['user']['role_id'] == 1) {
            $this->load->view('templates/header_user', $data);
        } else if ($data['user']['role_id'] == 2) {
            $this->load->view('templates/header_developer', $data);
        }
        $this->load->view('user/myTransactions', $data);
        $this->load->view('templates/auth_footer');
    }

    /**
     * Melakukan pergantian profile picture user
     */
    public function ubah_photo_profile()
    {
        $config['upload_path']          =  './assets/img/profile';
        $config['allowed_types']        =  'jpg|png'; 
        $config['max_size']             = '2048'; 
        $config['max_width']            =  '2024'; 
        $config['max_height']           = '1780'; 

        $this->load->library('upload', $config);

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if (!$this->upload->do_upload('image')) {
            $data['title'] = 'Ubah Foto Profile';
            if ($data['user']['role_id'] == 1) {
                $this->load->view('templates/header_user', $data);
            } else if ($data['user']['role_id'] == 2) {
                $this->load->view('templates/header_developer', $data);
            }
            $this->load->view('user/editProfile', $data);
            $this->load->view('templates/auth_footer');
        } else {
            $new_image = $this->upload->data('file_name');
            $this->db->set('image', $new_image);
            $this->db->where('id_user', $data['user']['id_user']);
            $this->db->update('user');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Foto Profile Berhasil Di Update<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> </div>');
            
            if ($data['user']['role_id'] == 1) {
                return redirect('user');
            } else if ($data['user']['role_id'] == 2) {
                return redirect('developer');
            }

        }
    }

    /**
     * Proses menambahkan game ke dalam cart user berdasarkan game id yang terpilih
     */
    public function addToCart($id)
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); #mengambil data 
        $game = $this->Model_game->find($id);

        $data = array(
            'id'      => $game->game_id, #wajib
            'qty'     => 1, #wajib
            'price'   => $game->price, #wajib
            'name'    => $game->gameName, #wajib
            'description' => $game->description, #optional
            'id_user' => $user['id_user'], #optional
            "developer_id" => $game->developer_id, #optional
            "image" => $game->image #optional

        );

        $this->cart->insert($data);
        return redirect('user/buyGame');
    }

    /**
     * Menampilkan cart user, yang dapat berisi game yang telah di pilih user
     */
    public function myCart()
    {
        $data['title'] = 'My Cart';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] == 1) {
            $this->load->view('templates/header_user', $data);
        } else if ($data['user']['role_id'] == 2) {
            $this->load->view('templates/header_developer', $data);
        }
        $this->load->view('user/myCart', $data);
        $this->load->view('templates/auth_footer');
    }

    /**
     * Membeli game via card dengan parameter sebagai rowid untuk menghilangkan game tersebut di dalam view cart
     */
    public function buyViaCart($rowid)
    {
        $data['title'] = 'My Games';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('game_id', 'Game', 'required|trim');

        if ($data['user']) {
            if ($this->form_validation->run() == false) {
                if ($data['user']['role_id'] == 1) {
                    $this->load->view('templates/header_user', $data);
                } else if ($data['user']['role_id'] == 2) {
                    $this->load->view('templates/header_developer', $data);
                }
                $this->load->view('user/myCart', $data);
                $this->load->view('templates/auth_footer');
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal Membeli Game<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </div>');
            } else {
                $this->UserModel->buyNewGame();
                $this->cart->remove($rowid);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Game Berhasil dibeli<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </div>');
                if ($data['user']['role_id'] == 1) {
                    redirect('user');
                } else if ($data['user']['role_id'] == 2) {
                    redirect('developer');
                }
            }
        } else {
            redirect('auth');
        }
    }

    /**
     * Mereset dan menghapus semua isi cart user
     */
    public function destroyCart()
    {
        $this->cart->destroy();
        redirect('user/myCart');
    }

    /**
     * Melakukan request untuk menjadi developer, dengan memanggil 
     * function dalam UserModel untuk di manipulasi databasenya
     */
    public function developerRequest()
    {
        $this->UserModel->devRequest();
        redirect('user/editProfile');
    }
}
