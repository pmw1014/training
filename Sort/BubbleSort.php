<?php
/**
 * 冒泡排序
 * 时间复杂度：平均O(n²)、最坏O(n²)、最优O(n)
 * 空间复杂度:O(n),o(1)额外空间
 * 300个数(6秒左右) 400个数（13秒左右） 500个数（20秒左右）
 * 10000个数(未知)
 */
$m1 = memory_get_usage();
$t1 = microtime(true);
$arr = range(1,500);
shuffle($arr);

// plan A：
function bubbleSort(array &$arr = [])
{
    $len = count($arr);
    foreach ($arr as $ik => &$iv) {
        foreach ($arr as $jk => $jv) {
            if (($ik+$jk) >= $len) {
                break;
            }
            if ($arr[$ik+$jk] > $iv) {
                list($iv, $arr[$ik+$jk]) = [$arr[$ik+$jk],$iv];
            }
        }
    }
}

bubbleSort($arr);
echo "\n";
echo "耗时：" . (microtime(true)-$t1);
echo "\n";
echo "消耗内存：" . round((memory_get_usage()-$m1)/1024/1024,2)."MB";
echo "\n";
exit;
