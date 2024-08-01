<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <div class="navbar-brand-box">
            <a href="/admin/home" class="logo">
                <span>
                    Trade-In
                </span>
            </a>
        </div>

    
        <div id="sidebar-menu">
            
            <ul class="metismenu list-unstyled" id="side-menu">
                
                <li class="menu-title">เมนู</li>
                <li><a href="/admin/event" class=" waves-effect"><i class="feather-book-open"></i><span>การนัดหมาย</span></a></li>
                <?php if($_SESSION['survey'] == 0){ ?>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="feather-truck"></i><span>รถยนต์</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="/admin/home">รถยนต์ทั้งหมด</a></li>
                        <li><a href="/admin/add">เพิ่มรถยนต์ใหม่</a></li>
                        <li><a href="/admin/trast">รถยนต์ที่ถูกลบ</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="feather-bar-chart-2"></i><span>รายงาน</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                    <li><a href="/admin/home-report">รถยนต์ทั้งหมด V.1</a></li>
                        <li><a href="/admin/team-report">รายงานทีมขาย</a></li>
                        <li><a href="/admin/qm-report">รายงานเปรียบเทียบ</a></li>
                        
                    </ul>
                </li>
                <li><a href="/admin/member" class=" waves-effect"><i class="feather-user"></i><span>จัดการสมาชิก</span></a></li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="feather-users"></i><span>พันธมิตร</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/admin/partner">จัดการสมาชิก</a></li>
                        <li><a href="/admin/business">จัดการบริษัท</a></li>
                    </ul>
                </li>

                <li><a href="/admin/extension" class=" waves-effect"><i class="feather-box"></i><span>ส่วนขยาย</span></a></li>
                <?php } elseif($_SESSION['survey'] == 1){ ?>  
                <li><a href="/admin/survey" class=" waves-effect"><i class="feather-clipboard"></i><span>แบบสำรวจ</span></a></li>
                <?php } ?>
            </ul>

            
        </div>
    
    </div>
</div>