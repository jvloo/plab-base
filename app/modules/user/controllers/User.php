<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Base_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->helper('form');
  }

  public function index()
  {
    if ( $this->aauth->is_loggedin() ) {
      redirect('account');
    }

    redirect('user/login');
  }

  public function login()
  {
    if ( $this->aauth->is_loggedin() ) {
      redirect('account');
    }

    if ( ! empty($this->input->post('plabUserLogin')) ) {
      $identifier = $this->input->post('plabLoginID');
      $password   = $this->input->post('plabLoginPassword');
      $remember   = $this->input->post('plabLoginRemember');

      if ( ! empty($remember) ) {
        $remember = true;
      } else {
        $remember = false;
      }

      if ( $this->aauth->login($identifier, $password, $remember) ) {
        $user_id = $this->aauth->get_user()->id;
        
        $cart = $this->db->where('user_id', $user_id);
        $cart = $this->db->where('is_checkout', 0);
        $cart = $this->db->get('cart');

        if ($cart->num_rows() > 0) {
          $cart = $cart->row_array();
          $cart_id = $cart['cart_id'];
        } else {
          $data = [
            'user_id' => $user_id
          ];

          $this->db->insert('cart', $data);
          $cart_id = $this->db->insert_id();
        }

        $cart_items = $this->db->where('cart_id', $cart_id);
        $cart_items = $this->db->where('is_deleted', 0);
        $cart_items = $this->db->get('cart_item');
        $cart_items = $cart_items->result_array();

        foreach ($cart_items as $cart_item) {
          $data = [
            'id' => $cart_item['item_id'],
            'name' => $cart_item['name'],
            'options' => json_decode($cart_item['options'], true),
            'option_text' => $cart_item['option_text'],
            'thumbnail' => $cart_item['thumbnail'],
            'price' => $cart_item['price'],
            'qty' => $cart_item['qty'],
          ];

          $this->cart->insert($data);
        }

        redirect('account');
      }
    }

    $this->template->title->prepend('Login | ');
    $this->template->content->view('login', $this->data);

    $this->template->publish();
  }

  public function sign_up()
  {
    if ( $this->aauth->is_loggedin() ) {
      redirect('account');
    }

    if ( ! empty( $this->input->post('plabUserSignup')) ) {
      $username = strtolower($this->input->post('plabSignupUsername'));
      $password = $this->input->post('plabSignupPassword');
      $email    = $this->input->post('plabSignupEmail');

      $newsletter = $this->input->post('plabSignupSubscribe');

      if ( $this->aauth->create_user($email, $password, $username) ) {
        $this->aauth->login($email, $password);

        if ( empty($newsletter) ) {
          $this->aauth->set_user_var('newsletter', 'false');
        } else {
          $this->aauth->set_user_var('newsletter', 'true');
        }

        redirect('account/setup');
      }
    }

    $this->template->title->prepend('Sign Up | ');
    $this->template->content->view('sign-up', $this->data);

    $this->template->publish();
  }

  public function logout()
  {
    $this->cart->destroy();
    $this->aauth->logout();
    redirect('home');
  }
}
