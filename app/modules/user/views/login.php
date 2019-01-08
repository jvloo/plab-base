<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--- Section Content --->
<main class="section-content">
  <div class="container py-5">
    <!--- Content --->
    <?php echo form_open(site_url('user/login')); ?>
      <div class="card-group w-100 justify-content-center">
        <div class="card col-sm-10 p-0 shadow">
          <div class="card-body m-3">
            <h5 class="card-title">Wait, Security Check!</h5>
            <?php if ( ! empty( $this->aauth->get_errors_array() )) : ?>
              <p class="card-text text-danger"><small><?php echo $this->aauth->print_errors(); ?></small></p>
            <?php else : ?>
              <p class="card-text"><small>You're required to login first before playing around in the lab.</small></p>
            <?php endif; ?>
            <div class="form-group">
              <label for="plabLoginID"><small>Email or Password</small></label>
              <input type="text" class="form-control" id="plabLoginID" name="plabLoginID" placeholder="Please enter your email or username">
            </div>
            <div class="form-group">
              <label for="plabLoginPwd"><small>Password</small></label>
              <input type="password" class="form-control" id="plabLoginPassword" name="plabLoginPassword" placeholder="And your password">
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="plabLoginRemember" name="plabLoginRemember">
                  <label class="custom-control-label" for="plabLoginRemember">
                    <small>Remember me please</small>
                  </label>
                </div>
              </div>
              <div class="col-sm-12 text-right"><a href="<?php echo site_url('user/recovery'); ?>"><small>Forgot password?</small></a></div>
            </div>
          </div>
        </div>
        <div class="card col-sm-8 p-0 shadow">
          <div class="card-body m-3">
            <input type="submit" class="btn btn-block btn-gradient btn-primary mb-3" name="plabUserLogin" value="Login Now">
            <p class="card-text"><small>Or login with</small></p>
            <div class="social-login">
              <button type="button" class="btn btn-block mb-3 text-white bg-gradient bg-facebook" data-toggle="tooltip" data-placement="right" title="This function has been disabled.">Facebook</button>
              <button type="button" class="btn btn-block text-white bg-gradient bg-google" data-toggle="tooltip" data-placement="right" title="This function has been disabled.">Google</button>
            </div>
          </div>
          <div class="card-footer px-5 pb-4">
            <p class="card-text"><small>Haven't get an account yet?</small></p>
            <a class="btn btn-block btn-gradient btn-outline-primary" href="<?php echo site_url('user/sign-up');?>">Proceed to Signup Page</a>
          </div>
        </div>
      </div>
    </form>
    <!--- END Content --->
  </div>
</main><!--- END Section Content --->
