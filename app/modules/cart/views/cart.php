<?php
defined('BASEPATH') OR exit('No direct script access allowed.');
?>
<style>
  .section-content {
    min-height: 100vh;
  }
</style>
<!--- Section Content --->
<main class="section-content">
  <div class="container pb-5">
  <!--- Content --->

    <!--- Content Header --->
    <?php if ( ! empty($cart_contents)) : ?>
      <header class="content-header pt-3 h4 text-center">
        <span class="badge badge-pill badge-primary bg-gradient bg-primary px-3 py-2">
          Shopping Cart
        </span>
      </header>
    <?php endif; ?><!--- END Content Header --->

    <!--- Content Body --->
    <main class="content-body pt-5">
      <div class="container">

        <?php if (empty($cart_contents)) : ?>
          <div class="no-cart-item empty-state">
            <figure class="figure mt-5">
              <img class="figure-img" src="https://image.flaticon.com/icons/svg/825/825561.svg">
              <figcaption class="figure-caption">
                <h5 class="text-muted text-center my-3">No items found in your shopping cart</h5>
                <a class="btn btn-primary mt-4" href="<?php echo site_url(); ?>">Continue Shopping</a>
              </figcaption>
            </figure>
          </div>
        <?php else : ?>
          <div class="has-cart-item card shadow-sm">
            <div class="card-header">
              <div class="row no-gutters">
                <div class="col-12 content-flex-row content-v-center">
                  <div class="nav content-mx-between">
                    <div class="nav-item">
                      <div class="custom-control custom-checkbox">
                        <style>
                          .select-all {
                            display: inline-block;
                          }
                          .deselect-all {
                            display: none;
                          }
                          .cart-select-all:checked ~ .custom-control-label .select-all {
                            display: none;
                          }
                          .cart-select-all:checked ~ .custom-control-label .deselect-all {
                            display: inline-block;
                          }
                        </style>
                        <input type="checkbox" class="cart-select-all custom-control-input" id="cartSelectAll">
                        <label class="custom-control-label pl-2" for="cartSelectAll"><span class="select-all">Select All</span><span class="deselect-all">Deselect All</span> (<span class="cart-total-items"><?php echo $cart_total_items; ?></span> items)</label>
                      </div>
                    </div>
                    <style>
                      .item-remove-selected:hover {
                        cursor: pointer;
                      }
                    </style>
                    <div class="nav-item item-remove-selected">
                      <span class="icon icon-sm">
                        <i class="fas fa-trash mr-1" data-feather="trash-2"></i>
                      </span>
                      Remove Selected
                    </div>
                  </div>
                </div>
                <div class="col-3 content-flex-row content-center">
                 Price Per Set
                </div>
                <div class="col-4 content-flex-row content-center">
                  Set Quantity
                </div>
                <div class="col-4 content-flex-row content-center">
                  Total Price
                </div>
              </div>
            </div>
            <!--- Cart Item List --->
            <ul class="order-item-list list-group list-group-flush">
              <style>
                .input-quantity.input-group {
                  width: 50%;
                  margin: 0px auto;
                }

                .input-quantity.input-group .form-control::-webkit-inner-spin-button {
                  -webkit-appearance: none;
                }
                .input-quantity.input-group .form-control:focus {
                  border-radius: 0.25rem;
                }

                .input-quantity.input-group .input-group-append {
                  position: relative;
                  width: 25px;
                  background-color: none;
                  border: 1px solid #D5DCE1;
                  border-left: none;
                  border-top-right-radius: 0.25rem;
                  border-bottom-right-radius: 0.25rem;
                  overflow: hidden;
                }

                .input-quantity.input-group .input-group-append [class*="input-quantity-"] {
                  position: absolute;
                  width: 23px;
                  margin-left: 1px;
                  height: 50%;
                  line-height: 0;
                  border-radius: 0;
                  color: #bbb;
                  font-size: 18px;
                  background-color: transparent;
                  padding: 0;
                }
                .input-quantity.input-group .input-group-append [class*="input-quantity-"]:hover {
                  background-color: #FDF4F7;
                  cursor: pointer;
                  color: #EB3833;
                  border-top-right-radius: 0.25rem;
                }

                .input-quantity.input-group .input-quantity-minus {
                  bottom: 0;
                  border-top-right-radius: 0;
                  border-bottom-right-radius: 0.25rem;
                }
              </style>
              <script>
                $(document).ready(function() {
                  $('.input-quantity-plus').on('click', function() {
                    var input = $(this).parents('.input-quantity').find('input[type="number"]');

                    var inputNum = parseInt(input.val());
                    var maxNum = parseInt(input.attr('max'));
                    var minNum = parseInt(input.attr('min'));

                    var step = parseInt(input.attr('step'));

                    var newNum = inputNum + step;
                    if (newNum > maxNum) {
                      newNum = maxNum;
                    }

                    $(input).val(newNum);
                  });

                  $('.input-quantity-minus').on('click', function() {
                    var input = $(this).parents('.input-quantity').find('input[type="number"]');

                    var inputNum = parseInt(input.val());
                    var maxNum = parseInt(input.attr('max'));
                    var minNum = parseInt(input.attr('min'));

                    var step = parseInt(input.attr('step'));

                    var newNum = inputNum - step;
                    if (newNum < minNum) {
                      newNum = minNum;
                    }

                    $(input).val(newNum);
                  });
                });
              </script>
              <!--- Cart Item --->
              <?php foreach($cart_contents as $row_id => $cart_item) : ?>
                <li id="cartItem-<?php echo $row_id; ?>" data-ID="<?php echo $row_id; ?>" class="order-item list-group-item">
                  <div class="row no-gutters">
                    <div class="col-1">
                      <label for="cartSelectItem-<?php echo $row_id; ?>">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="cartSelectItem-<?php echo $row_id; ?>" name="itemSelected[]">
                          <label class="custom-control-label" for="cartSelectItem-<?php echo $row_id; ?>"></label>
                        </div>
                      </label>
                    </div>
                    <div class="col-11">
                      <figure class="media m-0">
                        <img <?php echo ( ! empty($cart_item['thumbnail'])) ? 'src="'.$cart_item['thumbnail'].'"' : 'data-src="holder.js/80x80?auto=yes&bg=#F9FAFB"'; ?> class="border item-thumbnail mr-3" alt="Item Thumbnail" width="80px" height="80px">
                        <figcaption class="media-body">
                          <a href="<?php echo site_url('item/'.$cart_item['id']); ?>">
                            <h5 class="item-name pl-2"><?php echo $cart_item['name']; ?></h5>
                          </a>
                          <p class="item-info">
                            <ul class="label-group">
                              <?php echo ( ! empty($cart_item['option_text'])) ? $cart_item['option_text'] : false; ?>
                            </ul>
                          </p>
                        </figcaption>
                      </figure>
                    </div>
                    <div class="col-3 content-flex-row content-center">
                      <span class="item-price-per-set">RM <span data-value-loaded><?php echo $cart_item['price']; ?></span></span>
                    </div>
                    <div class="col-4 content-flex-row content-center">
                      <div class="input-quantity input-group">
                        <input type="number" class="item-set-quantity form-control text-center" value="<?php echo $cart_item['qty']; ?>" step="1" min="1" max="99" maxLength="2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)">
                        <div class="input-group-append">
                          <button class="input-quantity-plus btn btn-block btn-sm btn-outline no-outline">&plus;</button>
                          <button class="input-quantity-minus btn btn-block btn-sm btn-outline no-outline">&minus;</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-4 content-flex-column content-center">
                      <span class="item-total-price h5">RM <span data-value-loaded><?php echo $cart_item['subtotal']; ?></span></span>
                      <div class="item-discount d-none">
                        <span class="item-original-price text-strike">RM <span data-value-loaded>99999.99</span></span>
                        <span class="item-discount-percent badge badge-primary"><span data-value-loaded>99</span>% OFF</span>
                      </div>
                    </div>
                    <div class="col-1 content-flex-row content-center">
                      <style>
                        [data-remove]:hover {
                          color: #EB3833
                        }
                      </style>
                      <div class="btn btn-outline" data-toggle="modal" data-target="#modalItemRemove" data-remove="<?php echo $row_id; ?>">
                        <span class="icon icon-md"><i class="fas fa-trash" data-feather="trash-2"></i></span>
                      </div>
                    </div>
                  </div>
                </li><!--- END Cart Item --->
              <?php endforeach; ?>
            </ul><!--- END Cart Item List --->
          </div>

        <?php endif; ?>
      </div>
    </main><!--- END Content Body --->

    <!--- Content Footer --->
    <footer class="content-footer fixed-bottom<?php echo empty($cart_contents) ? ' d-none' : false; ?>">
      <div class="container">

        <!--- Widget: Drawer --->
        <div class="drawer drawer-slide-up">
          <style>
            .drawer {
              position: relative;
              display: flex;
              flex-direction: column;
              min-width: 0;
              word-wrap: break-word;
              background-color: #FFFFFF;
              background-clip: border-box;
              border: 1px solid #E5E9EC;
              overflow: hidden;
            }
            .drawer-slide-up {
              border-top-left-radius: 8px;
              border-top-right-radius: 8px;
              border-bottom: none;
              box-shadow: 0 -0.3rem 1rem rgba(33, 37, 41, 0.05);
            }
            .drawer-slide-down {
              border-bottom-left-radius: 8px;
              border-bottom-right-radius: 8px;
              border-top: none;
              box-shadow: 0 0.3rem 1rem rgba(33, 37, 41, 0.05);
            }

            .drawer-body {
              padding: 0.75rem 1.25rem;
              background-color: #FDFDFD; /* Content Inner */
            }

            .drawer-header {
              padding: 0.75rem 1.25rem;
              background-color: #FFFFFF; /* Content Inner */
            }
            .drawer-slide-down .drawer-header {
              border-bottom: 1px solid #E5E9EC;
            }
            .drawer-slide-up .drawer-header {
              border-top: 1px solid #E5E9EC;
            }

          </style>
          <div class="drawer-body">
            <div class="row">
              <div class="col-16 h6 m-0">
                Voucher(s) Applied
              </div>
              <div class="col-8 h6 m-0 text-center">
                Order Summary
              </div>
            </div>

          </div>
          <div class="drawer-header">


            <div class="row">
              <div class="col-16">
                <style>
                  .empty-state {
                    width: 100%;
                    padding: 15px;
                  }
                  .empty-state .figure-img {
                    width: 80px !important;
                    height: 80px !important;
                  }

                  .empty-state-sm {
                    width: 50%;
                    padding: 15px;
                  }
                  .empty-state-sm .figure-img {
                    width: 30px !important;
                    height: 30px !important;
                  }

                  .empty-state .figure,
                  .empty-state .figure-caption {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                  }
                </style>
                <div class="empty-state empty-state-sm">
                  <figure class="figure">
                    <figcaption class="figure-caption">
                      <p class="text-muted text-center">No voucher added</p>
                      <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAddVoucher">Add Voucher(s)</button>
                    </figcaption>
                  </figure>
                </div>
              </div>
              <div class="col-8 text-right content-my-between">
                <style>
                  [class*="list-description"] {
                    margin-bottom: 5px; }
                    [class*="list-description"] dd {
                      margin-bottom: 0; }

                  .list-align dt {
                    float: left;
                    word-wrap: break-word; }
                  .list-align dd {
                    vertical-align: baseline; }

                  .list-inline dt, .list-inline dd {
                    display: inline-block; }
                </style>

                <div class="order-summary">
                  <style>
                    .order-summary > .list-description + .list-description {
                      margin-top: 15px;
                    }
                  </style>
                  <dl class="subtotal list-description list-align">
                    <dt>Subtotal (<span class="order-selected-items">0</span> items): </dt>
                    <dd class="text-right">
                      <span class="h4 order-subtotal">RM <span>0.00</span></span>
                    </dd>
                  </dl>
                  <dl class="subtotal-b4-discount list-description list-align invisible">
                    <dt>Before Discount: </dt>
                    <dd class="text-right">
                      <span class="text-strike">RM <span data-value-loaded>99999.99</span></span>
                    </dd>
                  </dl>
                </div>

                <div class="order-action py-1">
                  <a class="btn btn-lg btn-primary text-white" <?php echo $this->aauth->is_loggedin() ? 'data-toggle="checkout"' : 'data-toggle="modal"'; ?> data-target="#modalLoginRequired">Proceed To Checkout</a>
                </div>
              </div>
            </div>


          </div>
        </div><!--- END Widget: Drawer --->

      </div>
    </footer><!--- END Content Footer --->

  <!--- END Content --->
  </div>
