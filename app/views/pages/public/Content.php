<?php
$latestEvent = $params["latestEvent"] === false ? null : $params["latestEvent"];

?>

<div class="container">
    <div style="min-height: 80vh" class="d-flex align-items-center justify-content-center">
        <div class="row p-3 d-flex align-items-center justify-content-center" style="min-height: 70vh; box-shadow: 1px -7px 28px -5px rgba(24,153,60,0.43);" id="heading">
            <div class="col-sm-6 mt-5 d-flex align-items-center justify-content-center flex-column">
                <h1 class="display-3 mb-4">Szedjük együtt!</h1>
                <p class="text-center">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Sit facere qui animi sed mollitia beatae, aut corrupti nihil a rem,
                    praesentium, suscipit id unde minus voluptate. Pariatur animi reprehenderit provident!
                </p>
            </div>
            <div class="col-sm-6 mt-5">
                <img src="public/assets/images/test_2.jpg" style="width: 100%" alt="">
            </div>
            <div class="col-xs-12 d-flex align-items-center justify-content-center flex-column">
                <a href="#about-us" class="text-dark p-0" id="scroll-down">
                    <i class="bi bi-arrow-down-circle" style="font-size: 2.2rem;"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row mt-5 p-5 text-center bg-light d-flex align-items-center justify-content-center" id="about-us">
        <div class="col-12">
            <h1 class="display-5 mt-5">Rólunk</h1>
            <hr>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae voluptatum placeat vero temporibus, unde iure asperiores dolorem harum debitis, nostrum suscipit molestiae, quis cum delectus dolore necessitatibus fuga! Odio, tenetur.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias aperiam error, maxime molestias vero, at repellat dolores, quo voluptas iure placeat reiciendis impedit quaerat quasi cum minus eos architecto repellendus.
            </p>
        </div>
    </div>

    <div class="row mt-5 mb-5 p-1 bg-success text-light" id="event">
        <div class="col-xs-12 col-sm-7 d-flex align-items-center justify-content-center flex-column text-center">
            <h1 class="display-4 mt-5 text-center">Következő eseményünk</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <div class="text-center mt-4">
                <a href="/event/<?= $latestEvent["eventId"] ?>" class="btn btn-outline-light">Részletek</a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 mt-2 p-3 rounded d-flex align-items-center justify-content-center flex-column">
            <div class="d-flex align-items-center justify-content-center flex-column">
                <img src="public/assets/images/heading.jpg" id="event-image" alt="">
            </div>
            <div id="event-section">
                <h3 id="event-title" class="mt-5">
                    <?= isset($latestEvent) && count($latestEvent) !== 0 ? $latestEvent["title"] : '' ?>
                </h3>
                <hr>
                <p id="event-content">
                    <?= isset($latestEvent) && count($latestEvent) !== 0 ? $latestEvent["content"] : '' ?>
                </p>
            </div>
        </div>
    </div>


</div>


<style>
    #event-image,
    #event-section {
        width: 100%;
    }


    #scroll-down {
        animation: down 1.5s infinite;
        cursor: pointer;

    }

    @keyframes down {
        0% {
            transform: translate(0);
        }

        20% {
            transform: translateY(15px);
        }

        40% {
            transform: translate(0);
        }
    }
</style>