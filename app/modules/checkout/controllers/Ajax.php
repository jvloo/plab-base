<?php
defined('BASEPATH') OR exit('No direct script access allowed.');

class Ajax extends Base_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function checkoutCart()
  {
    $selected_items = $this->input->post('itemSelected');

    if ( ! $this->aauth->is_loggedin()) {
      echo 'notLoggedin';
    }

    if (empty($selected_items)) {
      echo 'noItemSelected';
    }
  }
}
