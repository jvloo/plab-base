<?php
defined('BASEPATH') OR exit('No direct script access allowed.');

class Lab extends Base_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->config('address');
  }

  public function index(string $postcode)
  {
    if (empty($postcode)) {
      return false;
    }

    $state_code = $this->_getStateCode($postcode);
    $region_code = $this->_getRegionCode($state_code);

    return $region_code;
  }

  private function _getRegionCode(string $state_code, string $country = 'MY')
  {
    $address = $this->config->item('address_states');

    if ( ! empty($address[$country][$state_code]['region_code'])) {
      return $address[$country][$state_code]['region_code'];
    }

    return false;
  }

  private function _getStateCode(string $postcode, string $country = 'MY')
  {
    $address = $this->config->item('address_postcodes');

    if ( ! empty($address[$country][$postcode]['state'])) {
      return $address[$country][$postcode]['state'];
    }

    return false;
  }

  public function address2Postcode()
  {
    $handle = fopen(FCPATH.'address.txt', 'r');

    if ($handle) {

      while (($line = fgets($handle)) !== false) {
        $line = explode('"', $line);

        foreach ($line as $key => $value) {
          if ($value == ',' || empty($value)) {
            unset($line[$key]);
          }
        }

        unset($line[3]);
        unset($line[8]);
        sort($line);

        foreach ($line as $unknown) {
          if (is_numeric($unknown)) {
            $postcode = $unknown;
          } elseif (strlen($unknown) == 3) {
            $state = $unknown;
          } else {
            $city = $unknown;
          }
        }


        $data['MY'][$postcode] = [
          "'city'"  => "'".$city."','",
          "'state'" => "'".$state."','",
        ];
      }

      fclose($handle);

      print("<pre>".print_r($data, true)."</pre>");

    }
  }
}
