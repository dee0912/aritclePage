<?php

/**
*
* 题目是:
* 假设有"123<em>abc</em>456<em>def</em>789"这么一个字符串,写一个函数，可以传入一个字符* 串，和一个要截取的长度。返回截取后的结果。

* 要求:
* 1 <em>和</em>标记不得计算在长度之内。
* 2 截取后的字符串，要保留原有<em>标签，不过如果最后有一个标签没有闭合，则去掉其开始 *   标签。

* 示例:
* 题中的字符串，要截取长度5，则返回的字符串应该为:123ab,要截取长度8，应返回
* 123<em>abc</em>45。
*
**/

$str = "123<em>abc</em>456<em>def</em>789";

$count = (strlen($str) + mb_strlen($str,'utf-8'))/2;

echo "字符串:".$str."的长度是:".$count;


