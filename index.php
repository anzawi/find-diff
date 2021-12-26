<?php
require_once 'vendor/autoload.php';
$action = new \Anzawi\App\Action();

if ($_GET && isset($_GET['first_string']) && isset($_GET['second_string'])) {
    $data = $_GET;
    $action->set($_GET['first_string'], $_GET['second_string']);

    if ($action->validate()) {
        $action->run();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php if ($action->errors()): ?>
<p style="background-color: #ffcccc; color: red">
    all fields are required!
</p>
<?php endif; ?>
<form action="/" method="get">
    <label>
        First string
        <input type="text" maxlength="255" name="first_string" value="<?php echo $action->getFirstString() ?>">
    </label>
    <label>
        Second string
        <input type="text" maxlength="255" name="second_string" value="<?php echo $action->getSecondString()?>">
    </label>

    <button type="submit">Calculate</button>
</form>
<?php if($action->isSubmitted() === true): ?>
    <div style="padding: 10px">
        <div>
            <table style="border: 2px solid;">
                <tr>
                    <?php foreach ($action->getDiff() as $item): ?>
                        <td><?php echo $item; ?></td>
                    <?php endforeach; ?>
                </tr>
            </table>
        </div>

        <span>Levenshtein Distance: <?php echo $action->getLevenshtein() ?></span>
        <br>
        <span>Hamming Distance: <?php echo $action->getHamming() ?></span>
    </div>
<?php endif; ?>
</body>
</html>
