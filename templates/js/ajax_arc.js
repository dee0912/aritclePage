$(function(){

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
		
			if($("#pre_page").is(":hidden") || $("#pre_page").length == 0){
				$("#pre_page").show();
			}
			if($("#first_page").is(":hidden") || $("#first_page").length == 0){
				
				$("#first_page").show();
			}
			if($("#flo_page").is(":hidden") || $("#flo_page") == 0){
				$("#flo_page").show();
			}
			if($("#last_page").is(":hidden") || $("#last_page").length == 0){
				$("#last_page").show();
			}
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
		
			$("#first_page").click(function(){

				//删除更新前的
				ajaxpre();

				//pageNow设为1
				$("#pageNow").val(1);
				apagenow = parseInt($("#pageNow").val());

				//修改页码信息
				$("#pagenow_info").html("&nbsp;&nbsp;当前第1页");

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

				//每点击"下一次",隐藏域值-1
				if(parseInt(apagenow) != 1){
				
					apagenow = parseInt(apagenow) - parseInt(1);
				}
				
				$("#pageNow").val(apagenow);
				
				//隐藏域的页码值大于1时
				if(parseInt($("#pageNow").val()) > parseInt(1)){
			
					//修改页码信息
					$("#pagenow_info").html("&nbsp;&nbsp;当前第"+$("#pageNow").val()+"页");
				}

				//ajax请求数据
				ajaxpost();

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
		
		$("#flo_page").click(function(){

			ajaxpre();
			
			//每点击"下一次",隐藏域值+1
			apagenow = parseInt(apagenow) + parseInt(1);

			$("#pageNow").val(apagenow);

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
				firstPageAct();
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
		
		$("#last_page").click(function(){
		
			ajaxpre();
			
			//修改隐藏域当前页信息
			apagenow = parseInt($("#totalPage").val());
			$("#pageNow").val(apagenow);

			//修改页码信息
			$("#pagenow_info").html("&nbsp;&nbsp;当前第"+$("#totalPage").val()+"页");
			
			//ajax请求数据
			ajaxpost();

			//点击"末页"之后出现"首页"
			
			if($("#first_page").length == 0){
			
				showPage();
				firstPageAct();
				prePageAct();
			}

			infoAct();

			//给页码加样式
			selpage();

			return false;
		});
	}

	//取消a标签跳转
	$("#first_page").click(function(){
			
		return false;
	});

	$("#pre_page").click(function(){
			
		return false;
	});

	//删除具体页码的href
	$(".ajaxpage").removeAttr("href");

	$(".ajaxpage").click(function(){

		ajaxpre();
		
		//每点击"下一次",隐藏域值变为当前a标签显示的页码
		apagenow = $(this).text();

		$("#pageNow").val(apagenow);

		//修改页码信息
		$("#pagenow_info").html("&nbsp;&nbsp;当前第"+$("#pageNow").val()+"页");

		$(".ajaxpage").removeClass("selected");

		$(this).each(function(){
		
			if($(this).text() == $("#pageNow").val()){
			
				$(this).addClass("selected");
			}
		})
//flopage();
		showPage();
		firstPageAct();
		prePageAct();
		//点击第一页，隐藏"首页","上一页"
		infoAct();

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
//	function flopage(){
//	
//		if(parseInt($("#flopage").val()) < parseInt($("#totalPage").val())){
//		
//			//当后偏移量小于总页数时，默认的后边界为1+flopage
//			$default_fpage = parseInt(1) + parseInt($("#flopage").val());
//			
//			//当页码发生变化时(点击页码)，新添加的边界页码为
//			$ins_page_num = parseInt($default_fpage) + parseInt($("#pageNow").val()) -parseInt(1);
//
//			//当新边界小于总页数时,把原先的页码全部删除，插入含新加边界的页码
//			if(parseInt($ins_page_num) <= parseInt($("#totalPage").val())){
//
//				for(var i=(parseInt($default_fpage)+parseInt(1));i<=(parseInt($ins_page_num));i++){
//				
//					$pageshow = $("<a class=\"pagenum ajaxpage\">"+i+"</a>");
//		
//					$pageshow.insertBefore($("#flo_page"));
//				}
//			}
//		}
//	}
});


