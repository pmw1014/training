<?php
/**
 * 鸡尾酒排序
 * 时间复杂度：平均O(n²)、最坏O(n²)、最优O(n)
 * 空间复杂度
 * 10000个数(2.00秒左右)
 */
$m1 = memory_get_usage();
$t1 = microtime(true);
$arr = range(1,10000);
shuffle($arr);

// plan A：
function cooktailSort(array $arr = []) :array
{
    $len = count($arr);
    if ($len <= 1) {
        return $arr;
    }

    $left_idx = 0;
    $right_idx = $len - 1;

    while ($left_idx < $right_idx) {
        for ($i = $left_idx + 1; $i <= $right_idx; $i++) {
            if ($arr[$i-1] > $arr[$i]) {
                list($arr[$i-1], $arr[$i]) = [$arr[$i], $arr[$i-1]];
            }
        }
        for ($j=$right_idx - 1; $j >= $left_idx; $j--) {
            if ($arr[$j+1] < $arr[$j]) {
                list($arr[$j], $arr[$j+1]) = [$arr[$j+1], $arr[$j]];
            }
        }
        $left_idx++;
        $right_idx--;
    }

    return $arr;
}


cooktailSort($arr);
echo "\n";
echo "耗时：" . (microtime(true)-$t1);
echo "\n";
echo "消耗内存：" . round((memory_get_usage()-$m1)/1024/1024,2)."MB";
echo "\n";
exit;
