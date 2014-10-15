<?php

class MyArcPage{

	private $content;
	private $pagebreak;
	private $url; //当前出去参数p的url

	//页码显示
	private $prePage;		//页码前偏移量
	private $floPage;		//页码后偏移量
	private $pageNow;		//当前页码
	private $totalPage;

	private $page_act;		//翻页样式 0:url 1:ajax

	//页码文字
	private $firstFonts = "首页";
	private $lastFonts = "末页";

	private $nextFonts = "下一页 >";		
	private $preFonts = "< 上一页";

	//显示页码
	private $pageShow = "";

	
	//参数：文章内容，分页符的html代码，分页方式，当前url的p参数
	function __construct($content,$pagebreak,$page_act,$p,$prePage,$floPage){

		$this->content = $content;
		$this->pagebreak = $pagebreak;
		$this->floPage = $floPage;
		$this->prePage = $prePage;

		$this->page_act = $page_act;

		$this->p = $p;
	}

	/**************************检测是否含有分页符***********************/
	public function check(){

		//检测是否含有分页符
		if(strpos($this->content,$this->pagebreak) === false){

			//不含有分页符
			return $this->content;				
		}else{

			//含有分页符
			$contentArr = explode($this->pagebreak,$this->content);	
			return $contentArr;
		}	
	}

	/************获得当前页页码,接收$_GET['p']*******/
	public function getPageNow(){
	
		if(!isset($this->p)){
			
			$this->pageNow = 1;
		}else if($this->p>0){
			
			$this->pageNow = $this->p;	
		}else{
		
			die("page number error");
		}

		return $this->pageNow;
	}

	/**************************设置当前页面链接**************************/
	 public function getUrl(){

        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		
		//判断是否带参数
		if(strpos($url,"?") === false){ //不带参数

			return $this->url = $url."?";
		}else{ //带参数
		
			$url = explode("?",$url);
			//参数
			$param = $url[1];

			//判断是否有多个参数
			if(strpos($param,"&") === false){ //只有一个参数
	
				//判断参数是否为p
				if(strpos($param,"p=") === false){ //不含参数p
				
					//合并url
					$url = implode("?",$url);	

					return $this->url = $url."&";

				}else{
				
					//把参数p去掉
					$url = $url[0];

					return $this->url = $url."?";
				}
				
			}else{ //多个参数
			
				$param = explode("&",$param);

				//遍历参数数组
				foreach($param as $k=>$v){

					if(strpos($v,"p=") === false){
						
						continue;
					}else{
			
						//当含有参数p时，把它从数组中删除
						unset($param[$k]);
					}
				}

					//删除参数p之后组合数组
					$param = implode("&",$param);
					$url[1] = $param;
					$url = implode("?",$url);

					return $this->url = $url."&";
			}
		}
	}
	
	/****************************前偏移量处理***************************/
	public function preOffset($preFonts){

		$this->getPageNow();
		$this->getUrl();
		$this->getPreFonts($preFonts);

		//前偏移量的处理
		if($this->pageNow!=1 && ($this->pageNow - $this->prePage -1 <= 1)){
	
			//上一页
			$this->pageShow .= "<a id=\"pre_page\" class=\"pagenum\" href=\"".$this->url."p=".($this->pageNow-1)."\">".($preFonts == ""?$this->preFonts:$preFonts)."</a>";

			
			//页码
			for($i=1;$i<=$this->pageNow-1;$i++){		

				//ajax方式不显示
				if($this->page_act != 1){

					$this->pageShow .= "<a class=\"pagenum\" href=\"".$this->url."p=".$i."\">".$i."</a>";	
				}
			}

		}else if($this->pageNow - $this->prePage -1 > 1){ //pageNow至少大于2时才会出现"1..."
			
				
			//首页
			$this->pageShow .= "<a id=\"first_page\" class=\"pagenum\" href=\"".$this->url."p=1\">".$this->firstFonts."</a>";			
			
			//上一页
			$this->pageShow .= "<a id=\"pre_page\" class=\"pagenum\" href=\"".$this->url."p=".($this->pageNow-1)."\">".($preFonts == ""?$this->preFonts:$preFonts)."</a>";

			for($i=$this->prePage;$i>=1;$i--){		

				//当前页和'...'之间的页码，ajax方式不显示
				if($this->page_act != 1){

					$this->pageShow .= "<a class=\"pagenum\" href=\"".$this->url."p=".($this->pageNow-$i)."\">".($this->pageNow-$i)."</a>";	
				}
			}
		}
	}

