<?php

// 题目: 206. 反转链表 https://leetcode-cn.com/problems/reverse-linked-list/

require_once(dirname(__DIR__).'/constructNodeList.php');

class Solution {

    /**
     * 方式一: 递归
     * @param ListNode $head
     * @return ListNode
     */
    public function reverseList_recursion($head) {
        // 可能没有节点或者只剩一个节点[尾节点], 递推结束条件
        if ($head == null || $head->next == null) {
            return $head;
        }

        $p = $this->reverseList_recursion($head->next);
        $head->next->next = $head;
        $head->next = null;
        return $p;
    }
    
    /**
     * 方式二: 迭代
     * @param ListNode $head
     * @return ListNode
     */
    public function reverseList_iteration($head) {
        $pre = null;
        $cur = $head;
        $temp = null;
        while($cur != null)
        {
            $temp = $cur->next;
            $cur->next = $pre;
            $pre = $cur;
            $cur = $temp;
        }
        return $pre;
    }
}

$linkedList = constructNodeList();
var_export($linkedList);

// 开始执行算法
$solution = new Solution();
$reverseLinkedList = $solution->reverseList_recursion($linkedList);
var_export($reverseLinkedList);

// 输出:
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

// ListNode::__set_state(array(
//    'val' => 5,
//    'next' => 
//   ListNode::__set_state(array(
//      'val' => 4,
//      'next' => 
//     ListNode::__set_state(array(
//        'val' => 3,
//        'next' => 
//       ListNode::__set_state(array(
//          'val' => 2,
//          'next' => 
//         ListNode::__set_state(array(
//            'val' => 1,
//            'next' => NULL,
//         )),
//       )),
//     )),
//   )),
// ))
