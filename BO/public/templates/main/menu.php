<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Panel administrateur</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../../FO/public/index.php">
            <i class="fas fa-archway"></i>
            <span>Menu</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Utilisateurs
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseCompte" aria-expanded="true" aria-controls="collapseCompte">
            <i class="fas fa-fw fa-cog"></i>
            <span>Compte</span>
        </a>
        <div id="collapseCompte" class="collapse" aria-labelledby="headingCompte" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Utilisateurs inscrit:</h6>
                <a class="collapse-item" href="index.php?cas=BO_Users&action=ViewUsers">Gestion des inscrits</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAbonnements" aria-expanded="true" aria-controls="collapseAbonnements">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Abonnement</span>
        </a>
        <div id="collapseAbonnements" class="collapse" aria-labelledby="headingAbonnements" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Utilisateurs abonné:</h6>
                <a class="collapse-item" href="index.php?cas=BO_Users&action=ViewSubscribers">Gestion des abonnés</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="index.php?cas=BO_Users&action=ViewAll">
            <i class="fas fa-fw far fa-user"></i>
            <span>Tous les utilisateurs</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Rubriques
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="index.php?cas=BO_Headings&action=ViewHeading">
            <i class="far fa-newspaper"></i>
            <span>Rubriques</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Commentaires
    </div>


    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="index.php?cas=BO_Comments&action=ViewComments">
            <i class="fas fa-fw far fa-comments"></i>
            <span>Gestion des commentaires</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Newsletter
    </div>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNewsLetter" aria-expanded="true" aria-controls="collapseNewsLetter">
            <i class="fas fa-fw far fa-envelope"></i>
            <span>NewsLetter</span>
        </a>
        <div id="collapseNewsLetter" class="collapse" aria-labelledby="headingNewsLetter" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Newsletter:</h6>
                <a class="collapse-item" href="index.php?cas=BO_Newsletter&action=ViewSubscribers">Inscrit newsletter</a>
                <a class="collapse-item" href="index.php?cas=BO_Newsletter&action=send">Envoyer newsletter</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Abonnements
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="index.php?cas=BO_Transactions&action=ViewTransactions">
            <i class="fas fa-fw fas fa-coins"></i>
            <span>Transactions</span></a>
    </li>
</ul>
<!-- End of Sidebar -->

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>


</nav>
<!-- End of Topbar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>


            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Mon compte</span>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="../FO/index.php?cas=FO_usersActions&action=editerprofil">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../FO/index.php?cas=FO_usersActions&action=logout">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>