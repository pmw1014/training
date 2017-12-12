<?php
/**
 * 测试数据库连接是否正常
 * 
 */
$conns = [
    [
        'host' => '127.0.0.1',
        'port' => '3306',
        'username' => 'root',
        'password' => 'admin',
    ],
    [
        'host' => '127.0.0.1',
        'port' => '13306',
        'username' => 'root',
        'password' => 'admin',
    ],
    [
        'host' => '127.0.0.1',
        'port' => '3306',
        'username' => 'root',
        'password' => 'admin',
    ],
];

$results = [];
foreach (conn($conns) as $res) {
    // 收集每次连接测试结果
    $results[] = $res;
}

function conn($conns){
    foreach ($conns as $row) {
        $con = @mysqli_connect($row['host'].":".$row['port'],$row['username'],$row['password']);
        if (!$con){
            // 连接不成功
            yield $row['host'] . ":" . $row['port'] . "\n";
        }else{
            // 连接成功
            mysqli_close($con);
            yield "0\n";
        }
    }
}

print_r($results);
