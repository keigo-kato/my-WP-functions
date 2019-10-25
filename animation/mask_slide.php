<style>
#top-mainvisual {
  position: relative;
  height: calc(100vh - 80px);
}
.mv-back-01 {
  background-image: url(../images/top_mv_back_01.jpg) !important;
}
.mv-back-02 {
  background-image: url(../images/top_mv_back_02.jpg) !important;
}
.mv-back-03 {
  background-image: url(../images/top_mv_back_03.jpg) !important;
}
.mask {
  content: "";
  position: absolute;
  display: block;
  top: 0;
  left: 0;
  /* 初期位置は左端に置いておくためにrightは100%にする */
  right: 100%;
  bottom: 0;
  background-color: #111;
}
</style>

<div id="top-mainvisual">
  <!-- 最初に画像を読み込んでおかないと、マスクがスライドした時に画像のロードが遅れる -->
	<div class="mv-back mv-back-03 mv-back-02 mv-back-01">
		<span class="mask"></span>
	</div>
	<div class="mv-ttl-box img-box">
		<img src="<?php echo esc_attr(get_template_directory_uri() . '/images/top_mv_ttl_01.png'); ?>" alt="NIIGATA NIPPO SERVICE NET">
	</div>
</div>

<script>
jQuery(document).ready(function($) {
  // TOPページ以外では使わない
	if(location.pathname !== '/') {return false;}
  
  // 単位アニメーションを定義
	function animateValue(left, right) {
		$('.mask').animate({
			left: left + '%',
			right: right + '%',
		}, 500, 'swing');
  }
  // 左から右に現れるマスクのアニメーション
	function slideInLeft() {
		$('.mask').css({'left': '0', 'right': '100%'});
		animateValue(0, 0);
  }
  // 左から右に消えるマスクのアニメーション
	function slideOutLeft() {
		$('.mask').css({'left': '0', 'right': '0'});
		animateValue(100, 0);
	}

  // HTMLの方であらかじめ画像を読み込んでいたので、ここで初期に表示するもの以外の画像リセットする
	$('.mv-back').removeClass('mv-back-02').removeClass('mv-back-03');

  // 3枚の画像が移り変わるまでの一塊を作る
	function unitAnimation() {
		setTimeout(function() {
			slideInLeft();
		}, 4000);
		setTimeout(function() {
			slideOutLeft();
			$('.mv-back').removeClass('mv-back-01').removeClass('mv-back-03');
			$('.mv-back').addClass('mv-back-02');
		}, 4500);
		setTimeout(function() {
			slideInLeft();
		}, 9000);
		setTimeout(function() {
			slideOutLeft();
			$('.mv-back').removeClass('mv-back-01').removeClass('mv-back-02');
			$('.mv-back').addClass('mv-back-03');
		}, 9500);
		setTimeout(function() {
			slideInLeft();
		}, 14000);
		setTimeout(function() {
			slideOutLeft();
			$('.mv-back').removeClass('mv-back-02').removeClass('mv-back-03');
			$('.mv-back').addClass('mv-back-01');
		}, 14500);
	}

	/* まず1周アニメーションを回す */
	unitAnimation();

	/* 2周目移行を無限に回す */
	setInterval(function() {
		unitAnimation();
	}, 15000);
});
</script>