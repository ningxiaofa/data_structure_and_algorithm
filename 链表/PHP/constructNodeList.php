<?php

require_once(__DIR__.'/ListNode.php');

/**
 * 方式一: 利用数组, 两次循环处理, 处理后的数组元素每个元素都是链表结构 ---这里不是很推荐
 * @param number $num
 * @param number|null $pos -- 有环链表的闭合点 [表示链表尾连接到链表中的位置（索引从 0 开始)]
 * @param number $random -- 是否使用随机数
 * @return ListNode
 */
function constructNodeList($num = 5, $pos = null, $random = false)
{
	$nodeArray = [];
	$i = 1;

	while($i <= $num){
		$nodeArray[] = new ListNode($random ? rand(0, $num) : $i, null);
		$i++;
	}
	// var_dump($nodeArray);

	foreach ($nodeArray as $key => $node) {
		$node->next = isset($nodeArray[$key + 1]) ? $nodeArray[$key + 1] : ($pos !== null && $pos > -1  ? $nodeArray[$pos] : null);
	}
	// var_dump($nodeArray);

	return array_shift($nodeArray);
}

/**
 * 方式二: 直接一次循环解决, 这里每个$node变量也是链表结构
 * @param lenth $num
 * @param position $pos -- 有环链表的闭合点 [表示链表尾连接到链表中的位置（索引从 0 开始)]
 * @return ListNode
 */
function constructNodeList_1($num = 5, $pos)
{
	$first = true;

	while($num > 0){
		$prevNode = $first ? null : 'node' . ($num + 1);
		$currNode = 'node' . $num;
		// 使用到可变变量 ---- 踩了个坑: object(ListNode)#1 (2) { ["val"]=> int(5) ["next"]=> NULL } empty($node5) 为true
		$tmp = $prevNode === null ? null : $$prevNode;

		$$currNode = new ListNode($num, $tmp);
		// var_dump($$currNode);
		// echo "<hr />";
		
		$first = false;
		$num--;
	}

	return $node1;
}

// var_dump(constructNodeList()); // 无环链表
// var_dump(constructNodeList(5, 0)); // 有环链表
// Out: // 有环
// object(ListNode)#1 (2) { ["val"]=> int(1) ["next"]=> object(ListNode)#2 (2) { ["val"]=> int(2) ["next"]=> object(ListNode)#3 (2) { ["val"]=> int(3) ["next"]=> object(ListNode)#4 (2) { ["val"]=> int(4) ["next"]=> object(ListNode)#5 (2) { ["val"]=> int(5) ["next"]=> *RECURSION* } } } } }

// 下面只是验证辅助

// 踩了个坑: object(ListNode)#1 (2) { ["val"]=> int(5) ["next"]=> NULL } empty($node5) 为true
// $node5 =  new ListNode(5, null);
// var_dump($node5);
// if($node5 === null){
// 	exit('stop');
// }
// $node4 =  new ListNode(4, $node5);
// $node3 =  new ListNode(3, $node4);
// $node2 =  new ListNode(2, $node3);
// $node1 =  new ListNode(1, $node2);
// var_dump($node1);

/// --------------- 踩了个大坑----------- ListNode 的定义不完整, 导致一直出现问题