$(function() {
    var nav = $('#nav');
    //navの位置
    var navTop = nav.offset().top;
    //スクロールするたびに実行
    $(window).scroll(function () {
        var winTop = $(this).scrollTop();
        //スクロール位置がnavの位置より下だったらクラスfixedを追加
        if (winTop >= navTop) {
            nav.addClass('fixed')
        } else if (winTop <= navTop) {
            nav.removeClass('fixed')
        }
    });
});

$(function(){
    // 「id="jQueryBox"」を非表示
    $("#menu").css("display", "none");

    // 「id="jQueryPush"」がクリックされた場合
    $(".menuToggle").click(function(){
        // 「id="jQueryBox"」の表示、非表示を切り替える
        $("#menu").slideDown(200);
		});
    // 「id="jQueryPush"」がクリックされた場合
    $(".menu_close").click(function(){
        // 「id="jQueryBox"」の表示、非表示を切り替える
        $("#menu").slideUp(200);
		});

    $("#menu a").click(function(){
        var target = $(this).attr('href');
        if(target == "#news") $("#menu").slideUp(200);
    });

});
