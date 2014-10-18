$(function(){

	//初始显示"下一页","末页"
	showFloPage();
	
	//删除原先的li,插入gif
	function ajaxpre(){

		//插入gif图
		$loading = $("<img class=\"loading_arc\" src=\""+$Template_Dir+"/images/loading.gif\">");

		$("#content").html($loading);
	}

	//隐藏翻页信息
	function infoAct(){

		//当前页到达尾页时，"下一页"和"末页"
		if(parseInt($("#pageNow").val()) == parseInt($("#totalPage").val())){
			
			$("#flo_page").hide();
			$("#last_page").hide();
			
			$("#pre_page").show();
			$("#first_page").show();
			
		}else if(parseInt($("#pageNow").val()) == 1){ //当前页到达时隐藏"首页"和"上一页"
		
			$("#pre_page").hide();
			$("#first_page").hide();
			
			$("#flo_page").show();
			$("#last_page").show();

		}else{
		
			$("#pre_page").show();
			$("#first_page").show();
		
			$("#flo_page").show();
			$("#last_page").show();	
		}
	}

	//点击"下一页"、"末页"时出现"首页"和"上一页"
	function showPage(){

		//首页
		$firstPage = $("<a id=\"first_page\" class=\"pagenum\">首页</a>");
		
		if($("#first_page").length == 0){
			$firstPage.insertBefore($(".ajaxpage:first"));
		}

		//上一页 
		$pre_page = $("<a id=\"pre_page\" class=\"pagenum\">"+$preFonts+"</a>");
		
		if($("#pre_page").length == 0){
			$pre_page.insertBefore($(".ajaxpage:first"));
		}
	}

	//点击"上一页"、"首页"时出现"下一页"和"末页"
	function showFloPage(){

		//下一页 
		$flo_page = $("<a id=\"flo_page\" class=\"pagenum\">"+$preFonts+"</a>");
		
		if($("#flo_page").length == 0){
			$flo_page.insertAfter($(".ajaxpage:last"));
		}
		
		//末页
		$lastPage = $("<a id=\"last_page\" class=\"pagenum\">末页</a>");
		
		if($("#last_page").length == 0){
			$lastPage.insertAfter($("#flo_page"));
		}
	}

	//ajax请求数据
	function ajaxpost(){

		$.post("ajaxarc.php",{
			
			pageNow : parseInt($("#pageNow").val()),
			id : parseInt($("#id").val()),
			pagebreak : $("#pagebreak").val()
		},function(data,textStatus){
			
			//删除gif
			$(".loading").remove();
													
			$("#content").html(data);
		});
	}

			
	//初始值=1
	apagenow = parseInt($("#pageNow").val());

	//ajax "首页" 因为"首页"和"上一页"一开始是不出现的，所以只有在"下一页"和"末页"的的点击函数中调用"首页"和"上一页"函数
	function firstPageAct(){

		if($("#first_page").is(":visible")){
		
			$("#first_page").live('click',function(){

				//删除更新前的
				ajaxpre();

				//pageNow设为1
				$("#pageNow").val(1);
				apagenow = parseInt($("#pageNow").val());

				//修改页码信息
				$("#pagenow_info").html("&nbsp;&nbsp;当前第1页");

				//后偏移分页
				flopage($("#pageNow").val());
				
				//ajax请求数据
				ajaxpost();
				
				//到达"首页"之后隐藏"首页"和"上一页"
				infoAct();

				//给页码加样式
				selpage();
			});
		}
	}

	function lastPageAct(){

		if($("#last_page").is(":visible")){
		
			$("#last_page").live('click',function(){

				//删除更新前的
				ajaxpre();

				//pageNow设为1
				$("#pageNow").val($("#totalPage").val());
				apagenow = parseInt($("#pageNow").val());

				//修改页码信息
				$("#pagenow_info").html("&nbsp;&nbsp;当前第"+apagenow+"页");

				//后偏移分页
				flopage($("#pageNow").val());
				
				if($("#first_page").is(":hidden") || $("#first_page").length == 0){

					//出现"首页"和"下一页"
					showPage();
					showFloPage();
					firstPageAct();
					lastPageAct();
					prePageAct();
				}
				
				//ajax请求数据
				ajaxpost();
				
				//到达"首页"之后隐藏"首页"和"上一页"
				infoAct();

				//给页码加样式
				selpage();
			});
		}
	}

	//ajax "上一页"
	function prePageAct(){

		if($("#pre_page").is(":visible")){
		
			$("#pre_page").click(function(){
			
				//删除更新前的
				ajaxpre();
	
				//每点击"上一页",隐藏域值-1
				if(parseInt(apagenow) != 1){
				
					apagenow = parseInt(apagenow) - parseInt(1);
				}
				
				$("#pageNow").val(apagenow);
				
				//前、后偏移分页
				flopage($("#pageNow").val());

				//隐藏域的页码值大于1时
				if(parseInt($("#pageNow").val()) > parseInt(1)){
			
					//修改页码信息
					$("#pagenow_info").html("&nbsp;&nbsp;当前第"+$("#pageNow").val()+"页");
				}

				//ajax请求数据
				ajaxpost();

				if($("#first_page").is(":hidden") || $("#first_page").length == 0){

					//出现"首页"和"下一页"
					showPage();
					showFloPage();
					firstPageAct();
					lastPageAct();
					prePageAct();
				}

				//第一页时隐藏"首页"和"上一页"
				infoAct();

				//给页码加样式
				selpage();
			});

		}
	}

	//ajax "下一页"
	if($("#flo_page").length>0){

		//去掉a的href属性
		$("#flo_page").removeAttr("href");
		
		$("#flo_page").live('click',function(){

			ajaxpre();
			
			//每点击"下一次",隐藏域值+1
			apagenow = parseInt(apagenow) + parseInt(1);

			$("#pageNow").val(apagenow);

			//后偏移分页
			flopage($("#pageNow").val());

			//隐藏域的页码值小于总页码时
			if(parseInt($("#pageNow").val()) <= parseInt($("#totalPage").val())){
			
				//修改页码信息
				$("#pagenow_info").html("&nbsp;&nbsp;当前第"+$("#pageNow").val()+"页");

				//ajax请求数据
				ajaxpost();
			}

			//点击"下一页"之后出现"首页"
			if($("#first_page").is(":hidden") || $("#first_page").length == 0){

				//出现"首页"和"下一页"
				showPage();
				showFloPage();
				firstPageAct();
				lastPageAct();
				prePageAct();
			}

			//隐藏"下一页"和"末页"
			infoAct();

			//给页码加样式
			selpage();

			return false; //取消点击翻页
		});
	}

	//ajax "末页"
	if($("#last_page").length>0){

		//去掉a的href属性
		$("#last_page").removeAttr("href");
		
		$("#last_page").live('click',function(){
		
			ajaxpre();
			
			//修改隐藏域当前页信息
			apagenow = parseInt($("#totalPage").val());
			$("#pageNow").val(apagenow);

			//修改页码信息
			$("#pagenow_info").html("&nbsp;&nbsp;当前第"+$("#totalPage").val()+"页");
			
			//后偏移分页
			flopage($("#pageNow").val());
			
			//ajax请求数据
			ajaxpost();

			//点击"末页"之后出现"首页"
			
			if($("#first_page").length == 0){
			
				showPage();
				showFloPage();
				firstPageAct();
				lastPageAct();
				prePageAct();
			}

			infoAct();

			//给页码加样式
			selpage();

			return false;
		});
	}

	//取消a标签跳转
	$("#first_page").live('click',function(){
			
		return false;
	});

	$("#pre_page").live('click',function(){
			
		return false;
	});

	//删除具体页码的href
	$(".ajaxpage").removeAttr("href");

	
	//live()可使jQuery动态添加的元素也能绑定事件处理函数
	$(".ajaxpage").live('click', function(){

		ajaxpre();

		//每点击"下一次",隐藏域值变为当前a标签显示的页码
		apagenow = $(this).text();

		$("#pageNow").val(apagenow);

		//后偏移分页
		flopage($("#pageNow").val());

		//修改页码信息
		$("#pagenow_info").html("&nbsp;&nbsp;当前第"+$("#pageNow").val()+"页");

		$(".ajaxpage").removeClass("selected");

		$(this).each(function(){
		
			if($(this).text() == $("#pageNow").val()){
			
				$(this).addClass("selected");
			}
		})
		
		if($("#first_page").is(":hidden") || $("#first_page").length == 0){

			//出现"首页"和"下一页"
			showPage();
			showFloPage();
			firstPageAct();
			lastPageAct();
			prePageAct();
		}

		infoAct();

		//给页码加样式
		selpage();

		ajaxpost();
	});

	//"上一页","下一页"给页码加样式
	function selpage(){

		//给页码加样式
		$(".ajaxpage").removeClass("selected");
		$(".ajaxpage").each(function(){
		
			if($(this).text() == $("#pageNow").val()){
			
				$(this).addClass("selected");
			}
		})
	}

	//后偏移量
	function flopage($pagenow){
	
		if(parseInt($("#flopage").val()) < parseInt($("#totalPage").val())){
					
			//当页码发生变化时(点击页码)，新添加的边界页码为
			$ins_page_num = parseInt($pagenow) + parseInt($("#flopage").val()) - parseInt(1);
		
			prepage($pagenow);

			//当新的页码边界也小于总页数时
			if(parseInt($ins_page_num) < parseInt($("#totalPage").val())){
				//新的页码显示为
				for(var i=$pagenow;i<=$ins_page_num+parseInt(1);i++){
				
					$pageshow += "<a class=\"pagenum ajaxpage\">"+i+"</a>"; 
				}

				//如果后边界没有到达末页，则显示'下一页'、'末页'
				$pageshow += "<a id=\"flo_page\" class=\"pagenum\">"+$nextFonts+"</a>";
				$pageshow += "<a id=\"last_page\" class=\"pagenum\">末页</a>";
				
				//修改页码信息
				$pageshow += "&nbsp;&nbsp;当前第"+$pagenow+"页";
				$pageshow += "/共"+$("#totalPage").val()+"页";

				//替换原来的页码显示
				$("#page").html($pageshow);
			}else{
			
				//当新的页码边界也大于总页数时
				for(var i=$pagenow;i<=parseInt($("#totalPage").val());i++){
				
					$pageshow += "<a class=\"pagenum ajaxpage\">"+i+"</a>"; 
				}

				//如果后边界没有到达末页，则显示'下一页'、'末页'
				$pageshow += "<a id=\"flo_page\" class=\"pagenum\">"+$nextFonts+"</a>";
				$pageshow += "<a id=\"last_page\" class=\"pagenum\">末页</a>";
				
				//修改页码信息
				$pageshow += "&nbsp;&nbsp;当前第"+$pagenow+"页";
				$pageshow += "/共"+$("#totalPage").val()+"页";

				//替换原来的页码显示
				$("#page").html($pageshow);
			}
		}
	}

	//前偏移量
	function prepage($pagenow){
	
		$pageshow = "";

		//当前页 - 当前偏移量 <= 0 时
		if(parseInt($pagenow) - parseInt($("#perpage").val()) <= 0){

			//前边界 = 1
			//pagenow不输出，在后偏移量时pagenow已经输出
			for(var i=1;i<parseInt($pagenow);i++){
			
				$pageshow += "<a class=\"pagenum ajaxpage\">"+i+"</a>"; 
			}
		}else{
	
			//前边界 = pagenow - prepage
			for(var i=parseInt($pagenow)-parseInt($("#perpage").val());i<parseInt($pagenow);i++){
			
				$pageshow += "<a class=\"pagenum ajaxpage\">"+i+"</a>"; 
			}
		}
	}
});


