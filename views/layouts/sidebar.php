<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      
            <span class="app-brand-text demo menu-text fw-bold ms-2">Infintech</span>
   

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 ps">
      
    
        <li class="menu-item">
            <a href="<?php echo BASE_DIR; ?>/dash?auth=<?php echo $encryptedAppNo; ?>" class="menu-link <?php echo ($current_page == 'dash.php') ? 'active' : ''; ?>">
                <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                <div class="text-truncate" data-i18n="Reading">Blog Management</div>
            </a>
        </li>
     <?php
    // Assuming $name is the variable holding the current user's name
    if ($username == 'Admin') {
?>
        <li class="menu-item">
            <a href="<?php echo BASE_DIR; ?>/adduser?auth=<?php echo $encryptedAppNo; ?>" class="menu-link <?php echo ($current_page == 'adduser.php') ? 'active' : ''; ?>">
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div class="text-truncate" data-i18n="Billgen">User Management</div>
            </a>
        </li>
<?php
    }
?>
        <!-- Logout -->
        <li class="menu-item">
            <a href="<?php echo BASE_DIR; ?>/logout" class="menu-link">
                <i class="menu-icon tf-icons bx bx-log-out-circle"></i>
                <div class="text-truncate" data-i18n="Logout">Logout</div>
            </a>
        </li>
    </ul>
</aside>
