<?php
defined('BASEPATH') OR exit('No direct script access allowed.');

class Cart extends Base_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->template->title->prepend('Shopping Cart | ');
    $this->template->content->view('cart', $this->data);

    $this->template->publish();
  }
}
