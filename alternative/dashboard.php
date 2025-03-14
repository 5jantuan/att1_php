<?php
require_once "inc/functions.php";
require_once "templates/header.php";

$results = get_results(); // Получение всех результатов
?>

<h2>Результаты тестов</h2>
<table border="1">
    <tr>
        <th>Имя</th>
        <th>Правильных ответов</th>
        <th>Всего вопросов</th>
        <th>Процент</th>
    </tr>
    <?php foreach ($results as $result): ?>
        <tr>
            <td><?= htmlspecialchars($result["name"]) ?></td>
            <td><?= $result["score"] ?></td>
            <td><?= $result["total"] ?></td>
            <td><?= $result["percentage"] ?>%</td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
require_once "templates/footer.php";

