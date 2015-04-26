<div id="register-form">
    <div id="main">
        <div id="bg">
            <img src="<?php echo site_url('assets/images/fullscreen.jpg'); ?>">
        </div>
        <?php echo form_open('sign/verify', 'class="form-horizontal"'); ?>
            <fieldset>
                <div id="control_gen_3" class="outer-wrapper">
                    <div class="inner-wrapper">
                        <form class="form-horizontal">
                          <div class="form-group">
                            <label for="act_code" class="col-sm-4 control-label"><?php echo $this->lang->line('act_code'); ?></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control ltr" id="act_code" name="act_code" placeholder="1234">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                              <button type="submit" class="btn btn-success"><?php echo $this->lang->line('act_number'); ?></button>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>
