<?php
/**
 * 插入排序
 * 此方法较冒泡排序要快4倍，比堆排序快2倍
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
