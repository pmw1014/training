<?php
/**
 * 快速排序
 * 时间复杂度：平均O(nlogn)、最坏O(n²),最优O(nlogn)
 * 空间复杂度 不定
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
    //获取当前数组的第一个值当中间值
    $mid_value = $arr[0];

    //循环当前数组的每一个值
    for ($i=0; $i < $len; $i++) {
        if ($arr[$i] == $mid_value) {
            continue;
        }
        if ($arr[$i] < $mid_value) {
            // 如果$arr[$i]小于中间值 则将$arr[$i]存入$left
            $left[] = $arr[$i];
        }else{
            // 不然将$arr[$i]存入$right
            $right[] = $arr[$i];
        }
    }
    // 返回$left、$mid_value、$right合并后的数组（此时这个数组已将当前数组排序完成）
    return array_merge(quickSort($left), (array)$mid_value, quickSort($right));
}


quickSort($arr);
echo "\n";
echo "耗时：" . (microtime(true)-$t1);
echo "\n";
exit;
