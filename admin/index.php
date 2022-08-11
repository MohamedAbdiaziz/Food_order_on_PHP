<?php include('partials/menu.php'); ?>

    <!-- menu-content section -->
    <div class="menu-content">
        <div class="wrapper">
        <?php if (isset($_SESSION['login'])) {
            # code...
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        } ?> <br/> <br/>
            <h1>DASHBOARD</h1>
            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                category
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                category
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                category
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                category
            </div>

            
            <div class="clear-fix"></div>
        </div>
    </div>
    <!-- end section  -->
    <?php include('partials/footer.php'); ?>