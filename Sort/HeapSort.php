<?php
/**
 * 堆排序（分大顶堆，小顶堆）
 * 求升序用大根堆，求降序用小根堆
 */
$t1 = microtime(true);
$arr = range(1,10000);
shuffle($arr);


// plan A
/**
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
// php自带大根堆函数(实测比plan A快1000倍左右)
function heapSortB(array $arr)
{
    $obj = new SplMaxHeap();
    foreach ($arr as &$row) {
        $obj->insert($row);
    }
    return $obj;
}

heapSortA($arr);
// heapSortB($arr);
echo "\n";
echo "耗时：" . (microtime(true)-$t1);
echo "\n";
exit;
