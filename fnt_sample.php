<?php
require 'crud.php';

function createInstance() {
    $connection = Connection::getInstance();
    return $connection;
}

function getData($logUser, $logPass) {
    $instance = createInstance();
    $table = 'usuarios';
    $param = 'name_user = "'.$logUser.'" && pass_user = "'.$logPass.'"';

    $result = $instance->readSQL($table, $param);
    $instance->closeConnection();

    if ($result) {
        print_r($result);
    } else {
        echo 'maaal';
    }
}

getData('albert', '12345');
?>