$(function(){
    //처음에 스크롤바 위치 0
    $(window).on("load",function(){

        $("html,body").stop().animate({"scrollTop":0},10); 
        
    });
    
    $(".useBtn").on("click",function(event){

        event.preventDefault();
        $(".loginBox").stop().slideDown(500);
        $(".useBtn").addClass("on");

    });
});