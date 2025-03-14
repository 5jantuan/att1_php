<?php
<<<<<<< HEAD
=======

>>>>>>> 4bf79330a3329cc28e65b4616dbdd1abce1cb564
// Остальные include файлы
require_once "inc/functions.php";

// Получаем вопросы из файла
$questions = get_questions();

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем ответы пользователя
    if (isset($_POST['answers'])) {
        $user_answers = $_POST['answers']; // Массив с ответами пользователя
        
        // Проверка, что массив с ответами соответствует числу вопросов
        if (count($user_answers) !== count($questions)) {
            echo "Ошибка: количество ответов не совпадает с количеством вопросов.";
            exit;
        }

        // Получаем правильные ответы из данных
        $correct_answers = array_column($questions, 'answer'); // Правильные ответы

        
        // Рассчитываем количество правильных ответов
        list($score, $percentage) = calculate_score($user_answers, $correct_answers);

        // Сохранение результата
        save_result($_POST['name'], $score, count($questions), $percentage);
        
        // Перенаправление на страницу результатов
        header("Location: dashboard.php");
        exit;
    }
}

require_once "templates/header.php";
?>

<h2>Тест</h2>
<form action="test.php" method="POST">
    <input type="text" name="name" placeholder="Ваше имя" required>
    <div>
        <?php foreach ($questions as $index => $question): ?>
            <p><?= htmlspecialchars($question["question"]) ?></p>
            <?php if ($question["type"] == "radio"): ?>
                <!-- Для вопросов с одним правильным ответом -->
                <?php foreach ($question["options"] as $option): ?>
                    <label>
                        <input type="radio" name="answers[<?= $index ?>]" value="<?= $option ?>" required>
                        <?= htmlspecialchars($option) ?>
                    </label>
                <?php endforeach; ?>
            <?php elseif ($question["type"] == "checkbox"): ?>
                <!-- Для вопросов с несколькими правильными ответами -->
                <?php foreach ($question["options"] as $option): ?>
                    <label>
                        <input type="checkbox" name="answers[<?= $index ?>][]" value="<?= $option ?>">
                        <?= htmlspecialchars($option) ?>
                    </label>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <button type="submit">Завершить тест</button>
</form>
<<<<<<< HEAD
=======

>>>>>>> 4bf79330a3329cc28e65b4616dbdd1abce1cb564
