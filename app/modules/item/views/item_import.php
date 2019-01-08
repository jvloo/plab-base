<?php
defined('BASEPATH') or exit('No direct script access allowed.');
?>
  <style>
    .loading {
      padding: 15px;
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
    }
    .loading img {
      margin-bottom: 10px;
    }

    .breadcrumb {
      background: none;
      padding: 0px;
    }
    .breadcrumb-item.active {
      color: #EB3833;
      font-weight: 600;
    }
    .breadcrumb-item + .breadcrumb-item::before {
      font-weight:bold;
      content:">"
    }
  </style>
  <style>
    .quantity {
      display: inline-flex;
      width: 100%;
      margin: 0px auto;
      background-color: #eee;
      position: relative;
      overflow: hidden;
    }
    .quantity input {
      float: right;
      color: #000;
      text-align: center;
      padding: 0;
      margin: 0;
      border: 0;
      outline: 0;
      background-color: #FFFFFF;
    }
    .quantity input.qty {
      position: relative;
      width: 100%;
      height: 40px;
      padding: 5px 10px;
      text-align: center;
      font-weight: 400;
      font-size: 1rem;
      background-clip: padding-box;
    }
    .quantity .minus,
    .quantity .plus {
      position: absolute;
      width: 25px;
      height: 50%;
      line-height: 0;
      right: 0;
      color: #bbb;
      border-left: 1px solid rgba(222, 219, 221, 0.5);
      background-clip: padding-box;
      -webkit-border-radius: 0;
      -moz-border-radius: 0;
      border-radius: 0;
      -webkit-background-size: 6px 30px;
      -moz-background-size: 6px 30px;
    }
    .quantity .plus {
      font-size: 25px;
      padding: 2px;
      padding-bottom: 6px;
      top: 0;
    }
    .quantity .minus {
      font-size: 32px;
      padding: 2px;
      padding-bottom: 8px;
      bottom: 0;
    }
    .quantity .minus:hover, .quantity .plus:hover {
      background-color: #FDF4F7;
      cursor: pointer;
      color: #EB3833;
    }
  </style>
  <style>
    /* Item Card */
    .item-card,
    .item-card-sidebar,
    .item-card-main {
      padding: 0px;
    }
  </style>
  <style>
    /* Item Card Sidebar */
    .item-card .item-card-sidebar .item-preview {
      padding: 20px 15px;
    }
    .item-card .item-card-sidebar .item-preview-indicators {
      padding: 15px;
      background-color: #F8F9FA;
      border-bottom: 1px solid rgba(222, 219, 221, 0.5);
    }
    /* Item Card Main Section */

  </style>
  <style>
    .item-card .item-card-main .list-group .list-group-item:first-of-type {
      border-top: none;
      margin-top: 5px;
    }
  </style>
  <style>
    .item-card .item-card-main .item-title {
      display: flex;
      align-items: center;
      margin-top: 5px;
      margin-bottom: 15px;
    }
    .item-card .item-card-main .item-title span + span {
      margin-left: 5px;
    }
    .item-card .item-card-main .item-price {
      position: relative;
      padding: 5px;
      margin-bottom: 15px;
      background: #FFEFED; /* Variants: Light Pink #FDF4F7 | Light Orange #FEF6EF */
      color: #EB3833;
      box-shadow: 0 5px 8px -6px rgba(0, 0, 0, 0.15);
    }
    .item-card .item-card-main .item-price .item-original-price {
      display: inline-block;
      text-decoration: line-through;
    }
  </style>
  <style>
    /* Created Using enjoycss.com */
    .item-price.orange-stripes {
      box-sizing: content-box !important;
      background: linear-gradient(90deg, rgba(255,255,255,0.2) 50%, rgba(0,0,0,0) 50%, rgba(0,0,0,0) 0), rgb(255, 153, 0) !important;
      background-position: auto auto !important;
      background-origin: padding-box !important;
      background-clip: border-box !important;
      background-size: 50px auto !important;
      color: rgba(255, 255, 255, 0.9) !important;
    }
  </style>
  <style>
    .item-card .item-card-main .item-info .label-group {
      margin: 0px;
    }
    .item-card .item-card-main .item-info .label-body {
      font-weight: bold;
    }
  </style>
  <style>
    .list-group-heading,
    .list-group-heading small {
      margin-bottom: 15px;
      color: #EB3833;
      font-weight: bold;
    }
  </style>
  <style>
    .attribute-group {
      display: flex;
      flex-flow: row wrap;
      align-items: center;
      margin: .938rem 0;
      padding: 0px;
    }
    .attribute-group .attribute-item {
      margin-bottom: 10px;
    }

    .attribute-group .attribute-item {
      display: flex;
      flex-wrap: wrap;
      flex-direction: row;
      width: 100%;
      padding: 0px;
      list-style: none;
      overflow: hidden;
      color: #495057;
      font-size: .938rem;
      line-height: 1.5;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
      -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
      transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    }
    .attribute-group .attribute-item summary {
      display: flex;
      flex-wrap: wrap;
      flex-direction: row;
    }
    .attribute-group .attribute-item .attribute-name .row,
    .attribute-group .attribute-item .attribute-selected .row {
      height: 100%;
    }
    .attribute-group .attribute-item .attribute-name .row [class*="col-"],
    .attribute-group .attribute-item .attribute-selected .row [class*="col-"] {
      display: flex;
      align-items: center;
    }
    .attribute-group .attribute-item:hover,
    .attribute-group .attribute-item.active {
      cursor: pointer;
      color: #EB3833;
      border: 1px solid #EB3833;
    }
    .attribute-group .attribute-item .attribute-name {
      display: flex;
      flex-direction: row;
      font-weight: bold;
      background: #F8F9FA;
      padding: 8px;
    }
    .attribute-group .attribute-item .attribute-selected {
      display: flex;
      flex-direction: column;
      color: #EB3833;
      padding-left: 15px;
      margin-left: 0px;
      font-weight: bold;
    }
    .attribute-group .attribute-item .attribute-selected.has-input {
      padding: 0px;
    }
    .attribute-group .attribute-item .attribute-selected.has-input input[type=text] {
      background: none;
      padding: 8px 10px;
      width: 100%;
      margin: 0px;
      color: #212529;
      font-size: 1rem;
      border: none;
    }
    .attribute-group .attribute-item .attribute-selected.has-input input[type=text]:active,
    .attribute-group .attribute-item .attribute-selected.has-input input[type=text]:focus {
      outline: 0;
    }
    .attribute-group .attribute-item .attribute-selected.has-input > *,
    .attribute-group .attribute-item .attribute-selected.has-input [class*="col-"] {
      padding: 0px;
      margin: 0px;
    }
    .attribute-group .attribute-item .attribute-selected.has-input .input-addon {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      font-weight: normal;
      font-size: 1rem;
      color: #212529;
      background-color: #F8F9FA;
    }
  </style>
  <style>
    .attribute-item > div {
      position: relative;
    }
    .attribute-item .loading {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    details.attribute-item[open] summary {
      border-bottom: 1px solid #dee2e6;
    }

    details.attribute-item[open] .attribute-selections {
      background-color: #FDFDFD;
    }
  </style>
  <style>
    .attribute-item .attribute-selections .option-group {
      padding: 15px;
      list-style: none;
    }

    .attribute-item .attribute-selections .option-group .option-name {
      background: #FFFFFF;
    }
    details.attribute-item .attribute-selections .option-group .option-name {
      background: #FDFDFD;
    }
    .attribute-item .attribute-selections .option-group .option-name.has-addon {
      padding: 0px !important;
    }
    .attribute-item .attribute-selections .option-group .option-name.has-input {
      border: none;
      background: none;
    }
    .option-addon {
      display: inline-flex;
      flex-direction: row;
      flex-wrap: wrap;
      padding: 5px;
    }
    .option-addon .addon-image img,
    .option-addon .addon-color {
      width: 30px;
      height: 30px;
    }
    .option-addon .addon-color {
      border-radius: 5px;
    }
    .option-addon .addon-text {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      padding: 0px 8px;
    }

    .option-addon .addon-input {
      display: inline-block !important;
      width: 50px;
      background: #FDFDFD;
    }
    .option-addon .addon-input.addon-input-xs {
      width: 10px;
    }
    .option-addon .addon-input.addon-input-sm {
      width: 25px;
    }
    .option-addon .addon-input.addon-input-lg {
      width: 75px;
    }
    .option-addon .addon-input.addon-input-xl {
      width: 100px;
    }

    .option-addon .addon-input.quantity {
      border: 1px solid #ced4da;
      border-radius: .25rem;
      transition: border-color 0.15s ease-in-out;
    }
    .option-addon .addon-input.quantity input.qty {
      height: 35px;
      font-size: 15px;
      padding: 0px 10px;
      font-size: 1rem;
    }
    .option-addon .addon-input.quantity .minus,
    .option-addon .addon-input.quantity .plus {
      width: 25px;
      -webkit-background-size: 6px 30px;
      -moz-background-size: 6px 30px;
    }
    .option-addon .addon-input.quantity .plus {
      font-size: 25px;
      padding: 2px;
      padding-bottom: 6px;
    }
    .option-addon .addon-input.quantity .minus {
      font-size: 32px;
      padding: 2px;
      padding-bottom: 8px;
    }
  </style>
  <style>
    .attribute-group > [class*="col-"]:first-of-type {
      padding-left: 0px;
    }
    .attribute-group > [class*="col-"]:last-of-type {
      padding-right: 0px;
    }
  </style>
  <script>
    $(document).ready(function () {
      $('.quantity').each(function() {
        var spinner = jQuery(this),
          input = spinner.find('.qty'),
          btnUp = spinner.find('.plus'),
          btnDown = spinner.find('.minus'),
          min = input.attr('min'),
          max = input.attr('max');

        btnUp.click(function() {
          var oldValue = parseFloat(input.val());
          if (oldValue >= max) {
            var newVal = oldValue;
          } else {
            var newVal = oldValue + 1;
          }
          spinner.find('.qty').val(newVal);
          spinner.find('.qty').trigger("change");
        });

        btnDown.click(function() {
          var oldValue = parseFloat(input.val());
          if (oldValue <= min) {
            var newVal = oldValue;
          } else {
            var newVal = oldValue - 1;
          }
          spinner.find('.qty').val(newVal);
          spinner.find('.qty').trigger("change");
        });

      });

      $('.qty').on('blur', function(){
        var currQty = $('.qty').val();

        if( currQty.startsWith('0') || isNaN(currQty) || currQty === '' ) {
          $('.qty').val('1');
          updateInfo();
        }
      });
    });
  </script>
  <div class="container p-3 pb-5">
    <!--- Content Topbar --->
    <section class="content-topbar">
      <div class="row">
        <!--- Content Breadcrumb --->
        <div class="content-breadcrumb col-sm-18">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Leaflet</a></li>
            <li class="breadcrumb-item"><a href="#">Booklet</a></li>
            <li class="breadcrumb-item active"><?php echo ucwords($item['name']); ?></li>
          </ol>
        </div><!--- END Content Breadcrumb --->
        <!--- TODO: Content Toolbar --->
        <div class="content-toolbar col-sm-6">
          <ul class="nav d-flex justify-content-end">
          </ul>
        </div><!--- END Content Breadcrumb --->
      </div>
    </section><!--- END Content Topbar --->

    <!--- Content Header --->
    <section class="content-header sticky-top" style="height: 0px; z-index: -99;">
      <div class="row">
        <div class="card col-sm-18 p-3">
          <div class="row">
            <div class="col-sm-18">
              <h6 class="item-title ml-3">
                <span class="badge badge-primary"><!--- TODO: Campaign Badge, e.g. Hot Sale, Featured ---></span>
                <span class="title"><?php echo ucwords($item['name']); ?></span>
              </h6>
              <div class="item-info">
                <ul class="label-group">
                  <a href="#">
                    <li class="label-item label-item-sm label-item-flush">
                      <span class="label-title">Price per unit:</span>
                      <span class="item-unit-price label-body">
                        RM <span>0.00</span>
                      </span>
                      <i class="far fa-question-circle ml-2"></i>
                    </li>
                  </a>
                  <a href="#">
                    <li class="label-item label-item-sm label-item-flush">
                      <span class="label-title">Total Weight:</span>
                      <span class="item-total-weight label-body">
                        <span>0.00</span> KG
                      </span>
                      <i class="far fa-question-circle ml-2"></i>
                    </li>
                  </a>
                  <a href="#">
                    <li class="label-item label-item-sm label-item-flush">
                      <span class="label-title">Estimated Delivery:</span>
                      <span class="item-est-delivery label-body">
                        <span class="min-delivery"></span> - <span class="max-delivery"></span> Days
                      </span>
                      <i class="far fa-question-circle ml-2"></i>
                    </li>
                  </a>
                </ul>
              </div>
            </div>
            <div class="col-sm">
              <div class="item-price">
                <div class="loading d-none" data-loading="price">
                  <img class="w-25" src="<?php echo asset_url('img/common/loading.svg'); ?>">
                  <h6>updating price...</h6>
                </div>
                <div class="loaded visible px-1"  data-loaded="price">
                  <h4 class="item-total-price text-primary">
                    RM <span>0.00</span>
                  </h4>
                  <div class="item-discount text-muted invisible">
                    <span class="item-original-price">RM <span>0.00</span></span>
                    <span class="item-discount-percent badge badge-primary"><span>0</span>% OFF</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
        $.fn.isInViewport = function() {
          var elementTop = $(this).offset().top;
          var elementBottom = elementTop + $(this).outerHeight();

          var viewportTop = $(window).scrollTop();
          var viewportBottom = viewportTop + $(window).height();

          return elementBottom > viewportTop && elementTop < viewportBottom;
        };

        $(window).on('resize scroll', function() {
          $('.content-header').each(function() {
            if ($(this).offset().top == $(window).scrollTop()) {
              $(this).css('z-index', '99');
              $(this).css('height', 'auto');
            } else {
              $(this).css('z-index', '-99');
              $(this).css('height', '0px');
            }
          });
        });
      </script>
    </section><!--- END Content Header --->

    <!--- Content Body --->
    <section class="content-body">
      <div class="row">
        <!--- Item Card --->
        <main class="item-card card-group shadow col-sm-18">
          <!--- Item Card Sidebar --->
          <div class="item-card-sidebar card col-sm-9">
            <div class="item-preview">
              <img class="card-img" src="<?php echo $item['thumbnail']; ?>" alt="<?php echo ucwords($item['name']); ?>">
              <div class="card-img-overlay">
              </div>
            </div>
            <div class="item-preview-indicators">
            </div>
          </div><!--- END Item Card Sidebar --->
          <!--- Item Card Main Section --->
          <div class="item-card-main card col-sm-15">
            <ul class="list-group list-group-flush">
              <!--- Item Information --->
              <li class="item-info-group list-group-item">
                <h3 class="item-title">
                  <span class="badge badge-primary"><!--- TODO: Campaign Badge, e.g. Hot Sale, Featured ---></span>
                  <span class="title"><?php echo ucwords($item['name']); ?></span>
                </h3>
                <div class="item-campaign-label"><!--- TODO: Campaign Label, e.g. 12.12, Christmas ---></div>
                <div class="item-price">
                  <div class="loading d-none" data-loading="price">
                    <img class="w-25" src="<?php echo asset_url('img/common/loading.svg'); ?>">
                    <h6>updating price...</h6>
                  </div>
                  <div class="loaded visible px-1"  data-loaded="price">
                    <h2 class="item-total-price">
                      RM <span>0.00</span>
                    </h2>
                    <h6 class="item-discount text-muted invisible">
                      <span class="item-original-price">RM <span>0.00</span></span>
                      <span class="item-discount-percent badge badge-primary"><span>0</span>% OFF</span>
                    </h6>
                  </div>
                </div>
                <div class="item-info">
                  <ul class="label-group">
                    <a href="#">
                      <li class="label-item label-item-sm label-item-flush">
                        <span class="label-title">Price per unit:</span>
                        <span class="item-unit-price label-body">
                          RM <span>0.00</span>
                        </span>
                        <i class="far fa-question-circle ml-2"></i>
                      </li>
                    </a>
                    <a href="#">
                      <li class="label-item label-item-sm label-item-flush">
                        <span class="label-title">Total Weight:</span>
                        <span class="item-total-weight label-body">
                          <span>0.00</span> KG
                        </span>
                        <i class="far fa-question-circle ml-2"></i>
                      </li>
                    </a>
                    <a href="#">
                      <li class="label-item label-item-sm label-item-flush">
                        <span class="label-title">Estimated Delivery:</span>
                        <span class="item-est-delivery label-body">
                          <span class="min-delivery"></span> - <span class="max-delivery"></span> Days
                        </span>
                        <i class="far fa-question-circle ml-2"></i>
                      </li>
                    </a>
                  </ul>
                </div>
              </li>

              <!--- Item Attribute --->
              <?php if ( ! empty($attribute_groups) ) : foreach ($attribute_groups as $group_index => $group) : ?>
              <li class="item-configuration list-group-item">
                <?php if ( ! empty($group['name'])) : ?>
                  <div class="list-group-heading">
                    <small><?php echo $group['name']; ?></small>
                  </div>
                <?php endif; ?>
                <div class="attribute-group" data-attr-group="<?php echo $group['group_id']; ?>">
                  <?php if (empty($group['attributes'])) : ?>
                    <div class="p-3 w-100 text-center text-muted">
                      No Selections Available
                    </div>
                  <?php else : foreach($group['attributes'] as $attr_index => $attribute) : ?>
                    <?php switch ($attribute['option_type']) :
                      case 'label': ?>
                        <details class="attribute-item<?php echo $attribute['is_required'] == 1 ? ' required' : ''; ?><?php echo $attribute['is_variant_determinant'] == 1 ? ' variant-determinant' : ''; ?><?php echo $attribute['is_variant_determinant'] == 1 ? ' quantity-determinant' : ''; ?>" data-attr="<?php echo $attribute['attribute_id']; ?>"<?php echo $group_index == 0 && $attr_index == 0 ? ' open' : ''; ?>>
                          <summary>
                            <span class="attribute-name col-sm-6">
                              <?php echo $attribute['name']; ?>
                              <?php if ( ! empty($attribute['help_text'])) : ?>
                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="<?php echo $attribute['help_text']; ?>"><i class="far fa-question-circle ml-2"></i></a>
                              <?php endif; ?>
                              <!--- TODO: Multiple Choice & Optional indicator --->
                            </span>
                            <span class="attribute-selected col-sm-18">
                              Select Option
                            </span>
                          </summary>
                          <div class="attribute-selections">
                            <div class="loading d-none"<?php echo $attribute['is_option_variable'] == 1 ? ' data-loading' : ''; ?>>
                              <img class="w-25" src="<?php echo asset_url('img/common/loading.svg'); ?>">
                              <h6 class="text-primary">updating...</h6>
                            </div>
                            <div class="loaded row"<?php echo $attribute['is_option_variable'] == 1 ? ' data-loaded' : ''; ?>>
                              <div class="col-sm-6" style="font-weight: bold; padding: 20px;">
                                Options
                              </div>
                              <ul class="option-group label-group col-sm-18">
                                <?php if ( ! empty($attribute['options'])) : foreach ($attribute['options'] as $option_index => $option) : ?>
                                  <li class="option-item label-input-group">
                                    <input class="option-value label-input" type="radio" id="group-<?php echo $group_index; ?>-attr-<?php echo $attr_index; ?>-option-<?php echo $option_index; ?>" name="group-<?php echo $group_index; ?>-attr-<?php echo $attr_index; ?>-options" data-option="<?php echo $option['option_id']; ?>" <?php echo $option_index === 0 ? ' checked' : ''; ?>>
                                    <label class="option-name has-addon label-item" for="group-<?php echo $group_index; ?>-attr-<?php echo $attr_index; ?>-option-<?php echo $option_index; ?>" onclick="selectOption(this, <?php echo $attribute['is_variant_determinant'] == 1 ? 'true' : 'false'; ?>);">
                                      <div class="option-addon">
                                        <span class="addon-text"><?php echo $option['name']; ?></span>
                                      </div>
                                    </label>
                                  </li>
                                <?php endforeach; else : ?>
                                  <li class="option-item label-input-group">
                                    <label class="option-name label-item has-input">No Options</label>
                                  </li>
                                <?php endif; ?>

                                <!--- Option With Image Addon --->
                                <li class="option-item label-input-group d-none">
                                  <input class="option-value label-input" type="radio" id="option-2" name="option" value="100">
                                  <label class="option-name has-addon label-item" for="option-2">
                                    <div class="option-addon">
                                      <span class="addon-image"><img src="https://via.placeholder.com/30x30"></span>
                                      <span class="addon-text">aa</span>
                                    </div>
                                  </label>
                                </li><!--- END Option With Image Addon --->
                                <!--- Option With Color Addon --->
                                <li class="option-item label-input-group d-none">
                                  <input class="option-value label-input" type="radio" id="option-2" name="option" value="100">
                                  <label class="option-name has-addon label-item" for="option-2">
                                    <div class="option-addon">
                                      <span class="addon-color border" style="background: #EB3833"></span>
                                      <span class="addon-text">aa</span>
                                    </div>
                                  </label>
                                </li><!--- END Option With Color Addon --->
                                <!--- Option With Text Field --->
                                <li class="option-item label-input-group d-none">
                                  <div class="option-name has-addon has-input label-item">
                                    <div class="option-addon">
                                      <div class="addon-text col-sm-5">XS: </div>
                                      <input type="text" class="col-sm addon-input addon-input-xl form-control form-control-sm no-outline">
                                    </div>
                                  </div>
                                </li><!--- END Option With Text Field --->
                                <!--- Option With Number Field --->
                                <li class="option-item label-input-group d-none">
                                  <div class="option-name has-addon has-input label-item">
                                    <div class="option-addon">
                                      <div class="addon-text col-sm-5">XS: </div>
                                      <div class="addon-input addon-input-lg quantity">
                                        <input type="number" value="1" class="qty" step="1" min="1" max="9999" maxLength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                        <input type="button" value="+" class="plus">
                                        <input type="button" value="-" class="minus">
                                      </div>
                                    </div>
                                  </div>
                                </li><!--- END Option With Number Field --->

                              </ul>
                            </div>
                          </div>
                        </details>
                      <?php break; ?>

                      <?php case 'text_field': ?>
                        <!--- Text Field --->
                        <div class="attribute-item d-none">
                          <span class="attribute-name col-sm-7">
                            Text Field <a href="#"><i class="far fa-question-circle ml-2"></i></a>
                          </span>
                          <span class="attribute-selected has-input col-sm-17">
                            <div class="row">
                              <div class="col-sm">
                                <input type="text" placeholder="Text Field">
                              </div>
                            </div>
                          </span>
                        </div><!--- END Text Field --->
                        <!--- Text Fields (Multiple) --->
                        <div class="attribute-item d-none">
                          <div class="attribute-name col-sm-7">
                            Text Fields
                          </div>
                          <div class="attribute-selected has-input col-sm-17">
                            <div class="row">
                              <div class="col-sm">
                                <input type="text" placeholder="Text Field 1">
                              </div>
                              <div class="col-sm-2 input-addon border-left border-right">x</div><!--- delimiter --->
                              <div class="col-sm">
                                <input type="text" placeholder="Text Field 2">
                              </div>
                              <div class="col-sm-4 input-addon border-left">gsm</div><!--- prefix/suffix --->
                            </div>
                          </div>
                        </div><!--- END Text Fields (Multiple) --->
                      <?php break; ?>

                      <?php case 'number_field': ?>
                        <!--- Number Field --->
                        <div class="attribute-item d-none">
                          <span class="attribute-name col-sm-7">
                            Number Field
                          </span>
                          <span class="attribute-selected has-input col-sm-17">
                            <div class="row">
                              <div class="col-sm">
                                <div class="quantity">
                                  <input type="number" value="1" class="qty" step="1" min="1" max="9999" maxLength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                  <input type="button" value="+" class="plus">
                                  <input type="button" value="-" class="minus">
                                </div>
                              </div>
                            </div>
                          </span>
                        </div><!--- END Number Field --->
                        <!--- Number Fields (Multiple) --->
                        <div class="attribute-item d-none">
                          <span class="attribute-name col-sm-7">
                            Number Fields
                          </span>
                          <span class="attribute-selected has-input col-sm-17">
                            <div class="row">
                              <div class="col-sm-2 input-addon border-left border-right">
                                S
                              </div>
                              <div class="col-sm">
                                <div class="quantity">
                                  <input type="number" value="1" class="qty" step="1" min="1" max="9999" maxLength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                  <input type="button" value="+" class="plus">
                                  <input type="button" value="-" class="minus">
                                </div>
                              </div>
                              <div class="col-sm-2 input-addon border-left border-right">
                                M
                              </div>
                              <div class="col-sm">
                                <div class="quantity">
                                  <input type="number" value="1" class="qty" step="1" min="1" max="9999" maxLength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                  <input type="button" value="+" class="plus">
                                  <input type="button" value="-" class="minus">
                                </div>
                              </div>
                            </div>
                          </span>
                        </div><!--- END Number Input Multiple --->
                      <?php break; ?>

                    <?php endswitch; ?>
                  <?php endforeach; endif; ?>

                  <!--- Label Summary --->
                  <details class="attribute-item d-none">
                    <summary>
                      <span class="attribute-name col-sm-7">Shirt Size & Quantity</span>
                      <span class="attribute-selected col-sm-17">
                        <div class="row h-100">
                          <div class="option-addon">
                            <span class="addon-text">XS: 3</span>
                          </div>
                          <div class="option-addon">
                            <span class="addon-text">S: 3</span>
                          </div>
                          <div class="option-addon">
                            <span class="addon-text">M: 5</span>
                          </div>
                          <div class="option-addon">
                            <span class="addon-text">L: 3</span>
                          </div>
                          <div class="option-addon">
                            <span class="addon-text">XL: 3</span>
                          </div>
                          <div class="option-addon">
                            <span class="addon-text">XXL: 3</span>
                          </div>
                        </div>
                      </span>
                    </summary>
                    <div class="attribute-selections">
                      <div class="loading d-none" data-loading="options">
                        <img class="w-25" src="<?php echo asset_url('img/common/loading.svg'); ?>">
                        <h6 class="text-primary">updating...</h6>
                      </div>
                      <div class="loaded visible row" data-loaded="options">
                        <div class="col-sm-7" style="font-weight: bold; padding: 20px;">Popular Options</div>
                        <ul class="option-group label-group col-sm-17">

                          <!--- Option --->
                          <li class="option-item label-input-group">
                            <input class="option-value label-input" type="radio" id="option-test" name="option" value="100">
                            <label class="option-name label-item" for="option-test">
                              100
                            </label>
                          </li><!--- END Option --->

                          <!--- Option With Image Addon --->
                          <li class="option-item label-input-group">
                            <input class="option-value label-input" type="radio" id="option-2" name="option" value="100">
                            <label class="option-name has-addon label-item" for="option-2">
                              <div class="option-addon">
                                <span class="addon-image"><img src="https://via.placeholder.com/30x30"></span>
                                <span class="addon-text">aa</span>
                              </div>
                            </label>
                          </li><!--- END Option With Image Addon --->

                          <!--- Option With Color Addon --->
                          <li class="option-item label-input-group">
                            <input class="option-value label-input" type="radio" id="option-2" name="option" value="100">
                            <label class="option-name has-addon label-item" for="option-2">
                              <div class="option-addon">
                                <span class="addon-color border" style="background: #EB3833"></span>
                                <span class="addon-text">aa</span>
                              </div>
                            </label>
                          </li><!--- END Option With Color Addon --->

                          <!--- Option With Text Field --->
                          <li class="option-item label-input-group">
                            <div class="option-name has-addon has-input label-item">
                              <div class="option-addon">
                                <div class="addon-text col-sm-5">XS: </div>
                                <input type="text" class="col-sm addon-input addon-input-xl form-control form-control-sm no-outline">
                              </div>
                            </div>
                          </li><!--- END Option With Text Field --->


                          <!--- Option With Number Field --->
                          <li class="option-item label-input-group">
                            <div class="option-name has-addon has-input label-item">
                              <div class="option-addon">
                                <div class="addon-text col-sm-5">XS: </div>
                                <div class="addon-input addon-input-lg quantity">
                                  <input type="number" value="1" class="qty" step="1" min="1" max="9999" maxLength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                  <input type="button" value="+" class="plus">
                                  <input type="button" value="-" class="minus">
                                </div>
                              </div>
                            </div>
                          </li><!--- END Option With Number Field --->

                        </ul>
                      </div>
                    </div>
                  </details>
                  <!--- Label Inline --->
                  <div class="attribute-item d-none">
                    <span class="attribute-name col-sm-7">Shirt Size & Quantity</span>
                    <span class="attribute-selected attribute-selections col-sm-17">
                      <ul class="option-group label-group p-2">
                        <!--- T-Shirt Demo --->
                        <li class="option-item label-input-group">
                          <input class="option-value label-input" type="radio" id="option-test" name="option" value="100">
                          <label class="option-name label-item" for="option-test">
                            <div class="option-addon">
                              <span class="addon-color border" style="background: #EB3833"></span>
                            </div>
                            Orange #EB3833
                            <div class="option-addon">
                              <div class="addon-input addon-input-lg quantity">
                                <input type="number" value="1" class="qty" step="1" min="1" max="9999" maxLength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                <input type="button" value="+" class="plus">
                                <input type="button" value="-" class="minus">
                              </div>
                            </div>
                          </label>
                        </li><!--- END T-Shirt Demo --->

                        <!--- Option --->
                        <li class="option-item label-input-group">
                          <input class="option-value label-input" type="radio" id="option-test" name="option" value="100">
                          <label class="option-name label-item" for="option-test">
                            100
                          </label>
                        </li><!--- END Option --->

                        <!--- Option With Image Addon --->
                        <li class="option-item label-input-group">
                          <input class="option-value label-input" type="radio" id="option-2" name="option" value="100">
                          <label class="option-name has-addon label-item" for="option-2">
                            <div class="option-addon">
                              <span class="addon-image"><img src="https://via.placeholder.com/30x30"></span>
                              <span class="addon-text">aa</span>
                            </div>
                          </label>
                        </li><!--- END Option With Image Addon --->

                        <!--- Option With Color Addon --->
                        <li class="option-item label-input-group">
                          <input class="option-value label-input" type="radio" id="option-2" name="option" value="100">
                          <label class="option-name has-addon label-item" for="option-2">
                            <div class="option-addon">
                              <span class="addon-color border" style="background: #EB3833"></span>
                              <span class="addon-text">aa</span>
                            </div>
                          </label>
                        </li><!--- END Option With Color Addon --->

                        <!--- Option With Text Field --->
                        <li class="option-item label-input-group">
                          <div class="option-name has-addon has-input label-item">
                            <div class="option-addon">
                              <div class="addon-text col-sm-5">XS: </div>
                              <input type="text" class="col-sm addon-input addon-input-xl form-control form-control-sm no-outline">
                            </div>
                          </div>
                        </li><!--- END Option With Text Field --->


                        <!--- Option With Number Field --->
                        <li class="option-item label-input-group">
                          <div class="option-name has-addon has-input label-item">
                            <div class="option-addon">
                              <div class="addon-text col-sm-5">XS: </div>
                              <div class="addon-input addon-input-lg quantity">
                                <input type="number" value="1" class="qty" step="1" min="1" max="9999" maxLength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                <input type="button" value="+" class="plus">
                                <input type="button" value="-" class="minus">
                              </div>
                            </div>
                          </div>
                        </li><!--- END Option With Number Field --->
                      </ul>
                    </span>
                  </div>
                  <!--- T-Shirt Demo Label Inline --->
                  <div class="attribute-item d-none">
                    <span class="attribute-name col-sm-7">Shirt Size & Quantity</span>
                    <span class="attribute-selected attribute-selections col-sm-17">
                      <ul class="option-group label-group p-2">
                        <!--- T-Shirt Demo --->
                        <li class="option-item label-input-group">
                          <input class="option-value label-input" type="radio" id="option-orange" name="option" value="100">
                          <label class="option-name label-item" for="option-orange">
                            <div class="option-addon">
                              <span class="addon-color border" style="background: #EB3833"></span>
                            </div>
                            Orange #EB3833
                            <div class="option-addon ml-auto">
                              <div class="addon-input addon-input-lg quantity">
                                <input type="number" value="1" class="qty" step="1" min="1" max="9999" maxLength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                <input type="button" value="+" class="plus">
                                <input type="button" value="-" class="minus">
                              </div>
                            </div>
                          </label>
                        </li><!--- END T-Shirt Demo --->

                        <!--- T-Shirt Demo --->
                        <li class="option-item label-input-group">
                          <input class="option-value label-input" type="radio" id="option-pink" name="option" value="100">
                          <label class="option-name label-item" for="option-pink">
                            <div class="option-addon">
                              <span class="addon-color border" style="background: #FA5656"></span>
                            </div>
                            Pink #FA5656
                            <div class="option-addon ml-auto">
                              <div class="addon-input addon-input-lg quantity">
                                <input type="number" value="1" class="qty" step="1" min="1" max="9999" maxLength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                <input type="button" value="+" class="plus">
                                <input type="button" value="-" class="minus">
                              </div>
                            </div>
                          </label>
                        </li><!--- END T-Shirt Demo --->

                        <!--- T-Shirt Demo --->
                        <li class="option-item label-input-group">
                          <input class="option-value label-input" type="radio" id="option-white" name="option" value="100">
                          <label class="option-name label-item" for="option-white">
                            <div class="option-addon">
                              <span class="addon-color border" style="background: #FFFFFF"></span>
                            </div>
                            White #FFFFFF
                            <div class="option-addon ml-auto">
                              <div class="addon-input addon-input-lg quantity">
                                <input type="number" value="1" class="qty" step="1" min="1" max="9999" maxLength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                <input type="button" value="+" class="plus">
                                <input type="button" value="-" class="minus">
                              </div>
                            </div>
                          </label>
                        </li><!--- END T-Shirt Demo --->

                      </ul>
                    </span>
                  </div>
                </div>
              </li><?php endforeach; endif; ?><!--- END Item Attribute --->

              <script>
                $(document).ready(function() {
                  var choices = {};
                  jQuery.updateAttrChoices = function updateAttrChoices() {
                    var attributes = $(this).find('[data-attr]');
                    attributes.each(function() {
                      var attrID = $(this).attr('data-attr');
                      var optionID = $(this).find('[data-option]:checked').attr('data-option');

                      choices[attrID] = {};
                      choices[attrID]['attrID'] = attrID;
                      choices[attrID]['optionID'] = optionID;
                    });

                    $.each(choices, function(attrID, attribute) {
                      var targetAttr = $('[data-attr="' + attrID + '"]');
                      var content = $(targetAttr).find('[data-option="' + attribute["optionID"] + '"]').siblings('label').html();
                      $(targetAttr).find('.attribute-selected').html(content);
                    });

                    //console.log(choices); // DEBUG
                  }

                  jQuery.updateAttrOptions = function updateAttrOptions() {
                    // Get variant determinants
                    var determinants = [];
                    $('.item-configuration').find('.variant-determinant').each(function() {
                      determinants.push($(this).attr('data-attr'));
                    });

                    if (determinants.length > 0) {
                      $('[data-attr]').find('[data-loading]').removeClass('d-none');
                      $('[data-attr]').find('[data-loaded]').addClass('invisible');

                      $.ajax({
                         type: "POST",
                         url: "<?php echo site_url('item/ajax/updateAttrOptions'); ?>",
                         data: {
                           itemID: <?php echo $item['item_id']; ?>,
                           determinants: determinants,
                           choices: choices,
                         },
                         success: function(data){
                           if (data !== 'false') {
                             var attributes = JSON.parse(data);

                             $.each(attributes, function(key, value) {
                               var attrID = value['attrID'];
                               var options = value['options'];

                               var content = '';

                               $.each(options, function(key, option) {
                                 content = content + '<li class="option-item label-input-group">';
                                 content = content + '<input class="option-value label-input" type="radio" id="';
                                 content = content + 'group-' + 1 + '-attr-' + attrID + '-opt-' + option["optID"] + '" name="group-' + 1 + '-attr-' + attrID + '-options" data-option="' + option["optID"] + '"';
                                 if (option["is_checked"] == 1) {
                                   content = content + ' checked';
                                   choices[attrID]['optionID'] = option["optID"];
                                 }
                                 content = content + '>';

                                 content = content + '<label class="option-name has-addon label-item" for="group-' + 1 + '-attr-' + attrID + '-opt-' + option["optID"] + '" onclick="selectOption(this, ';
                                 if (option["is_determinant"] == 1) {
                                   content = content + 'true';
                                 } else {
                                   content = content + 'false';
                                 }
                                 content = content + ');">';
                                 content = content + '<div class="option-addon"><span class="addon-text">' + option['name'] + '</span></div></label></li>';
                               });


                               $('.item-configuration').find('[data-attr="' + attrID + '"]').each(function() {
                                 $(this).find('.option-group').html(content);
                               });
                             });

                             $('[data-attr]').find('[data-loading]').addClass('d-none');
                             $('[data-attr]').find('[data-loaded]').removeClass('invisible');

                             $.updateAttrChoices();
                           } else {
                             console.log(data); // DEBUG
                             $('[data-attr]').find('[data-loading]').addClass('d-none');
                             $('[data-attr]').find('[data-loaded]').removeClass('invisible');
                           }
                         },
                         complete: function() {},
                         error: function(xhr, textStatus, errorThrown) {
                         }
                      });
                    }
                  }

                  jQuery.updatePriceInfo = function updatePriceInfo() {
                    $('.item-price').find('[data-loading]').removeClass('d-none');
                    $('.item-price').find('[data-loaded]').addClass('invisible');

                    $('.item-total-price span').html(parseFloat(0).toFixed(2));
                    $('.item-original-price span').html(parseFloat(0).toFixed(2));
                    $('.item-discount-percent span').html(0);
                    $('.item-unit-price span').html(parseFloat(0).toFixed(2));
                    $('.item-total-weight span').html(parseFloat(0).toFixed(2));
                    $('.item-est-delivery span.min-delivery').html('');
                    $('.item-est-delivery span.max-delivery').html('');

                    $.ajax({
                      type: "POST",
                      url: "<?php echo site_url('item/ajax/updatePriceInfo/'); ?>",
                      data: {
                        itemID: <?php echo $item['item_id']; ?>,
                        choices: choices,
                      },
                      success: function(data){
                        if (data !== 'false') {
                          var info = JSON.parse(data);

                          var itemSet = parseInt($('.attribute-item-set').find('input[type=number]').val());

                          $('.item-total-price span').html($.number(info['total_price'] * itemSet, 2, '.', ','));
                          $('.item-original-price span').html($.number(info['original_price'] * itemSet, 2, '.', ','));
                          $('.item-discount-percent span').html(info['discount_percent']);
                          $('.item-unit-price span').html($.number(info['price_per_unit'], 2, '.', ','));
                          $('.item-total-weight span').html($.number(info['total_weight'] * itemSet, 2, '.', ','));
                          $('.item-est-delivery span.min-delivery').html(info['min_delivery_day']);
                          $('.item-est-delivery span.max-delivery').html(info['max_delivery_day']);

                          $('.item-price').find('[data-loading]').addClass('d-none');
                          $('.item-price').find('[data-loaded]').removeClass('invisible');
                        } else {
                          console.log(data); // DEBUG
                        }
                      }
                    });
                  }

                  $('.attribute-item-set').find('input[type=number]').on('change', function() {
                    $.updatePriceInfo();
                  });

                  jQuery.importPrice = function importPrice() {
                    var productCost = $('#productCost').val();
                    var totalWeight = $('#totalWeight').val();

                    $.ajax({
                      type: "POST",
                      url: "<?php echo site_url('item/ajax/import'); ?>",
                      data: {
                        itemID: <?php echo $item['item_id']; ?>,
                        choices: choices,
                        productCost: productCost,
                        totalWeight: totalWeight,
                      },
                      success: function(data){
                        if (data == 'true') {
                          alert('Price Imported');
                          $.updatePriceInfo();
                        } else {
                          console.log(data);
                        }
                      }
                    });
                  }

                  $('#importPrice').on('click', function() {
                    $.importPrice();
                  });

                  $.updateAttrChoices();
                  $.updateAttrOptions();
                  $.updatePriceInfo();
                });

                function selectOption(option, updateOptions) {
                  $(option).siblings('.option-value').prop('checked', true);
                  $.updateAttrChoices();

                  if (updateOptions === true) {
                    $.updateAttrOptions();
                  }

                  $.updatePriceInfo();
                }

                $(document).keypress(function(event){
                	var keycode = (event.keyCode ? event.keyCode : event.which);
                	if(keycode == '13'){
                		$.importPrice();
                	}
                });
              </script>

              <!--- item-quantity --->
              <li class="item-configuration list-group-item">
                <div class="attribute-group">

                  <div class="attribute-item d-none">
                    <span class="attribute-name col-sm-6">Quantity</span>
                    <span class="attribute-selected has-input col-sm-18">
                      <div class="row">
                        <div class="col-sm">
                          <div class="quantity">
                            <input type="number" value="1" class="qty" step="1" min="1" max="9999" maxLength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            <input type="button" value="+" class="plus">
                            <input type="button" value="-" class="minus">
                          </div>
                        </div>
                      </div>
                    </span>
                  </div>

                  <div class="attribute-item attribute-item-set col-sm-12">
                    <span class="attribute-name col-sm-12">Set</span>
                    <span class="attribute-selected has-input col-sm-12">
                      <div class="row">
                        <div class="col-sm">
                          <div class="quantity">
                            <input type="number" value="1" class="qty" step="1" min="1" max="9999" maxLength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            <input type="button" value="+" class="plus">
                            <input type="button" value="-" class="minus">
                          </div>
                        </div>
                      </div>
                    </span>
                  </div>
                </div>
              </li>

              <li class="item-action-group list-group-item">
                <style>
                  .item-action-group {
                    background: #F8F9FA;
                  }
                </style>
                <div class="row py-2">
                  <div class="col-sm-8">
                    <button class="btn btn-lg btn-block bg-gradient bg-yellow">Buy Now</button>
                  </div>
                  <div class="col-sm-8">
                    <button class="btn btn-lg btn-block bg-gradient bg-orange">Add to Cart</button>
                  </div>
                </div>
              </li>
            </ul>
          </div><!--- END Item Card Main Section --->
        </main><!--- END Item Card --->

        <!--- Item Toolbar --->
        <aside class="item-widget col-sm-6 mt-3">
          <style>
            .item-widget {
              padding-left : 15px;
            }
            .item-widget .item-tool + .item-tool {
              margin-top: 15px;
            }
          </style>
          <div class="item-tool shadow-sm sticky-top">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <div class="mb-3">
                  <small class="text-primary">
                    <b>Import</b>
                  </small>
                </div>
                <div class="form-group row">
                  <label for="productCost" class="col-sm-10 col-form-label"><small><b>Product Cost</b></small></label>
                  <div class="col-sm-14">
                    <input type="text" class="form-control" id="productCost" value="0.00">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="totalWeight" class="col-sm-10 col-form-label"><small><b>Total Weight</b></small></label>
                  <div class="col-sm-14">
                    <input type="test" class="form-control" id="totalWeight" value="0.00">
                  </div>
                </div>
                <button class="btn btn-block bg-gradient bg-orange" id="importPrice">Import</button>
              </li>
            </ul>
          </div>

          <div class="item-tool shadow-sm">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <div class="mb-3">
                  <small class="text-primary">
                    <b>Delivery Options</b>
                  </small>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item py-1 px-0" style="border: none">
                    <div class="row">
                      <div class="col-sm-4 text-center p-1">
                        <i class="fas fa-map-marker-alt"></i>
                      </div>
                      <div class="col-sm-20" style="font-size: 1rem; font-weight: 500;">
                        Cheras, Kuala Lumpur
                        <p class="text-primary"><small style="font-weight: 500;">within Peninsalur Malaysia</small></p>
                      </div>
                    </div>
                  </li>
                </ul>
              </li>

              <li class="list-group-item">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item py-1 px-0" style="border: none">
                    <div class="row">
                      <div class="col-sm-4 text-center p-1">
                        <i class="fas fa-truck"></i>
                      </div>
                      <div class="col-sm-20" style="font-size: 1rem; font-weight: 500;">
                        Free Delivery
                        <p class="text-primary"><small style="font-weight: 500;">within Peninsalur Malaysia</small></p>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item py-1 px-0" style="border: none">
                    <div class="row">
                      <div class="col-sm-4 text-center p-1">
                        <i class="fas fa-hand-lizard"></i>
                      </div>
                      <div class="col-sm-20" style="font-size: 1rem; font-weight: 500;">
                        Self-Collect Ready
                        <p class="text-primary"><small style="font-weight: 500;">within Klang Valley area</small></p>
                      </div>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <!--- TODO: Unit Converter --->
          <div class="item-tool shadow-sm">
            <ul class="list-group list-group-flush">
            </ul>
          </div><!--- END Unit Converter --->
          <!--- TODO: Size Chart --->
          <div class="item-tool shadow-sm">
            <ul class="list-group list-group-flush">
            </ul>
          </div><!--- END Size Chart --->
          <!--- TODO: Artwork Guide --->
          <div class="item-tool shadow-sm">
            <ul class="list-group list-group-flush">
            </ul>
          </div><!--- END Artwork Guide --->
        </aside><!--- END Item Toolbar --->
      </div>

      <div class="item-info-card card-group col-sm-18 mt-4">
        <ul class="card list-group list-group-flush py-3 shadow-sm">
          <li class="item-details list-group-item py-3" style="border: none;">
            <a class="card-header d-block" data-toggle="collapse" href="#collapseItemDetails">
              <h5 class="m-0 d-flex flex-row justify-content-between">
                <small>Product Details</small>
                <small><i class="fas fa-chevron-down"></i></small>
              </h5>
            </a>
            <div class="card-body collapse show" id="collapseItemDetails">
              <div class="no-details d-flex flex-column justify-content-center align-items-center">
                <img style="width: 10%" src="https://image.flaticon.com/icons/svg/682/682033.svg">
                <h6 class="text-primary mt-3">No Description</h6>
              </div>
            </div>
          </li>

          <li class="item-faq list-group-item py-3" style="border: none;">
            <a class="card-header d-block" data-toggle="collapse" href="#collapseItemFaq">
              <h5 class="m-0 d-flex flex-row justify-content-between">
                <small>Frequent Ask Questions</small>
                <small><i class="fas fa-chevron-down"></i></small>
              </h5>
            </a>
            <div class="card-body collapse show" id="collapseItemFaq">
              <div class="no-faq d-flex flex-column justify-content-center align-items-center">
                <img style="width: 10%" src="https://image.flaticon.com/icons/svg/682/682040.svg">
                <h6 class="text-primary mt-3">No Frequent Ask Questions</h6>
              </div>
            </div>
          </li>

        </ul>

      </div>

    </section><!--- END Content Body --->

    <!--- Content Footer --->
    <section class="content-footer">
    </section><!--- END Content Footer --->

  </div>

  <script>
    // https://github.com/customd/jquery-number
    !function(e){"use strict";function t(e,t){if(this.createTextRange){var a=this.createTextRange();a.collapse(!0),a.moveStart("character",e),a.moveEnd("character",t-e),a.select()}else this.setSelectionRange&&(this.focus(),this.setSelectionRange(e,t))}function a(e){var t=this.value.length;if(e="start"==e.toLowerCase()?"Start":"End",document.selection){var a,i,n,l=document.selection.createRange();return a=l.duplicate(),a.expand("textedit"),a.setEndPoint("EndToEnd",l),i=a.text.length-l.text.length,n=i+l.text.length,"Start"==e?i:n}return"undefined"!=typeof this["selection"+e]&&(t=this["selection"+e]),t}var i={codes:{46:127,188:44,109:45,190:46,191:47,192:96,220:92,222:39,221:93,219:91,173:45,187:61,186:59,189:45,110:46},shifts:{96:"~",49:"!",50:"@",51:"#",52:"$",53:"%",54:"^",55:"&",56:"*",57:"(",48:")",45:"_",61:"+",91:"{",93:"}",92:"|",59:":",39:'"',44:"<",46:">",47:"?"}};e.fn.number=function(n,l,s,r){r="undefined"==typeof r?",":r,s="undefined"==typeof s?".":s,l="undefined"==typeof l?0:l;var u="\\u"+("0000"+s.charCodeAt(0).toString(16)).slice(-4),h=new RegExp("[^"+u+"0-9]","g"),o=new RegExp(u,"g");return n===!0?this.is("input:text")?this.on({"keydown.format":function(n){var u=e(this),h=u.data("numFormat"),o=n.keyCode?n.keyCode:n.which,c="",v=a.apply(this,["start"]),d=a.apply(this,["end"]),p="",f=!1;if(i.codes.hasOwnProperty(o)&&(o=i.codes[o]),!n.shiftKey&&o>=65&&90>=o?o+=32:!n.shiftKey&&o>=69&&105>=o?o-=48:n.shiftKey&&i.shifts.hasOwnProperty(o)&&(c=i.shifts[o]),""==c&&(c=String.fromCharCode(o)),8!=o&&45!=o&&127!=o&&c!=s&&!c.match(/[0-9]/)){var g=n.keyCode?n.keyCode:n.which;if(46==g||8==g||127==g||9==g||27==g||13==g||(65==g||82==g||80==g||83==g||70==g||72==g||66==g||74==g||84==g||90==g||61==g||173==g||48==g)&&(n.ctrlKey||n.metaKey)===!0||(86==g||67==g||88==g)&&(n.ctrlKey||n.metaKey)===!0||g>=35&&39>=g||g>=112&&123>=g)return;return n.preventDefault(),!1}if(0==v&&d==this.value.length?8==o?(v=d=1,this.value="",h.init=l>0?-1:0,h.c=l>0?-(l+1):0,t.apply(this,[0,0])):c==s?(v=d=1,this.value="0"+s+new Array(l+1).join("0"),h.init=l>0?1:0,h.c=l>0?-(l+1):0):45==o?(v=d=2,this.value="-0"+s+new Array(l+1).join("0"),h.init=l>0?1:0,h.c=l>0?-(l+1):0,t.apply(this,[2,2])):(h.init=l>0?-1:0,h.c=l>0?-l:0):h.c=d-this.value.length,h.isPartialSelection=v==d?!1:!0,l>0&&c==s&&v==this.value.length-l-1)h.c++,h.init=Math.max(0,h.init),n.preventDefault(),f=this.value.length+h.c;else if(45!=o||0==v&&0!=this.value.indexOf("-"))if(c==s)h.init=Math.max(0,h.init),n.preventDefault();else if(l>0&&127==o&&v==this.value.length-l-1)n.preventDefault();else if(l>0&&8==o&&v==this.value.length-l)n.preventDefault(),h.c--,f=this.value.length+h.c;else if(l>0&&127==o&&v>this.value.length-l-1){if(""===this.value)return;"0"!=this.value.slice(v,v+1)&&(p=this.value.slice(0,v)+"0"+this.value.slice(v+1),u.val(p)),n.preventDefault(),f=this.value.length+h.c}else if(l>0&&8==o&&v>this.value.length-l){if(""===this.value)return;"0"!=this.value.slice(v-1,v)&&(p=this.value.slice(0,v-1)+"0"+this.value.slice(v),u.val(p)),n.preventDefault(),h.c--,f=this.value.length+h.c}else 127==o&&this.value.slice(v,v+1)==r?n.preventDefault():8==o&&this.value.slice(v-1,v)==r?(n.preventDefault(),h.c--,f=this.value.length+h.c):l>0&&v==d&&this.value.length>l+1&&v>this.value.length-l-1&&isFinite(+c)&&!n.metaKey&&!n.ctrlKey&&!n.altKey&&1===c.length&&(p=d===this.value.length?this.value.slice(0,v-1):this.value.slice(0,v)+this.value.slice(v+1),this.value=p,f=v);else n.preventDefault();f!==!1&&t.apply(this,[f,f]),u.data("numFormat",h)},"keyup.format":function(i){var n,s=e(this),r=s.data("numFormat"),u=i.keyCode?i.keyCode:i.which,h=a.apply(this,["start"]),o=a.apply(this,["end"]);0!==h||0!==o||189!==u&&109!==u||(s.val("-"+s.val()),h=1,r.c=1-this.value.length,r.init=1,s.data("numFormat",r),n=this.value.length+r.c,t.apply(this,[n,n])),""===this.value||(48>u||u>57)&&(96>u||u>105)&&8!==u&&46!==u&&110!==u||(s.val(s.val()),l>0&&(r.init<1?(h=this.value.length-l-(r.init<0?1:0),r.c=h-this.value.length,r.init=1,s.data("numFormat",r)):h>this.value.length-l&&8!=u&&(r.c++,s.data("numFormat",r))),46!=u||r.isPartialSelection||(r.c++,s.data("numFormat",r)),n=this.value.length+r.c,t.apply(this,[n,n]))},"paste.format":function(t){var a=e(this),i=t.originalEvent,n=null;return window.clipboardData&&window.clipboardData.getData?n=window.clipboardData.getData("Text"):i.clipboardData&&i.clipboardData.getData&&(n=i.clipboardData.getData("text/plain")),a.val(n),t.preventDefault(),!1}}).each(function(){var t=e(this).data("numFormat",{c:-(l+1),decimals:l,thousands_sep:r,dec_point:s,regex_dec_num:h,regex_dec:o,init:this.value.indexOf(".")?!0:!1});""!==this.value&&t.val(t.val())}):this.each(function(){var t=e(this),a=+t.text().replace(h,"").replace(o,".");t.number(isFinite(a)?+a:0,l,s,r)}):this.text(e.number.apply(window,arguments))};var n=null,l=null;e.isPlainObject(e.valHooks.text)?(e.isFunction(e.valHooks.text.get)&&(n=e.valHooks.text.get),e.isFunction(e.valHooks.text.set)&&(l=e.valHooks.text.set)):e.valHooks.text={},e.valHooks.text.get=function(t){var a,i=e(t),l=i.data("numFormat");return l?""===t.value?"":(a=+t.value.replace(l.regex_dec_num,"").replace(l.regex_dec,"."),(0===t.value.indexOf("-")?"-":"")+(isFinite(a)?a:0)):e.isFunction(n)?n(t):void 0},e.valHooks.text.set=function(t,a){var i=e(t),n=i.data("numFormat");if(n){var s=e.number(a,n.decimals,n.dec_point,n.thousands_sep);return e.isFunction(l)?l(t,s):t.value=s}return e.isFunction(l)?l(t,a):void 0},e.number=function(e,t,a,i){i="undefined"==typeof i?"1000"!==new Number(1e3).toLocaleString()?new Number(1e3).toLocaleString().charAt(1):"":i,a="undefined"==typeof a?new Number(.1).toLocaleString().charAt(1):a,t=isFinite(+t)?Math.abs(t):0;var n="\\u"+("0000"+a.charCodeAt(0).toString(16)).slice(-4),l="\\u"+("0000"+i.charCodeAt(0).toString(16)).slice(-4);e=(e+"").replace(".",a).replace(new RegExp(l,"g"),"").replace(new RegExp(n,"g"),".").replace(new RegExp("[^0-9+-Ee.]","g"),"");var s=isFinite(+e)?+e:0,r="",u=function(e,t){return""+ +(Math.round((""+e).indexOf("e")>0?e:e+"e+"+t)+"e-"+t)};return r=(t?u(s,t):""+Math.round(s)).split("."),r[0].length>3&&(r[0]=r[0].replace(/\B(?=(?:\d{3})+(?!\d))/g,i)),(r[1]||"").length<t&&(r[1]=r[1]||"",r[1]+=new Array(t-r[1].length+1).join("0")),r.join(a)}}(jQuery);
  //# sourceMappingURL=jquery.number.min.js.map
  </script>
