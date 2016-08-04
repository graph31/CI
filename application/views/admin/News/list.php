<?php $this->load->view("admin/template/header");?>

<!-- breadcrumbs -->
<ul class="breadcrumbs ">
    <li><a href="#"><span class="entypo-home"></span></a></li>
    <li>News</li>
    <li>List</li>
</ul>
<!-- end of breadcrumbs -->
<!-- Container Begin -->
<div class="row" style="margin-top:-20px">

    <div class="large-12 columns">
        <div class="box">
            <div class="box-header bg-transparent">
                <!-- tools box -->
                <div class="pull-right box-tools">

                    <span class="box-btn" data-widget="collapse"><i class="icon-minus"></i>
                    </span>
                    <span class="box-btn" data-widget="remove"><i class="icon-cross"></i>
                    </span>
                </div>
                <h3 class="box-title"><i class="fontello-th-large-outline"></i>
                    <span>News List</span>
                </h3>

            </div>

            <!-- /.box-header -->
            <div class="box-body " style="display: block;">
                <div class="right">
                    <a href="<?php echo base_url();?>admin/photo/addCoat ">
                        <span class="fontello-plus "> Add </span>
                    </a>
                    
                </div>
                

                <table id="table-list" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <!-- <th>Create Date</th> -->
                            <th></th>
                            <th>Title</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>No</th>
                            <!-- <th>Create Date</th> -->
                            <th></th>
                            <th>Title</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </tfoot>

                    <tbody>

                    <?php

                    $i=1;

                    foreach ($rs as $r)
                        {   
                        if($r['status']==1){
                            $status = '<span class="status-metro status-active" title="Activated">Activated<span/>';} 
                        else{
                            $status='<span class="status-metro status-disabled" title="No Activated">No Activated</span>';} 
                    ?>
                        <tr>
                            <a href="<?php echo base_url();?>admin/photo/editCoat/<?php echo $r['id'];?>">
                            <td><?php echo $i;?></td>
                            <td><img id="blah" class="grayscale" src="<?php echo base_url();?>images/news/<?php echo $r['photo'];?>"  ></td>
                            <!-- <td><?php echo $this->dbhelper->DateThai($r['create_date']);?></td> -->
                            <td><?php echo $r['title'];?></td>
                            <td><?php echo $status;?></td>
                            <td>
                                
                                    <span class="fontello-edit"></span>
                               
                            </td>
                             </a>
                        </tr>
                    <?php 
                    $i=$i+1;
                    }
                    ?>
                    </tbody>
                </table>


            </div>
            <!-- end .timeline -->
        </div>
        <!-- box -->
    </div>
</div>
<!-- End of Container Begin -->

<?php $this->load->view("admin/template/footer");?>
<!-- page script -->
    <script type="text/javascript">
    (function($) {
        "use strict";
        $('#table-list').dataTable({
            "order": [
                [2, "asc"]
            ]
        });
    })(jQuery);

    </script>