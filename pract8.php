<?php
session_start();
?>

<!-- Задание 1: Запись и чтение чисел из сессии -->
<div>
    <h3>Задание 1</h3>
    <?php
    $_SESSION['number1'] = 400;
    $_SESSION['number2'] = 280;
    echo "Числа записаны в сессию.";
    ?>
</div>

<div>
    <h3>Проверка суммы чисел</h3>
    <?php
    if (isset($_SESSION['number1']) && isset($_SESSION['number2'])) {
        $sum = $_SESSION['number1'] + $_SESSION['number2'];
        echo "Сумма чисел из сессии: " . $sum;
    } else {
        echo "Числа не найдены в сессии. Сначала запустите соответствующий файл.";
    }
    ?>
</div>
<hr>

<!-- Задание 2: Сколько прошло секунд с момента захода на сайт -->
<div>
    <h3>Задание 2</h3>
    <div id="time-elapsed">
        <?php
        if (!isset($_SESSION['start_time'])) {
            $_SESSION['start_time'] = time();
            echo "Вы только что зашли на сайт.";
        } else {
            $elapsed_time = time() - $_SESSION['start_time'];
            echo "Вы пришли на сайт <span id='elapsed-time'>" . $elapsed_time . "</span> секунд назад.";
        }
        ?>
    </div>
</div>
<script>
    // Обновление времени каждую секунду
    setInterval(function() {
        var elapsedTimeElement = document.getElementById('elapsed-time');
        var elapsedTime = parseInt(elapsedTimeElement.innerText) + 1;
        elapsedTimeElement.innerText = elapsedTime;
    }, 1000);
</script>
<hr>

<!-- Задание 3: Кликер -->
<div>
    <h3>Задание 3</h3>
    <?php
    if (isset($_POST['click'])) {
        if (!isset($_SESSION['counter'])) {
            $_SESSION['counter'] = 0;
        }
        $_SESSION['counter']++;
        if ($_SESSION['counter'] >= 10) {
            $_SESSION['counter'] = 0;
        }
    }
    ?>
    <form method="post">
        <input type="submit" name="click" value="Клик!">
        <p>Счетчик: <?= isset($_SESSION['counter']) ? $_SESSION['counter'] : 0 ?></p>
    </form>
</div>
<hr>

<!-- Задание 4: Завершение сессии -->
<div>
    <h3>Задание 4</h3>
    <p><a href="?logout=1">Завершить сессию</a></p>
    <?php
    if (isset($_GET['logout'])) {
        session_destroy();
        echo "Сессия завершена.";
        exit;
    }
    ?>
</div>
<hr>

<!-- Задание 5: Форма ввода данных пользователя -->
<div>
    <h3>Задание 5</h3>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_data'])) {
        $_SESSION['user_data'] = [
            'surname' => $_POST['surname'],
            'name' => $_POST['name'],
            'age' => $_POST['age']
        ];
    }
    ?>
    <form method="post">
        Фамилия: <input type="text" name="surname" required><br>
        Имя: <input type="text" name="name" required><br>
        Возраст: <input type="number" name="age" required><br>
        <input type="submit" name="user_data" value="Отправить">
    </form>
</div>
<hr>

<!-- Задание 6: Отображение данных -->
<div>
    <h3>Задание 6</h3>
    <?php
    if (isset($_SESSION['user_data'])) {
        echo "<h4>Данные пользователя</h4><ul>";
        foreach ($_SESSION['user_data'] as $key => $value) {
            echo "<li>" . htmlspecialchars($key) . ": " . htmlspecialchars($value) . "</li>";
        }
        echo "</ul>";
    }
    ?>
</div>
