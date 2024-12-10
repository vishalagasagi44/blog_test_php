<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
            <i class="bx bx-menu bx-md"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Display Page Title Conditionally -->
        <div class="navbar-nav ms-2">
            <?php if (!empty($navbar_title)) { ?>
                <h5 class="mb-0"><?php echo $navbar_title; ?></h5>
            <?php } ?>
        </div>

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            
            <!--/ User -->
        </ul>
    </div>
</nav>
