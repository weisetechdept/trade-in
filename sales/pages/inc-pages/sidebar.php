<div class="vertical-menu">

    <div data-simplebar class="h-100">
        
        <div id="sidebar-menu">
            
            <ul class="metismenu list-unstyled" id="side-menu">
                
                <li class="menu-title">เมนู</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fas fa-address-book"></i><span>รถยนต์</span></a>
                    <ul class="sub-menu mm-collapse mm-show" aria-expanded="false">
                        <li><a href="/sales/home">รถยนต์ทั้งหมด</a></li>
                        <li><a href="/sales/add-car">เพิ่มรถยนต์ใหม่</a></li>
                    </ul>
                </li>
                <?php if($_SESSION['tin_permission'] == 'leader') { ?>
                <li>
                    <a href="/sales/mgr" class="waves-effect"><i class="mdi mdi-car"></i><span>รถลูกทีม</span></a>
                </li>
                <?php } ?>
            
            </ul>
        </div>
    
    </div>
</div>