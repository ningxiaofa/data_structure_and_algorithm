<?php

// 题目: 面试题 02.02. 返回倒数第 k 个节点 https://leetcode-cn.com/problems/kth-node-from-end-of-list-lcci/

require_once(dirname(__DIR__).'/constructNodeList.php');

class Solution {

    /**
     * @param ListNode $head
     * @param Integer $k
     * @return Integer
     */
    function kthToLast($head, $k) {
        $hand = $head;
        $i = 0;
        while ($hand != null) {
            $hand = $hand->next;
            $i++;
            if ($i > $k) {
                $head = $head->next;
            }
        }

        return $head->val;
    }

    // 快慢指针
    function kthToLast_fast_slow($head, $k){
        $first = $head;
        $second = $head;

        //第一个指针先走k步
        while ($k-- > 0) {
            $first = $first->next;
        }

        //然后两个指针在同时前进
        while ($first != null) {
            $first = $first->next;
            $second = $second->next;
        }

        return $second->val;
    }

    // 利用栈  使用数组模拟
    function kthToLast_stack($head, $k){
        $stack = [];
        //链表节点压栈
        while ($head != null) {
            array_push($stack, $head);
            // $stack.push($head);
            $head = $head->next;
        }
        //在出栈串成新的链表
        $firstNode = array_pop($stack);
        while (--$k > 0) {
            $temp = array_pop($stack);
            $temp->next = $firstNode;
            $firstNode = $temp;
        }
        return $firstNode->val;
    }
}


// 无环链表
$linkedList = constructNodeList(5);

// 开始执行算法
$solution = new Solution();
$ret_1 = $solution->kthToLast($linkedList, 2);
$ret_2 = $solution->kthToLast_fast_slow($linkedList, 2);
$ret_3 = $solution->kthToLast_stack($linkedList, 2);
print $ret_1 . "<br />";
print $ret_2 . "<br />";
print $ret_3 . "<br />";


// Out:
// 4
// 4
// 4

// Note:
// 这里是返回节点的值, 如果是返回节点, 只需要将上面的返回值改为 return $node; 而不是 return $node->val;
