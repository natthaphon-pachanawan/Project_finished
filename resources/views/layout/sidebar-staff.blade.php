<div class="min-height-300 bg-primary position-absolute w-100"></div>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main" style="top: 70px;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="javascript:void(0)">
            <span class="ms-1 font-weight-bold text-white">Staff Dashboard</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('staff-dashboard') ? 'active bg-gradient-primary' : '' }}" href="/staff-dashboard">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">หน้าหลัก</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('adl-show') ? 'active bg-gradient-primary' : '' }}" href="/adl-show">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assessment</i>
                    </div>
                    <span class="nav-link-text ms-1">ทำแบบประเมิน (ADL)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('cg-show') ? 'active bg-gradient-primary' : '' }}" href="cg-show">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">การปฏิบัติงานผู้ดูแลผู้สูงอายุ (CG)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('acg-show') ? 'active bg-gradient-primary' : '' }}" href="acg-show">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">elderly</i>
                    </div>
                    <span class="nav-link-text ms-1">กิจกรรมการดูแลผู้สงอายุ (ACG)</span>
                </a>
            </li>
            
        </ul>
    </div>
</aside>
