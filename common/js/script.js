$(function(){
  //ボタン(id:move-page-top)のクリックイベント
  $("#totop a").click(function(){
    //ページトップへ移動する
    $("html,body").animate({scrollTop:0},"slow");
    return false;
  });
});

$(function() {
  // スクロールのオフセット値
  var offsetY = -10;
  // スクロールにかかる時間
  var time = 500;
  // ページ内リンクのみを取得
  $('a[href^=#]').click(function() {
    // 移動先となる要素を取得
    var target = $(this.hash);
    if (!target.length) return ;
    // 移動先となる値
    var targetY = target.offset().top+offsetY;
    // スクロールアニメーション
    $('html,body').animate({scrollTop: targetY}, time, 'swing');
    // ハッシュ書き換えとく
    return false;
  });
});
