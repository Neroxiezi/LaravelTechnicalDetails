<?php
/**
 * Created by PhpStorm.
 * User: 南丞
 * Date: 2019/6/14
 * Time: 12:58
 *
 *
 *                      _ooOoo_
 *                     o8888888o
 *                     88" . "88
 *                     (| ^_^ |)
 *                     O\  =  /O
 *                  ____/`---'\____
 *                .'  \\|     |//  `.
 *               /  \\|||  :  |||//  \
 *              /  _||||| -:- |||||-  \
 *              |   | \\\  -  /// |   |
 *              | \_|  ''\---/''  |   |
 *              \  .-\__  `-`  ___/-. /
 *            ___`. .'  /--.--\  `. . ___
 *          ."" '<  `.___\_<|>_/___.'  >'"".
 *        | | :  `- \`.;`\ _ /`;.`/ - ` : | |
 *        \  \ `-.   \_ __\ /__ _/   .-` /  /
 *  ========`-.____`-.___\_____/___.-`____.-'========
 *                       `=---='
 *  ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
 *           佛祖保佑       永无BUG     永不修改
 *
 */

class Node
{
    public $data = null;
    public $next = null;
}

function eatList(Node $node)
{
    $fast = $slow = $node;
    $first_target = null;
    if ($node->data == null) {
        return false;
    }
    while (true) {
        if ($fast->next != null && $fast->next->next != null) {
            $fast = $fast->next->next;  // 指针一次走两步
            $slow = $slow->next;        // 慢指针一次走一步
        } else {
            return false;
        }
        if ($fast == $slow) {   // 慢指针追上快指针,说明有环
            $p1 = $node;        // p1指针指向 head节点, p2指针指向他们第一次相交的点, 然后两个指针每次移动一步 当它们再次相交,即为环的入口
            $p2 = $fast;
            while ($p1 != $p2) {
                $p1 = $p1->next;
                $p2 = $p2->next;
            }
            return $p1;
        }
    }
}