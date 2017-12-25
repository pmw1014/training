<?php
/**
 * 希尔排序
 * 时间复杂度：平均、最坏O(nlog²n)、最优O(n)
 * 空间复杂度 O(n)
 * 10000个数(0.30秒左右)
 */
$m1 = memory_get_usage();
$t1 = microtime(true);
$arr = range(1,10000);
shuffle($arr);

// plan A：
function shellSort(array $arr = []) :array
{
    $len = count($arr);
    if ($len <= 1) {
        return $arr;
    }

    // 将当前数组循环取步长
    for ($step=($len>>1); $step > 0; $step = ($step>>1)) {
        // 根据步长累加循环
        for ($i=$step; $i < $len ; $i++) {
            // 循环根据当前步长对比上一个步长，并交换位置
            for ($j=$i-$step; $j >= 0 && $arr[$j+$step] < $arr[$j] ; $j-= $step) {
                list($arr[$j],$arr[$j+$step]) = [$arr[$j+$step], $arr[$j]];
            }
        }
    }

    return $arr;
}


shellSort($arr);
echo "\n";
echo "耗时：" . (microtime(true)-$t1);
echo "\n";
echo "消耗内存：" . round((memory_get_usage()-$m1)/1024/1024,2)."MB";
echo "\n";
exit;
