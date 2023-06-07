<div class="container">
    <div class="row">
        <div class="col text-center">
            <h1 class="display-3">Események listája</h1>
            <a href="/events/new" class="btn btn-outline-success mt-4">Új esemény</a>
        </div>
    </div>
    <div class="row mt-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="fs-5"> # </th>
                        <th scope="col" class="fs-5"> Címe </th>
                        <th scope="col" class="fs-5"> Helyszín </th>
                        <th scope="col" class="fs-5"> Időpont </th>
                        <th scope="col" class="fs-5"> Létrehozva </th>
                        <th scope="col" class="fs-5"> Kezelés </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($params["events"] as $index => $event) { ?>
                        <tr>
                            <th scope="row"><?= $index + 1 ?></th>
                            <td><?= $event["title"] ?></td>
                            <td><?= $event["location"] ?></td>
                            <td><?= $event["date"] ?></td>
                            <td><?= $event["createdAt"] ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-primary m-1"><i class="bi bi-eye"></i></a>
                                    <a href="/event/update/<?= $event["eventId"] ?>" class="btn btn-warning m-1"><i class="bi bi-arrow-clockwise"></i></a>
                                    <button type="button" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $event["eventId"] ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop<?= $event["eventId"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Esemény törlése</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Biztosan törlöd a <b><span class="text-danger"><?= $event["title"] ?></span></b> nevű eseményt?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="/event/delete/<?= $event["eventId"] ?>" class="btn btn-primary">Törlés</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>