	var userAgent = window.navigator.userAgent.toLowerCase();
	if (userAgent.indexOf('msie') != -1) {

(function($){
	/*
	 * 背景画像をimgタグに変換する
	 * ページ読み込み時にbackground-sizeが指定されている要素が対象
	 * 基本的にIE8でしか使うことを想定していない
	 * この世のIEが全部9以上になればいいのに
	 */
	$.remakeImageAll = function() {
		//CSSの読み込み
		sheets = document.styleSheets;	

		for(i = 0; i < sheets.length; i++) {
			sheet = sheets[i];
			rules = sheet.rules || sheet.cssRules;
			if(rules.length > 0) {
				for(j = 0; j < rules.length; j++) {
					rule = rules[j];

					//スタイルにbackground-sizeが指定されていなければ処理を行わない
					cssText = rule.style.cssText.toLowerCase();
					if(!cssText.match(/background-size/)) {
						continue;
					}			

					cssText = cssText.split(';');
					if(cssText.length == 0) {
						continue;
					}

					for(k = 0; k < cssText.length; k++) {
						styleAttr = cssText[k];

						//background-sizeが指定されていれば処理を行う
						if(!styleAttr.match(/background-size/)) {
							continue;
						}

						//対象のセレクタ
						selectorText = rule.selectorText.toLowerCase();

						//background-sizeの値を取得
						bkSize = styleAttr.replace('background-size:', '').replace(/^\s+/, '');

						$('body').find(selectorText).each(function(){
							//背景をimgタグに変換
							$(this).makeImage(bkSize);
						});

						break;
					}
				}
			}
		}
	};

	/*
	 * 特定の要素の背景画像をimgタグに変換
	 * javascriptでbackgroundSizeを指定する必要がある
	 * ex) $('#id').remakeImage({backgroundSize:'10px 10px'});
	 * この世のIEが全部9以上になればいいのに
	 */
	$.fn.remakeImage = function(options) {
		//初期値
		var defaults = {
			backgroundSize : 'auto auto'
        },
        settings = $.extend({}, defaults, options);

		this.css({'backgroundSize':settings.backgroundSize});
		bkSize = this.css('backgroundSize');

		//背景をimgタグに変換
		this.makeImage(bkSize);
	};

	/**
	 * 背景を消してimgタグを出力
	 * この世のIEが全部9以上になればいいのに
	 */
	$.fn.makeImage = function(bkSize) {
		//正規表現用の変数
		var bkSrc = /url\(["']?(.*?)["']?\)/;

		//背景画像がリピートしているものには対応できない
		if(this.css('backgroundRepeat') != 'no-repeat') {
			return false;
		}

		//背景画像のURLを取得
		bkImg = this.css('backgroundImage');

		if(bkImg == 'none' || bkImg == null) {
			return false;
		}

		bkImg = bkSrc.exec(bkImg)[1];

		w = this.width();
		h = this.height();

		//生成する画像のサイズと位置を算出
		switch(bkSize) {
			//TODO containとcoverはよく分かんないから対応を保留中（とりあえずautoか100%でいんじゃね？）
			case 'contain':
				imgWidth = (w >= h) ? 'auto' : '100%';
				imgHeight = (w >= h) ? '100%' : 'auto';
				posTop = posLeft = 0;
				break;
			case 'cover':
				imgWidth = (w >= h) ? '100%' : 'auto';
				imgHeight = (w >= h) ? 'auto' : '100%';
				posTop = posLeft = 0;
				break;
			default:
				//画像のサイズはbackground-sizeと同じ
				imgSize = bkSize.split(' ');
				imgWidth = imgSize[0];
				imgHeight = imgSize[1] ? imgSize[1] : imgSize[0];

				//画像の位置はbackground-positionに準拠
				bkPosX = this.css('backgroundPositionX');
				bkPosY = this.css('backgroundPositionY');

				switch(bkPosX) {
					case 'left':
						bkPosX = '0%';
						break;
					case 'center':
						bkPosX = '50%';
						break;
					case 'right':
						bkPosX = '100%';
						break;
				}

				switch(bkPosY) {
					case 'top':
						bkPosY = '0%';
						break;
					case 'center':
						bkPosY = '50%';
						break;
					case 'bottom':
						bkPosY = '100%';
						break;
				}

				//TODO autoの場合はbackground-positionに依存しない（そのうち拡張する？）
				if(imgWidth == 'auto') {
					posLeft = 0;
				} else {
					if(bkPosX == '100%') {
						posLeft = 'auto';
					} else {
						posLeft = bkPosX.match(/%/) ? w * (parseFloat(bkPosX) / 100) : parseFloat(bkPosX);
						posLeft = posLeft - (parseInt(imgWidth) / 2);

						if(posLeft < 0) {
							posLeft = 0;
						}
					}
				}

				if(imgHeight == 'auto') {
					posTop = 0;
				} else {
					if(bkPosY == '100%') {
						posTop = 'auto';
					} else {
						posTop = bkPosY.match(/%/) ? h * (parseFloat(bkPosY) / 100) : parseFloat(bkPosY);
						posTop = posTop - (parseInt(imgHeight) / 2);

						if(posTop < 0) {
							posTop = 0;
						}						
					}
				}

				break;
		}

		//背景画像を消す
		this.css({
			backgroundImage: 'none',
			position: 'relative'
		});

		//positionがstaticになっているものはrelativeに変換
		//明示的に指定してない場合はstaticになっているはず
		this.children().each(function() {
			if($(this).css('position') == 'static') {
				$(this).css({
					position: 'relative'
				});
			}
		});

		//divの生成
		pdTop = this.css('paddingTop');
		pdLeft = this.css('paddingLeft');
		wrapper = $( "<div>" ).css({
			position: "absolute",
			// zIndex: -1,
			top: pdTop,
			left: pdLeft,
			right: 0,
			bottom: 0,
			overflow: "hidden"
		});

		//背景画像を使ったimgタグを生成
		img = $( "<img>" ).css({
			position: "absolute",
			top: posTop,
			left: posLeft,
			right: 0,
			bottom: 0,
			width: imgWidth,
			height: imgHeight
		}).attr({
			src: bkImg
		}).appendTo(wrapper);

		//タグの埋め込み
		wrapper.prependTo(this);
	}
})(jQuery);

//ページ読み込み時
$(function(){
		$.remakeImageAll();
});

	}
