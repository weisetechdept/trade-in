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
                <?php if($_SESSION['survey'] == 0){ ?>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fas fa-address-book"></i><span>รถยนต์</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/admin/home">รถยนต์ทั้งหมด</a></li>
                        <li><a href="/admin/add">เพิ่มรถยนต์ใหม่</a></li>
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