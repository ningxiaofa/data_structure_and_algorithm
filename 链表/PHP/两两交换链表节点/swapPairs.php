<?php

// 题目: 24. 两两交换链表中的节点 https://leetcode-cn.com/problems/swap-nodes-in-pairs/

require_once(dirname(__DIR__).'/constructNodeList.php');

class Solution {
    /**
     * 方式一: 只是改变节点的值
     * @param ListNode $head
     * @return ListNode
     */
    public function swapPairs_1($head) {
    	$oldLinkedList = $head; // 这里一定要记录下, 原来的链表[这里踩了坑, 后面直接返回的是$head节点, 最后才想明白, $head节点一直在变化, 不再是原来的链表]
        while($head && $head->next){
            $tmpValue = $head->val;
            $head->val = $head->next->val;
            $head->next->val = $tmpValue;
            if(!$head->next->next){
                return $oldLinkedList;
            }
            $head = $head->next->next;
            var_export($head); // 仅仅为了更加了解循环过程
        }
        return $oldLinkedList;
    }

    /**方式二[进阶] --- 递归
     * @param ListNode $head
     * @return ListNode
     */
    public function swapPairs_2($head) {
        // 第一步找到中止条件
        if($head == null || $head->next == null){
            return $head;
        }

        // 递归代码 [科学归纳法] 写出最简单情况[一个单元, k=1]下实现
        $newHead = $head->next;
        $head->next = $this->swapPairs_2($newHead->next);
        $newHead->next = $head;
        return $newHead;
    }

    /**方式三[进阶] -- 迭代 [即循环方式]
     * @param ListNode $head
     * @return ListNode
     */
    public function swapPairs_3($head) {
        // 构造一个空节点
        $dummyHead = new ListNode(0);
        $dummyHead->next = $head;
        $temp = $dummyHead;
        while ($temp->next != null && $temp->next->next != null) {
            // 先取值
            $node1 = $temp->next;
            $node2 = $temp->next->next;

            // 更新指针
            $temp->next = $node2;
            $node1->next = $node2->next;
            $node2->next = $node1;

            // 更新循环条件
            $temp = $node1;
        }
        //返回空节点之后的节点
        return $dummyHead->next;
    }
}

$linkedList = constructNodeList();
var_dump($linkedList);

// 开始执行算法
$solution = new Solution();
$reverseLinkedList = $solution->swapPairs_2($linkedList);
var_export($reverseLinkedList);

// 输出结果:
// ListNode::__set_state(array(
//    'val' => 1,
//    'next' => 
//   ListNode::__set_state(array(
//      'val' => 2,
//      'next' => 
//     ListNode::__set_state(array(
//        'val' => 3,
//        'next' => 
//       ListNode::__set_state(array(
//          'val' => 4,
//          'next' => 
//         ListNode::__set_state(array(
//            'val' => 5,
//            'next' => NULL,
//         )),
//       )),
//     )),
//   )),
// ))
// //  循环执行 -- 开始
// ListNode::__set_state(array(
//    'val' => 3,
//    'next' => 
//   ListNode::__set_state(array(
//      'val' => 4,
//      'next' => 
//     ListNode::__set_state(array(
//        'val' => 5,
//        'next' => NULL,
//     )),
//   )),
// ))

// ListNode::__set_state(array(
//    'val' => 5,
//    'next' => NULL,
// ))

// //  循环执行 -- 结束
// ListNode::__set_state(array(
//    'val' => 2,
//    'next' => 
//   ListNode::__set_state(array(
//      'val' => 1,
//      'next' => 
//     ListNode::__set_state(array(
//        'val' => 4,
//        'next' => 
//       ListNode::__set_state(array(
//          'val' => 3,
//          'next' => 
//         ListNode::__set_state(array(
//            'val' => 5,
//            'next' => NULL,
//         )),
//       )),
//     )),
//   )),
// ))
