<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_m extends CI_Model {
	public function getType( $type_id )
  {
    $type = $this->db->where('shop.shop_id', $type_id);
    $type = $this->db->join('shop_meta', 'shop.shop_id = shop_meta.shop_id');
    $type = $this->db->get('shop')->row_array();

    $result = null;

		if( ! empty($type) ) {
			$result = $type;

      $prefix = '';

      if( ! empty($type['thumbnail']) && strpos($type['thumbnail'], 'http') === false ) {
        $prefix = asset_url('img/');
      }

      $result['thumbnail'] = $prefix . $type['thumbnail'];
		}

    return $result;
  }

  public function getTypeCategory( $type_id )
  {
    $category = $this->db->where('category_shop.shop_id', $type_id);
    $category = $this->db->join('category_meta', 'category_meta.category_id = category_shop.category_id');
    $category = $this->db->get('category_shop')->row_array();

    return $category;
  }

  public function getTypes( $category_id )
  {
    $types = $this->db->where('category_shop.category_id', $category_id);
    $types = $this->db->order_by('sort_order', 'ASC');
    $types = $this->db->join('shop', 'category_shop.shop_id = shop.shop_id');
    $types = $this->db->join('shop_meta', 'category_shop.shop_id = shop_meta.shop_id');
    $types = $this->db->get('category_shop')->result_array();

    $result = null;

		if( ! empty($types) ) {
			$result = $types;

			foreach( $types as $index => $type ) {
				$prefix = '';

				if( ! empty($type['thumbnail']) && strpos($type['thumbnail'], 'http') === false ) {
					$prefix = asset_url('img/');
				}

				$result[$index]['thumbnail'] = $prefix . $type['thumbnail'];
        $result[$index]['link'] = site_url('product/type/' . $type['shop_id']);
			}
		}

    return $result;
  }
}
