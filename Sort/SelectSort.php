<?php
/**
 * 选择排序
 * 时间复杂度：平均O(n²)、最坏O(n²)、最优O(n²)
 * 空间复杂度 O(n²)
 * 10000个数(34秒左右)
 */
$m1 = memory_get_usage();
$t1 = microtime(true);
$arr = range(1,10000);
shuffle($arr);

// plan A：
function selectSort(array $arr = []) :array
{
    $len = count($arr);
    if ($len <= 1) {
        return $arr;
    }

    // 从最后一个数循环到第一个数
    for ($i=$len-1; $i >= 0; $i--) {
        // 比较$i和$j 如果$arr[$j]比$arr[$i]大 则交换位置
        for ($j=$i-1; $j >= 0 ; $j--) {
            if ($arr[$i] < $arr[$j]) {
                list($arr[$i], $arr[$j]) = [$arr[$j], $arr[$i]];
            }
        }
    }

    return $arr;
}


selectSort($arr);
echo "\n";
echo "耗时：" . (microtime(true)-$t1);
echo "\n";
echo "消耗内存：" . round((memory_get_usage()-$m1)/1024/1024,2)."MB";
echo "\n";
exit;
