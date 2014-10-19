<?php
header("charset=utf-8");

$content='<p>Terence Parr是美国旧金山大学的计算机教授、研究生导师，他一直致力于从事ANTLR项目（antlr.org）和模板引擎（stringtemplate.org）的设计和开发工作。Terence曾担任IBM、洛克希德马丁、NeXT、雷诺汽车等公司的技术顾问，另著有《ANTLR权威指南》。</p>
<p><img src="http://img5.douban.com/lpic/s7661036.jpg" alt="" width="321" height="414" />《编程语言实现模式》旨在传授开发语言应用（工具）的经验和理念，帮助读者构建自己的语言应用。这里的语言应用并非特指用编译器或解释器实现编程语言，而是泛指任何处理、分析、翻译输入文件的程序，比如配置文件读取器、数据读取器、模型驱动的代码生成器、源码到源码的翻译器、源码分析工具、解释器，以及诸如此类的工具。为此，作者举例讲解已有语言应用的工作机制，拆解、归纳出31种易于理解且常用的设计模式（每种都包括通用数据结构、算法、策略）。虽然示例是用Java编写的，但相信读者可以触类旁通，利用这些设计模式构建针对其他编程语言（既包括特定领域语言，也包括通用编程语言）的应用。</p>
<p><embed src="http://player.youku.com/player.php/sid/XNzEzMDc5NDQ=/v.swf" type="application/x-shockwave-flash" width="480" height="400" align="middle"></embed></p>黑斯廷斯战役(Battle of Hastings)，1066年10月14日，哈罗德国王(Harold II)的盎格鲁&mdash;撒克逊军队和诺曼底公爵威廉一世(William of Normandy)的军队在黑斯廷斯(英国东萨塞克斯郡濒临加来海峡的城市)地域进行的一场交战。<br />　　【序幕】<br />　　1066年9月29日，诺曼底公爵吉约姆二世（即征服者威廉）希望用他的军队取得英格兰的王位，其军队出发后在英吉利海峡被飓风延迟，后于英格兰南岸的村庄佩文西在未遇到抵抗的情况下登陆。传说威廉登上海滩后不小心面朝下摔倒。为了不在其军队面前出丑，他双手捧沙站起来喊到&ldquo;我现在拥有了英国的土地!&rdquo;（这个故事与恺撒侵略不列颠的故事相似；也许是威廉的传记作者为了让威廉与恺撒有更多的共同点而编造的。）当听到威廉军队登陆的消息之后，刚歼灭挪威国王哈拉尔三世的入侵军队的英格兰国王哈罗德二世，急忙召集他所能找到的所有军队，然后南下御敌。</p>
<table>
<tbody>
<tr>
<td>1</td>
<td>2</td>
<td>3</td>
<td>4</td>
</tr>
<tr>
<td>5</td>
<td>6</td>
<td>7</td>
<td>8</td>
</tr>
<tr>
<td>9</td>
<td>10</td>
<td>11</td>
<td>12</td>
</tr>
</tbody>
</table>
<p>哈乐德在黑斯廷斯至伦敦的道路上布置了他的军队，具体地点是在距黑斯廷斯六英里的森拉克山丘。他的后方是安德里达森林，前方是一个山谷。后来此战发生地被称作巴特尔（&ldquo;Battle&rdquo;，意即战斗，位于今日英国之东萨塞克斯郡），以纪念这个事件。</p>
<p>女王——北极星希蒂(希路达)</p>
<p>　　神斗士：(共8人)</p>
<p>　　北欧之神奥丁的战士，其中一人为影子神斗士，与薛度是亲兄弟的巴度。北欧神斗士对应的是北斗七星。</p>
<p>　　星天枢星神斗士飞龙捷克弗列德(捷古佛列)</p>
<p>　　星天璇星神斗士烈马哈根</p>
<p>　　星天玑星神斗士毒蛇杜鲁(德尔鲁)</p>
<p>　　星天权星神斗士骷髅阿鲁贝利希</p>
<p>　　星玉衡星神斗士天狼菲路(菲利路)</p>
<p>　　星开阳星神斗士黑虎希度(斯多)</p>
<p>　　辅星影子神斗士白虎巴度(巴多)</p>
<p>　　星摇光星神斗士天琴米鸣(米伊美)</p>&nbsp;<img src="uploads/saint.jpg" alt="" width="300">';

$pagebreak = "<!-- pagebreak -->";

//分页标签
$cuttag_array = array("</p>","</table>",".",".'","。","。”","?","?'","?”","!","!'","！”","<br>","<br />","<br/>");

//截取字符串函数,递归。参数分别为需要截取的字符串、截取的起始位置、每页的字数
function conCut($content,$start,$per_num,$content_arr){

	//需要截取的字符串的长度
	$count = (strlen($content) + mb_strlen($content,'utf-8'))/2;

echo "此时需要截取的长度：".$count."<br>";
	//截取后长度
	$rest_num = $count - $per_num;	

	//当截取后的长度 > 每页的字数
	if($rest_num > $per_num){

		//开始截取
		//被截取的部分
		$con_cut = mb_substr($content,$start,$per_num,'utf-8');
echo "截取后下一部分的起始值：".$start."&nbsp;&nbsp;截取后剩余的长度：".$rest_num."<br>";

		//把被截取的部分装入数组
		$content_array[] = $con_cut; 

		//剩余的部分
		$content = mb_substr($content,$start+$per_num,$rest_num,'utf-8');
		
		//新的截取起点
		//$start += $per_num;

		//调用自身函数
		conCut($content,$start,$per_num,$content_arr);
	}else{
echo "最后一页剩余的长度：".$count;	
		$content_array[] = $content; 
	}
	
	return $content_array;	
	
}


//每页的字数
$per_num = 500;
$content_arr = array();

$content_array = conCut($content,0,$per_num,$content_arr);

echo "<pre>";
print_r($content_array);
echo "</pre>";

//分页标签
//echo "<pre>";
//print_r($cuttag_array);
//echo "</pre>";


