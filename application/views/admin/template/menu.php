<!-- Menu sidebar begin-->
                        <div class="side-bar">
                            <ul id="menu-showhide" class="topnav slicknav">
                                <li>
                                    <a  <?php if($this->uri->segment(1)=="admin_index"){echo 'id="menu-select"';} ?> class="tooltip-tip"  href="<?php echo base_url();?>admin_index" title="Dashboard">
                                        <i class="icon-monitor"></i>
                                        <span>Dashboard</span>

                                    </a>

                                </li>
                                
                                <li>
                                    <a <?php if($this->uri->segment(2)=="newsList"){echo 'id="menu-select"';} ?> href="<?php echo base_url();?>news/newsList" title="News">
                                        <i class="fontello-doc-1"></i>
                                        <span>News</span>
                                    </a>
                                </li>
                                <li>
                                    <a  <?php if($this->uri->segment(2)=="album"){echo 'id="menu-select"';} ?> href="#" title="UI">
                                        <i class="fontello-doc-1"></i>
                                        <span>Photo Album</span>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url();?>admin/album/coatList">Photo Coating
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url();?>admin/album/sizeList">Photo Size/Price</a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                <li>
                                    <a  <?php if($this->uri->segment(2)=="frame"){echo 'id="menu-select"';} ?> href="#" title="UI">
                                        <i class="icon-view-thumb"></i>
                                        <span>Photo Frame</span>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url();?>admin/frame/coatList">Photo Coating
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url();?>admin/frame/sizeList">Photo Size/Price</a>
                                        </li>
                                        
                                    </ul>
                                </li>


                                
                            </ul>
                        </div>
                        <!-- end of Menu sidebar  -->