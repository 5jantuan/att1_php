<?php
require_once "inc/functions.php";



// Рассчитываем количество правильных ответов
list($score, $percentage) = calculate_score($answers, $correct_answers);

// Сохраняем результаты
save_result($name, $score, count($correct_answers), $percentage);

// Редирект на страницу с результатами
header('Location: dashboard.php');
exit();
?>
