	<style type="text/css">
			body { background: none repeat scroll 0% 0% #E9E9E9; }
		</style>
	<div class="container-fluid-full">
		<div class="row-fluid">
			<div class="row-fluid">
				<div class="login-box">
					<h2 style="font-size: 24px;">Register CheckOderNhanh.com</h2>
					<form name="fromlogin" id="form-horizontal" class="form-horizontal" action="" method="post">
						<fieldset>
							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input class="input-large span10" name="username" id="usernames" type="text" placeholder="Họ và Tên"/>
								<label id="warring-username" style="font-size: 10px; color: red;"> Tên đăng nhập không nhỏ hơn 6 kí tự</label>
							</div>
							<div class="input-prepend" title="email">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input class="input-large span10" name="email" id="email" type="email" placeholder="Email Đăng Nhập"/>
								<label id="warring-email" style="font-size: 10px; color: red;"> Email Đã Có hoặc sai kí tự</label>
							</div>
							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="halflings-icon lock"></i></span>
								<input class="input-large span10" name="password" id="passwords" type="password" placeholder="Mật Khẩu"/>
								<label id="warring-password" style="font-size: 10px; color: red;"> Mật Khẩu không nhỏ hơn 8 kí tự</label>
							</div>
							<div class="input-prepend" title="phonenumber">
								<span class="add-on"><i class="halflings-icon phone"></i></span>
								<input class="input-large span10" name="phonenumber" id="phonenumber" type="text" placeholder="Số Điện Thoại"/>
								<label id="warring-phonenumber" style="font-size: 10px; color: red;"> Vui lòng không để trống</label>
							</div>
							<div class="input-prepend" title="address">
								<span class="add-on"><i class="halflings-icon road"></i></span>
								<input class="input-large span10" name="address" id="address" type="text" placeholder="Địa chỉ Liên Hệ"/>
								<label id="warring-address" style="font-size: 10px; color: red;"> Vui lòng không để trống</label>
							</div>
							<label class="remember" for="remember"><a href="<?php echo base_url();?>login"><button id="btlogins" type="button" class="btn btn-primary">BACK</button></a></label>
							<div class="button-login">	
								<button id="btregister" type="button" class="btn btn-primary">ĐĂNG KÍ</button>
								
							</div>
							<div class="clearfix"></div>
					<script type="text/javascript">
						$(document).ready(function() {
							$("#warring-username").hide();
							$("#warring-password").hide();
							$("#usernames" ).blur(function(){
								var users = $("#usernames" ).val();
								if(users.length < 6){
									$("#warring-username").show();
									$("#usernames" ).focus();
								}else{
									$("#passwords" ).focus();
									$("#warring-username").hide();
								}	
							});
							$("#passwords" ).blur(function(){
								var passs = $("#passwords" ).val();
								if(passs.length < 8){
									$("#passwords" ).focus();
									$("#warring-password").show();
								}else {
									$("#btlogin" ).focus();
									$("#warring-password").hide();
								}
							});
							$("#btlogin").click(function(){
								var user = $("#usernames" ).val();
								var passw = $("#passwords" ).val();
								if(user.length ==0 || user.length <6){
									$("#usernames" ).focus();
									$("#warring-username").show();
								}
								else if(passw.length ==0 || passw.length <6){
									$("#passwords" ).focus();
									$("#warring-password").show();
								}
								else{
									$("#warring-username").hide();
									$("#warring-password").hide();
									$.ajax({
										type: "post",
										url: '<?php base_url(); ?>login/CheckLogin',
										data: $("#form-horizontal").serialize(),
										success: function(data){
											if(data = false){
												//window.reload();
											}else{
												  window.location.replace('/admin');
												
											}
											
										},
									});
								}//return false;
								
							});	
						});
						</script>
					</form>
				</hr>
				</div><!--/span-->
				</div><!--/row-->
			</div><!--/.fluid-container-->
	
		</div><!--/fluid-row-->
	</div><!--/fluid-row-->