</main><!--- END Section Content --->

<div style="height: 150px"></div>

<!--- Modal Item Remove --->
<div class="modal fade" id="modalItemRemove" tabindex="-1" role="dialog" aria-labelledby="modalItemRemoveTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title mx-auto" id="modalItemRemoveTitle">Remove Item From Cart</h5>
      </div>

      <div class="modal-body">
        <p class="card-text text-center">Are you sure to remove this item from the shopping cart?</p>
        <figure class="media m-0">
          <img data-src="holder.js/80x80?auto=yes&bg=#F9FAFB" class="border item-thumbnail mr-3" alt="Item Thumbnail" width="80px" height="80px">
          <figcaption class="media-body">
            <h5 class="item-name pl-2"></h5>
            <p class="item-info">
              <ul class="label-group item-option-text">
              </ul>
            </p>
          </figcaption>
        </figure>
      </div>

      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-outline" data-dismiss="modal">Cancel</button>
        <button type="button" class="item-remove-btn btn btn-primary">Remove Item</button>
      </div>

    </div>
  </div>
</div>

<!--- Modal Add Voucher --->
<div class="modal fade" id="modalAddVoucher" tabindex="-1" role="dialog" aria-labelledby="modalAddVoucherTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAddVoucherTitle">Choose Voucher(s)</h5>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Add Voucher</button>
      </div>
    </div>
  </div>