	/**********************页码和后偏移量处理***************************/
	public function floOffset($nextFonts){
	
		$this->getPageNow();
		$this->getTotalPage();
		$this->getUrl();
		$this->getNextFonts($nextFonts);

		if($this->totalPage > $this->floPage){ //总页数大于后偏移量时

			for($i=0;$i<=$this->floPage;$i++){
			
				$page = $this->pageNow+$i;
				
				if($page<=$this->totalPage){

					//页码,ajax方式不显示
					if($this->page_act != 1){

						$this->pageShow .= "<a class=\"pagenum\" href=\"".$this->url."p=".$page."\">".$page."</a>";
					}
				}
			}

			if($this->pageNow < $this->totalPage){
																		
				$this->pageShow .= "<a id=\"flo_page\" class=\"pagenum\" href=\"".$this->url."p=".($this->pageNow+1)."\">".($nextFonts == ""?$this->nextFonts:$nextFonts)."</a>"; //当实例化对象时用户传递的文字为空时则调用类预设的"下一页",否则输出用户传递的值
				
				if(($this->pageNow+$this->floPage+1)<$this->totalPage){

					$this->pageShow .= "<a id=\"last_page\" class=\"pagenum\" href=\"".$this->url."p=".$this->totalPage."\">末页</a>";
				}
				
			}else if($this->pageNow > $this->totalPage){
			
				die("超出页码范围");
			}
		}else{ //总页数小于后偏移量时
		
			if($this->pageNow < $this->totalPage){  //当前页小于总页数时

				for($i=0;$i<$this->totalPage;$i++){
			
					$page = $this->pageNow+$i;
					
					if($page < $this->totalPage){
					
						if($this->page_act != 1){

							//页码后边界
							$this->pageShow .= "<a id=\"flo_page\" class=\"pagenum\" href=\"".$this->url."p=".$page."\">".$page."</a>";
						}

					}else if($page == $this->totalPage){
					
						if($this->page_act != 1){

							$this->pageShow .= "<a id=\"flo_page\" class=\"pagenum\" href=\"".$this->url."p=".$page."\">".$page."</a>";
						}
					}else if($this->pageNow > $this->totalPage){
			
						die("超出页码范围");
					}
				}

				$this->pageShow .= "<a id=\"flo_page\" class=\"pagenum\" href=\"".$this->url."p=".($this->pageNow+1)."\">".$this->nextFonts."</a>";
			}else if($this->pageNow > $this->totalPage){
			
				die("超出页码范围");
			}else{ //当前页等于总页数
			
				if($this->page_act != 1){

					$this->pageShow .= "<a id=\"flo_page\" class=\"pagenum\" href=\"".$this->url."p=".$this->totalPage."\">".$this->totalPage."</a>";
				}
			}
		}
	}

	/********************其它页面信息***********************/
	public function getOtherInfo(){
	
		$this->pageShow .= "<span id=\"pagenow_info\">&nbsp;&nbsp;当前第".$this->pageNow."页</span>";
		$this->pageShow .= "/<span id=\"totalpage_info\">共".$this->totalPage."页</span>";

		return $this->pageShow;
	}

	/* ********************获取上一页、下一页文字******************* */
	public function getPreFonts($preFonts){
	
		return $this->preFonts = ($preFonts=="")?$this->preFonts:$preFonts;
	}
	
	public function getNextFonts($nextFonts){
	
		return $this->nextFonts = ($nextFonts=="")?$this->nextFonts:$nextFonts;
	}


	
	/******************************获得总页数页**********************************/
	public function getTotalPage(){
	
		//检测content是否为数组
		if(is_array($this->check())){ //content含分页符才分页

			//总页数
			return $this->totalPage = count($this->check());
		}else{
		
			return $this->totalPage = 1;
		}
	}

	/*********************************分页***************************************/
	public function page(){

		//文章分页一般不多，所以只是用list_page.class.php中的style2作为分页样式
		//返回页码
		return $this->preOffset($preFonts,$this->prePage).$this->floOffset($nextFonts,$this->floPage).$this->getOtherInfo();
	} 
}