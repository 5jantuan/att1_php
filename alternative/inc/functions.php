<?php
require_once "config.php";



/**
 * Получение всех вопросов из файла questions.json
 * 
 * @return array
 */
function get_questions() {
    $file = QUESTIONS_FILE_PATH;
    
    if (!file_exists($file)) {
        die("Ошибка: Файл с вопросами не найден.");
    }

    $data = file_get_contents($file);
    $questions = json_decode($data, true);

    
    return $questions;
}




/**
 * Получение результатов из файла results.json
 * 
 * @return array
 */
function get_results() {
    if (file_exists(RESULTS_FILE_PATH)) {
        $data = file_get_contents(RESULTS_FILE_PATH);
        return json_decode($data, true);
    }
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Ошибка JSON: " . json_last_error_msg();
        exit();
    }
    return [];
}

/**
 * Сохранение результата теста в файл
 * 
 * @param string $name
 * @param int $score
 * @param int $total
 * @param float $percentage
 */
function save_result($name, $score, $total, $percentage) {
    $results = get_results();
    
    // Добавляем новый результат
    $results[] = [
        'name' => $name,
        'score' => $score,
        'total' => $total,
        'percentage' => $percentage
    ];
    
    // Сохраняем данные в JSON файл
    file_put_contents(RESULTS_FILE_PATH, json_encode($results, JSON_PRETTY_PRINT));
}

/**
 * Проверка данных теста пользователя
 * 
 * @param array $answers
 * @param array $correct_answers
 * @return array
 */
// Эта функция рассчитывает баллы пользователя
function calculate_score($user_answers, $correct_answers) {
    $score = 0;
    $total_questions = count($correct_answers);

    foreach ($user_answers as $index => $user_answer) {
        // Для checkbox-с вопросов (несколько правильных ответов)
        if (is_array($user_answer)) {
            // Проверяем, что все выбранные ответы совпадают с правильными
            $correct = !array_diff($user_answer, $correct_answers[$index]);
            if ($correct) {
                $score++;
            }
        } else {
            // Для radio-с вопросов (один правильный ответ)
            if ($user_answer == $correct_answers[$index][0]) {
                $score++;
            }
        }
    }

    $percentage = ($score / $total_questions) * 100;
    return [$score, $percentage];
}



?>
