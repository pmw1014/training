<?php
/**
 * 插入排序
 * 时间复杂度：平均O(n²)、最坏O(n²)、最优O(n²)
 * 空间复杂度: O(n),需要辅助空间O(1)
 * 10000个数(13秒左右)
 * 较冒泡排序要快2倍左右
 * 比堆排序快2倍左右
 * 较php自带堆排序慢500倍左右
 */
$t1 = microtime(true);
$arr = range(1,10000);
shuffle($arr);

// plan A：
function insertSort(array $arr = []) :array
{
    $list = [];
    $arr_size = count($arr);
    for ($i = 1; $i < $arr_size; $i++) {
        // 抽取当前值
        $temp = $arr[$i];
        //循环比$temp小的值，如果$j大于$temp，就将$arr[$j]与$arr[$j+1]位置交换，并$j--
        for ( $j = $i - 1; $j >= 0 && $arr[$j] > $temp; $j-- ) {
            $arr[$j + 1] = $arr[$j];
        }
        // 将$temp放置到循环终止的位置$arr[$j]上
        $arr[$j + 1] = $temp;
    }
    return $arr;
}


insertSort($arr);
echo "\n";
echo "耗时：" . (microtime(true)-$t1);
echo "\n";
exit;