</div><!--- END Modal Add Voucher --->

<!--- Modal Login Required --->
<div class="modal fade" id="modalLoginRequired" tabindex="-1" role="dialog" aria-labelledby="modalLoginRequiredTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLoginRequiredTitle">Please Login To Proceed</h5>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Add Voucher</button>
      </div>
    </div>
  </div>
</div><!--- END Modal Login Required --->


<!--- Modal No Item Selected --->
<div class="modal fade" id="modalNoItemSelected" tabindex="-1" role="dialog" aria-labelledby="modalNoItemSelectedTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mx-auto" id="modalNoItemSelected">No Item Selected</h5>
      </div>
      <div class="modal-body text-center">
        Please select item(s) to checkout
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary mx-auto" data-dismiss="modal">Alright</button>
      </div>
    </div>
  </div>
</div><!--- END Modal No Item Selected  --->

<!--- Modal Remove Selected --->
<div class="modal fade" id="modalremoveSelected" tabindex="-1" role="dialog" aria-labelledby="modalremoveSelectedTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mx-auto" id="modalremoveSelected">Remove Selected Item(s)</h5>
      </div>
      <div class="modal-body text-center">
        Are you sure to remove all the selected item(s)?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-dismiss="modal">Cancel</button>
        <button type="button" class="remove-selected-btn btn btn-primary mx-auto" data-dismiss="modal">Remove Selected Item(s)</button>
      </div>
    </div>
  </div>
