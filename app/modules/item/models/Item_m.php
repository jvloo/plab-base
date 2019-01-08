<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_m extends CI_Model {
	public function getItem( $item_id )
	{
		$result = $this->db->where('demo_item.item_id', $item_id);
		$result = $this->db->where('is_available', 1);
		$result = $this->db->get('demo_item');

		return $result->row_array();
	}

	public function getItems( $type_id )
	{
		$result = $this->db->where('shop_item.shop_id', $type_id);
		$result = $this->db->where('is_available', 1);
		$result = $this->db->join('item_meta', 'item_meta.item_id = shop_item.item_id');
		$result = $this->db->join('item', 'item.item_id = shop_item.item_id');
		$result = $this->db->get('shop_item');

		return $result->result_array();
	}

	public function getItemBreadcrumb( $item_id )
	{
		$this->load->model('shop_m', 'type');
		$this->load->model('category_m', 'category');

		$type = $this->db->where('item_id', $item_id);
		$type = $this->db->get('shop_item')->row_array();
		$type = $this->type->getType($type['shop_id']);

		$category = $this->db->where('shop_id', $type['shop_id']);
		$category = $this->db->get('category_shop')->row_array();
		$category = $this->category->getCategory($category['category_id']);

		$item = $this->getItemMeta($item_id);

		$result = array(
			0 => array(
				'label' => $category['name'],
				'link' => site_url('home') // TODO: category page
			),
			1 => array(
				'label' => $type['name'],
				'link' => site_url('shop/' . $type['shop_id'])
			),
			2 => array(
				'label' => $item['name'],
				'link' => null
			)
		);

		return $result;
	}

	public function getItemStartingPrice( $item_id )
	{
		$spec_group = $this->db->where('item_id', $item_id);
		$spec_group = $this->db->order_by('sort_order', 'ASC');
		$spec_group = $this->db->get('demo_item_spec')->row_array();

		if( ! empty($spec_group['spec_group_id']) ) {
			$result = $this->db->where('demo_spec_condition.spec_group_id', $spec_group['spec_group_id']);
			$result = $this->db->join('demo_spec_condition_price', 'demo_spec_condition_price.spec_cond_id = demo_spec_condition.spec_cond_id');
			$result = $this->db->order_by('quantity', 'ASC');
			$result = $this->db->order_by('total_price', 'ASC');
			$result = $this->db->get('demo_spec_condition')->row_array();
		}

		if( ! empty($result) ) {
			return $result['total_price'];
		}

	}

	public function getItemMeta( $item_id )
	{
		$result = $this->db->where('item_id', $item_id);
		$result = $this->db->get('demo_item_meta');

		return $result->row_array();
	}

	public function getItemPreview( $item_id )
	{
		$previews = $this->db->where('item_id', $item_id);
		$previews = $this->db->order_by('sort_order', 'ASC');
		$previews = $this->db->get('demo_item_preview')->result_array();

		$result = null;

        if( ! empty($previews) ) {
            $result = $previews;

            foreach( $previews as $index => $preview ) {
    		    $prefix = '';

    		    if( strpos($preview['source'], 'http') === false ) {
    		        $prefix = asset_url('img/');
    		    }

    		    $result[$index]['source'] = $prefix . $preview['source'];
    		}
        }

		return $result;
	}

	public function getItemSpecs( $item_id )
	{
		$spec_groups = $this->db->where('item_id', $item_id);
		$spec_groups = $this->db->order_by('sort_order', 'ASC');
		$spec_groups = $this->db->get('demo_item_spec')->result_array();

		$result = null;

		if( ! empty($spec_groups) ) {
			$result = $spec_groups;

			foreach( $spec_groups as $index => $spec_group ) {
				$specs = $this->_getSpecs($spec_group['spec_group_id']);
				$result[$index]['specs'] = $specs;
			}
		}

		return $result;
	}

	private function _getSpecs( $spec_group_id )
	{
		$specs = $this->db->where('demo_spec.spec_group_id', $spec_group_id);
		$specs = $this->db->order_by('sort_order', 'ASC');
		$specs = $this->db->join('demo_spec_meta', 'demo_spec_meta.spec_id = demo_spec.spec_id');
		$specs = $this->db->get('demo_spec')->result_array();

		$result = null;

		if( ! empty($specs) ) {
			$result = $specs;

			foreach( $specs as $index => $spec ) {
				$options = $this->_getSpecOptions($spec['spec_id']);
				$result[$index]['options'] = $options;
			}
		}

		return $result;
	}

	private function _getSpecOptions( $spec_id )
	{
		$options = $this->db->where('demo_spec_option.spec_id', $spec_id);
		$options = $this->db->order_by('sort_order', 'ASC');
		$options = $this->db->get('demo_spec_option')->result_array();

    $result = null;

    if( ! empty($options) ) {
      foreach( $options as $index => $option ) {

        $option_meta = $this->db->where('demo_spec_option.option_id', $option['option_id']);
        $option_meta = $this->db->join('demo_spec_option_meta', 'demo_spec_option_meta.option_id = demo_spec_option.option_id');
        $option_meta = $this->db->get('demo_spec_option')->row_array();

        $result[$index] = $option_meta;
      }
    }

    return $result;
	}

}
