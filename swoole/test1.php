<?php
$http = new swoole_http_server('0.0.0.0', 11300);

$http->set([
    'reactor_num'   => 2, //设置最大线程数
    'worker_num'    => 4, //worker进程数
    'daemonize'     => 1, //1 开启守护进程
    'dispatch_mode' => 3, //1 worker进程数数据包分配模式 3代表抢占模式
    'max_request'   => 0, //设置处理多少次请求后结束并重设一个worker
    'log_file'      => '/var/log/swoole.log', // 设置swoole log文件
    'chroot'        => '/usr/www/train/swoole/', // 指定根目录

    // 指定用户组和用户 设置后不可用命令控制swoole开启与关闭
    'user'          => 'www-data', // 指定启动用户
    'group'         => 'www-data', // 指定启动用户组

]);

$http->on('request', function ($request, $response) use ($http) {
    $db = new swoole_mysql;
    $db_server = [
        'host' => '127.0.0.1',
        'port' => 3306,
        'user' => 'root',
        'password' => 'admin',
        'database' => 'blog',
        'charset'  => 'utf8'
    ];
    $r = true;
    $db->connect($db_server, function($db, $r){
        if ( $r === false ) {
            var_dump($db->connect_errno, $db->connect_error);
            die;
        }

        $sql = 'show tables';
        $db->query($sql, function(swoole_mysql $db, $r){
            if ($r === false) {
                var_dump($db->error, $db->errno);
            }else if($r === true){
                var_dump($db->affected_rows, $db->insert_id);
            }
            var_dump($r);
            $db->close();
        });
    });

    $response->header("Content-Type", "text/html; charset=urf-8");
    // $response->end(phpinfo(4));
    var_dump($request->get, $request->post);
    $get = $request->get;
    $post = $request->post;
    if (isset($post['sig']) && $post['sig'] === 'restart' ) {
        $response->end("<h1>restart now</h1>");
        $http->reload();
    }
    if (isset($post['sig']) && $post['sig'] === 'shutdown' ) {
        $http->shutdown();
    }
});

$http->on('WorkerStart', function($http, $workerId) {
    var_dump(get_included_files()); //此数组中的文件表示进程启动前就加载了，所以无法reload
});

$http->start();
