<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить товар</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<div class="container">
    <header class="header">
        <h1 class="header__title">Добавить товар</h1>
    </header>
    <?php if (isset($error)): ?>
        <p class="error-message"><?= $error ?></p>
    <?php endif; ?>
    <form class="product-form" method="POST" action="index.php?controller=product&action=create">
        <label class="product-form__label">URL:
            <input class="product-form__input" type="text" name="url" required>
        </label>
        <label class="product-form__label">Название:
            <input class="product-form__input" type="text" name="name" required>
        </label>
        <label class="product-form__label">Артикул:
            <input class="product-form__input" type="text" name="articul" required>
        </label>
        <label class="product-form__label">Цена:
            <input class="product-form__input" type="number" step="0.01" name="price" required>
        </label>
        <label class="product-form__label">Старая цена:
            <input class="product-form__input" type="number" step="0.01" name="price_old" required>
        </label>
        <label class="product-form__label">Заметка:
            <textarea class="product-form__textarea" name="notice"></textarea>
        </label>
        <label class="product-form__label">Описание:
            <textarea class="product-form__textarea" name="content"></textarea>
        </label>
        <label class="product-form__label">Раздел:
            <select class="product-form__select" name="section_id" required>
                <?php foreach ($sections as $section): ?>
                    <option value="<?= $section['id'] ?>"><?= htmlspecialchars($section['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label class="product-form__label">Тип:
            <select class="product-form__select" name="type_id" required>
                <?php foreach ($types as $type): ?>
                    <option value="<?= $type['id'] ?>"><?= htmlspecialchars($type['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <button class="product-form__button" type="submit">Добавить</button>
    </form>
</div>
</body>
</html>
