<?php
$event = $params["event"];

?>
<?php if (isset($_GET["isRegistered"])) : ?>
    <div class="alert bg-primary text-light text-center" role="alert">
        <strong>Sikeres regisztráció!</strong>
    </div>
<?php endif ?>


<div class="container p-3">
    <div class="row" style="min-height: 60vh">
        <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center flex-column">
            <img src="public/assets/images/heading.jpg" id="event-header-image" alt="">

            <h1 class="display-6 mt-3 text-center"><?= $event["title"] ?></h1>
            <p class="p-3">
                <?= $event["content"] ?>
            </p>
        </div>
        <div class="col-12 col-lg-6 mt-5 bg-light" style="box-shadow: 1px -7px 28px -5px rgba(24,153,60,0.43);">
            <div class="p-2 bg-success text-light w-100 mt-3">
                <span style="font-size: 1.4rem"><strong>Helyszín:</strong> <?= $event["location"] ?></span>
                <br>
                <span style="font-size: 1.4rem"><strong>Időpont:</strong> <?= $event["date"] ?></span>
            </div>
            <?php if (isset($_SESSION["s_adminId"])) : ?>
                <div class="p-2 bg-success text-light w-100">
                    <span style="font-size: 1.4rem"><strong>Regisztráltak száma:</strong> <?= $event["registrations"] ?></span>
                    <br>
                    <span style="font-size: 1.4rem"><strong>Szükséges zsákok száma:</strong> <?= $event["bags"] ?></span>
                </div>
            <?php endif ?>
            <div class="d-flex align-items-center justify-content-center mt-3">
                <iframe src="<?= $event["maps"] ?>" width="500" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <?php if (!isset($_SESSION["s_adminId"])) : ?>
        <div class="row">
            <div class="col-12">
                <div id="user-apply" class="text-center mt-5">
                    <form>
                        <div class="btn-group">
                            <button type="button" class="btn btn-lg btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Jelentkezés
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>











<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Jelentkezés</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="/register/<?= $event["eventId"] ?>" method="POST">
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Keresztnév:</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Keresztnév">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Eszközök igénylése:</label>
                        <br>
                        <input type="radio" class="btn-check" name="bag" id="success-outlined" autocomplete="off" value="off" checked>
                        <label class="btn btn-outline-primary" for="success-outlined">Hozok zsákot</label>

                        <input type="radio" class="btn-check" name="bag" id="danger-outlined" autocomplete="off" value="on">
                        <label class="btn btn-outline-primary" for="danger-outlined">Igénylek zsákot</label>
                    </div>
                    <hr>
                    <div class="mb-3 d-flex align-items-center justify-content-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                            <label class="form-check-label" for="flexSwitchCheckChecked">Többen jövünk!</label>
                        </div>
                    </div>

                    <input type="hidden" name="date" value="<?= $event["date"] ?>" />

                    <div class="mb-3" id="multiplier-container" style="display: none">
                        <label for="multiplier" class="col-form-label">Hány fő?</label>
                        <input type="number" class="form-control" id="multiplier" name="numOfRegistrations" min="1" max="4">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Megjegyzés</label>
                        <textarea class="form-control" id="message-text" name="message" placeholder="Megjegyzés írása..."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                        <button type="submit" class="btn btn-success">Jelentkezés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    #event-header-image {
        width: 100%;
    }
</style>

<script>
    const checkbox = document.getElementById('flexSwitchCheckChecked');
    const multiplierContainer = document.getElementById('multiplier-container');
    const multiplierInput = multiplierContainer.querySelector('#multiplier');

    checkbox.addEventListener('change', function() {
        if (this.checked) {
            multiplierContainer.style.display = 'block';
            multiplierInput.setAttribute('required', 'required');

        } else {
            multiplierContainer.style.display = 'none';
            multiplierInput.removeAttribute('required');

        }
    });
</script>