<?php

// 题目: 141. 环形链表 https://leetcode-cn.com/problems/linked-list-cycle/

require_once(dirname(__DIR__).'/constructNodeList.php');

class Solution {

    /**
    * 方式一: 集合[哈希表]
    * 时间复杂度：O(N)，其中 N 为链表中节点的数目。我们恰好需要访问链表中的每一个节点。
    * 空间复杂度：O(N)，其中 N 为链表中节点的数目。我们需要将链表中的每个节点都保存在哈希表当中。
    * @param ListNode $head
    * @return Boolean
    */
    function hasCycle_set($head) {
        $set = [];
        while($head){
            if (in_array($head, $set)){
                return true;
            }else{
                array_push($set, $head);
            }

            $head = $head->next;
        }
        
        return false;
    }

    /**
     * 方法二：快慢指针
     * 时间复杂度：O(N), 其中 N 为链表中节点的数目。在最初判断快慢指针是否相遇时，slow指针走过的距离不会超过链表的总长度；随后寻找入环点时，走过的距离也不会超过链表的总长度。因此，总的执行时间为 O(N)+O(N)=O(N).
     * 空间复杂度：O(1)。我们只使用了 slow,fast,ptr\textit{slow}, \textit{fast}, \textit{ptr}slow,fast,ptr 三个指针。
     * @param LinkedList $head
     * @return boolean
     */
    public function hasCycle_fast_slow($head) {
        $fast = $slow = $head;

        while($slow && $fast && $fast->next){
            // 一次走两步
            $fast = $fast->next->next;
            // 一次走一步
            $slow = $slow->next;
            // 如果有环形, 肯定会相遇
            if($fast == $slow){
                return true;
            }
        }

        return false;
    }

    /// --------------------------------- 进阶: 返回闭合的节点或者null, 而不是boolean值
    /**
     * 方式一: 集合/哈希
     * @param ListNode $head
     * @return ListNode
     */
    public function detectCycle_set_1($head) {
        $set = [];

        while($head){
            if (in_array($head, $set)){
                return $head;
            }else{
                array_push($set, $head);
            }

            $head = $head->next;
        }
        
        return null;
    }

    /**
     * 方法二：快慢指针  ----- 下面代码有问题, 入环点并不是相遇点[相遇点是根据不同链表有变化的]
     * 时间复杂度：O(N), 其中 N 为链表中节点的数目。在最初判断快慢指针是否相遇时，slow指针走过的距离不会超过链表的总长度；随后寻找入环点时，走过的距离也不会超过链表的总长度。因此，总的执行时间为 O(N)+O(N)=O(N).
     * 空间复杂度：O(1)。我们只使用了 slow,fast,ptr\textit{slow}, \textit{fast}, \textit{ptr}slow,fast,ptr 三个指针。
     * @param LinkedList $head
     * @return boolean
     */
    public function hasCycle_fast_slow_1($head) {
        $fast = $slow = $head;

        while($slow && $fast && $fast->next){
            // 一次走两步
            $fast = $fast->next->next;
            // 一次走一步
            $slow = $slow->next;
            // 如果有环形, 肯定会相遇
            if($fast == $slow){
                return $fast;
            }
        }

        return null;
    }
}
// 无环链表
// $linkedList = constructNodeList(5);

// 有环链表
$linkedList = constructNodeList(5, 1);
// var_dump($linkedList);

// 开始执行算法
$solution = new Solution();
// $reverseLinkedList = $solution->hasCycle($linkedList);
// $listNode = $solution->detectCycle_set_1($linkedList);
$listNode = $solution->hasCycle_fast_slow_1($linkedList); // --- 相遇点在 node5,但不是入环点  object(ListNode)#5 (2) { ["val"]=> int(5) ["next"]=> object(ListNode)#2 (2) { ["val"]=> int(2) ["next"]=> object(ListNode)#3 (2) { ["val"]=> int(3) ["next"]=> object(ListNode)#4 (2) { ["val"]=> int(4) ["next"]=> *RECURSION* } } } }

// var_export($reverseLinkedList); // Warning: var_export does not handle circular references in D:\wamp\php-7.4.3-Win32-vc15-x64\public\data_structure_and_algorithm\链表\PHP\检测有环\detectCircle.php on line 60
// ListNode::__set_state(array( 'val' => 5, 'next' => ListNode::__set_state(array( 'val' => 2, 'next' => ListNode::__set_state(array( 'val' => 3, 'next' => ListNode::__set_state(array( 'val' => 4, 'next' => NULL, )), )), )), ))

// 换成var_dump()
var_dump($listNode);
