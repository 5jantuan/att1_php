<?php
require_once "inc/functions.php";
require_once "templates/header.php";
?>

<h2>Добро пожаловать! Нажмите на кнопку, чтобы начать тест.</h2>
<form action="test.php" method="get">
    <button type="submit">Пройти тест</button>
</form>

<?php
require_once "templates/footer.php";
?>
