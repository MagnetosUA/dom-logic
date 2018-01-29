<?php

//include 'OWNet.php';
require_once 'OWNet.php';


$host = "127.0.0.1";
$user = "root";
$password = "12345";
$database = "dom-logic";


$link = mysqli_connect($host, $user, $password, $database);
$link->set_charset('utf8');

if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Соединение с MySQL установлено!" . PHP_EOL;
echo "Информация о сервере: " . mysqli_get_host_info($link) . PHP_EOL;

$set = [];
function getStatus($link) {
    global $set;
    $settings = $link->query("SELECT * FROM `settings`");
    while ($row = $settings->fetch_assoc()) {
        $set['status'] = $row['status'];
        $set['time'] = $row['time'];
    }
    $settings->close();
    return $set;
}

while(1) {
    if (getStatus($link)['status'] == 1) {
        $query = "SELECT `personal_id` FROM `device` WHERE `type`='Sensor'";
        $result_set = $link->query($query);
        $device = [];
        while ($row = $result_set->fetch_assoc()) {
            $device[] = $row['personal_id'];
        }
        $result_set->close();
        $sensorId = $device[0];
        $ow = new \MagnetosCompany\MainBundle\Daemon\OWNet("tcp://127.0.0.1:4304");

        while (getStatus($link)['status'] == 1) {
            if ($value = $ow->read($device[0]."/temperature") == 0) {
                continue;
            }
            $value = $ow->read($device[0]."/temperature");
            echo $value = $ow->read($device[0]."/temperature");
            echo "\n";
            $query = "INSERT INTO `sensor_value` (`reading`, `sensor_id`) VALUES ('$value', '$sensorId')";
            if ($link->query($query)) {
                echo 'yes';
            };
            sleep($set['time']);
        }
    } else {
         echo 'status 0';
    }
    sleep(5);
}
mysqli_close($link);
?>
