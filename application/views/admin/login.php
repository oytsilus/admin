<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title;?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets');?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets');?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets');?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets');?>/build/css/custom.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <?php
			if( ! isset( $on_hold_message ) )
			{
				if( isset( $login_error_mesg ) )
				{
					echo '
						<div style="border:1px solid red; padding:10px;">
							<p>
								Login Error #' . $this->authentication->login_errors_count . '/' . config_item('max_allowed_attempts') . ': Invalid Username, Email Address, or Password.
							</p>
							<p>
								Username, email address and password are all case sensitive.
							</p>
						</div>
					';
				}

				if( $this->input->get('logout') )
				{
					echo '
						<div style="border:1px solid green; padding:10px;">
							<p>
								You have successfully logged out.
							</p>
						</div>
					';
				}

				echo form_open( $login_url, ['class' => 'std-form'] ); 
			?>
			<!--<form action="<?php echo base_url();?>login?redirect=home" class="std-form" method="post" accept-charset="utf-8">-->
              <h1>Login Form</h1>
              <div>
                <input type="text" name="login_string" id="login_string" class="form_input form-control" autocomplete="off" maxlength="255" placeholder="Username" required />
              </div>
              <div>
                <input type="password" name="login_pass" id="login_pass" class="form-control form_input password" maxlength="<?php echo config_item('max_chars_for_password'); ?>" autocomplete="off" readonly="readonly" onfocus="this.removeAttribute('readonly');" placeholder="Password" required />
              </div>
              <div>
				<input type="submit" class="btn btn-default submit" name="submit" value="Login" id="submit_button" />
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <p>&copy; 2016 All Rights Reserved.</p>
                </div>
              </div>
            </form>
			<?php
			}
			else
			{
				// EXCESSIVE LOGIN ATTEMPTS ERROR MESSAGE
				echo '
					<div style="border:1px solid red; padding:10px;">
						<p>
							Excessive Login Attempts
						</p>
						<p>
							You have exceeded the maximum number of failed login<br />
							attempts that this website will allow.
						<p>
						<p>
							Your access to login and account recovery has been blocked for ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes.
						</p>
						<p>
							Please use the <a href="/examples/recover">Account Recovery</a> after ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes has passed,<br />
							or contact us if you require assistance gaining access to your account.
						</p>
					</div>
				';
			}
			?>
          </section>
        </div>

      </div>
    </div>
  </body>
</html>