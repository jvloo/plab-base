<?php
defined('BASEPATH') or exit('No direct script access allowed.');

class Ajax extends AJAX_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->render_json(['test' => 'test']);
  }

  // render json
  public function render_json($response, $statuscode = '200')
  {
      $this->output
      ->set_status_header($statuscode)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
      ->_display();
      exit;
  }
}
