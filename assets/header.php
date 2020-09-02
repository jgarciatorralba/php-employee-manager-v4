<header class="d-flex flex-row align-items-center bg-light border-bottom">
    <nav class="navbar navbar-expand-sm mr-auto navbar-light">
        <a class="navbar-brand">
            <img src="<?php echo constant('URL'); ?>assets/img/assembler-school.jpg" class="rounded" width="30" height="30"
                alt="assembler school logo">
        </a>
        <a class="navbar-brand">Assembler School</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <!-- <a class="nav-link font-weight-bold" id="dashboard"
                        href="index.php?controller=login&action=goToDashboard">Dashboard</a> -->
                    <a class="nav-link font-weight-bold" id="dashboard" href="<?php echo constant('URL'); ?>login/goToDashboard">Dashboard</a>
                </li>
                <li class="nav-item active">
                    <!-- <a class="nav-link" id="employee" href="index.php?controller=login&action=goToEmployee">Employee</a> -->
                    <a class="nav-link" id="employee" href="<?php echo constant('URL'); ?>login/goToEmployee">Employee</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- <a class="text-dark m-3" href="index.php?controller=login&action=kickout">Log out</a> -->
    <a class="text-dark m-3" href="<?php echo constant('URL'); ?>login/kickout">Log out</a>
</header>

<script>
    const url = window.location.href;
    if (url.includes('goToDashboard')) {
        document.getElementById('dashboard').classList.add('font-weight-bold');
        document.getElementById('employee').classList.remove('font-weight-bold');
    }

    if (url.includes('goToEmployee')) {
        document.getElementById('employee').classList.add('font-weight-bold');
        document.getElementById('dashboard').classList.remove('font-weight-bold');
    }
</script>