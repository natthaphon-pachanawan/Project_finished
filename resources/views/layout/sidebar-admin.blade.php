<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main" style="top: 70px;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="javascript:void(0)">
            <span class="ms-1 font-weight-bold text-white">Admin Dashboard</span>
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
                <a class="nav-link text-white {{ Request::is('admin-dashboard') ? 'active bg-gradient-primary' : '' }}" href="/admin-dashboard">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">จัดการข้อมูลผู้ใช้</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('layout-admin') ? 'active bg-gradient-primary' : '' }}" href="/layout-admin">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">จัดการข่าวสาร</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('acg-show') ? 'active bg-gradient-primary' : '' }}" href="acg-show">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">report</i>
                    </div>
                    <span class="nav-link-text ms-1">ออกรายงานผู้ใช้</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('acg-show') ? 'active bg-gradient-primary' : '' }}" href="acg-show">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">article</i>
                    </div>
                    <span class="nav-link-text ms-1">ออกรายงานข่าวสาร</span>
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
        top: 110px; /* ปรับค่าตามต้องการเพื่อให้ปุ่มอยู่ในตำแหน่งที่เหมาะสม */
        left: 260px; /* เริ่มต้นที่ตำแหน่งปกติของ sidebar */
        z-index: 1100;
        background-color: #333;
        border: none;
        color: white;
        cursor: pointer;
        padding: 10px;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: left 0.3s ease;
    }

    .sidenav.collapsed ~ .sidebar-toggle-btn {
        left: 0px; /* เมื่อพับเก็บแล้ว, ปุ่มจะเลื่อนไปทางซ้าย */
    }
</style>
