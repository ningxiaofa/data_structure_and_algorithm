<?php

// 题目: 19. 删除链表的倒数第 N 个结点 https://leetcode-cn.com/problems/remove-nth-node-from-end-of-list/
// 参看题解: https://leetcode-cn.com/problems/remove-nth-node-from-end-of-list/solution/shan-chu-lian-biao-de-dao-shu-di-nge-jie-dian-b-61/

require_once(dirname(__DIR__).'/constructNodeList.php');

class Solution {
    /**
     * 快慢指针 --------------- 该解法依然有问题, 不能满足所有的测试用例
     * @param ListNode $head
     * @param int $n
     * @return ListNode
     */
    function removeNthFromEnd($head, $n) {
        $firstNode = new ListNode(-1); 
        $firstNode->next = $head;
        // // 边界问题1:只有一个节点
        // if(!$head->next){
        //     return null;
        // }
// var_dump($firstNode);
// exit;
        $fast = $slow = $firstNode;
        
        // 快指针先走k步
        while($n-- >= 0){
            $fast = $fast->next;
        }
        // var_dump($fast);
        // exit;

        // 边界问题2: 缺少头节点, 使用哨兵机制, 应该用在最上面
        // $firstNode = new ListNode(-1); 
        // $firstNode->next = $slow;
        
        // 快慢指针同时走
        while($fast){
            $fast = $fast->next;
            $slow = $slow->next;
        }
        // var_dump($slow);
        // exit;
        // 当快指针到达为尾节点时, 将此时的slow的next节点指针指向slow的下下个节点[即删除原来的slow->next节点]
        $slow->next = $slow->next->next;

        return $firstNode->next;
    }

    // 调试上面的代码数次, 才通过测试
    public function removeNthFromEnd_lastest($head, $n) {
        // 边界问题: 哨兵机制 ---> 将特殊情况转化为正常情况, 使得可统一处理
        $firstNode = new ListNode(-1); 
        $firstNode->next = $head;
        $fast = $slow = $firstNode;
        
        // 快指针先走k步
        while($n-- >= 0){
            $fast = $fast->next;
        }
        
        // 快慢指针同时走
        while($fast){
            $fast = $fast->next;
            $slow = $slow->next;
        }
      
        // 当快指针到达为尾节点时, 将此时的slow的next节点指针指向slow的下下个节点[即删除原来的slow->next节点]
        $slow->next = $slow->next->next;

        return $firstNode->next;
    }
}

$solution = new Solution();
// 测试用例
// [1,2,3,4,5]
// 2
$list = constructNodeList(5);
$ret = $solution->removeNthFromEnd_lastest($list, 2);
var_export($ret);
print "<hr/>";

// 边界问题: 只有一个节点
// 测试用例
// [1]
// 1
$list = constructNodeList(1); 
$ret = $solution->removeNthFromEnd_lastest($list, 1);
var_export($ret);
print "<hr/>";

 // 边界问题: 只有两个节点
 // 测试用例
//  [1,2]
//  2
$list = constructNodeList(2);
$ret = $solution->removeNthFromEnd_lastest($list, 2);
var_export($ret);
print "<hr/>";

// Out:
// ListNode::__set_state(array( 'val' => 1, 'next' => ListNode::__set_state(array( 'val' => 2, 'next' => ListNode::__set_state(array( 'val' => 3, 'next' => ListNode::__set_state(array( 'val' => 5, 'next' => NULL, )), )), )), ))  // 删除元素4

// NULL  // 删除唯一的元素1

// ListNode::__set_state(array( 'val' => 2, 'next' => NULL, ))  // 删除元素1, 剩下元素2
