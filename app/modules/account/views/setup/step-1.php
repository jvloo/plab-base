<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$user = $this->aauth->get_user();
?>
<!--- Section Content --->
<main class="section-content">
  <div class="container py-5">
    <!--- Content --->
    <section class="section-content-dialog">
      <div class="container">
        <?php echo form_open(site_url('account/setup/step-1')); ?>
          <div class="card-group w-100 justify-content-center">
            <div class="card col-sm-7 p-0 shadow">
              <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <img class="card-img-top w-50 mb-3" src="https://image.flaticon.com/icons/svg/1039/1039621.svg">
                <h5 class="card-title color-orange">Welcome, <?php echo ucwords($user->username); ?>.</h5>
                <p class="card-text text-center"><small>Thanks for choosing PrintingLab.MY<br>Before you proceed, here's something<br>we're curious about you.</small></p>
              </div>
            </div>
            <div class="card col-sm-9 p-0 shadow">
              <div class="card-body m-3">
                <div class="form-group">
                  <label for="">
                    Which is your preferred display language?
                    <a href=""><i class="far fa-question-circle" style="margin-left: 5px; font-size: 14px"></i></a>
                    <small class="form-text text-muted">
                      Choose either one.
                    </small>
                  </label>
                  <div class="label-group">
                    <div class="label-input-group">
                      <input class="label-input" type="radio" id="langDisplayEnglish" name="plabLangDisplay" value="english" checked>
                      <label class="label-item flex-column align-items-start" for="langDisplayEnglish">
                        English
                        <small>English</small>
                      </label>
                    </div>
                    <div class="label-input-group">
                      <input class="label-input" type="radio" id="langDisplayMalay" name="plabLangDisplay" value="malay">
                      <label class="label-item flex-column align-items-start" for="langDisplayMalay">
                        Malay
                        <small>Bahasa Malaysia</small>
                      </label>
                    </div>
                    <div class="label-input-group">
                      <input class="label-input" type="radio" id="langDisplayChinese" name="plabLangDisplay" value="chinese">
                      <label class="label-item flex-column align-items-start" for="langDisplayChinese">
                        Chinese
                        <small class="">简体中文</small>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">
                    How about communication language?
                    <a href=""><i class="far fa-question-circle" style="margin-left: 5px; font-size: 14px"></i></a>
                    <small class="form-text text-muted">
                      Choose at least one.
                    </small>
                  </label>
                  <div class="label-group">
                    <div class="label-input-group">
                      <input class="label-input" type="checkbox" id="langCommEnglish" name="plabLangComm[]" value="english" checked>
                      <label class="label-item flex-column align-items-start" for="langCommEnglish">
                        English
                        <small>English</small>
                      </label>
                    </div>
                    <div class="label-input-group">
                      <input class="label-input" type="checkbox" id="langCommMalay" name="plabLangComm[]" value="chinese">
                      <label class="label-item flex-column align-items-start" for="langCommMalay">
                        Malay
                        <small>Bahasa Malaysia</small>
                      </label>
                    </div>
                    <div class="label-input-group">
                      <input class="label-input" type="checkbox" id="langCommChinese" name="plabLangComm[]" value="malay">
                      <label class="label-item flex-column align-items-start" for="langCommChinese">
                        Chinese
                        <small class="">简体中文</small>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer px-5 py-4">
                <input type="submit" class="btn btn-block btn-primary text-white" name="plabAccSetup" value="Proceed to Next Step">
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>
    <!--- END Content --->
  </div>
</div><!--- END Section Content --->
