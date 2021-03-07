<?php

class Solution {

    /**
     * @param String $s
     * @return Boolean
     */
     // 方式一: 递归 抵消 减枝
    function isValid($s) {
        $validArr = ["()", "[]", "{}"];
        $count = count($validArr);
        
        while($s){
            $validSign =  false;
            for($i = 0; $i < $count; $i++){
                if(strpos($s, $validArr[$i]) !== false){
                    $validSign = true;
                    $s = str_replace($validArr[$i], "", $s);

                    if(!$s){
                        return true;
                    }
                }
            }
            
            if(!$validSign){
                return false;
            }
        }

        return true;
    }
}

$solution = new Solution();
$ret = $solution->isValid('()');
var_dump($ret);