<?php
defined('BASEPATH') or exit('No direct script access allowed.');

class Home extends Base_Controller {
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data = [];

    // Get categories
    $categories = $this->db->where('is_show_home', 1);
    $categories = $this->db->order_by('sort_order', 'ASC');
    $categories = $this->db->join('category_meta AS meta', 'meta.category_id = category.category_id');
    $categories = $this->db->get('category');

    if ($categories->num_rows() > 0) {
      $categories = $categories->result_array();

      foreach ($categories as $index => $category) {
        // Get banners
        $banners = $this->db->where('category_id', $category['category_id']);
        $banners = $this->db->order_by('sort_order', 'ASC');
        $banners = $this->db->join('banner', 'banner.banner_id = category_banner.banner_id');
        $banners = $this->db->get('category_banner');

        if ($banners->num_rows() > 0) {
          $banners = $banners->result_array();

          foreach ($banners as $banner_index => $banner) {
            $banners[$banner_index]['source'] = parse_source($banner['source']);
            $banners[$banner_index]['action_link'] = parse_link($banner['action_link']);
          }

          $categories[$index]['banners'] = $banners;
        }

        // Get Shops
        $shops = $this->db->where('category_id', $category['category_id']);
        $shops = $this->db->where('is_show_home', 1);
        $shops = $this->db->order_by('sort_order', 'ASC');
        $shops = $this->db->join('shop', 'shop.shop_id = category_shop.shop_id');
        $shops = $this->db->join('shop_meta', 'shop_meta.shop_id = category_shop.shop_id');
        $shops = $this->db->get('category_shop');

        if ($shops->num_rows() > 0) {
          $shops = $shops->result_array();

          foreach ($shops as $shop_index => $shop) {
            if ( empty($shop['thumbnail']) ) {
              $shop['thumbnail'] = dummy_image('250x250', $shop['name']);
            }
            $shops[$shop_index]['thumbnail'] = parse_source($shop['thumbnail']);

            $shops[$shop_index]['url'] = site_url(
              //'shop/' .
              //str_replace( ' ', '-', mb_strtolower($category['name']) ) . '/' .
              //str_replace( ' ', '-', mb_strtolower($shop['name']) )
              'shop/' . $shop['shop_id']
            );
          }
          $categories[$index]['shops'] = $shops;
        }
      }

      // Categorize shops
      foreach ($categories as $index => $category) {
        //$shop_per_row = 4;
        //$row_per_tab = 2;

        $shop_per_row = 4;
        $row_per_tab = 2;

        $shop_count = 1;
        $row_index = 0;
        $tab_index = 0;

        $tabs = [];

        foreach ($category['shops'] as $shop_index => $shop) {
          if ($shop_count > $shop_per_row) {
            $shop_count = 1;
            $row_index = $row_index + 1;
          }
          if ($row_index >= $row_per_tab) {
            $row_index = 0;
            $tab_index = $tab_index + 1;
          }

          $items = $this->db->where('shop_id', $shop['shop_id']);
          $items = $this->db->join('item AS item', 'item.item_id = shop_item.item_id');
          $items = $this->db->join('item_meta AS meta', 'meta.item_id = shop_item.item_id');
          $items = $this->db->get('shop_item');
          $items = $items->result_array();

          $shop['items'] = $items;

          $tabs[$tab_index][$row_index][] = $shop;
          $shop_count = $shop_count + 1;
        }
        $categories[$index]['shops'] = $tabs;
      }
    }

    $data['categories'] = $categories;

    $this->template->title->append(' - Your Online One Stop Printing E-Commerce Platform');
    $this->template->content->view('home', $data);
    $this->template->publish();
  }
}
