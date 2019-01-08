<?php
defined('BASEPATH') or exit('No direct script access allowed.');

class Item extends Base_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index($identifier = 0, $import = '')
  {
    $data = [];

    if (empty($identifier)) {
      show_404();
    }

    // IF $identifier = id
    if (is_numeric($identifier)) {
      $item = $this->db->where('item_id', $identifier);

    // ELSE $identifier = slug
    } else {
      $item = $this->db->where('slug', $identifier);
    }

    // Get item
    $item = $this->db->where('is_active', 1); // Only get active item
    $item = $this->db->get('item');

    if (empty($item->num_rows())) {
      show_404();
    }

    $item = $item->row_array();

    $data['item']['item_id'] = $item['item_id'];
    $data['item']['slug'] = $item['slug'];

    if (! empty($item['thumbnail_image'])) {
      $data['item']['thumbnail'] = parse_source($item['thumbnail_image']);
    } else {
      $data['item']['thumbnail'] = dummy_image('800x800');
    }

    // Get item meta
    $item_meta = $this->db->where('item_id', $item['item_id']);
    $item_meta = $this->db->where('language_id', 1); // TODO: Internationalization
    $item_meta = $this->db->get('item_meta');

    if (empty($item_meta->num_rows())) {
      // Try to refer to meta of parent item
      if ( ! empty($item['parent_id']) ) {
        $item_meta = $this->db->where('item_id', $item['item_id']);
        $item_meta = $this->db->where('language_id', 1); // TODO: Internationalization
        $item_meta = $this->db->get('item_meta');

        if (empty($item_meta->num_rows())) {
          show_404();
        }
      } else {
        show_404();
      }
    }

    $item_meta = $item_meta->row_array();

    // Get delivery area
    $data['item']['postcode'] = $this->session->userdata('postcode');

    $data['item']['name'] = $item_meta['name'];
    $data['item']['description'] = $item_meta['description'];

    $data['page']['title'] = $item_meta['name'];
    $data['page']['description'] = ( ! empty($item_meta['meta_description']) ? $item_meta['meta_description'] : '');
    $data['page']['keyword'] = ( ! empty($item_meta['meta_keyword']) ? $item_meta['meta_keyword'] : '');

    // Get item attribute groups
    $item_attr_groups = $this->db->select('meta.attribute_group_id, name');
    $item_attr_groups = $this->db->where('item_id', $item['item_id']);
    $item_attr_groups = $this->db->where('language_id', 1); // TODO: Internationalization
    $item_attr_groups = $this->db->join('attribute_group_meta AS meta', 'meta.attribute_group_id = item_attribute.attribute_group_id');
    $item_attr_groups = $this->db->group_by('meta.attribute_group_id');
    $item_attr_groups = $this->db->get('item_attribute');

    // Get grouped attributes
    if ( ! empty($item_attr_groups->num_rows()) ) {
      $item_attr_groups = $item_attr_groups->result_array();
      array_push($item_attr_groups, [
        'name' => '',
        'attribute_group_id' => 0,
      ]);
    } else {
      $item_attr_groups = [];
      array_push($item_attr_groups, [
        'name' => '',
        'attribute_group_id' => 0,
      ]);
    }

    foreach ($item_attr_groups as $group_index => $group) {
      $attributes = $this->db->select('meta.attribute_id, name, help_text, is_required, is_option_multiple_choice, is_variant_determinant, option_type, is_option_variable');
      $attributes = $this->db->where('item_id', $item['item_id']);
      $attributes = $this->db->where('attribute_group_id', $group['attribute_group_id']);
      $attributes = $this->db->where('language_id', 1); // TODO: Internationalization
      $attributes = $this->db->join('attribute_meta AS meta', 'meta.attribute_id = item_attribute.attribute_id');
      $attributes = $this->db->order_by('meta.attribute_id', 'ASC');
      $attributes = $this->db->order_by('sort_order', 'ASC');
      $attributes = $this->db->get('item_attribute');

      if ( ! empty($attributes->num_rows())) {
        $data['attribute_groups'][$group_index]['name'] = $group['name'];
        $data['attribute_groups'][$group_index]['group_id'] = $group['attribute_group_id'];

        $attributes = $attributes->result_array();

        foreach ($attributes as $attr_index => $attribute) {
          $options = $this->db->where('item_id', $item['item_id']);
          $options = $this->db->where('attribute_id', $attribute['attribute_id']);
          $options = $this->db->join('option_meta AS meta', 'meta.option_id = item_option.option_id');
          //$options = $this->db->order_by('meta.option_id', 'ASC');
          $options = $this->db->order_by('sort_order', 'ASC');
          $options = $this->db->get('item_option');

          if ( ! empty($options->num_rows())) {
            $attributes[$attr_index]['options'] = $options->result_array();
          }
        }

        $data['attribute_groups'][$group_index]['attributes'] = $attributes;
      }
    }

    if ($import == 'import') {
      $this->template->content->view('item_import', $data);
    } else {
      $this->template->content->view('item', $data);
    }

    $this->template->title->prepend($item_meta['name'].' | ');
    $this->template->publish();
  }

  public function getSpecData()
  {
    $item_id = $this->input->post('itemID');
    $specs = $this->input->post('specsData');

    $spec_groups = array();

    foreach( $specs as $g_index => $spec_group ) {
        $spec_group_id = $spec_group['groupID'];
        $spec_groups[$g_index] = array(
          'id' => $spec_group_id,
          'conditions' => array(),
          'quantity' => $spec_group['quantity']
        );

      if( ! empty($spec_group['specs']) ) {
        foreach( $spec_group['specs'] as $s_index => $spec ) {
          $spec_id = $spec['specID'];

          $spec_groups[$g_index]['conditions'][$s_index]['name'] = $spec['name'];
          $spec_groups[$g_index]['conditions'][$s_index]['value'] = $spec['value'];
          $spec_groups[$g_index]['conditions'][$s_index]['spec_id'] = $spec_id;
        }
      }
    }

    foreach( $spec_groups as $spec_group ) {
      $spec_condition = $this->db->where('spec_group_id', $spec_group['id']);
      $spec_condition = $this->db->where('quantity', $spec_group['quantity']);

      foreach( $spec_group['conditions'] as $condition ) {
        if( $condition['name'] == 'quantity' ) {
          continue;
        }

        $spec_condition = $this->db->where('JSON_EXTRACT(conditions,"$[0].name")', $condition['name'] );
        $spec_condition = $this->db->where('JSON_EXTRACT(conditions,"$[0].value")', $condition['value'] );
      }

      $spec_condition = $this->db->get('demo_spec_condition')->row_array();

      if( ! empty($spec_condition) ) {
        $spec_data = $this->db->where('demo_spec_condition.spec_cond_id', $spec_condition['spec_cond_id']);
        //$spec_data = $this->db->where('delivery_area', '');
        //$spec_data = $this->db->join('spec_condition_cost', 'spec_condition_cost.spec_cond_id = spec_condition.spec_cond_id');
        $spec_data = $this->db->join('demo_spec_condition_price', 'demo_spec_condition_price.spec_cond_id = demo_spec_condition.spec_cond_id');
        $spec_data = $this->db->get('demo_spec_condition');

        $this->load->model('item_m', 'item');
        $item_data = $this->item->getItem($item_id);

        $result = array(
          'item' => $item_data,
          'spec' => $spec_data->row_array()
        );

        print_r( json_encode($result) );
      }

    }

  }
}
