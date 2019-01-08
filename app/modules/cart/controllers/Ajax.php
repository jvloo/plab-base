  <?php
defined('BASEPATH') or exit('No direct script access allowed.');

class Ajax extends Base_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function addCart()
  {
    $this->load->library('cart');

    $item_id = $this->input->post('itemID');
    $item_set = $this->input->post('itemSet');
    $item_name = $this->input->post('itemName');
    $item_thumbnail = $this->input->post('itemThumbnail');
    $item_total_price = $this->input->post('itemTotalPrice');
    $item_original_price = $this->input->post('itemOriginalPrice');
    $item_discount_percent = $this->input->post('itemDiscountPercent');

    $option_choosen = $this->input->post('choices');
    $options = [];
    $option_text = '';
    foreach ($option_choosen as $attribute_id => $option) {
      $options[$attribute_id] = $option['optionID'];

      $attribute = $this->db->where('attribute_id', $attribute_id);
      $attribute = $this->db->get('attribute_meta');
      $attribute = $attribute->row_array();

      $option = $this->db->where('option_id', $option['optionID']);
      $option = $this->db->get('option_meta');
      $option = $option->row_array();

      $option_text = $option_text.'<li class="label-item label-item-sm label-item-flush">'.
                      '<span class="label-title">'.$attribute['name'].':</span>'.
                      '<span class="label-body">'.$option['name'].'</span></li>';
    }


    $data = [
      'id' => $item_id,
      'name' => $item_name,
      'thumbnail' => $item_thumbnail,
      'price' => $item_total_price,
      'original_price' => $item_original_price,
      'discount_percent' => $item_discount_percent,
      'qty' => $item_set,
      'options' => $options,
      'option_text' => $option_text,
    ];

    if ($this->cart->insert($data)) {
      $row_id = md5($item_id.serialize($options));
      $cart_item = (array) $this->cart->get_item($row_id);

      $result = [
        'name' => $cart_item['name'],
        'thumbnail' => $cart_item['thumbnail'],
        'subtotal' => $item_total_price * $item_set,
        'qty' => $item_set,
        'cartTotalItems' => number_limiter($this->cart->total_items()),
        'optionText' => $cart_item['option_text'],
      ];

      $this->render_json($result);
    } else {
      echo 'false';
    }
  }

  public function getCartContents()
  {
    $row_id = $this->input->post('rowID');

    if (empty($this->cart->contents()[$row_id])) {
      echo false;
    } else {
      $output = (array) $this->cart->contents()[$row_id];
      $this->render_json($output);
    }
  }

  public function removeCartItem()
  {
    $row_id = $this->input->post('rowID');

    if ($this->cart->remove($row_id)) {
      echo number_limiter($this->cart->total_items());
    } else {
      echo 'false';
    }
  }

  public function removeCartItems()
  {
    $items = $this->input->post('items');

    $item_removed = [];

    foreach ($items as $row_id) {
      if ($this->cart->remove($row_id)) {
        $item_removed[] = $row_id;
      }
    }

    $result = [
      'removedItems' => $item_removed,
      'cartTotalItems' => number_limiter($this->cart->total_items())
    ];

    if ( ! empty($result)) {
      $this->render_json($result);
    } else {
      echo 'false';
    }
  }

  public function updateItemQty()
  {
    $row_id = $this->input->post('rowID');
    $qty = $this->input->post('qty');

    $data = [
      'rowid' => $row_id,
      'qty'   => $qty,
    ];

    $this->cart->update($data);

    $cart_item = (array) $this->cart->get_item($row_id);
    $result = [
      'totalItems' => number_limiter($this->cart->total_items()),
      'subtotal' => $cart_item['subtotal'],
      'qty' => $cart_item['qty'],
    ];

    $this->render_json($result);
  }

  private function _old_addCart()
  {
    $item_id = $this->input->post('itemID');
    $item_set = $this->input->post('itemSet');
    $option_choosen = $this->input->post('choices');

    $cart_id = md5($item_id.serialize($option_choosen));
    $user = $this->aauth->get_user();

    $cart = $this->db->where('cart_id', $cart_id);
    $cart = $this->db->where('item_id', $item_id);
    $cart = $this->db->where('user_id', $user->id);
    $cart = $this->db->where('is_deleted', 0);
    $cart = $this->db->where('is_checkout', 0);
    $cart = $this->db->get('cart');

    if ($cart->num_rows() > 0) {
      $cart = $cart->row_array();

      $cart_data = [
        'set_quantity' => $cart['set_quantity'] + $item_set,
      ];

      $this->db->where('cart_id', $cart_id);
      $this->db->where('item_id', $item_id);
      $this->db->where('user_id', $user->id);
      $this->db->where('is_deleted', 0);
      $this->db->where('is_checkout', 0);

      $this->db->update('cart', $cart_data);
    } else {
      // Get Price Group
      $attributes = $this->db->where('item_id', $item_id);
      $attributes = $this->db->get('item_attribute');
      $attributes = $attributes->result_array();

      $attribute_options = [];
      foreach ($attributes as $attribute) {
          $attribute_options['attrID' . $attribute['attribute_id']] = [
            'optionID' => $option_choosen[$attribute['attribute_id']]['optionID'],
          ];
      }

      $attribute_option_text = '';
      foreach ($option_choosen as $attribute_id => $option) {
        $attribute = $this->db->where('attribute_id', $attribute_id);
        $attribute = $this->db->where('language_id', 1);
        $attribute = $this->db->get('attribute_meta');
        $attribute = $attribute->row_array();

        $option = $this->db->where('option_id', $option['optionID']);
        $option = $this->db->where('language_id', 1);
        $option = $this->db->get('option_meta');
        $option = $option->row_array();

        $attribute_option_text = $attribute['name'] . ': ' . $option['name'] . '; ' . $attribute_option_text;
      }

      $cart_data = [
        'cart_id' => $cart_id,
        'item_id' => $item_id,
        'user_id' => $user->id,
        'set_quantity' => $item_set,
        'attribute_options' => json_encode($attribute_options),
        'attribute_option_text' => $attribute_option_text,
      ];

      $this->db->insert('cart', $cart_data);
    }


    //$this->render_json($option_chosen);
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
