<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--- Section Content --->
<main class="section-content">
  <div class="container py-5">
    <!--- Content --->
    <?php echo form_open(site_url('user/sign-up')); ?>
      <div class="card-group w-100 justify-content-center ">
        <div class="card col-sm-10 p-0 shadow">
          <div class="card-body m-3">
            <h5 class="card-title">Join PrintingLab.my</h5>
            <?php if ( ! empty( $this->aauth->get_errors_array() )) : ?>
              <p class="card-text text-danger"><small><?php echo $this->aauth->print_errors(); ?></small></p>
            <?php endif; ?>
            <div class="form-group">
              <label for="plabSignupUsername"><small>Username</small></label>
              <input type="text" class="form-control" id="plabSignupUsername" name="plabSignupUsername" aria-describedby="usernameHelp" placeholder="Please enter your username">
              <small id="usernameHelp" class="form-text text-muted">Minimum 5 characters with letter(s) and number(s) only.</small>
            </div>
            <div class="form-group">
              <label for="plabSignupPassword"><small>Password</small></label>
              <input type="password" class="form-control" id="plabSignupPassword" name="plabSignupPassword" placeholder="Please enter your password">
            </div>
            <div class="form-group">
              <label for="plabSignupEmail"><small>Email Address</small></label>
              <input type="email" class="form-control" id="plabSignupEmail" name="plabSignupEmail" aria-describedby="emailHelp" placeholder="And of course, your email address">
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="plabSignupSubscribe" name="plabSignupSubscribe" checked>
              <label class="custom-control-label" for="plabSignupSubscribe">
                <small>I want to receive educational newsletter and exclusive offers from PrintingLab.my.</small>
              </label>
            </div>
          </div>
        </div>
        <div class="card col-sm-8 p-0 shadow">
          <div class="card-body m-3">
            <input type="submit" class="btn btn-block btn-primary mb-3" name="plabUserSignup" value="Sign Up Now">
            <p class="card-text">
              <small>
                By clicking "SIGN UP", I agree to PrintingLab.my
                <a href="http://support.printinglab.my/p/2-privacy-policy" target="_blank" class="color-orange">Privacy Policy</a> and
                <a href="http://support.printinglab.my/p/1-terms-of-services" target="_blank" class="color-orange">Terms & Conditions</a>.
              </small>
            </p>
            <p class="card-text"><small>Or signup with</small></p>
            <div class="social-login">
              <button type="button" class="btn btn-block mb-3 bg-gradient bg-facebook text-white" data-toggle="tooltip" data-placement="right" title="This function has been disabled.">Facebook</button>
              <button type="button" class="btn btn-block bg-gradient bg-google text-white" data-toggle="tooltip" data-placement="right" title="This function has been disabled.">Google</button>
            </div>
          </div>
          <div class="card-footer px-5 pb-4">
            <p class="card-text"><small>Already have an account?</small></p>
            <a class="btn btn-block btn-gradient btn-outline-primary" href="<?php echo site_url('user/login'); ?>">Proceed to Login Page</a>
          </div>
        </div>
      </div>
    </form>
    <!--- END Content --->
  </div>
</main><!--- END Section Content --->
