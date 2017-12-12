<?php
/**
 * 冒泡排序
 */
$t1 = microtime(true);
$arr = range(1,10000);
shuffle($arr);

// plan A：
function bubbleSort(array $arr = []) :array
{
    foreach ($arr as $ik => &$iv) {
        foreach ($arr as $jk => &$jv) {
            if ($iv<$jv) {
                list($iv,$jv) = [$jv,$iv];
            }
        }
    }
    return $arr;
}


bubbleSort($arr);
echo "\n";
echo "耗时：" . (microtime(true)-$t1);
echo "\n";
exit;
