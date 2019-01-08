<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_m extends CI_Model {
	public function getCategory( $category_id )
  {
    $result = $this->db->where('category.category_id', $category_id);
    $result = $this->db->order_by('sort_order', 'ASC');
    $result = $this->db->join('category_meta', 'category.category_id = category_meta.category_id');
    $result = $this->db->get('category')->row_array();

    return $result;
  }

  public function getCategoryBanners( $category_id )
  {
    $banners = $this->db->where('category_id', $category_id);
    $banners = $this->db->order_by('sort_order', 'ASC');
    $banners = $this->db->get('category_banner')->result_array();

		$result = null;

		if( ! empty($banners) ) {
			$result = $banners;

			foreach( $banners as $index => $banner ) {
				$prefix = '';

				if( strpos($banner['source'], 'http') === false ) {
					$prefix = base_url('/');
				}

				$result[$index]['source'] = $prefix . $banner['source'];
			}
		}

		return $result;
  }

  public function getCategories( $limit = 0, $offset = 0 )
  {
    $result = $this->db->order_by('sort_order', 'ASC');
    $result = $this->db->offset($offset);

    if( ! empty($limit) ) {
      $result = $this->db->limit($limit);
    }

    $result = $this->db->join('category_meta', 'category.category_id = category_meta.category_id');
    $result = $this->db->get('category')->result_array();

    return $result;
  }
}
