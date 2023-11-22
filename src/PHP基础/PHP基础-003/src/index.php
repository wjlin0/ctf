<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Challenge</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }

        #challenge {
            font-size: 20px;
            margin-bottom: 20px;
        }

        #answer {
            font-size: 16px;
            padding: 5px;
        }

        #result {
            margin-top: 10px;
            font-size: 16px;
            color: green;
        }
    </style>
</head>
<body>

<div id="challenge"></div>
<input type="text" id="answer" placeholder="Your Answer">
<button onclick="checkAnswer()">Submit</button>
<div id="result"></div>

<script>
    function generateChallenge() {
        // 向服务器请求新的挑战
        fetch('api.php')
            .then(response => response.text())
            .then(challenge => {
                document.getElementById('challenge').innerText = challenge;
                document.getElementById('answer').value = ''; // 清空答案输入框
                document.getElementById('result').innerText = ''; // 清空结果显示
            });
    }

    function checkAnswer() {
        const userAnswer = document.getElementById('answer').value;

        // 向服务器验证用户答案
        fetch('api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'userAnswer=' + encodeURIComponent(userAnswer),
        })
            .then(response => response.text())
            .then(result => {
                document.getElementById('result').innerText = result;
                generateChallenge(); // 生成下一个挑战
            });
    }

    // 页面加载时生成第一个挑战
    generateChallenge();
</script>

</body>
</html>