</div><!--- END Modal Remove Selected  --->

<script>
  $(document).ready(function() {
    var itemSelected = [];

    $('[data-toggle="checkout"]').on('click', function() {
      $.ajax({
        url: '<?php echo site_url('checkout/ajax/checkoutCart'); ?>',
        type: 'POST',
        data: {
          itemSelected: itemSelected,
        },
        success: function(result) {
          if (result !== 'false') {
            if (result == 'notLoggedin') {
              $('[data-toggle="checkout"]').attr('data-toggle', 'modal');
              $('#modalLoginRequired').modal('show');
            } else if (result == 'noItemSelected') {
              $('#modalNoItemSelected').modal('show');
            } else {
              window.location.href = '<?php echo site_url('checkout'); ?>';
            }
          }
        }
      });
    });

    $.updateItemSelected = function updateItemSelected() {
      $('[name="itemSelected[]"]').each(function() {
        var rowID = $(this).parents('.order-item').data('id');

        if ($(this).prop('checked') === true && $.inArray(rowID, itemSelected) < 0) {
          itemSelected.push(rowID);
        }

        if ($(this).prop('checked') === false && $.inArray(rowID, itemSelected) > -1) {
          itemSelected.splice(itemSelected.indexOf(rowID), 1);
        }
      });

      var orderSubtotal = 0.00;
      var orderSelectedItems = 0;

      $.each(itemSelected, function(index, rowID) {
        var item = $('#cartItem-' + rowID);
        var itemSubtotal = $(item).find('.item-total-price span').html();
        var itemQty = $(item).find('.item-set-quantity').val();

        itemSubtotal = itemSubtotal.replace(',', '');

        orderSubtotal = orderSubtotal + parseFloat(itemSubtotal);
        orderSelectedItems = orderSelectedItems + parseFloat(itemQty);
      });

      $('.order-subtotal span').html($.number(orderSubtotal, 2, '.', ','));
      $('.order-selected-items').html(orderSelectedItems);
    }

    $('[name="itemSelected[]"]').on('change', function() {
      $.updateItemSelected();
    });

    $('#cartSelectAll').on('change', function() {
      $('[name="itemSelected[]"]').prop('checked', $(this).prop('checked'));
      $.updateItemSelected();
    });

    $('.item-set-quantity').on('input', function() {
      var parent = $(this).parents('.order-item');
      var rowID = $(parent).data('id');

      var qty = $(this).val();

      var max = $(this).attr('max');
      var min = $(this).attr('min');

      //javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);
      if (qty > max) {
        $(this).val(max);
        qty = max;
      }
      if (qty < min) {
        $(this).val(min);
        qty = min;
      }

      $.updateItemQty(rowID, qty);
    });

    $('.input-quantity-plus').on('click', function() {
      var parent = $(this).parents('.order-item');
      var rowID = $(parent).data('id');

      var input = $(parent).find('.item-set-quantity');

      var qty = $(input).val();
      var max = $(input).attr('max');
      var min = $(input).attr('min');

      if (qty > max) {
        $(input).val(max);
        qty = max;
      }
      if (qty < min) {
        $(input).val(min);
        qty = min;
      }

      $.updateItemQty(rowID, qty);
    });

    $('.input-quantity-minus').on('click', function() {
      var parent = $(this).parents('.order-item');
      var rowID = $(parent).data('id');

      var input = $(parent).find('.item-set-quantity');

      var qty = $(input).val();
      var max = $(input).attr('max');
      var min = $(input).attr('min');

      if (qty > max) {
        $(input).val(max);
        qty = max;
      }
      if (qty < min) {
        $(input).val(min);
        qty = min;
      }

      $.updateItemQty(rowID, qty);
    });

    $.updateItemQty = function updateItemQty(rowID, qty) {
      $.ajax({
        url: '<?php echo site_url('cart/ajax/updateItemQty'); ?>',
        type: 'POST',
        data: {
          rowID: rowID,
          qty: qty,
        },
        success: function(result) {
          if (result !== 'false') {
            $('.cart-total-items').html(result['totalItems']);
            $('#cartItem-' + rowID).find('.item-total-price span').html($.number(result['subtotal'], 2, '.', ','));
            $('#cartItem-' + rowID).find('.item-set-quantity').val(result['qty']);

            $.updateItemSelected();
          }
        }
      });
    }

    $('.item-remove-selected').on('click', function() {
      $('#modalremoveSelected').modal('show');
    });

    $('.remove-selected-btn').on('click', function() {
      $.ajax({
        url: '<?php echo site_url('cart/ajax/removeCartItems'); ?>',
        type: 'POST',
        data: {
          items: itemSelected
        },
        success: function(result) {
          if (result !== 'false') {
            $('.cart-total-items').html(result['cartTotalItems']);

            $.each(result['removedItems'], function(key, rowID) {
              $('#cartItem-' + rowID).html('');
              $('#cartItem-' + rowID).addClass('d-none');

              itemSelected.splice(itemSelected.indexOf(rowID), 1);
            });

            $.updateItemSelected();
          }
        }
      });
    });

    var rowID = '';

    $('#modalItemRemove').find('.item-remove-btn').on('click', function() {
      $.ajax({
        url: '<?php echo site_url('cart/ajax/removeCartItem'); ?>',
        type: 'POST',
        data: {
          rowID: rowID
        },
        success: function(result) {
          if (result !== 'false') {
            $('.cart-total-items').html(result);

            $('#cartItem-' + rowID).html('');
            $('#cartItem-' + rowID).addClass('d-none');

            itemSelected.splice(itemSelected.indexOf(rowID), 1);
            $.updateItemSelected();

            $('#modalItemRemove').modal('hide');
          }
        }
      });
    });

    $('#modalItemRemove').on('show.bs.modal', function(event) {
      var trigger = $(event.relatedTarget);
      var modal = $(this);

      rowID = trigger.data('remove');

      $.ajax({
        url: '<?php echo site_url('cart/ajax/getCartContents'); ?>',
        type: 'POST',
        data: {
          rowID: rowID
        },
        success: function(result) {
          if (result !== 'false') {
            if (result['thumbnail'] !== '') {
              modal.find('.item-thumbnail').attr('src', result['thumbnail']);
            } else {
              modal.find('.item-thumbnail').removeAttr('src');
            }
            modal.find('.item-name').html(result['name']);
            modal.find('.item-option-text').html(result['option_text']);
          }
        }
      })
    });

    $('.item-total-price span').each(function() {
      var value = $(this).html();
      $(this).html($.number(value, 2, '.', ','));
    });

    $('.item-price-per-set span').each(function() {
      var value = $(this).html();
      $(this).html($.number(value, 2, '.', ','));
    });
  });
