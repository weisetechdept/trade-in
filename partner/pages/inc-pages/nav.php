        <header id="page-topbar">
            <div class="navbar-header">
                
                <div class="navbar-brand-box d-flex align-items-left">
                    <a href="index.html" class="logo logo-show">
                        <span>
                            พันธมิตรรถยนต์
                        </span>
                    </a>

                    <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect waves-light" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>

                <div class="d-flex align-items-center">

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect waves-light" style="width: 90px;">
                            <i class="mdi mdi-bell"></i>
                            <span class="badge badge-info badge-pill">3</span>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect waves-light" style="padding-left: 0;" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="<?php echo $_SESSION['partner_img'];?>"
                                alt="<?php echo $_SESSION['partner_name'];?>">
                            <span class="d-none d-sm-inline-block ml-1"><?php echo $_SESSION['partner_name'];?></span>
                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                <span>ออกจากระบบ</span>
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </header>