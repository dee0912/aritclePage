<?php

class MyArcPage{

	//参数：文章内容，分页符html代码
	function __construct($content,$pagebreak){
	
			
	}

	//检测是否含有分页符
	public function check(){
	
		//检测是否含有分页符
		if(strpos($content,"&lt;!-- pagebreak --&gt;") === false){

			//含有分页符
		}else{

			//不含分页符
		}
	}
}