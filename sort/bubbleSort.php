<?php
/**
 * 冒泡排序
 */
$t1 = microtime(true);
$arr = range(1,1000);
shuffle($arr);
// 方法一：
function bubbleSort(array $arr = []) :array
{
    foreach ($arr as $ik => &$iv) {
        foreach ($arr as $jk => &$jv) {
            if ($iv<$jv) {
                list($iv,$jv) = [$jv,$iv];
            }
        }
        list($iv,$jv) = [$jv,$iv];
    }
    return $arr;
}


bubbleSort($arr);
echo "\n";
echo "耗时：" . (microtime(true)-$t1);
echo "\n";
exit;
