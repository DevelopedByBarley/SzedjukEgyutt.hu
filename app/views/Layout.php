<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" />
    <script src="/public/bootstrap/js/bootstrap.js"></script>
    <title>Layout</title>
</head>

<body>
    <div class="container-fluid" style="position: relative; min-height: 90vh;">
        <nav id="nav">
            <?php include 'includes/Header.php' ?>
        </nav>
        <div class="row" style="padding-bottom: 10rem;">
            <div class="col" style=" margin-top: 100px">
                <?= $params["content"] ?? "" ?>
            </div>
        </div>
        <div id="footer" style="position: absolute; bottom: 0; width: 100%;">
            <?php include 'includes/Footer.php' ?>
        </div>
    </div>
</body>

</html>