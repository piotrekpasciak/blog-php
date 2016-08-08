<html>
<head>
    <title>PHP Blog</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">

    <?php if ($layout === 'admin_layout'): ?>
        <link rel="stylesheet" type="text/css" href="/css/sb-admin.css">
        <link rel="stylesheet" type="text/css" href="/css/font-awesome/css/font-awesome.min.css">
    <?php endif ?>

    <link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body>

<?php

    require_once '../app/views/' . $layout . '.php';

?>

<!-- Javascript libraries -->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<!-- End of javascript libraries -->

<!-- My javascript code -->
<script src="/js/app.js"></script>
<!-- End of my javascript code -->

</body>
</html>