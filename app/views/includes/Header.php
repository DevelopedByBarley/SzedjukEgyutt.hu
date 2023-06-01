<div class="container-fluid bg-success">
    <nav class="navbar navbar-expand-lg navbar-light bg-success" style="min-height: 60px">
        <strong>
            <a class="navbar-brand text-light" href="/">SzedjükEgyütt <i class="bi bi-balloon-heart"></i> </a>
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

<style>
    @media(min-width: 1024px) {
        #navigation-panel{
            position: fixed;
            right: 100px;
            top: -10px;
        }
    }
</style>