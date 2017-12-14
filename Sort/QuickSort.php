<?php
/**
 * 快速排序
 * 时间复杂度：平均O(nlogn)、最坏情况下O(n²)
 * 分治法的典型案例
 * 10000个数(0.18秒左右)
 * 比归并排序快4倍左右
 * 比php自带大根堆排序慢10倍左右
 */
$t1 = microtime(true);
$arr = range(1,10000);
shuffle($arr);
// plan A：
function quickSort(array $arr = []) :array
{
    $len = count($arr);
    if ($len <= 1) {
        return $arr;
    }

    $left = $right = [];
    $mid_value = $arr[0];

    for ($i=0; $i < $len; $i++) {
        if ($arr[$i] == $mid_value) {
            continue;
        }
        if ($arr[$i] < $mid_value) {
            $left[] = $arr[$i];
        }else{
            $right[] = $arr[$i];
        }
    }

    return array_merge(quickSort($left), (array)$mid_value, quickSort($right));
}


quickSort($arr);
echo "\n";
echo "耗时：" . (microtime(true)-$t1);
echo "\n";
exit;
