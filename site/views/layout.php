<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="public/img/logo.png" type="image/x-icon">
    <title><?php echo !empty($TitlePage) ? $TitlePage : 'Furry Friends' ?></title>
    <link rel="stylesheet" href="public/css/all.css">
    <link rel="stylesheet" href="public/css/style.css">
    <script src="public/js/javascript.js"></script>
</head>
<body>
    <?php
    include_once 'site/views/header.php';
    include_once 'site/views/nav.php';
    include_once $Views;
    include_once 'site/views/footer.php';
    ?>
</body>
</html>