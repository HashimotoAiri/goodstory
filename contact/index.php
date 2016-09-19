<?php

  //php設定：デバック用、リリース時は0へ
  error_reporting(E_ALL);
  ini_set ( "display_errors", "0" );

  if(!defined("CHARSET")) {
    define("CHARSET","UTF-8");
  }

  //mbstring設定
  mb_language("ja");
  mb_internal_encoding(CHARSET);
  mb_regex_encoding(CHARSET);

if(isset($_POST["action"]) && ($_POST["action"] == "confirm")) {
  foreach($_POST as $key => $value){
    $postvalues[$key] = $value;
  }

  if(isset($postvalues["conmany"])) {
    $postvalues["conmany"] = mb_convert_kana($postvalues["conmany"], "KVNs", CHARSET);
  }
  if(isset($postvalues["conmany"]) && (trim($postvalues["conmany"]) == "")) {
    $errmsg["conmany"] = "※会社は必須項目です";
  }

  if(isset($postvalues["represent"])) {
    $postvalues["represent"] = mb_convert_kana($postvalues["represent"], "KVNs", CHARSET);
  }
  if(isset($postvalues["represent"]) && (trim($postvalues["represent"]) == "")) {
    $errmsg["represent"] = "※担当者名は必須項目です";
  }

  if(isset($postvalues["represent_kana"])) {
    $postvalues["represent_kana"] = mb_convert_kana($postvalues["represent_kana"], "KVNs", CHARSET);
  }
  if(isset($postvalues["represent_kana"]) && (trim($postvalues["represent_kana"]) == "")) {
    $errmsg["represent_kana"] = "※担当者名ふりがなは必須項目です";
  }

  if(isset($postvalues["email"]) && (trim($postvalues["email"]) == "")) {
    $errmsg["email"] = "※メールアドレスは必須項目です";
  }
  if(!isset($errmsg["email"])) {
    $addr = explode('@', $postvalues["email"], 2);
    if(isset($addr[0]) && (@$addr[0] !="") && isset($addr[1]) && (@$addr[1] !="") ) {
      if(!preg_match("/^[\x01-\x7E]+$/", $addr[0]) || !checkdnsrr($addr[1],$type="ANY") ) {
        $errmsg["email"] = "※メールアドレスを正しく入力して下さい";
      }
    } else {
      $errmsg["email"] = "※メールアドレスを正しく入力して下さい";
    }
  }

  if(isset($postvalues["url"]) && (trim($postvalues["url"]) == "")) {
    $errmsg["url"] = "※会社URLは必須項目です";
  }

  if(isset($postvalues["tel"]) && (trim($postvalues["tel"]) == "")) {
    $errmsg["tel"] = "※電話番号は必須項目です";
  }

  if(isset($postvalues["message"]) && (trim($postvalues["message"]) == "")) {
    $errmsg["message"] = "※お問い合わせ内容は必須項目です";
  }


  $postvalues['conmany'] = $_POST['conmany'];
  $postvalues['represent'] = $_POST['represent'];
  $postvalues['represent_kana'] = $_POST['represent_kana'];
  $postvalues['email'] = $_POST['email'];
  $postvalues['url'] = $_POST['url'];
  $postvalues['tel'] = $_POST['tel'];
  $postvalues['message'] = $_POST['message'];

  if(empty($errmsg)) {
    require "./confirm.php";
    exit;
  }
  }elseif(isset($_POST["action"]) && ($_POST["action"] == "edit")) {
  foreach($_POST as $key => $value){
    $postvalues[$key] = $value;
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>contact By goodstory Inc.</title>
    <meta name="description" content="ひとつひとつの企業が持つ、個性や想い。そんな「らしさ」を正確にユーザーや社会に届けるための道筋を、私たちは“ストーリー”と呼びます。語られるべき文脈をPRの視点から、そして進むべき施策を経営視点から発想することで企業とユーザー、両者のすれ違いをなくし、課題解決につなげていきます。PRだけではなく、プロモーションだけでもない。 新しいカタチのブランディングを提供するブランドクリエイティブエージェンシー、私たちは「goodstory」です。">
    <meta name="keywords" content="PR,ストーリー,マーケティング,bizket,ブランドクリエイティブエージェンシー,goodstory">
    <link rel="stylesheet" href="../common/css/sanitize.css">
    <link href='https://fonts.googleapis.com/css?family=Prata' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../common/css/style.css">
    <link rel="stylesheet" href="../common/css/menu.css"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="../common/js/html5shiv.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav id="nav" class="sp-on">
      <ul>
        <li class="special">
          <div id="menu">
            <ul>
              <li class="menu_close"><img src="../common/images/close.png"></li>
              <li><a href="../#news">news</a></li>
              <li><a href="../about/">about</a></li>
              <li><a href="../services/">services</a></li>
              <li><span>works<span>coming soon</span></span></li>
              <li><a href="../member/">member</a></li>
              <li><a href="../contact/" class="active">contact</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
    <div id="header" class="sp-on">
      <div class="inner">
      <h1><a href="../"><img src="../common/images/logo.png" alt="goodstory" width="96"></a></h1>
      <a id="btn_menu" href="#menu" class="menuToggle"><img src="../common/images/btn_menu.png" width=71 /></a>
      </div>
    </div>

    <div id="header" class="pc-on fixed">
      <div class="inner">
        <h1><a href="../"><img src="../common/images/logo.png" alt="goodstory" width="96"></a></h1>
        <nav id="nav" class="pc-on">
          <ul>
            <li><a href="../#news">news</a></li>
            <li><a href="../about/">about</a></li>
            <li><a href="../services/">services</a></li>
            <li class="cs"><span>works<span>coming soon</span></span></li>
            <li><a href="../member/">member</a></li>
            <li><a href="../contact/" class="active">contact</a></li>
          </ul>
        </nav>
      </div>
    </div>

      <div id="contact" class="section bg_gray">
      <div class="inner" style="padding-top:0;">
        <h2><img src="../common/images/title_contact.png" alt="contact"></h2>
        <p class="telfax">TEL : 03-4360-5731<!--<span class="pc-on">/</span><br class="sp-on">FAX : 03-6700-9051--></p>
        <p class="mail"><a href="mailto:info@good-story.co.jp">info@good-story.co.jp</a></p>
        <p>下記フォームに必要事項を入力し<span class="contact_red">この内容で確認する</span>をクリックして下さい。</p>
      </div>

      <form id="form-box" action="./index.php#form-box" method="post" name="reserv">
      <input name="action" type="hidden" value="confirm">

      <div class="form inner bg_gray">
        <dl>
        <dt>会社名 <span class="red">必須</span><?php if(isset($errmsg["conmany"])) { ?><div class="form_error"><?php print(trim($errmsg["conmany"])); ?></div><?php } ?></dt>
        <dd>
          <input type="text" name="conmany" id="conmany" class="<?php if(isset($errmsg["conmany"])) { ?>error<?php } ?>" value="<?php if(isset($postvalues["conmany"])) { print(htmlentities($postvalues["conmany"],ENT_QUOTES,CHARSET)); } ?>">
        </dd>

        <dt>担当者名 <span class="red">必須</span><?php if(isset($errmsg["represent"])) { ?><div class="form_error"><?php print(trim($errmsg["represent"])); ?></div><?php } ?></dt>
        <dd>
          <input type="text" name="represent" id="represent" class="<?php if(isset($errmsg["represent"])) { ?>error<?php } ?>" value="<?php if(isset($postvalues["represent"])) { print(htmlentities($postvalues["represent"],ENT_QUOTES,CHARSET)); } ?>">
        </dd>
        <dt>担当者名 ふりがな <span class="red">必須</span><?php if(isset($errmsg["represent_kana"])) { ?><div class="form_error"><?php print(trim($errmsg["represent_kana"])); ?></div><?php } ?></dt>
        <dd>
          <input type="text" name="represent_kana" id="represent_kana" class="<?php if(isset($errmsg["represent_kana"])) { ?>error<?php } ?>" value="<?php if(isset($postvalues["represent_kana"])) { print(htmlentities($postvalues["represent_kana"],ENT_QUOTES,CHARSET)); } ?>">
        </dd>
        <dt>メールアドレス <span class="red">必須</span><?php if(isset($errmsg["email"])) { ?><div class="form_error"><?php print(trim($errmsg["email"])); ?></div><?php } ?></dt>
        <dd>
          <input type="text" name="email" id="email" class="<?php if(isset($errmsg["email"])) { ?>error<?php } ?>" value="<?php if(isset($postvalues["email"])) { print(htmlentities($postvalues["email"],ENT_QUOTES,CHARSET)); } ?>">
        </dd>
        <dt>会社URL <span class="red">必須</span><?php if(isset($errmsg["url"])) { ?><div class="form_error"><?php print(trim($errmsg["url"])); ?></div><?php } ?></dt>
        <dd>
          <input type="text" name="url" id="url" class="<?php if(isset($errmsg["url"])) { ?>error<?php } ?>" value="<?php if(isset($postvalues["url"])) { print(htmlentities($postvalues["url"],ENT_QUOTES,CHARSET)); } ?>">
        </dd>
        <dt>電話番号 <span class="red">必須</span><?php if(isset($errmsg["tel"])) { ?><div class="form_error"><?php print(trim($errmsg["tel"])); ?></div><?php } ?></dt>
        <dd>
          <input type="text" name="tel" id="tel" class="<?php if(isset($errmsg["tel"])) { ?>error<?php } ?>" value="<?php if(isset($postvalues["tel"])) { print(htmlentities($postvalues["tel"],ENT_QUOTES,CHARSET)); } ?>">
        </dd>
        <dt>お問い合わせ内容<br class="sp-on">（出来るだけ具体的にお願いします） <span class="red">必須</span><?php if(isset($errmsg["message"])) { ?><div class="form_error"><?php print(trim($errmsg["message"])); ?></div><?php } ?></dt>
        <dd>
          <textarea name="message" rows="10" id="message" class="<?php if(isset($errmsg["message"])) { ?>error<?php } ?>"><?php if(isset($postvalues["message"])) { print(htmlentities($postvalues["message"],ENT_QUOTES,CHARSET)); } ?></textarea>
        </dd>
        </dl>
        <center>
          <a href="#"><input type="submit" name="confirm" id="confirm" value="この内容で確認する" class="button"></a>
        </center>
      </div>
      </form>

    </div>
    <div id="totop">
      <div class="inner">
        <a href="#"><img src="../common/images/btn_totop.png" alt="トップへ戻る"></a>
      </div>
    </div>

    <div id="footer">
      <div class="inner">
        <p>© goodstory Inc. ALL Rights Reserved.</p>
      </div>
    </div>

  <script type="text/javascript" src="../common/js/jquery.min.js"></script>

  <script type="text/javascript" src="../common/js/script.js"></script>
  <script src="../common/js/util.js"></script>
  <script src="../common/js/nav.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-84368940-1', 'auto');
  ga('send', 'pageview');

</script>
</body>

</html>
