<?php
/**
 * 堆排序（分大顶堆，小顶堆）
 * 时间复杂度：平均O(nlogn)、最坏O(mlogn)、最优O(nlogn)
 * 空间复杂度:O(n),o(1)额外空间
 * 求升序用大根堆，求降序用小根堆
 */
$m1 = memory_get_usage();
$t1 = microtime(true);
$arr = range(1,10000);
shuffle($arr);

// plan A
/**
 * 10000个数(33秒左右)
 * 循环数组大小次数，每次循环得出最大/小值，
 * 并与当前数组长度的最后一个值交换位置，
 * 每次循环都是锁定一个最大/小值的过程
 * 参考资料：
 * https://www.cnblogs.com/zhenbianshu/p/5273995.html】
 */
function heapSortA(array $arr) :array
{
    $arrSize=count($arr);
    for($i=$arrSize;$i>0;$i--){
        buildHeap($arr,$i);
    }
    return $arr;
}

// 这里是大根堆的算法
function buildHeap(&$arr,$arrSize){
    //从当前最后一个父节点开始循环
    for($index=intval($arrSize/2)-1; $index>=0; $index--){
        //如果有左节点,将其下标存进最小值$min
        if($index*2+1<$arrSize){
            $min=$index*2+1;
            //如果有右子结点,则比较左右结点的大小,更新最小值$min
            if($index*2+2<$arrSize){
                if($arr[$index*2+2]<$arr[$min]){
                    $min=$index*2+2;
                }
            }
            //将当前树子结点中较小的和父结点比较,若子结点较小,则父结点交换位置
            if($arr[$min]<$arr[$index]){
                list($arr[$min], $arr[$index]) = [$arr[$index], $arr[$min]];
            }
        }
    }
    // 循环完毕，将顶点与最小值$min交换位置
    if (isset($min)) {
        list($arr[$arrSize-1], $arr[0]) = [$arr[0], $arr[$arrSize-1]];
    }
}


// plan B
/*
 * php自带大根堆函数(实测比plan A快1000倍左右)
 * 10000个数(0.028秒左右)
 */
function heapSortB(array $arr)
{
    $obj = new SplMaxHeap();
    foreach ($arr as &$row) {
        $obj->insert($row);
    }
    return $obj;
}

// plan C
/**
 * 10000个数(0.75秒左右)
 */
function heapSortC(&$arr) {
 	$len = count($arr);
    // 从第一个父节点开始，循环出大根堆（顺序排序用大根堆，逆序排序就用小根堆）
 	for ($i = ($len >> 1) - 1; $i >= 0; $i--){
 		max_heapify($arr, $i, $len);
    }
 	// 循环取$arr[$i]值与$arr[0]值交换位置,然后开始建立$arr[0~$i]的大根堆
 	// 即从$arr最后一位开始确认数组的最终排序
 	for ($i = $len - 1; $i > 0; $i--) {
 		swap($arr[0], $arr[$i]);
 		max_heapify($arr, 0, $i);
 	}
 	return $arr;
}
/**
 * 获取大根堆
 * @brief  [description]
 * @author zicai
 * @date   2017-12-15T14:39:50+080
 *
 * @param  array                   &$arr    [目标数组]
 * @param  int                     $parent  [父节点下标]
 * @param  int                     $end     [总长度]
 */
function max_heapify(array &$arr, int $parent, int $end) {
	$child = $parent * 2 + 1;//左子节点下标
	if ($child >= $end){
    	return;
    }
    // 比较两子节点，设置$child为最小者
	if ($child + 1 < $end && $arr[$child] < $arr[$child + 1]){
        $child++;
    }
    //如果父节点小于$child节点则交换两者位置，并继续求$child节点下的大根堆
	if ($arr[$parent] <= $arr[$child]) {
		swap($arr[$parent], $arr[$child]);
		max_heapify($arr, $child, $end);
	}
}
function swap(&$x, &$y) {
	list($x, $y) = [$y, $x];
}



// heapSortA($arr);
// heapSortB($arr);
heapSortC($arr);

echo "\n";
echo "耗时：" . (microtime(true)-$t1);
echo "\n";
echo "消耗内存：" . round((memory_get_usage()-$m1)/1024/1024,2)."MB";
echo "\n";
exit;
