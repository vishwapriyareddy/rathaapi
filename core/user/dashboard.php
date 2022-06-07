<?php
session_start();
require_once('../modules/profile.php');

$user_id = $_SESSION['user_id'];
if (empty($user_id)) {
  header('location: ../auth/login');
} else {
  $user = UserProfile($user_id);

  require_once("./components/header.php");
?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar" id="user-dashboard">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo p-2">
          <img src="../assets/img/logo/pharma-logo-2.png" />

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>
        <div id="content"></div>

        <ul class="menu-inner py-1">
          <!-- Layouts -->
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Updations</span>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link btn" onclick="$('#main').load('./components/elements.php #inward-cover')">
              <i class="menu-icon tf-icons bx bx-chevrons-left"></i>
              <div data-i18n="Basic">Inward Cover</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link btn" onclick="$('#main').load('./components/elements.php #outward-cover')">
              <i class="menu-icon tf-icons bx bx-chevrons-right"></i>
              <div data-i18n="Basic">Outward Cover</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link btn" onclick="$('#main').load('./components/elements.php #returns')">
              <i class="menu-icon tf-icons bx bx-rotate-left"></i>
              <div data-i18n="Basic">Returns</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link btn" onclick="$('#main').load('./components/elements.php #lr-update')">
              <i class="menu-icon tf-icons bx bx-refresh"></i>
              <div data-i18n="Basic">LR Update</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link btn" onclick="$('#main').load('./components/elements.php #box-update')">
              <i class="menu-icon tf-icons bx bx-package"></i>
              <div data-i18n="Basic">Box Update</div>
            </a>
          </li>

          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Reports</span>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link btn" onclick="$('#main').load('./components/elements.php #report')">
              <i class="menu-icon tf-icons bx bx-notepad"></i>
              <div data-i18n="Basic">Date Wise Report</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link btn" onclick="$('#main').load('./components/elements.php #ebs-report')">
              <i class="menu-icon tf-icons bx bx-cycling"></i>
              <div data-i18n="Basic">EBS Report</div>
            </a>
          </li>
        </ul>
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <!-- <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
              </div>
            </div> -->
            <!-- /Search -->
            <div class="nav-item d-flex align-items-center">
              <a href="#"> <i class='bx bx-log-in-circle fs-1' data-bs-toggle="tooltip" data-bs-placement="right" title="User view"></i></a>
            </div>


            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <i class='bx bxs-user-circle fs-1 text-primary'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <span class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="dropdown-avatar bg-primary rounded-circle d-flex justify-content-center align-items-center">
                            <span class="fw-bold fs-4 text-white mt-1 text-capitalize"><?php echo $user['user_name'][0]; ?></span>
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block text-capitalize"><?php echo $user['user_name'] ?></span>
                          <small class="text-muted">User</small>
                        </div>
                      </div>
                    </span>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="bx bx-user me-2"></i>
                      <span class="align-middle">My Profile</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="bx bx-cog me-2"></i>
                      <span class="align-middle">Settings</span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="../auth/logout.php">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>
        </nav>

        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y" id="main">

          </div>
          <div id="main-modal">
            <!-- Modal -->
            <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
              <div class="modal-dialog">
                <form class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">Quick Selection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Select company</label>
                        <input type="text" id="nameBackdrop" class="form-control" placeholder="Enter Name" />
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      $(function() {
        $("#main").load("./components/elements.php #inward-cover");
        //$('#backDropModal').modal('show');
      });     
    </script>
  <?php require_once('./components/footer.php');
}
