<?php

// 题目: 876. 链表的中间结点 https://leetcode-cn.com/problems/middle-of-the-linked-list/

require_once(dirname(__DIR__).'/constructNodeList.php');

class Solution {

    /**
     * 方式一: 快慢指针
     * 时间复杂度: O(n)
     * 空间复杂度: O(1)
     * @param ListNode $head
     * @return ListNode
     */
    public function middleNode($head) {
        $fast = $slow = $head;
        while($fast->next){ // 终止条件1: fast指针走到尾节点, 链表节点数为奇数
            // 终止条件2: fast指针走到倒数第二个节点, 链表节点数为偶数
            if($fast->next->next){
                // 快指针走两步
                $fast = $fast->next->next;
                // 慢指针走一步
                $slow = $slow->next;
            }else{
                return $slow->next;
            }
        }

        return $slow;
    }

    // 快慢指针 代码更加简洁
    //  public function middleNode($head) {
    //     $fast = $slow = $head;
    //     while($fast && $fast->next){
    //         $slow = $slow->next;
    //         $fast = $fast->next->next;
    //     }
    //     return $slow;
    // }

    /**
     * 方式二: 循环遍历
     * 时间复杂度: O(n)
     * 空间复杂度: O(1)
     * @param ListNode $head
     * @return ListNode
     */
    public function middleNode_iterate($head) {
        $tmpNode = $head;
        $i = 0;
        while($tmpNode){
            $i++;
            $tmpNode = $tmpNode->next;
        }
        
        // 奇偶数处理
        $i = $i % 2 ? ($i - 1) / 2 : ($i / 2);

        while($i--){
            $head = $head->next;
        }

        return $head;
    }
}

$linkedList_odd = constructNodeList(5);
$linkedList_even = constructNodeList(8);
var_dump($linkedList_odd);
print "<hr/>";
var_dump($linkedList_even);
print "<hr/>";

// 开始执行算法
$solution = new Solution();
// 方式一:
// $reverseLinkedList = $solution->middleNode($linkedList_odd);
// var_dump($reverseLinkedList);
// print "<hr/>";
// $reverseLinkedList = $solution->middleNode($linkedList_even);
// var_dump($reverseLinkedList);

// 方式二:
$reverseLinkedList = $solution->middleNode_iterate($linkedList_odd);
var_dump($reverseLinkedList);
print "<hr/>";
$reverseLinkedList = $solution->middleNode_iterate($linkedList_even);
var_dump($reverseLinkedList);
