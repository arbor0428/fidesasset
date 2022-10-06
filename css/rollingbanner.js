var $mainBannerWrap;
var $subBannerWrap; //*서브
var $divs;
var startX;
var endX;
var nCurrentNum;
var totalNum;
var nCurrentIndex;
var oldIndex;
var newIndex;
var timer;

var $btn_wrap;
var $btns;

$(document).ready(function(){
	
	init();
	init2(); //*서브
	addEvent();
	btnSet();
	setTimer();
});

function init(){
	$mainBannerWrap = $("#mainflash");
	$divs = $(".mainbannerImg");
	$leftBtn = $("#bannerLeftBtn");
	$rightBtn = $("#bannerRightBtn");

	totalNum = $divs.length;
	

	$mainBannerWrap.append("<ul id='numBtn'></ul>");

	for(var i = 0; i<totalNum; i++){
		$mainBannerWrap.find("ul").append("<li>"+i+"</li>");
	}


	$divs.css({
		"opacity": "0"
	});

	$divs.eq(0).css({
		"opacity": "1"
	});


	nCurrentIndex = 0;

}

//*서브롤링
function init2(){
	$subBannerWrap = $("#subflash");
	$divs = $(".subbannerImg");
	$leftBtn = $("#bannerLeftBtn");
	$rightBtn = $("#bannerRightBtn");

	totalNum = $divs.length;
	

	$subBannerWrap.append("<ul id='numBtn'></ul>");

	for(var i = 0; i<totalNum; i++){
		$subBannerWrap.find("ul").append("<li>"+i+"</li>");
	}


	$divs.css({
		"opacity": "0"
	});

	$divs.eq(0).css({
		"opacity": "1"
	});


	nCurrentIndex = 0;

}



function btnSet(){
	// 버튼 위치(이미지 사이즈 연결)
	$btn_wrap	= $mainBannerWrap.find("ul");
	//console.log($btn_wrap);
	$btns	= $btn_wrap.children();

	var btn_wrapWidth = $btns.length * $btns.outerWidth() * 1.8;
	$btn_wrap.css("width", btn_wrapWidth);
	
	btn_x = $mainBannerWrap.outerWidth() - parseInt($btn_wrap.css("width"));
	btn_y = $mainBannerWrap.outerHeight() - 50;
	$btn_wrap.css("left", btn_x/2);
	$btn_wrap.css("top", btn_y+20);

	$btns.eq(0).addClass("numBtnOver");	// 첫번째 버튼 활성화
	addBtnEvent();		// 버튼 이벤트 활성화
}

function addBtnEvent(){
	$btns.bind("mouseover", function(){
		moveImg(parseInt($(this).html()));	// html 값을 숫자로 변환
		//clearInterval(timer);
	});

	$btns.bind("mouseout", function(){
		//setTimer();
	});

	
}


function addEvent(){



	$("#bannerLeftBtn").bind("click", function(){
		moveLeft();
	});
	
	$("#bannerRightBtn").bind("click", function(){
		moveRight();
	});
	
	/*
	$("#bannerLeftBtn").bind("mouseover", function(){
		clearInterval(timer);
	});

	$("#bannerRightBtn").bind("mouseover", function(){
		clearInterval(timer);
	});

	$("#bannerLeftBtn").bind("mouseout", function(){
		setTimer();
	});

	$("#bannerRightBtn").bind("mouseout", function(){
		setTimer();
	});

	


	$divs.bind("mouseover", function(){
		clearInterval(timer);
	});

	$divs.bind("mouseout", function(){
		setTimer();
	});
	
	*/

	

}

function moveLeft(){
	if(nCurrentIndex == 0){
		moveImg(2);
	} else {
		moveImg(nCurrentIndex - 1);
	}
}

function moveRight(){
	if(nCurrentIndex +1 >= totalNum){
		moveImg(0);
	} else {
		moveImg(nCurrentIndex+1);
	}
}



function moveImg(nIndex){
	oldIndex = nCurrentIndex;
	newIndex = nIndex;
	
	$btns.removeClass();
	$btns.eq(newIndex).addClass("numBtnOver");

	$divs.eq(oldIndex).animate({
		opacity:0
	},{ duration:1000,
		easing:"easeInCubic",
		queue:false
	});

	$divs.eq(nIndex).animate({
		opacity:1
	},{ duration:1000,
		easing:"easeInCubic",
		queue:false
	});
	

	nCurrentIndex = nIndex;
}

function setTimer(){
	timer = setInterval(function(){
		moveRight();
	}, 4000);
}
