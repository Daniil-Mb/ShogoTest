<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<div class="container">
    <header class="header">
        <h1 class="header__title">Регистрация</h1>
    </header>
    <?php if (isset($error)): ?>
        <p class="error-message"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form class="auth-form" method="POST" action="index.php?controller=user&action=register">
        <label class="auth-form__label">Имя пользователя:
            <input class="auth-form__input" type="text" name="username" required>
        </label>
        <label class="auth-form__label">Пароль:
            <input class="auth-form__input" type="password" name="password" required>
        </label>
        <button class="auth-form__button" type="submit">Зарегистрироваться</button>
    </form>
    <p>Уже есть аккаунт? <a href="index.php?controller=user&action=login">Войти</a></p>
</div>
</body>
</html>
