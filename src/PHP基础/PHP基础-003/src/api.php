<?php
require 'flag.php';
session_start();

// 生成或验证算术题目
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    generateChallenge();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    checkAnswer();
} else {
    // 不支持的请求方法
    http_response_code(405);
    echo "Method Not Allowed";
}

function generateChallenge() {
    // 生成两个随机数和一个随机运算符
    $operand1 = rand(1, 10);
    $operand2 = rand(1, 10);
    $operators = ['+', '-', '*'];
    $operator = $operators[array_rand($operators)];

    // 计算正确的答案
    $correctAnswer = eval("return $operand1 $operator $operand2;");

    // 存储正确答案和当前时间戳到会话中
    $_SESSION['correct_answer'] = $correctAnswer;
    $_SESSION['start_time'] = time();

    // 输出计算式子给用户
    echo "$operand1 $operator $operand2 = ?";
}

function checkAnswer() {
    global $flag;
    // 获取用户的答案和正确答案
    $userAnswer = $_POST['userAnswer'];
    $correctAnswer = $_SESSION['correct_answer'];
    $startTime = $_SESSION['start_time'];
    $currentTime = time();

    // 设置时间限制为0.5秒
    $timeLimit = 0.5;

    // 检查答案和时间
    if ($userAnswer == $correctAnswer && ($currentTime - $startTime) <= $timeLimit) {
        echo "Correct! You solved it in time. $flag";
    } else {
        echo "Incorrect or out of time! Try again.";
    }
}
