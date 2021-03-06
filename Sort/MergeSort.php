<?php
/**
 * 归并排序
 * 时间复杂度：平均O(nlogn) 最坏O(nlogn) 最优O(n)
 * 空间复杂度：O(n)
 * 分治法的典型案例
 * 10000个数(0.9秒左右)
 * 比冒泡排序快32倍左右
 * 比堆排序快30倍左右
 * 比插入排序快10倍左右
 * 比php自带大根堆排序慢40倍左右
 *
 */
$m1 = memory_get_usage();
$t1 = microtime(true);
$arr = range(1,10000);
shuffle($arr);

// plan A：
function mergeSort(array $arr = []) :array
{
    $len = count($arr);
    if ($len <= 1) {
        return $arr;
    }
    // 获取一般长度
    $half = ($len >> 1) + ($len & 1);
    // 分隔数组
    $arr2p = array_chunk($arr, $half);
    $left = mergeSort($arr2p[0]);
    $right = mergeSort($arr2p[1]);
    // 只要有一个长度为0就退出循环
    while (count($left) && count($right)) {
        if ($left[0] < $right[0]) {
            // 出栈$left第一个值到$reg
            $reg[] = array_shift($left);
        }else{
            // 出栈$right第一个值到$reg
            $reg[] = array_shift($right);
        }
    }
    // 合并$reg和剩余的$left/$right
    return array_merge($reg, $left, $right);
}

mergeSort($arr);
echo "\n";
echo "耗时：" . (microtime(true)-$t1);
echo "\n";
echo "消耗内存：" . round((memory_get_usage()-$m1)/1024/1024,2)."MB";
echo "\n";
exit;
