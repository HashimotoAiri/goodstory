<?php

//php設定：デバック用、リリース時は0へ
error_reporting(E_ALL);
ini_set ( "display_errors", "0" );

//メールアドレス設定
//受信者側のメールアドレス
$mailreceiver = "info@good-story.co.jp";

//問い合わせ者に届くメールの送信元
$mailsender = "info@good-story.co.jp";

if(!defined("CHARSET")) {
  define("CHARSET","UTF-8");
}

if(!isset($_POST["action"])) {
  exit;
}else{
  $postvalues = array();
  foreach($_POST as $key => $value){
    $postvalues[$key] = $value;
  }
}

//mbstring設定
mb_language("ja");
mb_internal_encoding(CHARSET);
mb_regex_encoding(CHARSET);

/*--------------------
 * 送信側向け
 *--------------------*/

//送信側向け件名を作成する
$subject  = "お問い合わせありがとうございます";
$subject = mb_encode_mimeheader(trim($subject),CHARSET,"B","\r");

//送信側向け本文を作成する
$comment  = $postvalues["conmany"] . "　" . $postvalues["represent"] . "様\n";
$comment .= "\n";
$comment .= "\n";
$comment .= "この度は、弊社サイトにお問い合わせをいただき、\n";
$comment .= "誠にありがとうございます。\n";
$comment .= "\n";
$comment .= $postvalues["represent"] . "様が送信された内容は下記のとおりです。\n";
$comment .= "ご確認ください。\n";
$comment .= "\n";
$comment .= "------------------------------------------------------------\n";
$comment .= "【会社名】　　　　　：　" . $postvalues["conmany"] . "\n";
$comment .= "【担当者名】　　　　：　" . $postvalues["represent"] . "\n";
$comment .= "【ふりがな】　　　　：　" . $postvalues["represent_kana"] . "\n";
$comment .= "【メールアドレス】　：　" . $postvalues["email"] . "\n";
$comment .= "【会社URL】　　　　：　" . $postvalues["url"] . "\n";
$comment .= "【電話番号】　　　　：　" . $postvalues["tel"] . "\n";
$comment .= "【お問い合わせ内容】" . "\n";;
$comment .= $postvalues["message"] . "\n";
$comment .= "------------------------------------------------------------\n";
$comment .= "\n";
$comment .= "担当者より、3営業日以内にご連絡させていただきますので、\n";
$comment .= "今しばらくお待ちください。\n";
$comment .= "\n";
$comment .= "Good story for you！\n";
$comment .= "\n";
$comment .= "==========\n";
$comment .= "株式会社goodstory\n";
$comment .= "東京都渋谷区道玄坂1−12−1　渋谷マークシティW22階\n\n\n";
$comment = base64_encode($comment);

//ヘッダを作成する
$mailheader  = "Content-Type: text/plain;charset=".CHARSET."\n";
$mailheader .= "Content-Transfer-Encoding: base64\n";
$mailheader .= "MIME-Version: 1.0\n";
$mailheader .= "From: " . $mailsender . "\n";
$mailheader .= "Bcc: hashimotoairi@gmail.com";
$mailheader .= "\n";

//お問い合わせ受付メール送信処理
$result = mail($postvalues["email"],$subject,$comment,$mailheader);
if(!$result) {
  exit;
}

/*--------------------
 * 受信側向け
 *--------------------*/
//受信側向け件名を作成する
$subject  = "お問い合わせが届きました。";
$subject = mb_encode_mimeheader(trim($subject),CHARSET,"B","\r");

//受信側向け本文を作成する
$comment  = $postvalues["conmany"] . "　" . $postvalues["represent"] . "様 \n";
$comment .= "よりお問い合わせが届きました。\n";
$comment .= "\n";
$comment .= $postvalues["represent"] . "様が送信された内容は下記のとおりです。\n";
$comment .= "ご確認ください。\n";
$comment .= "\n";
$comment .= "------------------------------------------------------------\n";
$comment .= "【会社名】　　　　：　" . $postvalues["conmany"] . "\n";
$comment .= "【担当者名】　　　：　" . $postvalues["represent"] . "\n";
$comment .= "【ふりがな】　　　 ：　" . $postvalues["represent_kana"] . "\n";
$comment .= "【メールアドレス】　：　" . $postvalues["email"] . "\n";
$comment .= "【会社URL】　　　：　" . $postvalues["url"] . "\n";
$comment .= "【電話番号】　　　：　" . $postvalues["tel"] . "\n";
$comment .= "【お問い合わせ内容】" . "\n";;
$comment .= $postvalues["message"] . "\n";
$comment .= "------------------------------------------------------------\n";
$comment .= "\n";
$comment .= "==========\n";
$comment .= "株式会社goodstory\n";
$comment .= "東京都渋谷区道玄坂1−12−1　渋谷マークシティW22階\n\n\n";
$comment = base64_encode($comment);

//ヘッダを作成する
$mailheader  = "Content-Type: text/plain;charset=".CHARSET."\n";
$mailheader .= "Content-Transfer-Encoding: base64\n";
$mailheader .= "MIME-Version: 1.0\n";
$mailheader .= "From: " . $postvalues["email"] . "\n";
$mailheader .= "Bcc: hashimotoairi@gmail.com";
$mailheader .= "\n";

//受付メールアドレス宛メール送信処理
$result = mail($mailreceiver,$subject,$comment,$mailheader);
if(!$result) {
  exit;
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
          <p>お問い合わせを承りました。後日担当者よりご連絡差し上げます。</p>
        </div>

        <div class="inner">
          <p class="mb33 button">
            <a href="../index.html">トップページへ戻る</a>
          </p>
        </div>

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
