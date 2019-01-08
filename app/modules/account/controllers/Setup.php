<?php
defined('BASEPATH') or exit('No direct script access allowed.');

class Setup extends User_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->helper('form');

    if ($this->aauth->get_user_var('account_setup') >= 2) {
      redirect('account');
    }
  }

  public function index()
  {
    if ( empty($this->aauth->get_user_var('account_setup')) ) {
      $this->aauth->set_user_var('account_setup', 0);
    }

    if ($this->aauth->get_user_var('account_setup') < 2) {
      $step = $this->aauth->get_user_var('account_setup') +1;
      redirect('account/setup/step-' . $step);
    }
  }

  public function step_1()
  {
    if ($this->aauth->get_user_var('account_setup') == 1) {
      redirect('account/setup/step-2');
    }

    if ( ! empty($this->input->post('plabAccSetup')) ) {
      $display_lang = $this->input->post('plabLangDisplay');
      $this->aauth->set_user_var('display_language', $display_lang);

      $comm_lang = json_encode($this->input->post('plabLangComm'));
      $this->aauth->set_user_var('communication_language', $comm_lang);

      $this->aauth->set_user_var('account_setup', 1);

      redirect('account/setup/step-2');
    }

    $this->template->title->prepend('Account Setup | ');
    $this->template->content->view('setup/step-1', $this->data);

    $this->template->publish();
  }

  public function step_2()
  {
    if ($this->aauth->get_user_var('account_setup') == 0) {
      redirect('account/setup/step-1');
    }

    if ($this->aauth->get_user_var('account_setup') == 3) {
      redirect('account');
    }

    if ( ! empty($this->input->post('plabAccSetup')) ) {
      $secure_code = $this->input->post('plabSecureCode');
      $secure_code_2 = $this->input->post('plabSecureCode-2');

      if ( empty($secure_code) ) {
        $this->aauth->error('Please enter your secure code.');
      }

      if ($secure_code_2 !== $secure_code) {
        $this->aauth->error('Secure code does not match the confirm secure code.');
      }

      $survey_1 = $this->input->post('plabSurvey-1');
      $survey_1_other = $this->input->post('plabSurvey-1-other');

      if ( empty($survey_1) ) {
        $this->aauth->error('Please select your answer.');
      }

      if ($survey_1 == 'other' && empty($survey_1_other) ) {
        $this->aauth->error('Please specify your answer.');
      }

      if ( empty($this->aauth->get_errors_array()) ) {
        $this->aauth->set_user_var('secure_code', $secure_code);
        if ($survey_1 == 'other') {
          $this->aauth->set_user_var('survey_1', 'Other (' . $survey_1_other . ')');
        } else {
          $this->aauth->set_user_var('survey_1', $survey_1);
        }

        $this->aauth->set_user_var('account_setup', 3);
        redirect('home');
      }
    }

    $this->template->title->prepend('Account Setup | ');
    $this->template->content->view('setup/step-2', $this->data);

    $this->template->publish();
  }
}
