<?php
$habitsJson = file_get_contents("habits.json");
$habits = json_decode($habitsJson, true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>День 2</title>


    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 400px;
            margin-top: 40px;
        }

        h1 {
            font-size: 34px;
            font-weight: 800;
            margin: 40px 0 30px 0;
            letter-spacing: -1px;
            background: linear-gradient(to right, #ffffff, #a1a1a1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
        }

        h1::after {
            content: ".";
            color: #2ecc71;
            -webkit-text-fill-color: #2ecc71;
        }

        .habit-card,
        .habit-crd {
            background: linear-gradient(145deg, #1e1e1e, #252525);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 24px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: transform 0.2s ease;
        }

        .habit-card {
            border-left: 5px solid #4a90e2;
        }

        .habit-crd {
            border-left: 5px solid #ff6b6b;
        }


        .habit-card:hover,
        .habit-crd:hover {
            transform: translateY(-3px);
        }

        h3 {
            margin: 0 0 15px 0;
            font-size: 18px;
            font-weight: 500;
            outline: none;
            display: inline-block;
            width: 80%;
        }

        .delete-btn {
            float: right;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: #ff6b6b;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
        }

        .delete-btn:hover {
            background: rgba(255, 107, 107, 0.2);
        }

        .days {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .day {
            display: inline-block;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background-color: #333;
            text-align: center;
            line-height: 38px;
            font-size: 13px;
            font-weight: 600;
            color: #888;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            user-select: none;
        }

        .day.active {
            background-color: #2ecc71;
            color: #fff;
            box-shadow: 0 0 15px rgba(46, 204, 113, 0.4);
            transform: scale(1.1);
        }

        .day:hover:not(.active) {
            background-color: #444;
            color: #eee;
        }

        .add-btn {
            cursor: pointer;
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            font-size: 30px;
            border: none;
            background: #2ecc71;
            color: white;
            box-shadow: 0 8px 16px rgba(46, 204, 113, 0.3);
            transition: all 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .add-btn:hover {
            transform: rotate(90deg) scale(1.1);
            background-color: #27ae60;
        }
    </style>
</head>



<body>



    <div class="container">
        <h1>Мои привычки!</h1>


        <?php foreach ($habits as $index => $habit): ?>
            <div class="habit-card" data-index="<?php echo $index; ?>">

                <button class="delete-btn">✕</button>

                <h3 contenteditable="true"><?php echo $habit['name']; ?> </h3>

                <div class="days">
                    <?php
                    $dayNames = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
                    foreach ($dayNames as $i => $dayName):
                        $isActive = isset($habit['days'][$i]) && $habit['days'][$i];
                    ?>
                        <span class="day <?php echo $isActive ? 'active' : ''; ?>">
                            <?php echo $dayName; ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php endforeach; ?>


    </div>
    <button class="add-btn">+</button>
    <script src="app.js"></script>

</body>

</html>