</script>
<!--- END Modal Item Remove --->

<script>
  // https://github.com/customd/jquery-number
  !function(e){"use strict";function t(e,t){if(this.createTextRange){var a=this.createTextRange();a.collapse(!0),a.moveStart("character",e),a.moveEnd("character",t-e),a.select()}else this.setSelectionRange&&(this.focus(),this.setSelectionRange(e,t))}function a(e){var t=this.value.length;if(e="start"==e.toLowerCase()?"Start":"End",document.selection){var a,i,n,l=document.selection.createRange();return a=l.duplicate(),a.expand("textedit"),a.setEndPoint("EndToEnd",l),i=a.text.length-l.text.length,n=i+l.text.length,"Start"==e?i:n}return"undefined"!=typeof this["selection"+e]&&(t=this["selection"+e]),t}var i={codes:{46:127,188:44,109:45,190:46,191:47,192:96,220:92,222:39,221:93,219:91,173:45,187:61,186:59,189:45,110:46},shifts:{96:"~",49:"!",50:"@",51:"#",52:"$",53:"%",54:"^",55:"&",56:"*",57:"(",48:")",45:"_",61:"+",91:"{",93:"}",92:"|",59:":",39:'"',44:"<",46:">",47:"?"}};e.fn.number=function(n,l,s,r){r="undefined"==typeof r?",":r,s="undefined"==typeof s?".":s,l="undefined"==typeof l?0:l;var u="\\u"+("0000"+s.charCodeAt(0).toString(16)).slice(-4),h=new RegExp("[^"+u+"0-9]","g"),o=new RegExp(u,"g");return n===!0?this.is("input:text")?this.on({"keydown.format":function(n){var u=e(this),h=u.data("numFormat"),o=n.keyCode?n.keyCode:n.which,c="",v=a.apply(this,["start"]),d=a.apply(this,["end"]),p="",f=!1;if(i.codes.hasOwnProperty(o)&&(o=i.codes[o]),!n.shiftKey&&o>=65&&90>=o?o+=32:!n.shiftKey&&o>=69&&105>=o?o-=48:n.shiftKey&&i.shifts.hasOwnProperty(o)&&(c=i.shifts[o]),""==c&&(c=String.fromCharCode(o)),8!=o&&45!=o&&127!=o&&c!=s&&!c.match(/[0-9]/)){var g=n.keyCode?n.keyCode:n.which;if(46==g||8==g||127==g||9==g||27==g||13==g||(65==g||82==g||80==g||83==g||70==g||72==g||66==g||74==g||84==g||90==g||61==g||173==g||48==g)&&(n.ctrlKey||n.metaKey)===!0||(86==g||67==g||88==g)&&(n.ctrlKey||n.metaKey)===!0||g>=35&&39>=g||g>=112&&123>=g)return;return n.preventDefault(),!1}if(0==v&&d==this.value.length?8==o?(v=d=1,this.value="",h.init=l>0?-1:0,h.c=l>0?-(l+1):0,t.apply(this,[0,0])):c==s?(v=d=1,this.value="0"+s+new Array(l+1).join("0"),h.init=l>0?1:0,h.c=l>0?-(l+1):0):45==o?(v=d=2,this.value="-0"+s+new Array(l+1).join("0"),h.init=l>0?1:0,h.c=l>0?-(l+1):0,t.apply(this,[2,2])):(h.init=l>0?-1:0,h.c=l>0?-l:0):h.c=d-this.value.length,h.isPartialSelection=v==d?!1:!0,l>0&&c==s&&v==this.value.length-l-1)h.c++,h.init=Math.max(0,h.init),n.preventDefault(),f=this.value.length+h.c;else if(45!=o||0==v&&0!=this.value.indexOf("-"))if(c==s)h.init=Math.max(0,h.init),n.preventDefault();else if(l>0&&127==o&&v==this.value.length-l-1)n.preventDefault();else if(l>0&&8==o&&v==this.value.length-l)n.preventDefault(),h.c--,f=this.value.length+h.c;else if(l>0&&127==o&&v>this.value.length-l-1){if(""===this.value)return;"0"!=this.value.slice(v,v+1)&&(p=this.value.slice(0,v)+"0"+this.value.slice(v+1),u.val(p)),n.preventDefault(),f=this.value.length+h.c}else if(l>0&&8==o&&v>this.value.length-l){if(""===this.value)return;"0"!=this.value.slice(v-1,v)&&(p=this.value.slice(0,v-1)+"0"+this.value.slice(v),u.val(p)),n.preventDefault(),h.c--,f=this.value.length+h.c}else 127==o&&this.value.slice(v,v+1)==r?n.preventDefault():8==o&&this.value.slice(v-1,v)==r?(n.preventDefault(),h.c--,f=this.value.length+h.c):l>0&&v==d&&this.value.length>l+1&&v>this.value.length-l-1&&isFinite(+c)&&!n.metaKey&&!n.ctrlKey&&!n.altKey&&1===c.length&&(p=d===this.value.length?this.value.slice(0,v-1):this.value.slice(0,v)+this.value.slice(v+1),this.value=p,f=v);else n.preventDefault();f!==!1&&t.apply(this,[f,f]),u.data("numFormat",h)},"keyup.format":function(i){var n,s=e(this),r=s.data("numFormat"),u=i.keyCode?i.keyCode:i.which,h=a.apply(this,["start"]),o=a.apply(this,["end"]);0!==h||0!==o||189!==u&&109!==u||(s.val("-"+s.val()),h=1,r.c=1-this.value.length,r.init=1,s.data("numFormat",r),n=this.value.length+r.c,t.apply(this,[n,n])),""===this.value||(48>u||u>57)&&(96>u||u>105)&&8!==u&&46!==u&&110!==u||(s.val(s.val()),l>0&&(r.init<1?(h=this.value.length-l-(r.init<0?1:0),r.c=h-this.value.length,r.init=1,s.data("numFormat",r)):h>this.value.length-l&&8!=u&&(r.c++,s.data("numFormat",r))),46!=u||r.isPartialSelection||(r.c++,s.data("numFormat",r)),n=this.value.length+r.c,t.apply(this,[n,n]))},"paste.format":function(t){var a=e(this),i=t.originalEvent,n=null;return window.clipboardData&&window.clipboardData.getData?n=window.clipboardData.getData("Text"):i.clipboardData&&i.clipboardData.getData&&(n=i.clipboardData.getData("text/plain")),a.val(n),t.preventDefault(),!1}}).each(function(){var t=e(this).data("numFormat",{c:-(l+1),decimals:l,thousands_sep:r,dec_point:s,regex_dec_num:h,regex_dec:o,init:this.value.indexOf(".")?!0:!1});""!==this.value&&t.val(t.val())}):this.each(function(){var t=e(this),a=+t.text().replace(h,"").replace(o,".");t.number(isFinite(a)?+a:0,l,s,r)}):this.text(e.number.apply(window,arguments))};var n=null,l=null;e.isPlainObject(e.valHooks.text)?(e.isFunction(e.valHooks.text.get)&&(n=e.valHooks.text.get),e.isFunction(e.valHooks.text.set)&&(l=e.valHooks.text.set)):e.valHooks.text={},e.valHooks.text.get=function(t){var a,i=e(t),l=i.data("numFormat");return l?""===t.value?"":(a=+t.value.replace(l.regex_dec_num,"").replace(l.regex_dec,"."),(0===t.value.indexOf("-")?"-":"")+(isFinite(a)?a:0)):e.isFunction(n)?n(t):void 0},e.valHooks.text.set=function(t,a){var i=e(t),n=i.data("numFormat");if(n){var s=e.number(a,n.decimals,n.dec_point,n.thousands_sep);return e.isFunction(l)?l(t,s):t.value=s}return e.isFunction(l)?l(t,a):void 0},e.number=function(e,t,a,i){i="undefined"==typeof i?"1000"!==new Number(1e3).toLocaleString()?new Number(1e3).toLocaleString().charAt(1):"":i,a="undefined"==typeof a?new Number(.1).toLocaleString().charAt(1):a,t=isFinite(+t)?Math.abs(t):0;var n="\\u"+("0000"+a.charCodeAt(0).toString(16)).slice(-4),l="\\u"+("0000"+i.charCodeAt(0).toString(16)).slice(-4);e=(e+"").replace(".",a).replace(new RegExp(l,"g"),"").replace(new RegExp(n,"g"),".").replace(new RegExp("[^0-9+-Ee.]","g"),"");var s=isFinite(+e)?+e:0,r="",u=function(e,t){return""+ +(Math.round((""+e).indexOf("e")>0?e:e+"e+"+t)+"e-"+t)};return r=(t?u(s,t):""+Math.round(s)).split("."),r[0].length>3&&(r[0]=r[0].replace(/\B(?=(?:\d{3})+(?!\d))/g,i)),(r[1]||"").length<t&&(r[1]=r[1]||"",r[1]+=new Array(t-r[1].length+1).join("0")),r.join(a)}}(jQuery);
//# sourceMappingURL=jquery.number.min.js.map
</script>
