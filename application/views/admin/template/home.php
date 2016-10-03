<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $site_title.' - '.$page_title; ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets'); ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets'); ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets'); ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('assets'); ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url('assets'); ?>/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url('assets'); ?>/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>

    <?php
    if (isset($css_scripts)) {
        foreach ($css_scripts as $css) {
            ?>
    	<link href="<?=site_url('assets/'.$css.'.css'); ?>" rel="stylesheet" type="text/css" />
    <?php

        } //endforeach
    } //endif
    ?>

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets'); ?>/build/css/custom.css" rel="stylesheet">

	<!-- Bootstrap Toggle Style -->
	<link href="<?php echo base_url('assets'); ?>/vendors/bootstrap-toggle/css/bootstrap-toggle.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-envira"></i> <span><?php echo $site_title; ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile no-print">
              <div class="profile_pic">
                <img src="<?php echo base_url('assets')?>/images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo !empty($this->auth_role) ? $this->auth_username : null?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>MAIN MENU</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                    </ul>
                  </li>
				  <li><a><i class="fa fa-edit"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a>Supplier<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="<?php echo base_url('m_supplier'); ?>">Daftar Supplier</a>
                            </li>
                            <li><a href="<?php echo base_url('m_supplier/create'); ?>">Tambah Supplier Baru</a>
                            </li>
                          </ul>
                        </li>
						<li><a>Customer<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="<?php echo base_url('m_customer'); ?>">Daftar Customer</a>
                            </li>
                            <li><a href="<?php echo base_url('m_customer/create'); ?>">Tambah Customer Baru</a>
                            </li>
                          </ul>
                        </li>
						<li><a>Unit<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="<?php echo base_url('m_unit'); ?>">Daftar Unit</a>
                            </li>
                            <li><a href="<?php echo base_url('m_unit/create'); ?>">Tambah Unit Baru</a>
                            </li>
                          </ul>
                        </li>
						<li><a>Item<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="<?php echo base_url('m_product'); ?>">Daftar Item</a>
                            </li>
                            <li><a href="<?php echo base_url('m_product/create'); ?>">Tambah Item Baru</a>
                            </li>
                          </ul>
                        </li>
						<li><a>Harga<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('m_price'); ?>">Daftar Harga</a>
                            </li>
							<li class="sub_menu"><a href="<?php echo base_url('m_price/create'); ?>">Set Harga</a>
                            </li>
                          </ul>
                        </li>
                    </ul>
                  </li>
				  <li><a><i class="fa fa-money"></i>Pembelian <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a>Purchase Order<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="<?php echo base_url('purchase_order'); ?>">Daftar PO</a>
                            </li>
                            <li><a href="<?php echo base_url('purchase_order/create'); ?>">Buat PO Baru</a>
                            </li>
                          </ul>
					  </li>
					  <li><a>Penerimaan Barang	<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="<?php echo base_url('receiving'); ?>">Daftar Terima Barang</a>
                            </li>
                            <li><a href="<?php echo base_url('receiving/create'); ?>">Buat Penerimaan Baru</a>
                            </li>
                          </ul>
					  </li>
					  <li><a>Pembayaran<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="<?php echo base_url('purchase_payment'); ?>">Daftar Pembayaran</a>
                            </li>
                            <li><a href="<?php echo base_url('purchase_payment/create'); ?>">Buat Pembayaran</a>
                            </li>
                          </ul>
					  </li>
                    </ul>
                  </li>
				  <li><a><i class="fa fa-money"></i>Penjualan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a>Sales Order<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="<?php echo base_url('order'); ?>">Daftar Order</a>
                            </li>
                            <li><a href="<?php echo base_url('order/create'); ?>">Buat Order Baru</a>
                            </li>
                          </ul>
					  </li>
					  <li><a>Pengiriman Barang	<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="<?php echo base_url('delivery'); ?>">Daftar Pengiriman</a>
                            </li>
                            <li><a href="<?php echo base_url('delivery/create'); ?>">Buat Pengiriman Baru</a>
                            </li>
                          </ul>
					  </li>
					  <li><a>Pembayaran<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="<?php echo base_url('order_payment'); ?>">Daftar Pembayaran</a>
                            </li>
                            <li><a href="<?php echo base_url('order_payment/create'); ?>">Buat Pembayaran</a>
                            </li>
                          </ul>
					  </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-file-o"></i> Report <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?php echo base_url('receiving/report_delivery'); ?>">R.Pembelian /Supplier</a></li>
	                      <li><a href="<?php echo base_url('delivery/report_delivery'); ?>">R.Penjualan /Customer</a></li>
                        <li><a href="<?php echo base_url('report/laba_rugi'); ?>">Laba Rugi</a></li>
                    </ul>
                  </li>
		              <li><a><i class="fa fa-users"></i> User <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?php echo base_url('users'); ?>">Daftar User</a></li>
	                      <li><a href="<?php echo base_url('users/create'); ?>">Buat User Baru</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('logout'); ?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav no-print">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url('assets')?>/images/img.jpg" alt=""><?php echo !empty($this->auth_role) ? $this->auth_username : null?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li><a href="<?php echo base_url('logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php $this->load->view($page); ?>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer class="no-print">
          <div class="pull-right">
              <?php echo $site_title; ?> &COPY; 2016
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- Javascripts -->
    <?php
    if (isset($js_scripts)) {
        foreach ($js_scripts as $js) {
            ?>
    	<script src="<?=base_url('assets/'.$js.'.js'); ?>"></script>
    <?php

        } //endforeach
    } //endif
    ?>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('assets'); ?>/build/js/custom.min.js"></script>

    <?php (isset($js_page) ? $this->load->view($js_page) : null); ?>
	<?php (isset($js_page2) ? $this->load->view($js_page2) : null); ?>
  </body>
</html>
