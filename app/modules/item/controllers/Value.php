<?php
defined('BASEPATH') or exit('No direct script access allowed.');

class Value extends Base_Controller
{
  public function __construct()
  {
    parent::__construct();
    // http://malaysiapostcode.com/download
    // https://github.com/heiswayi/malaysia-postcodes
  }

  private function _getPriceInfo($item_id, $option_choosen = [], $postcode)
  {
    $attributes = $this->db->where('item_id', $item_id);
    $attributes = $this->db->get('item_attribute');

    if ($attributes->num_rows() > 0) {
      $attributes = $attributes->result_array();

      $quantity = $this->db->where('option_id', $option_choosen[15]['optionID']);
      $quantity = $this->db->get('option');
      $quantity = $quantity->row_array();
      $quantity = $quantity['slug'];

      $price_group = $this->db->where('item_id', $item_id);
      $price_group = $this->db->get('price_group');
      $price_group = $price_group->row_array();

      $price = $this->db->where('quantity', $quantity);
      $price = $this->db->where('price_group_id', $price_group['price_group_id']);

      foreach ($attributes as $attribute) {
        if ($attribute['attribute_id'] == 15) {
          continue;
        }

        $price = $this->db->where('JSON_EXTRACT(attribute_options,"$.attrID' . $attribute['attribute_id'] . '.optionID")', $option_choosen[ $attribute['attribute_id'] ]['optionID']);
      }


      $price = $this->db->get('price');

      if ($price->num_rows() > 0) {
        $price = $price->row_array();

        $item = $this->db->where('item_id', $item_id);
        $item = $this->db->get('item')->row_array();

        $discount_percent = $item['discount_percent'];
        $discount_decimals = ($item['discount_percent'] / 100);

        $result = [
          'total_price' => 0.00, // (ceil($total_price * 10) / 10); // round up 0.01 to 0.1
          'price_per_unit' => 0.00, // number_format($unit_price, 2);
          'original_price' => 0.00, // (ceil($original_price * 10) / 10);
          'discount_percent' => 0.00, // $discount_percent;
          'total_weight' => 0.00, // $total_weight;
          'delivery_fee' => 0.00,
          'min_delivery_day' => 0.00, // $min_delivery_day;
          'max_delivery_day' => 0.00, // $max_delivery_day;
        ];

        $region = $this->_getDeliveryRegion($postcode);

        switch ($region) {
          case 'WM':
            $result['min_delivery_day'] = ($item['min_process_day'] + 1);
            $result['max_delivery_day'] = ($item['max_process_day'] + 1);
            $result['total_weight'] = $price['total_weight'];

            $product_cost = $price['product_cost'];
            $petrol_cost = $price['petrol_cost'];
            $delivery_cost = $this->_getDeliveryCost($total_weight, $region);

            $costs = [$product_cost, $petrol_cost, $delivery_cost];

            $result['total_price'] = $this->_getTotalPrice($costs, $item['margin_percent']);

            if ( empty($discount_percent) ) {
              $original_price = $total_price;
            } else {
              $result['discount_percent'] = $discount_percent;
              $original_price = $total_price / (1 - $discount_decimals);
            }

            $result['original_price'] = $original_price;
            $result['unit_price'] = (ceil(($total_price / $quantity) * 100) / 100);

            break;

          case 'EM':
            $result['min_delivery_day'] = ($item['min_process_day'] + 1);
            $result['max_delivery_day'] = ($item['max_process_day'] + 1);
            $result['total_weight'] = $price['total_weight'];

            // Calculate EM total price
            $em_product_cost = $price['product_cost'];
            $em_petrol_cost = $price['petrol_cost'];
            $em_delivery_cost = $this->_getDeliveryCost($total_weight, $region);

            $em_costs = [$em_product_cost, $em_petrol_cost, $em_delivery_cost];

            $em_total_price = $this->_getTotalPrice($em_costs, $item['margin_percent']);

            // Calculate WM total price
            $wm_delivery_cost = $this->_getDeliveryCost($total_weight, 'WM');
            $wm_costs = [$wm_product_cost, $wm_petrol_cost, $wm_delivery_cost];

            $wm_total_price = $this->_getTotalPrice($wm_costs, $item['margin_percent']);

            $result['delivery_fee'] = ($em_total_price - $wm_total_price);

            $result['total_price'] = $wm_total_price;

            if ( empty($discount_percent) ) {
              $original_price = $total_price;
            } else {
              $result['discount_percent'] = $discount_percent;
              $original_price = $total_price / (1 - $discount_decimals);
            }

            $result['original_price'] = $original_price;
            $result['unit_price'] = (ceil(($total_price / $quantity) * 100) / 100);
            break;
        }


        return $result;
      }
    }
  }

  private function _getDeliveryRegion($postcode, $country_code = 'MY')
  {
    $this->load->config('address');

    // Get state_code by postcode
    $postcode_list = $this->config->item('address_postcodes');
    if ( ! empty($postcode_list[$country_code]) && ! empty($postcode_list[$country_code][$postcode])) {
      $state_code = $postcode_list[$country_code][$postcode]['state'];
    }

    // Get region_code by state_code
    $state_list = $this->config->item('address_states');
    if ( ! empty($state_list[$country_code]) && ! empty($state_list[$country_code][$state_code])) {
      return $state_list[$country_code][$state_code]['region_code'];
    }

    return false;
  }

  private function _getDeliveryCost($weight, $region_code)
  {
    $delivery_cost = 0.00;

    switch ($region_code) {
      // West (Peninsalur) Malaysia
      case 'WM':
        // Flat rate
        $first_rate = 9.94;
        $first_kg = 2;
        // Standard rate
        $subsequent_rate = 2.13;
        $subsequent_kg = 1;
        break;
      // East Malaysia
      case 'EM':
        // Flat rate
        $first_rate = 14.50;
        $first_kg = 1;
        // Standard rate
        $subsequent_rate = $first_rate;
        $subsequent_kg = $first_kg;
        break;
    }

    // If weight less than or equal to first_KG
    if (ceil($weight) <= $first_kg) {
      // Increment delivery_cost by first_rate per first_KG
      $delivery_cost = $first_rate;

    // If weight larger than first_KG
    } else {
      // Increment delivery_cost by first_rate per first_KG
      $delivery_cost = $first_rate;
      $weight = ceil($weight) - $first_kg;

      // Increment delivery_cost by subsequent_rate per subsequent_KG
      while ($weight > 0) {
        $delivery_cost = $delivery_cost + $subsequent_rate;
        $weight = $weight - $subsequent_kg;
      }
    }

    return $delivery_cost;
  }

  private function _getTotalPrice($costs = [], $margin_percent = 150)
  {
    $margin_decimals = $margin_percent / 100;

    $total_cost = array_sum($costs);
    $total_price = $total_cost * $margin_decimals;

    return $total_price;
  }
}
