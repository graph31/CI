<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin ThaiCinderellar</title>

    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/css/foundation.css" />
    <link rel="shortcut icon" href="<?php echo base_url();?>theme-admin/img/thai.ico" />

    <!-- Custom styles for this template -->

    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/css/dashboard.css">
    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/css/dripicon.css">
    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/css/typicons.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url();?>theme-admin/css/login.css">

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
    <!-- right sidebar wrapper -->

    <div class="inner-wrap">
        <div class="wrap-fluid">
            <br>
            <br>
            <!-- Container Begin -->
            <div class="large-offset-4 large-4 columns">
                <div class="box bg-white">
                    <!-- Profile -->
                    <div class="profile">
                        <img alt="" class="" src="<?php echo base_url();?>theme-admin/img/logo-admin.png">
                        <h3>Thai Cinderella</h3>

                    </div>
                    <!-- End of Profile -->

                    <!-- /.box-header -->
                    
                    <div class="box-body " style="display: block;">
                        <div class="row">

                            <div class="large-12 columns">
                                <div class="row">
                                    <div class="edumix-signup-panel">
                                        <p class="welcome"> Welcome to Admin ThaiCinderella</p>
                                        <?php echo validation_errors(); ?>
                                        <?php echo form_open('verifylogin'); ?>
                                            <div class="row collapse">
                                                <div class="small-2  columns">
                                                    <span class="prefix bg-green"><i class="text-white icon-user"></i></span>
                                                </div>
                                                <div class="small-10  columns">
                                                    <input type="text" placeholder="Username" name="username" id="username">
                                                </div>
                                            </div>
                                            <div class="row collapse">
                                                <div class="small-2 columns ">
                                                    <span class="prefix bg-green"><i class="text-white icon-lock"></i></span>
                                                </div>
                                                <div class="small-10 columns ">
                                                    <input type="text" placeholder="Password" name="password" id="password">
                                                </div>
                                            </div>

                                        
                                        </p>
                                        <input type="submit" value="Login">
                                        </form>
                                        <!-- <a href="index.html" class="bg-green"><span>Sign in</span> </a> -->
                                        <br>
                                    </div>
                                </div>


                            </div>



                        </div>


                    </div>
                    <!-- end .timeline -->
                </div>
                <!-- box -->
            </div>
        </div>
        <!-- End of Container Begin -->
    </div>

    <!-- end paper bg -->



    <!-- end of inner-wrap -->



    <!-- main javascript library -->
    <script type='text/javascript' src="<?php echo base_url();?>theme-admin/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>theme-admin/js/waypoints.min.js"></script>
    <script type='text/javascript' src='<?php echo base_url();?>theme-admin/js/preloader-script.js'></script>
    <!-- foundation javascript -->
    <script type='text/javascript' src="<?php echo base_url();?>theme-admin/js/foundation.min.js"></script>
    <script type='text/javascript' src="<?php echo base_url();?>theme-admin/js/foundation/foundation.dropdown.js"></script>
    <!-- main edumix javascript -->
    <script type='text/javascript' src='<?php echo base_url();?>theme-admin/js/slimscroll/jquery.slimscroll.js'></script>
    <script type='text/javascript' src='<?php echo base_url();?>theme-admin/js/slicknav/jquery.slicknav.js'></script>
    <script type='text/javascript' src='<?php echo base_url();?>theme-admin/js/sliding-menu.js'></script>
    <script type='text/javascript' src='<?php echo base_url();?>theme-admin/js/scriptbreaker-multiple-accordion-1.js'></script>
    <script type="text/javascript" src="<?php echo base_url();?>theme-admin/js/number/jquery.counterup.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>theme-admin/js/circle-progress/jquery.circliful.js"></script>
    <script type='text/javascript' src='<?php echo base_url();?>theme-admin/js/app.js'></script>
    <!-- additional javascript -->



    <script>
    $(document).foundation();
    </script>



</body>

</html>
