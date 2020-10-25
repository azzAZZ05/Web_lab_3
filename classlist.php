<?php require_once (__DIR__.'/php/functions.php');?>
<!doctype html>
<html lang="ru">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>Сайт ноунейм школы</title>
</head>
<body>
<h1 class="sch_name">School name</h1>
<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Главная</a>
    <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="teachlist.php">Учительский состав</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="classlist.php">Список классов</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="schedule.php">Расписание</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="journal.php">Журнал</a>
            </li>
        </ul>
        <?php session_start();
        if (isset($_SESSION['user'])): ?>
            <a class="text-white">Здравствуйте, <?php echo $_SESSION['user'] ?>.</a>
            <a type="button" class="deauth" href="php/exit.php">Выход</a>
        <?php else: ?>
            <a type="button" href="journal.php" class="btn btn-primary">Авторизация</a>
        <?php endif ?>
    </div>
</nav>
<form class="select_class" action="/php/list.php" method="post">
    <div class="input-group">
        <div class="input-group-prepend">
            <label class="input-group-text">Класс</label>
        </div>
        <select class="custom-select" name="number">
            <option></option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
        </select>
    </div>
    <div class="input-group">
        <div class="input-group-prepend">
            <label class="input-group-text">Буква</label>
        </div>
        <select class="custom-select" name="letter">
            <option></option>
            <option value="1">А</option>
            <option value="2">Б</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Показать</button>
</form>
<?php
if (isset($_SESSION['class'])) {
    $class = explode('|',$_SESSION['class']);
    $result = sql_connect('classlists', $class[0], $class[1]);
    if ($result->num_rows == 0):
        ?>
        <div class="alert alert-danger" role="alert">
            <?php echo "Ошибка: класс не найден"; unset($_SESSION['class']);?>
        </div>
    <?php endif;
}
if (isset($_SESSION['class'])):?>
<?php $row = mysqli_fetch_array($result);?>
    <div class="alert alert-primary klassruk" role="alert">Классный руководитель: <?=$row[3]?></div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col" class="num">#</th>
            <th scope="col" >Фамилия Имя Отчество</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td><?=$row[2]?></td>
        </tr>
        <?php
        $i = 2;
        while ($row = mysqli_fetch_array($result)) {
            echo "  <tr>
  <th scope=\"row\">$i</th>
  <td>$row[2]</td>
</tr>";
            $i++;
        }
        unset($_SESSION['class']);
        ?>
        </tbody>
    </table>
<?php endif; ?>
<div class="card border-dark fixed-bottom">
    <div class="card-body">
        <h5 class="card-title">Контактная информация:</h5>
        <p>Номер: 8 800 555 35 35</br>
            Адрес: ул.Пушкина дом колотушкина</p>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
</body>

</html>