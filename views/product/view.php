<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['product_name']) ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<div class="container">
    <header class="header">
        <h1 class="header__title"><?= htmlspecialchars($product['product_name']) ?></h1>
    </header>
    <div class="product-detail">
        <p class="product-detail__price">Цена: <?= htmlspecialchars($product['product_price']) ?> руб.</p>
        <p class="product-detail__price-old">Старая цена: <?= htmlspecialchars($product['product_price_old']) ?> руб.</p>
        <p class="product-detail__notice"><?= nl2br(htmlspecialchars($product['product_notice'])) ?></p>
        <p class="product-detail__content"><?= nl2br(htmlspecialchars($product['product_content'])) ?></p>
        <p class="product-detail__section">Раздел: <?= htmlspecialchars($product['section_name']) ?></p>
        <p class="product-detail__type">Тип: <?= htmlspecialchars($product['type_name']) ?></p>
        <p class="product-detail__params">Параметры: <?= htmlspecialchars($product['product_params']) ?></p>
        <a class="product-detail__back-link" href="index.php">Вернуться к каталогу</a>
    </div>
</div>
</body>
</html>
