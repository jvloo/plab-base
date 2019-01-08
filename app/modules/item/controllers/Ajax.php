<?php
defined('BASEPATH') or exit('No direct script access allowed.');

class Ajax extends Base_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function setDeliveryArea()
  {
    $postcode = $this->input->post('postcode');
    $this->session->set_userdata('postcode', $postcode);

    if (empty($postcode)) {
      print 'false';
    }

    $state_code = $this->_getStateCode($postcode);
    $deliveryInfo = $this->_getDeliveryInfo($postcode);

    if ($deliveryInfo) {
      print json_encode($deliveryInfo);
    } else {
      print 'false';
    }
  }

  public function getDeliveryRegion($postcode)
  {
    if (empty($postcode)) {
      return 'WM';
    }

    $state_code = $this->_getStateCode($postcode);
    $region_code = $this->_getRegionCode($state_code);

    return $region_code;
  }

  private function _getRegionCode(string $state_code, string $country = 'MY')
  {
    $this->load->config('address');
    $address = $this->config->item('address_states');

    if ( ! empty($address[$country][$state_code]['region_code'])) {
      return $address[$country][$state_code]['region_code'];
    }

    return false;
  }

  private function _getStateCode(string $postcode, string $country = 'MY')
  {
    $this->load->config('address');
    $address = $this->config->item('address_postcodes');

    if ( ! empty($address[$country][$postcode]['state'])) {
      return $address[$country][$postcode]['state'];
    }

    return false;
  }

  private function _getStateName(string $state_code, string $country = 'MY')
  {
    $this->load->config('address');
    $address = $this->config->item('address_states');

    if ( ! empty($address[$country][$state_code]['name'])) {
      return $address[$country][$state_code]['name'];
    }

    return false;
  }

  private function _getDeliveryInfo(string $postcode, string $country = 'MY')
  {
    $this->load->config('address');
    $address = $this->config->item('address_postcodes');

    if ( ! empty($address[$country][$postcode])) {
      $result = [
        'state'    => $this->_getStateName($address[$country][$postcode]['state']),
        'city'     => $address[$country][$postcode]['city'],
        'postcode' => $postcode,
      ];

      return $result;
    }

    return false;
  }

  public function updateAttrOptions()
  {
    $item_id = $this->input->post('itemID');
    $determinants = $this->input->post('determinants');
    $option_choosen = $this->input->post('choices');
    $keep_option_choosen = 1;

    $result = [];

    foreach ($determinants as $determinant_index => $determinant_id) {
      $attribute_id = $determinant_id;
      $option_id = $option_choosen[$determinant_id]['optionID'];

      // Get Attribute Variants
      $variants = $this->db->where('item_id', $item_id);
      $variants = $this->db->where('attribute_id', $attribute_id);
      $variants = $this->db->where('option_id', $option_id);
      $variants = $this->db->get('item_variant');
      $variants = $variants->result_array();

      $variable_attributes = [];
      foreach ($variants as $var) {
        // Get Variant Attributes
        $attributes = $this->db->where('variant_id', $var['variant_id']);
        $attributes = $this->db->get('variant_option');
        $attributes = $attributes->result_array();

        foreach ($attributes as $attribute) {
          $variable_attributes[] = $attribute['attribute_id'];
        }
      }

      $variable_attributes = array_unique($variable_attributes);


      foreach ($variants as $var) {
        foreach ($variable_attributes as $attribute_id) {
          $is_determinant = $this->db->select('is_variant_determinant');
          $is_determinant = $this->db->where('item_id', $item_id);
          $is_determinant = $this->db->where('attribute_id', $attribute_id);
          $is_determinant = $this->db->get('item_attribute');
          $is_determinant = $is_determinant->row_array();

          $is_determinant = $is_determinant['is_variant_determinant'];

          $result[$attribute_id]['attrID'] = $attribute_id;
          $options = [];

          // Load Item Attribute Options
          $item_options = $this->db->where('item_id', $item_id);
          $item_options = $this->db->where('attribute_id', $attribute_id);
          $item_options = $this->db->join('option_meta AS meta', 'meta.option_id = item_option.option_id');
          //$item_options = $this->db->order_by('meta.option_id', 'ASC');
          //$item_options = $this->db->order_by('sort_order', 'ASC');
          $item_options = $this->db->get('item_option');

          if ($item_options->num_rows() > 0) {
            $item_options = $item_options->result_array();
            foreach ($item_options as $opt) {
              $option = [
                'optID' => $opt['option_id'],
                'name' => $opt['name'],
                'sort_order' => $opt['sort_order'],
                'is_popular' => $opt['is_option_popular'],
                'is_determinant' => $is_determinant,
                'is_checked' => 0,
              ];

              if ( ! empty($option_choosen[$attribute_id]['optionID']) && $keep_option_choosen === 1) {
                $option_choosen_id = $option_choosen[$attribute_id]['optionID'];
                if ($opt['option_id'] == $option_choosen_id) {
                  $option['is_checked'] = 1;
                }
              }

              $options[] = $option;
            }
          }

          $variant_id = $var['variant_id'];

          // Load Variant Attribute Options
          $variant_options = $this->db->where('variant_id', $variant_id);
          $variant_options = $this->db->where('attribute_id', $attribute_id);
          $variant_options = $this->db->join('option_meta AS meta', 'meta.option_id = variant_option.option_id');
          //$variant_options = $this->db->order_by('meta.option_id', 'ASC');
          //$variant_options = $this->db->order_by('sort_order', 'ASC');
          $variant_options = $this->db->get('variant_option');

          if ($variant_options->num_rows() > 0) {
            $variant_options = $variant_options->result_array();
            foreach ($variant_options as $opt) {
              $option = [
                'optID' => $opt['option_id'],
                'name' => $opt['name'],
                'sort_order' => $opt['sort_order'],
                'is_popular' => $opt['is_option_popular'],
                'is_determinant' => $is_determinant,
                'is_checked' => 0,
              ];

              if ( ! empty($option_choosen[$attribute_id]['optionID']) && $keep_option_choosen === 1) {
                $option_choosen_id = $option_choosen[$attribute_id]['optionID'];
                if ($opt['option_id'] == $option_choosen_id) {
                  $option['is_checked'] = 1;
                }
              }

              $options[] = $option;
            }
          }

          //$options = array_map("unserialize", array_unique(array_map("serialize", $options)));
          $options = $this->array_unique_all($options, 'optID');

          // Sort Multi-dimensional Array by Value https://stackoverflow.com/a/2699159
          usort($options, function($a, $b) {
            return $a['optID'] <=> $b['optID'];
          });
          usort($options, function($a, $b) {
            return $a['sort_order'] <=> $b['sort_order'];
          });
          foreach ($options as $opt_index => $option) {
            $result[$attribute_id]['options'][] = $option;
          }

          $has_checked_option = false;
          foreach ($options as $option) {
            if ($option['is_checked'] === 1) {
              $option_choosen[$attribute_id]['optionID'] = $option['optID'];
              $has_checked_option = true;
              break;
            }
          }

          if ($has_checked_option == false) {
            $result[$attribute_id]['options'][0]['is_checked'] = 1;
            $option_choosen[$attribute_id]['optionID'] = $result[$attribute_id]['options'][0]['optID'];
          }
        }

      }
    }

    if ( ! empty($result) ) {
      print json_encode($result);
    } else {
      print 'false';
    }

    // DEBUG: Total 5 database requests
  }

  private function array_unique_all($my_array, $key)
  {
    // Method 1: https://www.phpflow.com/php/remove-duplicates-from-multidimensional-array/
    /*
     $output = array_map("unserialize",
     array_unique(array_map("serialize", $my_array)));
     return $output;
     */

    // Method 2: https://www.w3resource.com/php-exercises/php-array-exercise-38.php
    $result = [];
    $i = 0;
    $key_array = [];

    foreach($my_array as $val) {
      if (! in_array($val[$key], $key_array)) {
        $key_array[$i] = $val[$key];
        $result[$i] = $val;
      }
      $i++;
    }
    return $result;
  }

  public function updatePriceInfo()
  {
    $item_id = $this->input->post('itemID');
    $option_choosen = $this->input->post('choices');
    $postcode = $this->input->post('postcode');

    $result = $this->_getPriceInfo($item_id, $option_choosen, $postcode);

    if ( ! empty($result)) {
      print_r(json_encode($result));
    } else {
      echo 'false';
    }
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
          'delivery_region' => 'WM',
        ];

        $region = $this->getDeliveryRegion($postcode);

        switch ($region) {
          case 'WM':
            $min_delivery_day = ($item['min_process_day'] + 1);
            $max_delivery_day = ($item['max_process_day'] + 1);
            $total_weight = $price['total_weight'];

            $product_cost = $price['product_cost'];
            $petrol_cost = $price['petrol_cost'];
            $delivery_cost = $this->_getDeliveryCost($total_weight, $region);

            $costs = [$product_cost, $petrol_cost, $delivery_cost];
            $total_price = $this->_getTotalPrice($costs, $item['margin_percent']);

            if ( empty($discount_percent) ) {
              $original_price = $total_price;
            } else {
              $original_price = $total_price / (1 - $discount_decimals);
            }

            $unit_price = (ceil(($total_price / $quantity) * 100) / 100);

            $result['total_price'] = (ceil($total_price * 10) / 10); // round up 0.01 to 0.1
            $result['price_per_unit'] = number_format($unit_price, 2);
            $result['original_price'] = (ceil($original_price * 10) / 10);
            $result['discount_percent'] = $discount_percent;
            $result['total_weight'] = $total_weight;
            $result['min_delivery_day'] = $min_delivery_day;
            $result['max_delivery_day'] = $max_delivery_day;
            break;

          case 'EM':
            $min_delivery_day = ($item['min_process_day'] + 3);
            $max_delivery_day = ($item['max_process_day'] + 3);
            $total_weight = $price['total_weight'];

            // West Malaysia
            $wm_product_cost = $price['product_cost'];
            $wm_petrol_cost = $price['petrol_cost'];
            $wm_delivery_cost = $this->_getDeliveryCost($total_weight, 'WM');

            $wm_costs = [$wm_product_cost, $wm_petrol_cost, $wm_delivery_cost];
            $wm_total_price = $this->_getTotalPrice($wm_costs, $item['margin_percent']);

            // East Malaysia
            $em_product_cost = $price['product_cost'];
            $em_petrol_cost = $price['petrol_cost'];
            $em_delivery_cost = $this->_getDeliveryCost($total_weight, 'EM');

            $em_costs = [$em_product_cost, $em_petrol_cost, $em_delivery_cost];
            $em_total_price = $this->_getTotalPrice($em_costs, $item['margin_percent']);

            $em_delivery_fee = ($em_total_price - $wm_total_price);

            if ( empty($discount_percent) ) {
              $original_price = $wm_total_price;
            } else {
              $original_price = $wm_total_price / (1 - $discount_decimals);
            }

            $unit_price = (ceil(($wm_total_price / $quantity) * 100) / 100);

            $result['total_price'] = (ceil($wm_total_price * 10) / 10); // round up 0.01 to 0.1
            $result['price_per_unit'] = number_format($unit_price, 2);
            $result['original_price'] = (ceil($original_price * 10) / 10);
            $result['discount_percent'] = $discount_percent;
            $result['total_weight'] = $total_weight;
            $result['min_delivery_day'] = $min_delivery_day;
            $result['max_delivery_day'] = $max_delivery_day;
            $result['delivery_fee'] = (ceil($em_delivery_fee * 10) / 10);
            $result['delivery_region'] = 'EM';
            break;
        }


        return $result;
      }
    }
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

  private function _old_updatePriceInfo()
  {
    $item_id = $this->input->post('itemID');
    $option_choosen = $this->input->post('choices');

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

        $margin_percent = $item['margin_percent'];
        $discount_percent = $item['discount_percent'];

        $margin_decimals = ($item['margin_percent'] / 100);
        $discount_decimals = ($item['discount_percent'] / 100);

        $min_delivery_day = ($item['min_process_day'] + 1);
        $max_delivery_day = ($item['max_process_day'] + 1);
        $total_weight = $price['total_weight'];

        $product_cost = $price['product_cost'];
        $petrol_cost = $price['petrol_cost'];

        if (ceil($total_weight) <= 2) {
          $delivery_cost = 9.94;
        } else {
          $remaining_kg = ceil($total_weight);

          $first_n_kg = 9.94;
          $subsequent_kg = 2.13;

          $delivery_cost = 9.94;
          $remaining_kg = ($remaining_kg - 2);

          while ($remaining_kg > 0) {
            $delivery_cost = $delivery_cost + $subsequent_kg;
            $remaining_kg = $remaining_kg - 1;
          }
        }



        $total_cost = $product_cost + $petrol_cost + $delivery_cost;
        $total_price = $total_cost * $margin_decimals;

        if ( empty($discount_percent) ) {
          $original_price = $total_price;
        } else {
          $original_price = $total_price / (1 - $discount_decimals);
        }

        $unit_price = (ceil(($total_price / $quantity) * 100) / 100);

        $result['total_price'] = (ceil($total_price * 10) / 10); // round up 0.01 to 0.1
        $result['price_per_unit'] = number_format($unit_price, 2);
        $result['original_price'] = (ceil($original_price * 10) / 10);
        $result['discount_percent'] = $discount_percent;
        $result['total_weight'] = $total_weight;
        $result['min_delivery_day'] = $min_delivery_day;
        $result['max_delivery_day'] = $max_delivery_day;

        print_r( json_encode($result) );
        exit;
      }
    }

    print 'false';
  }


  public function import()
  {
    $item_id = $this->input->post('itemID');
    $option_choosen = $this->input->post('choices');

    $product_cost = str_replace([',',' '], '', $this->input->post('productCost'));
    $total_weight = str_replace([',',' '], '', $this->input->post('totalWeight'));


    // Get Price Group
    $price_group = $this->db->where('item_id', $item_id);
    $price_group = $this->db->get('price_group');
    $price_group = $price_group->row_array();


    $attributes = $price_group['attributes'];
    $attributes = json_decode($attributes, true);

    $attribute_options = [];
    foreach ($attributes as $attribute_id) {
      if ($attribute_id !== 15) {
        $attribute_options['attrID' . $attribute_id] = [
          'optionID' => $option_choosen[$attribute_id]['optionID'],
        ];
      }
    }

    $quantity = $this->db->where('option_id', $option_choosen[15]['optionID']);
    $quantity = $this->db->get('option');
    $quantity = $quantity->row_array();
    $quantity = $quantity['slug'];

    // Check if exist
    $is_exist_price = $this->db->where('price_group_id', $price_group['price_group_id']);
    $is_exist_price = $this->db->where('quantity', $quantity);
    foreach ($attribute_options as $key => $value) {
      $is_exist_price = $this->db->where('JSON_EXTRACT(attribute_options,"$.' . $key . '.optionID")', $value['optionID']);
    }
    $is_exist_price = $this->db->get('price');

    if ($is_exist_price->num_rows() > 0) {
      $this->db->where('price_group_id', $price_group['price_group_id']);
      $this->db->where('quantity', $quantity);
      foreach ($attribute_options as $key => $value) {
        $this->db->where('JSON_EXTRACT(attribute_options,"$.' . $key . '.optionID")', $value['optionID']);
      }

      $data = [
        'product_cost' => $product_cost,
        'total_weight' => $total_weight,
      ];
      $this->db->update('price', $data);

    } else {
      $data = [
        'price_group_id' => $price_group['price_group_id'],
        'quantity' => $quantity,
        'attribute_options' => json_encode($attribute_options),
        'product_cost' => $product_cost,
        'total_weight' => $total_weight,
      ];
      $this->db->insert('price', $data);
    }


    if ($this->db->affected_rows() > 0) {
      echo 'true';
    } else {
      echo 'false';
    }
  }
}
