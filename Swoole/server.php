<?php

$http = new swoole_http_server('swoole.local.zicai.com', 11300,SWOOLE_BASE);

define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');

$http->set([
    'reactor_num'   => 4, //设置最大线程数
    'worker_num'    => 6, //worker进程数
    'daemonize'     => 1, //1 开启守护进程
    'dispatch_mode' => 3, //1 worker进程数数据包分配模式 3代表抢占模式
    'max_request'   => 0, //设置处理多少次请求后结束并重设一个worker
    'chroot'        => BASE_PATH.'/', // 指定根目录
    'log_file'      => BASE_PATH.'/runtime/logs/swoole.log', // 设置swoole log文件
    // 'log_level'     => 3,//范围是0-5

    // 指定用户组和用户 设置后不可用命令控制swoole开启与关闭
    // 'user'          => 'www-data', // 指定启动用户
    // 'group'         => 'www-data', // 指定启动用户组

]);

function onRequest($request, swoole_http_response $response)
{
    try {
        $app = new \Phalcon\Mvc\Micro();

        $app->get(
            "/",
            function () use ($request) {
                $res = json_encode($request)."<h1>Welcome phalcon!</h1>";
                $res .= $request->server['path_info'];
                return $res;
            }
        );

        $app->get(
            '/api/{name}',
            function ($name) use ($app) {
                return $name.' welcome.';
            }
        );
        
        $app->notFound(function () {
            return abort(404);
        });

        $res = $app->handle($request->server['path_info']);
        is_string($res) ?
            $response->end($res) :
            $response->end();

    } catch (\Exception $e) {
        echo $e->getMessage().PHP_EOL;
        echo $e->getTraceAsString().PHP_EOL;
    }
}

$http->on('request', 'onRequest');

$http->on('WorkerStart', function($http, $workerId) {

    var_dump(get_included_files()); //此数组中的文件表示进程启动前就加载了，所以无法reload
});

$http->start();
