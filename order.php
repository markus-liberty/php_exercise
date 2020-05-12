<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <form action="action.php" method="post">
    <label for="name">ФИО:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="phone">Телефон:</label><br>
        <input type="text" id="phone" name="phone">
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email">
        <label for="address">Адрес доставки:</label><br>
        <input type="text" id="address" name="address">
        <label for="date">Дата доставки:</label><br>
        <input type="date" id="order" name="order-date" value=<?php echo date('y-m-d');?> min="<?php ?>">
        <label for="time">Время доставки:</label><br>
        <input type="time" name="order-time" min="07:00" max="21:00" step="600">
        <input type="submit" value="Send Form">
    </form>
</body>
</html>