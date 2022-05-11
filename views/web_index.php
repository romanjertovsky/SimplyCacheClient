<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= env('base_url') . 'css/bootstrap.css' ?>" />
    <link rel="stylesheet" href="<?= env('base_url') . 'css/main.css' ?>" />
    <script type="text/javascript">
        const ApiUrl = '<?= env('base_url') ?>api/'
        const DataEngine = '<?= env('front_data_engine') ?>'
    </script>
    <title>Главная</title>
</head>
<body>
    <div class="container">

        <h1>Список:</h1>

        <ul id="main_list">
        </ul>

        <h1>Лог:</h1>

        <div id="div_log" class="fs-6 font-monospace text-danger">
        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="<?= env('base_url') ?>js/bootstrap.bundle.js"></script>
    <script src="<?= env('base_url') ?>js/api.js"></script>
</body>
</html>
