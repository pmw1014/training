<?php
/**
 * 冒泡排序
 * 时间复杂度：平均O(n²)、最坏O(n²)、最优O(n)
 * 空间复杂度:O(n),o(1)额外空间
 * 10000个数(35秒左右)
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
