<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<div class="container">
    <header class="header">
        <h1 class="header__title">Вход</h1>
    </header>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form class="auth-form" method="POST" action="index.php?controller=user&action=login">
        <label class="auth-form__label">Имя пользователя:
            <input class="auth-form__input" type="text" name="username" required>
        </label>
        <label class="auth-form__label">Пароль:
            <input class="auth-form__input" type="password" name="password" required>
        </label>
        <button class="auth-form__button" type="submit">Войти</button>
    </form>
    <p>Нет аккаунта? <a href="index.php?controller=user&action=register">Зарегистрироваться</a></p>
</div>
</body>
</html>
