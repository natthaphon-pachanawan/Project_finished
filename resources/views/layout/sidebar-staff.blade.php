<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main" style="top: 80px; background-color: #355e3b;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="javascript:void(0)" style="text-align: center;">
            <h6 class="ms-1 font-weight-bold text-white" >เมนูของเจ้าหน้าที่</h6>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('/') ? 'active bg-gradient-primary' : '' }}" href="/">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">home</i>
                    </div>
                    <span class="nav-link-text ms-1">หน้าหลัก</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('staff-dashboard') ? 'active bg-gradient-primary' : '' }}" href="/staff-dashboard">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">จัดการข้อมูลผู้สูงอายุ</span>
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
                <a class="nav-link text-white {{ Request::is('cg-show') ? 'active bg-gradient-primary' : '' }}" href="/cg-show">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">การปฏิบัติงานผู้ดูแลผู้สูงอายุ (CG)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('acg-show') ? 'active bg-gradient-primary' : '' }}" href="/acg-show">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">elderly</i>
                    </div>
                    <span class="nav-link-text ms-1">กิจกรรมการดูแลผู้สูงอายุ (ACG)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('staff-ci') ? 'active bg-gradient-primary' : '' }}" href="/staff-ci">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">announcement</i>
                    </div>
                    <span class="nav-link-text ms-1">จัดการข้อมูลคำแนะนำ</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('staff-unconfirm') ? 'active bg-gradient-primary' : '' }}" href="/staff-unconfirm">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">announcement</i>
                    </div>
                    <span class="nav-link-text ms-1">จัดการข้อมูลคำแนะนำที่ยืนยัน</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<!-- ปุ่มสำหรับดึง Sidebar กลับมา -->
<button class="sidebar-toggle-btn btn btn-link text-white" id="sidebar-toggle-btn" onclick="toggleSidebar()">☰</button>

<script>
    function toggleSidebar() {
        var sidebar = document.getElementById('sidenav-main');
        var toggleBtn = document.getElementById('sidebar-toggle-btn');
        sidebar.classList.toggle('collapsed');
        if (sidebar.classList.contains('collapsed')) {
            toggleBtn.style.left = '10px';
        } else {
            toggleBtn.style.left = '260px';
        }
    }
</script>

<style>
    .sidenav.collapsed {
        transform: translateX(-260px);
        transition: transform 0.3s ease;
    }

    .sidebar-toggle-btn {
        position: fixed;
        top: 130px; /* Adjust based on your needs */
        left: 260px; /* Default position */
        z-index: 1100;
        background-color: #355e3b;
        border: none;
        color: white;
        cursor: pointer;
        padding: 10px;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: left 0.3s ease;
    }

    .sidenav.collapsed ~ .sidebar-toggle-btn {
        left: 0px; /* Move the button when the sidebar is collapsed */
    }

    .material-icons {
        font-size: 20px; /* Adjust icon size for balance */
    }
</style>
