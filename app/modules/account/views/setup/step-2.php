<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!--- Content --->
  <!--- Bootstrap Pincode Input https://github.com/fkranenburg/bootstrap-pincode-input --->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sf-bootstrap-pincode-input@1.5.0/css/bootstrap-pincode-input.css" integrity="sha256-1xoQ1lSED80pcL/uL++dSD2rI92ZdeLeufJS6/Mf36U=" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sf-bootstrap-pincode-input@1.5.0/js/bootstrap-pincode-input.js" integrity="sha256-g6Q0lh1bjJdUq1quAPG2VifDWcEh5oXp3bZ6cqj/Dw4=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $('#plabSecureCode').pincodeInput({
        inputs:6
      });
      $('#plabSecureCode-2').pincodeInput({
        inputs:6
      });
    });
  </script>
  <section class="section-content-dialog py-5">
    <div class="container">
      <?php echo form_open(site_url('account/setup/step-2')); ?>
        <div class="card-group w-100 justify-content-center">
          <div class="card col-sm-7 p-0 shadow">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
              <img class="card-img-top w-50 mb-3" src="https://image.flaticon.com/icons/svg/825/825572.svg">
              <h5 class="card-title color-orange">Account Setup</h5>
              <p class="card-text text-center"><small>Setup your secure code before proceed.</small></p>
            </div>
          </div>
          <div class="card col-sm-12 p-0 shadow">
            <div class="card-body m-3">
              <?php if ( ! empty( $this->aauth->get_errors_array() )) : ?>
                <p class="card-text text-danger"><small><?php echo $this->aauth->print_errors(); ?></small></p>
              <?php endif; ?>
              <div class="row">
                <div class="col-sm-24">
                  <label>
                    Setup your secure code
                    <a href=""><i class="far fa-question-circle" style="margin-left: 5px; font-size: 14px"></i></a>
                  </label>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label><small class="form-text text-muted">Enter Your 6-Digit Secure Code</small></label>
                    <style>
                      .pincode-input-text,
                      .form-control.pincode-input-text {
                        font-size: 12px;
                        padding: 10px 5px;
                        text-align: center;
                      }
                      .pincode-input-text:focus,
                      .form-control.pincode-input-text:focus {
                        box-shadow: inset 0 -1px 0 #ddd;
                        border-color: #EB3833;
                      }
                      .pincode-input-container input.mid:focus,
                      .pincode-input-container input.last:focus {
                        border-left-width: 1px;
                      }
                    </style>
                    <input type="text" class="form-control" id="plabSecureCode" name="plabSecureCode" placeholder="Enter your 6-digit secure code">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label><small class="form-text text-muted">Confirm Your Secure Code</small></label>
                    <input type="text" class="form-control" id="plabSecureCode-2" name="plabSecureCode-2" placeholder="Confirm your secure code">
                  </div>
                </div>
              </div>
              <div class="form-group pt-3 pr-3">
                <label for="">And lastly, how did you find us?</label>
                <select class="form-control" id="plabSurvey-1" name="plabSurvey-1">
                  <option value="" selected>Please select</option>
                  <option value="friend">Friend/Colleague</option>
                  <option value="search">Search Engine</option>
                  <option value="fb">Facebook</option>
                  <option value="ig">Instagram</option>
                  <option value="offline">Event/Article/Newspaper</option>
                  <option value="other">Other (Please specify)</option>
                </select>
                <script>
                  $(document).ready(function() {
                    $('#plabSurvey-1').on('change', function() {
                      if ($(this).val() == 'other') {
                        $('#plabSurvey-1-other').removeClass('d-none');
                      } else {
                        $('#plabSurvey-1-other').addClass('d-none');
                      }
                    });
                  });
                </script>
                <input type="text" class="form-control mt-3 d-none" id="plabSurvey-1-other" name="plabSurvey-1-other" placeholder="Please specify your answer">
              </div>
            </div>
            <div class="card-footer px-5 py-4">
              <div class="row">
                <div class="col-sm-12">
                  <a class="btn btn-block text-white bg-gradient bg-yellow d-none" href="<?php echo site_url('account/profile/setup'); ?>">Setup My Profile</a>
                </div>
                <div class="col-sm-12">
                  <input type="submit" class="btn btn-block btn-primary text-white" name="plabAccSetup" value="Continue Shopping">
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
  <!--- END Content --->
