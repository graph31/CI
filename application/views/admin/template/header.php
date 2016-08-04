<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ThaiCinderalla Admin</title>
    <link rel="shortcut icon" href="<?php echo base_url();?>theme-admin/img/thai.ico" />

    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/css/foundation.css" />

    <!-- Custom styles for this template -->

    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/css/dashboard.css">
    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/css/dripicon.css">
    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/css/typicons.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/css/theme.css">

    <link href="http://cdn.datatables.net/1.10.5/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url();?>theme-admin/js/footable/css/footable.core.css?v=2-0-1" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>theme-admin/js/footable/css/footable.standalone.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>theme-admin/js/footable/css/footable-demos.css" rel="stylesheet" type="text/css" />

    <link rel="<?php echo base_url();?>theme-admin/stylesheet" href="js/tip/tooltipster.css">

    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/js/chartist/chartist.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>theme-admin/js/vegas/jquery.vegas.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>theme-admin/js/range-slider/jquery.range2dslider.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>theme-admin/js/number-progress-bar/number-pb.css">


    <!-- pace loader -->
    <script src="<?php echo base_url();?>theme-admin/js/pace/pace.js"></script>
    <link href="<?php echo base_url();?>theme-admin/js/pace/themes/orange/pace-theme-flash.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/js/slicknav/slicknav.css" />



    <script src="<?php echo base_url();?>theme-admin/js/vendor/modernizr.js"></script>



</head>

<body>
    <!-- preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- End of preloader -->

    <div class="off-canvas-wrap" data-offcanvas>
        <!-- right sidebar wrapper -->
        <div class="inner-wrap">


            <!-- Right sidemenu -->
            <div id="skin-select">
                <!--      Toggle sidemenu icon button -->
                <a id="toggle">
                    <span class="fa icon-menu"></span>
                </a>
                <!--      End of Toggle sidemenu icon button -->

                <div class="skin-part">
                    <div id="tree-wrap">
                        <!-- Profile -->
                        <div align="center" >
                            <img style="height: 50px;margin-bottom: 30px;"  alt="" class="" src="<?php echo base_url();?>theme-admin/img/logo-admin.png">
                            

                        </div>
                        <!-- End of Profile -->

                        <?php $this->load->view("admin/template/menu");?>
                        <ul class="bottom-list-menu">
                            <li>Settings <span class="icon-gear"></span>
                            </li>
                            <li>Help <span class="icon-phone"></span>
                            </li>
                            <li>About Edumix <span class="icon-music"></span>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- end of Rightsidemenu -->



            <div class="wrap-fluid" id="paper-bg">
            
            <?php $this->load->view("admin/template/header_menu"); ?>
                <!-- end of top nav -->



                <!-- alert success -->
<?php 
    if($this->uri->segment(5)=="success"){
?>              
    <div class="box bg-light-green">
        <div class="box-header bg-light-green ">
            <!-- tools box -->
            <div class="pull-right box-tools">
                <span class="box-btn" data-widget="remove"><i class="icon-cross"></i>
</span>
            </div>
            <h3 class="box-title "><i class="text-white  icon-thumbs-up"></i>
<span class="text-white">SAVE SUCCESS</span>
</h3>
        </div>
    </div>
<?php } ?>