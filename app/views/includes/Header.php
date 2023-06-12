<div class="container-fluid bg-success">
    <nav class="navbar navbar-expand-lg navbar-light bg-success fixed-top p-3" style="min-height: 60px">
        <strong>
            <a class="navbar-brand text-light" href="/">SzedjükEgyütt <img src="public/assets/images/earth.png" style="height: 40px; width: 40px; position: relative; bottom: 5px; left: 2px;"/></a>
        </strong>
        <button class="navbar-toggler" style="background-color: white;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mt-3" id="navigation-panel">
                <?php if (!isset($_SESSION["s_adminId"])) : ?>
                    <li class="nav-item">
                        <b> <a class="nav-link active text-light lead" aria-current="page" href="/">Kezdőlap</a></b>
                    </li>
                    <li class="nav-item">
                        <b> <a class="nav-link text-light lead" href="#">Események</a></b>
                    </li>
                    <li class="nav-item">
                        <b> <a class="nav-link text-light lead" href="#">Galléria</a></b>
                    </li>
                <?php else : ?>
                    <li class="nav-item" id="logout">
                        <b> <a class="btn btn-danger text-light" href="/admin/logout">Kijelentkezés</a></b>
                    </li>

                <?php endif ?>
            </ul>
        </div>
    </nav>
</div>

<?php if (isset($_SESSION["s_adminId"])) : ?>
    <nav id="s-admin-navbar" class="text-light text-center">
        <ul>
            <li>
                <a href="/events" class="btn btn-success text-light">Események</a>
                <a href="/gallery" class="btn btn-success text-light">Galéria</a>
                <a href="/admins" class="btn btn-success text-light">Adminok</a>
            </li>
        </ul>
    </nav>
<?php endif ?>

<style>
    @media(min-width: 1024px) {
        #navigation-panel {
            position: fixed;
            right: 100px;
            top: -5px;
        }
    }

    #s-admin-navbar {
        margin-top: 100px;
    }
</style>