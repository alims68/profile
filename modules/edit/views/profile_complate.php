<?php
	$current_user_id = 2;
?>
<div id="message" class="modal fade up bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
				<h4 id="mySmallModalLabel" class="modal-title">پیغام<a href="#mySmallModalLabel" class="anchorjs-link"><span class="anchorjs-icon"></span></a></h4>
				
			</div>
			<div class="modal-body">
			
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function update()
{

	$('.loading').show();
	$.ajax
    ({
        url: '<?php echo site_url("edit/submit"); ?>',
        type: 'POST',
        dataType:  'json',
        data: $('form').serialize(),
        success: function(data) { 
        	if(data.status == "success")
			{
				$('.loading').fadeOut(750);
				$('#message .modal-body').append('<div class="alert alert-success" role="alert">' + data.errors + '</div>');
				$('#message').modal('show');
			}
			else{
				$('.loading').fadeOut(750);
				$('#message .modal-body').append('<div class="alert alert-danger" role="alert">' + data.errors + '</div>');
				$('#message').modal('show');
			}
        },
        error:  function() { alert("fail"); }
    });
}
$('#message .close').click('closed.bs.alert', function () {
	$('.modal-body').remove();
	$('.modal-content').append('<div class="modal-body"></div>');
})
</script>
<div class="profile-edit" id="register-form">
    <div id="main">
        <div id="bg">
            <img src="../../assets/images/fullscreen.jpg">
        </div>
        <?php echo form_open(site_url("edit/submit"), 'class="form-horizontal"'); ?>
            <fieldset>

                <div id="control_gen_3" class="outer-wrapper">
                    <div class="inner-wrapper">
                        
							<div class="tab" role="tabpanel">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active">
										<a href="#pesonal-info" aria-controls="pesonal-info" role="tab" data-toggle="tab">اطلاعات شخصی</a>
									</li>
									<li role="presentation">
										<a href="#location" aria-controls="location" role="tab" data-toggle="tab">موقعیت</a>
									</li>
									<li role="presentation">
										<a href="#education" aria-controls="education" role="tab" data-toggle="tab">تحصلات</a>
									</li>
									<li role="presentation">
										<a href="#job" aria-controls="job" role="tab" data-toggle="tab">شغل</a>
									</li>
									<li role="presentation">
										<a href="#network" aria-controls="network" role="tab" data-toggle="tab">شبکه اجتماعی</a>
									</li>
									<li role="presentation">
										<a href="#privacy" aria-controls="privacy" role="tab" data-toggle="tab">حریم خصوصی</a>
									</li>
								</ul>
								
								<!-- Tab panes -->
								<div class="tab-content">
										<div role="tabpanel" class="tab-pane active" id="pesonal-info">
											<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
												<div class="form-group">
													<label for="pishvand" class="col-sm-3 control-label">پیشوند</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" id="pishvand" name="pishvand" placeholder="پیشوند" value="<?php if(get_value($current_user_id, 'pishvand')) {echo get_value($current_user_id, 'pishvand');}else{set_value('pishvand');} ?>">
													</div>
													<div class="col-sm-3">
														<label>
															<input name="pishvand_view"  type="checkbox" <?php if(get_value($current_user_id, 'pishvand_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
												<div class="form-group">
													<label for="pasvand" class="col-sm-3 control-label">پسوند</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" id="pasvand" name="pasvand" placeholder="پسوند" value="<?php if(get_value($current_user_id, 'pasvand')) {echo get_value($current_user_id, 'pasvand');}else{set_value('pasvand');} ?>">
													</div>
													<div class="col-sm-3">
														<label>
															<input name="pasvand_view" type="checkbox" <?php if(get_value($current_user_id, 'pasvand_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
											</div>

											<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
												<div class="form-group">
													<label for="nam" class="col-sm-3 control-label">نام</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" id="nam" name="nam" placeholder="نام" value="<?php if(get_value($current_user_id, 'nam')) {echo get_value($current_user_id, 'nam');}else{set_value('nam');} ?>">
													</div>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
												<div class="form-group">
													<label for="family" class="col-sm-3 control-label">نام خانوادگی</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" id="pasvand" name="family" placeholder="نام خانوادگی" value="<?php if(get_value($current_user_id, 'family')) {echo get_value($current_user_id, 'family');}else{set_value('family');} ?>">
													</div>
												</div>
											</div>

											<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
												<div class="form-group">
													<label for="sex" class="col-sm-3 control-label">جنسیت</label>
													<div class="col-sm-6">
														<label for="male" class="radio-inline">
															<input type="radio" name="sex" id="male" value="male"> مذکر
														</label>
															<label for="girl" class="radio-inline">
															<input type="radio" name="sex" id="girl" value="girl"> مونث
														</label>
													</div>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
												<div class="form-group">
													<label class="col-sm-3 control-label">تاهل</label>
													<div class="col-sm-6">
														<label for="single" class="radio-inline">
															<input type="radio" name="taeahol" id="single" value="single"> مجرد
														</label>
															<label for="married" class="radio-inline">
															<input type="radio" name="taeahol" id="married" value="married"> متأهل
														</label>
													</div>
													<div class="col-sm-3">
														<label>
															<input name="taeahol_view" type="checkbox" <?php if(get_value($current_user_id, 'taeahol_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
												<div class="form-group">
													<label class="col-sm-3 control-label">تاریخ تولد</label>
													<div class="col-sm-6">
														<input type="text" class="form-control ltr" id="tavalod_date" name="tavalod_date" placeholder="تا تاریخ" data-MdDateTimePicker="true" data-trigger="click" data-targetselector="#tavalod_date" data-todate="true" data-enabletimepicker="false" data-placement="left" value="<?php if(get_value($current_user_id, 'tavalod_date')) {echo get_value($current_user_id, 'tavalod_date');}else{set_value('tavalod_date');} ?>" />
													</div>
													<div class="col-sm-3">
														<label>
															<input name="tavalod_view" type="checkbox" <?php if(get_value($current_user_id, 'tavalod_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
												<div class="form-group">
													<label class="col-sm-3 control-label">توضیحات</label>
													<div class="col-sm-9">
														<textarea class="form-control" name="note"><?php if(get_value($current_user_id, 'note')) {echo get_value($current_user_id, 'note');} ?></textarea>
													</div>
												</div>
											</div>
										</div>
										<script type="text/javascript">

											function select_city(ostan_id, city_select ) 
											{
												$(".loading").show();
												var domain = "<?php echo site_url('ajax/city/index') ?>/";
												var url = domain + ostan_id + '/' + city_select;
												$("#city").load(url, function() {
												  $(".loading").fadeOut(750);
												});
											}
										</script>
										<?php
										$ostan = (int) get_value($current_user_id, 'ostan');
										$city = (int) get_value($current_user_id, 'city');
										if($ostan) :
										?>
										<script type="text/javascript">
											$(document).ready(function() {
												select_city(<?php echo $ostan; ?>, <?php echo $city; ?>); 											
											});
										</script>
										<?php endif; ?>
										
										<div role="tabpanel" class="tab-pane" id="location">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
												<div class="form-group">
													<label for="state" class="col-sm-2 control-label">استان</label>
													<div class="col-sm-4">
														<?php ostan(get_value($current_user_id, 'ostan')); ?>
													</div>
													<div class="col-sm-3">
														<label>
															<input name="ostan_view" type="checkbox" <?php if(get_value($current_user_id, 'ostan_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
												<div class="form-group">
													<label for="city" class="col-sm-2 control-label">شهر</label>
													<div class="col-sm-4">
														<select name="city" id="city" class="select2me form-control" ></select>
													</div>
													<div class="col-sm-3">
														<label>
															<input name="city_view" type="checkbox" <?php if(get_value($current_user_id, 'city_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="education">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
												<div class="form-group">
													<label for="maghta" class="col-sm-2 control-label">مقطع</label>
													<div class="col-sm-4">
														<select id="maghta" class="form-control" name="maghta">
															<option <?php if(get_value($current_user_id, 'maghta') == "راهنمایی") {echo 'selected="selected"';} ?> value="راهنمایی">راهنمایی</option>
															<option <?php if(get_value($current_user_id, 'maghta') == "دبیرستان") {echo 'selected="selected"';} ?> value="دبیرستان">دبیرستان</option>
															<option <?php if(get_value($current_user_id, 'maghta') == "پیش دانشگاهی") {echo 'selected="selected"';} ?> value="پیش دانشگاهی">پیش دانشگاهی</option>
															<option <?php if(get_value($current_user_id, 'maghta') == "کاردانی") {echo 'selected="selected"';} ?> value="کاردانی">کاردانی</option>
															<option <?php if(get_value($current_user_id, 'maghta') == "کارشناسی") {echo 'selected="selected"';} ?> value="کارشناسی">کارشناسی</option>
															<option <?php if(get_value($current_user_id, 'maghta') == "کارشناسی ارشد") {echo 'selected="selected"';} ?> value="کارشناسی ارشد">کارشناسی ارشد</option>
															<option <?php if(get_value($current_user_id, 'maghta') == "دکترا") {echo 'selected="selected"';} ?> value="دکترا">دکترا</option>
														</select>
													</div>
													<div class="col-sm-3">
														<label>
															<input name="maghta_view" type="checkbox" <?php if(get_value($current_user_id, 'maghta_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
												<div class="form-group">
													<label for="maghta_from_date" class="col-sm-2 control-label">تاریخ شروع</label>
													<div class="col-sm-4">
														<input type="text" class="form-control ltr" id="maghta_from_date" name="maghta_from_date" placeholder="تا تاریخ" data-MdDateTimePicker="true" data-trigger="click" data-targetselector="#maghta_from_date" data-groupid="group1" data-todate="true" data-enabletimepicker="false" data-placement="left" value="<?php if(get_value($current_user_id, 'maghta_from_date')) {echo get_value($current_user_id, 'maghta_from_date');}else{set_value('maghta_from_date');} ?>" />
													</div>
													<div class="col-sm-3">
														<label>
															<input name="maghta_from_date_view" type="checkbox" <?php if(get_value($current_user_id, 'maghta_from_date_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
												<div class="form-group">
													<label for="maghta_to_date" class="col-sm-2 control-label">تاریخ پایان</label>
													<div class="col-sm-4">
														<input type="text" class="form-control ltr" id="maghta_to_date" name="maghta_to_date" placeholder="تا تاریخ" data-MdDateTimePicker="true" data-trigger="click" data-targetselector="#maghta_to_date" data-groupid="group1" data-todate="true" data-enabletimepicker="false" data-placement="left" value="<?php if(get_value($current_user_id, 'maghta_to_date')) {echo get_value($current_user_id, 'maghta_to_date');}else{set_value('maghta_to_date');} ?>" />
													</div>
													<div class="col-sm-3">
														<label>
															<input name="maghta_to_date_view" type="checkbox" <?php if(get_value($current_user_id, 'maghta_to_date_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="job">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
												<div class="form-group">
													<label for="job_name" class="col-sm-2 control-label">نام شغل</label>
													<div class="col-sm-4">
														<input type="text" class="form-control" id="job_name" name="job_name" placeholder="نام شغل" value="<?php if(get_value($current_user_id, 'job_name')) {echo get_value($current_user_id, 'job_name');}else{set_value('job_name');} ?>" />
													</div>
													<div class="col-sm-3">
														<label>
															<input name="job_name_view" type="checkbox" <?php if(get_value($current_user_id, 'job_name_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
												<div class="form-group">
													<label for="company_name" class="col-sm-2 control-label">نام شرکت / ارگان</label>
													<div class="col-sm-4">
														<input type="text" class="form-control" id="company_name" name="company_name" placeholder="نام شرکت / ارگان" value="<?php if(get_value($current_user_id, 'company_name')) {echo get_value($current_user_id, 'company_name');}else{set_value('company_name');} ?>" />
													</div>
													<div class="col-sm-3">
														<label>
															<input name="company_name_view" type="checkbox" <?php if(get_value($current_user_id, 'company_name_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
												<div class="form-group">
													<label for="semat" class="col-sm-2 control-label">سمت</label>
													<div class="col-sm-4">
														<input type="text" class="form-control" id="semat" name="semat" placeholder="سمت" value="<?php if(get_value($current_user_id, 'semat')) {echo get_value($current_user_id, 'semat');}else{set_value('semat');} ?>" />
													</div>
													<div class="col-sm-3">
														<label>
															<input name="semat_view" type="checkbox" <?php if(get_value($current_user_id, 'semat_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
												<div class="form-group">
													<label for="job_from_date" class="col-sm-2 control-label">تاریخ شروع</label>
													<div class="col-sm-4">
														<input type="text" class="form-control ltr" id="job_from_date" name="job_from_date" placeholder="تا تاریخ" data-MdDateTimePicker="true" data-trigger="click" data-targetselector="#job_from_date" data-groupid="group1" data-todate="true" data-enabletimepicker="false" data-placement="left" value="<?php if(get_value($current_user_id, 'job_from_date')) {echo get_value($current_user_id, 'job_from_date');}else{set_value('job_from_date');} ?>" />
													</div>
													<div class="col-sm-3">
														<label>
															<input name="job_from_date_view" type="checkbox" <?php if(get_value($current_user_id, 'job_from_date_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
												<div class="form-group">
													<label for="job_to_date" class="col-sm-2 control-label">تاریخ پایان</label>
													<div class="col-sm-4">
														<input type="text" class="form-control ltr" id="job_to_date" name="job_to_date" placeholder="تا تاریخ" data-MdDateTimePicker="true" data-trigger="click" data-targetselector="#job_to_date" data-groupid="group1" data-todate="true" data-enabletimepicker="false" data-placement="left" value="<?php if(get_value($current_user_id, 'job_to_date')) {echo get_value($current_user_id, 'job_to_date');}else{set_value('job_to_date');} ?>" />
													</div>
													<div class="col-sm-3">
														<label>
															<input name="job_to_date_view" type="checkbox" <?php if(get_value($current_user_id, 'job_to_date_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="network">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
												<div class="form-group">
													<div class="col-sm-6">
														<select class="form-control" id="network-select" name="network">
															<option value="facebook">facebook</option>
															<option value="twitter">twitter</option>
														</select>
													</div>
													<div class="col-sm-1">
														<button onclick="add()" type="button" class="btn btn-default">
															<span class="fa fa-plus" aria-hidden="true"> </span> افزودن
														</button>
													</div>
												</div>
												<?php 
												$facebooks = unserialize(get_value($current_user_id, 'facebook'));
												foreach ($facebooks as $value):
												?>
												<div class="form-group">
													<label class="col-sm-2 control-label">facebook</label>
													<div class="col-sm-6">
														<input type="text" placeholder="facebook" name="facebook[]" class="form-control ltr" value="<?php echo $value; ?>">
													</div>
												</div>
												<?php endforeach; ?>
												<?php 
												$twitter = unserialize(get_value($current_user_id, 'twitter'));
												foreach ($twitter as $value):
												?>
												<div class="form-group">
													<label class="col-sm-2 control-label">twitter</label>
													<div class="col-sm-6">
														<input type="text" placeholder="twitter" name="twitter[]" class="form-control ltr" value="<?php echo $value; ?>">
													</div>
												</div>
												<?php endforeach; ?>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="privacy">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
												<div class="form-group">
													<label for="email" class="col-sm-2 control-label">ایمیل</label>
													<div class="col-sm-5">
														<input type="text" class="form-control ltr" id="email" name="email" placeholder="ایمیل" value="<?php if(get_value($current_user_id, 'email')) {echo get_value($current_user_id, 'email');}else{set_value('email');} ?>" />
													</div>
													<div class="col-sm-3">
														<label>
															<input name="email_view" type="checkbox" <?php if(get_value($current_user_id, 'email_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
												<div class="form-group">
													<label for="site" class="col-sm-2 control-label">سایت</label>
													<div class="col-sm-5">
														<input type="text" class="form-control ltr" id="site" name="site" placeholder="سایت" value="<?php if(get_value($current_user_id, 'site')) {echo get_value($current_user_id, 'site');}else{set_value('site');} ?>" />
													</div>
													<div class="col-sm-3">
														<label>
															<input name="site_view" type="checkbox" <?php if(get_value($current_user_id, 'site_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
												<div class="form-group">
													<label for="tel" class="col-sm-2 control-label">شماره تماس</label>
													<div class="col-sm-5">
														<input type="text" class="form-control ltr" id="tel" name="tel" placeholder="شماره تماس" value="<?php if(get_value($current_user_id, 'tel')) {echo get_value($current_user_id, 'tel');}else{set_value('tel');} ?>" />
													</div>
													<div class="col-sm-3">
														<label>
															<input name="tel_view" type="checkbox" <?php if(get_value($current_user_id, 'tel_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
												<div class="form-group">
													<label for="mobile" class="col-sm-2 control-label">شماره موبایل</label>
													<div class="col-sm-5">
														<input type="text" class="form-control ltr" id="mobile" name="mobile" placeholder="شماره موبایل" value="<?php if(get_value($current_user_id, 'mobile')) {echo get_value($current_user_id, 'mobile');}else{set_value('mobile');} ?>" />
													</div>
													<div class="col-sm-3">
														<label>
															<input name="mobile_view" type="checkbox" <?php if(get_value($current_user_id, 'mobile_view') == "on") {echo 'checked="checked"';} ?> /> مخفی
														</label>
													</div>
												</div>
												
												<hr />
												<div class="form-group">
													<label for="current_password" class="col-sm-2 control-label">کلمه عبور فعلی</label>
													<div class="col-sm-5">
														<input type="password" class="form-control ltr" id="current_password" name="current_password" placeholder="کلمه عبور فعلی">
													</div>
												</div>
												<div class="form-group">
													<label for="new_password" class="col-sm-2 control-label">کلمه عبور جدید</label>
													<div class="col-sm-5">
														<input type="password" class="form-control ltr" id="new_password" name="new_password" placeholder="کلمه عبور جدید">
													</div>
												</div>
											</div>
										</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<span onclick="update()" type="submit" class="btn btn-success btn-xs pull-right" >ذخیره</span> 
									</div>
								</div>

							</div>
                        </form>
                    </div>
                </div>
            </fieldset>
    </div>
</div>