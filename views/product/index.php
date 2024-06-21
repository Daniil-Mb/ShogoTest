<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Каталог товаров</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<div class="container">
    <div class="container">
        <header class="header">
            <h1 class="header__title">Каталог товаров</h1>
            <a class="header__link" href="index.php?controller=product&action=create">Добавить товар</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="header__link" href="index.php?controller=user&action=logout">Выйти</a>
            <?php else: ?>
                <a class="header__link" href="index.php?controller=user&action=login">Войти</a>
            <?php endif; ?>
        </header>

        <form class="filter" method="GET" action="index.php">
            <input type="hidden" name="controller" value="product">
            <input type="hidden" name="action" value="index">

            <div class="filter__group">
                <label class="filter__label">Раздел:
                    <select class="filter__select" name="section">
                        <option value="">Все</option>
                        <?php foreach ($sections as $section): ?>
                            <option value="<?= $section['id'] ?>" <?= (isset($_GET['section']) && $_GET['section'] == $section['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($section['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <label class="filter__label">Тип:
                    <select class="filter__select" name="type">
                        <option value="">Все</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?= $type['id'] ?>" <?= (isset($_GET['type']) && $_GET['type'] == $type['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($type['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>

            <button class="filter__button" type="submit">Фильтровать</button>
        </form>

        <ul class="product-list">
            <?php foreach ($products as $product): ?>
                <li class="product-list__item">
                    <a class="product-list__link" href="index.php?controller=product&action=view&id=<?= $product['id'] ?>">
                        <?= htmlspecialchars($product['name']) ?> - <?= htmlspecialchars($product['price']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
