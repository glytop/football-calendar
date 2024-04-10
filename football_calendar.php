<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>FootballSheet</title>
</head>
<body>
<div class="pane-container">
    <?php

    $teams = ["Ливерпуль", "Челси", "Тоттенхэм Хотспур", "Арсенал", "Манчестер Юнайтед", "Эвертон", "Лестер Сити", "Вест Хэм Юнайтед", "Уотфорд", "Борнмут", "Бернли", "Саутгемптон", "Брайтон энд Хоув Альбион", "Норвич Сити", "Шеффилд Юнайтед", "Фулхэм", "Сток Сити", "Мидлсбро", "Суонси Сити", "Дерби Каунти"];

    $num_teams = count($teams);

    shuffle($teams);

    $calendar = [];
    // Генерация календаря для первого и второго круга
    for ($round = 1; $round <= $num_teams * 2 - 2; $round++) {
        $calendar[$round] = [];

        for ($i = 0; $i < $num_teams / 2; $i++) {
            $home = ($round + $i) % ($num_teams - 1);
            $away = ($num_teams - 1 - $i + $round) % ($num_teams - 1);
            // Для предотвращения игры команды с самой собой
            if ($home == $away) {
                $away = $num_teams - 1;
            }
            // Добавляем матч в расписание
            $calendar[$round][] = [$teams[$home], $teams[$away]];
        }

        // После 19-го тура (первого круга) меняем команды местами для второго круга
        if ($round == $num_teams - 1) {
            for ($j = 0; $j < $num_teams - 1; $j++) {
                $calendar[$round + 1 + $j] = [];
                foreach ($calendar[1 + $j] as $match) {
                    // Меняем местами домашнюю и гостевую команды
                    $calendar[$round + 1 + $j][] = [$match[1], $match[0]];
                }
            }
            // Прерываем цикл, так как календарь второго круга уже сформирован
            break;
        }
    }

    foreach ($calendar as $round => $matches) {
        echo <<<HEADER
        <div class='pane'>
            <h3>Тур $round</h3>
            <div class='header'>
                 <div class="shell">Хозяева</div>
                 <div class="shell">Счёт</div>
                 <div class="shell">Гости</div>
            </div>
        HEADER;
        foreach ($matches as $match) {
            $team1 = $match[0];
            $team2 = $match[1];
            $count1 = rand(0, 3);
            $count2 = rand(0, 3);
            while ($count1 == 0 && $count2 == 0) {
                $count1 = rand(0, 3);
                $count2 = rand(0, 3);
            }

            echo <<<ROW
            <div class='row'>
                <div class='skin'>$team1</div>
                <div class='score'><span class='lCount'>$count1</span> &nbsp:&nbsp <span class='rCount'>$count2</span></div>
                <div class='skin'>$team2</div>
            </div>
            ROW;
        }
        echo "</div>";
    }

    ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
