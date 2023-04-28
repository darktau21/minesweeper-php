<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/style.css">
    <title>Minesweeper | <?= $data['title'] ?></title>
</head>
<body>
<!--<header class="main-header">-->
<!--    <div class="container">-->
<!--        <div class="main-header__wrapper">-->
<!--            <div class="main-header__logo logo">-->
<!--                <p class="logo__text">-->
<!--                    <a href="/">-->
<!--                        Minesweeper-->
<!--                    </a>-->
<!--                </p>-->
<!--            </div>-->
<!--            <nav class="main-header__menu main-menu">-->
<!--                <ul class="main-menu__list">-->
<!--                    <li class="main-menu__item main-menu__item_color--danger">-->
<!--                        --><?php //= NORMAL ? '<a href="/reset-session">Сбросить сессию</a>' : '<a href="/?path=/reset-session">Сбросить сессию</a>' ?>
<!--                    </li>-->
<!--                </ul>-->
<!--            </nav>-->
<!--        </div>-->
<!--    </div>-->
<!--</header>-->
<main>
    <?= $main_content ?>
</main>
<!--<footer class="main-footer">-->
<!--    <div class="container">-->
<!--        <p class="main-footer__copyright">&copy; Copyright</p>-->
<!--    </div>-->
<!--</footer>-->
</body>
</html>
