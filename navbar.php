<nav id="sidebarMenu" class="col-md-4 col-lg-3 d-md-block bg-light sidebar collapse p-0">
    <div class="position-sticky sidebar-inner pt-3 ps-3">
        <ul class="nav flex-grow-1 overflow-auto flex-column flex-nowrap">
            <?php
            if (isAdmin()) {
                ?>
                <li class="nav-item ps-5 pb-2">
                    <a class="nav-link" href="dashboard.php"> Uni Admin Dashboard </a>
                </li>
                <li class="nav-item ps-5 pb-2">
                    <a class="nav-link" href="statistics.php"> Statistics </a>
                </li>
                <li class="nav-item ps-5 pb-2">
                    <a class="nav-link" href="ad_contacts.php"> Contacts </a>
                </li>
                <?php
            }
            ?>
            <?php
            if (isStudent()) {
                ?>
                <li class="nav-item ps-5 pb-2">
                    <a class="nav-link" href="highschool_grads.php"> High school graduates </a>
                </li>
                <?php
            }
            ?>
            <li class="nav-item ps-5 pb-2">
                <a class="nav-link" href="masters_post_grads.php"> Master's and Postgraduates </a>
            </li>
            <li class="nav-item ps-5 pb-2">
                <a class="nav-link" href="community.php"> Community Hub </a>
            </li>
            <li class="nav-item ps-5 pb-2">
                <a class="nav-link" href="ad_community.php"> Community Hub Dashboard </a>
            </li>
            <li class="nav-item ps-5 pb-2">
                <a class="nav-link" href="gpa.php"> GPA Calculator </a>
            </li>
            <li class="nav-item ps-5 pb-2">
                <a class="nav-link" href="faq.php"> FAQ </a>
            </li>
            <li class="nav-item ps-5 pb-2">
                <a class="nav-link" href="about.php"> About Us </a>
            </li>
            <li class="nav-item ps-5 pb-2">
                <a class="nav-link" href="contact.php"> Contact Us </a>
            </li>
        </ul>
        <div class="d-flex align-items-center gap-2 justify-content-center mt-3 py-4">
            <a href="#" class="btn btn-light border bg-teapink rounded-5 fs-20"><i class="fab fa-whatsapp"></i></a>
            <a href="#" class="btn btn-light border bg-teapink rounded-5 fs-20"><i class="fa fa-envelope"></i></a>
            <a href="#" class="btn btn-light border bg-teapink rounded-5 fs-20"><i class="fab fa-linkedin"></i></a>
        </div>
    </div>
</nav>