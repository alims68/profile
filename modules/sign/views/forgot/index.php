<div id="register-form">
    <div id="main">
        <div id="bg">
            <img src="<?php echo site_url('assets/images/fullscreen.jpg'); ?>">
        </div>
        <?php echo form_open('sign/forgot', 'class="form-horizontal"'); ?>
            <fieldset>
                <div id="control_gen_3" class="outer-wrapper">
                    <div class="inner-wrapper">
                        <form class="form-horizontal">
                          <div class="form-group">
                            <label for="login_mobile" class="col-sm-4 control-label"><?php echo $this->lang->line('phone_number'); ?></label>
                            <div class="col-sm-8">
                              <input type="mobile" class="form-control ltr" id="login_mobile" name="login_mobile" placeholder="09120000000">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                              <button type="submit" class="btn btn-success"><?php echo $this->lang->line('getnew_password'); ?></button>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>