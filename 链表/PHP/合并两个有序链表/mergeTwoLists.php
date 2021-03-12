<?php

//题目: 21. 合并两个有序链表 https://leetcode-cn.com/problems/merge-two-sorted-lists

require_once(dirname(__DIR__).'/constructNodeList.php');

class Solution {

    /** 递归 ---- 类比于科学归纳法
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    public function mergeTwoLists_recursive($l1, $l2) {
       if($l1 == null) {
            return $l2;
        }
        if($l2 == null) {
            return $l1;
        }

        if($l1->val < $l2->val) {
            $l1->next = $this->mergeTwoLists_recursive($l1->next, $l2);
            return $l1;
        } else {
            $l2->next = $this->mergeTwoLists_recursive($l1, $l2->next);
            return $l2;
        }
    }

    // 迭代
    public function mergeTwoLists_iterate($l1, $l2) {
       $prehead = new ListNode(-1);

        $prev = $prehead;
        while ($l1 != null && $l2 != null) {
            if ($l1->val <= $l2->val) {
                $prev->next = $l1;
                $l1 = $l1->next;
            } else {
                $prev->next = $l2;
                $l2 = $l2->next;
            }
            $prev = $prev->next;
        }

        // 合并后 $l1 和 $l2 最多只有一个还未被合并完，我们直接将链表末尾指向未合并完的链表即可
        $prev->next = $l1 == null ? $l2 : $l1;

        return $prehead->next;
    }
    // 解题思路： https://leetcode-cn.com/problems/merge-two-sorted-lists/solution/hua-jie-suan-fa-21-he-bing-liang-ge-you-xu-lian-bi/  说的很清楚
}

$list1 = constructNodeList();
$list2 = constructNodeList();
var_export($list1);
print "<hr/>";

$solution = new Solution();
$ret = $solution->mergeTwoLists_recursive($list1, $list2);
// $ret1 = $solution->mergeTwoLists_iterate($list1, $list2);

var_export($ret);
// print "<hr/>";
// var_export($ret1);


// Out:
// ListNode::__set_state(array( 'val' => 1, 'next' => ListNode::__set_state(array( 'val' => 2, 'next' => ListNode::__set_state(array( 'val' => 3, 'next' => ListNode::__set_state(array( 'val' => 4, 'next' => ListNode::__set_state(array( 'val' => 5, 'next' => NULL, )), )), )), )), ))

// ListNode::__set_state(array( 'val' => 1, 'next' => ListNode::__set_state(array( 'val' => 1, 'next' => ListNode::__set_state(array( 'val' => 2, 'next' => ListNode::__set_state(array( 'val' => 2, 'next' => ListNode::__set_state(array( 'val' => 3, 'next' => ListNode::__set_state(array( 'val' => 3, 'next' => ListNode::__set_state(array( 'val' => 4, 'next' => ListNode::__set_state(array( 'val' => 4, 'next' => ListNode::__set_state(array( 'val' => 5, 'next' => ListNode::__set_state(array( 'val' => 5, 'next' => NULL, )), )), )), )), )), )), )), )), )), ))

// Note:
// 不要同时执行上面的连个方法, 否则PHP self http server会被阻塞, 无法响应