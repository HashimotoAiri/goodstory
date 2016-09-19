<?php

//php設定：デバック用、リリース時は0へ
error_reporting(E_ALL);
ini_set ( "display_errors", "0" );

if(!defined("CHARSET")) {
  define("CHARSET","UTF-8");
}

if(!isset($postvalues)) {
  exit;
}

if(isset($postvalues["action"])) {
  unset($postvalues["action"]);
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
        <p class="telfax">TEL : 03-4360-5731<!--<span>/</span>FAX : 03-6700-9051--></p>
        <p class="mail"><a href="mailto:info@good-story.co.jp">info@good-story.co.jp</a></p>
        <p>入力内容に間違いがなければ<span class="contact_red">送信する</span>をクリックして下さい。</p>
      </div>

      <form id="form" name="form" method="post" action="./thanks.php">
      <div class="form inner bg_gray">
        <dl>
        <dt>会社名 <span class="red">必須</span></dt>
        <dd>
          <input type="text" name="conmany" id="conmany" readonly="readonly" value="<?php print(htmlentities($postvalues["conmany"],ENT_QUOTES,CHARSET)); ?>">
        </dd>
        <dt>担当者名 <span class="red">必須</span></dt>
        <dd>
          <input type="text" name="represent" id="represent" readonly="readonly" value="<?php print(htmlentities($postvalues["represent"],ENT_QUOTES,CHARSET)); ?>">
        </dd>
        <dt>担当者名 ふりがな <span class="red">必須</span></dt>
        <dd>
          <input type="text" name="represent_kana" id="represent_kana" readonly="readonly" value="<?php print(htmlentities($postvalues["represent_kana"],ENT_QUOTES,CHARSET)); ?>">
        </dd>
        <dt>メールアドレス <span class="red">必須</span></dt>
        <dd>
          <input type="text" name="email" id="email" readonly="readonly" value="<?php print(htmlentities($postvalues["email"],ENT_QUOTES,CHARSET)); ?>">
        </dd>
        <dt>会社URL <span class="red">必須</span></dt>
        <dd>
          <input type="text" name="url" id="url" readonly="readonly" value="<?php print(htmlentities($postvalues["url"],ENT_QUOTES,CHARSET)); ?>">
        </dd>
        <dt>電話番号 <span class="red">必須</span></dt>
        <dd>
          <input type="text" name="tel" id="tel" readonly="readonly" value="<?php print(htmlentities($postvalues["tel"],ENT_QUOTES,CHARSET)); ?>">
        </dd>
        <dt>お問い合わせ内容（出来るだけ具体的にお願いします） <span class="red">必須</span></dt>
        <dd>
          <textarea name="message" rows="10" id="message" readonly="readonly"><?php print(htmlentities($postvalues["message"],ENT_QUOTES,CHARSET)); ?></textarea>
        </dd>
        </dl>
        <?php foreach($postvalues as $key => $value) { ?>
        <input name="<?php print($key); ?>" type="hidden" value="<?php print(htmlentities($value,ENT_QUOTES,CHARSET)); ?>">
        <?php } ?>
        <input name="from" type="hidden" value="index">
        <input name="action" type="hidden" value="submit">
        <div class="btns">
          <input class="button" TYPE='button' VALUE = '入力画面に戻る' onClick='history.back()' >
          <input type="submit" name="confirm" id="confirm" value="送信する" class="button">
        </div>
      </div>
      </form>

    </div>

    <div id="totop">
      <div class="inner">
        <a href="#"><img src="../common/images/btn_totop.png" alt="トップへ戻る" width="88" height="32"></a>
      </div>
    </div>

    <div id="footer">
      <div class="inner">
      <p>copyright©goodstory.ALL Rights Reserved.</p>
      </div>
    </div>

  <script type="text/javascript" src="../common/js/jquery.min.js"></script>

  <script type="text/javascript" src="../common/js/script.js"></script>
  <script src="../common/js/util.js"></script>
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
