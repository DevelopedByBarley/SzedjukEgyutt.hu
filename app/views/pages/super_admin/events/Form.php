<?php
$eventForUpdate = $params["eventForUpdate"];

?>

<div class="row  d-flex align-items-center justify-content-center">
    <h1 class="display-4 mb-5 text-center">Új esemény hozzáadása</h1>
    <div class="col-12 col-sm-6">
        <form method="POST" action="/event/new">
            <!-- Name input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form4Example1">Cím</label>
                <input type="text" id="form4Example1" class="form-control" name="title" value="<?= isset($params["eventForUpdate"]) ? $eventForUpdate["title"] : '' ?>" required />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="form4Example2">Helyszín megadása</label>
                <input type="text" id="form4Example2" class="form-control" name="location" required value="<?= isset($params["eventForUpdate"]) ? $eventForUpdate["location"] : '' ?>" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="form4Example3">Időpont</label>
                <input type="datetime-local" id="form4Example3" class="form-control" name="date" required value="<?= isset($params["eventForUpdate"]) ? $eventForUpdate["date"] : '' ?>" />
            </div>


            <!-- Message input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form4Example3">Leírás</label>
                <textarea class="form-control" id="form4Example3" rows="4" name="content" required><?= isset($params["eventForUpdate"]) ? $eventForUpdate["content"] : '' ?></textarea>
            </div>


            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Elküld</button>
        </form>
    </div>
</div>