<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <a class="navbar-brand" href="#">
      <img
        src="<?php echo constant('URL'); ?>assets/img/assembler-school.jpg"
        width="30" height="30" class="rounded d-inline-block align-top mr-2 mt-0" alt="assembler school logo">
      <div class="d-none d-sm-inline-block mt-0">
        Assembler School
      </div>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
      aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarToggler">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0 w-100 d-flex justify-content-between">
        <div class="block-1 w-auto mt-0">
          <li id="dashboard" class="nav-item active text-right d-lg-inline-block font-weight-bold">
            <a class="nav-link" href="<?php echo constant('URL'); ?>login/goToDashboard">
              Dashboard
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li id="employee" class="nav-item active text-right d-lg-inline-block">
            <a class="nav-link" href="<?php echo constant('URL'); ?>login/goToEmployee">
              Employee
            </a>
          </li>
        </div>
        <div class="block-2 mt-0">
          <li class="nav-item text-right">
            <a class="nav-link text-primary" href="<?php echo constant('URL'); ?>login/kickout">
              Logout
            </a>
          </li>
        </div>
      </ul>
    </div>
  </nav>
</header>

<script>
    const url = window.location.href;
    if (url.includes('Dashboard')) {
        document.getElementById('dashboard').classList.add('font-weight-bold');
        document.getElementById('employee').classList.remove('font-weight-bold');
    }

    if (url.includes('Employee')) {
        document.getElementById('employee').classList.add('font-weight-bold');
        document.getElementById('dashboard').classList.remove('font-weight-bold');
    }
</script>