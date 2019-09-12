<?php

/**
 * 投稿記事の省略されたタイトルを出力する。
 * どんな全角文字でも半角2文字分としてカウントしている。
 *
 * @param  mixed $pc_length
 * @param  mixed $sp_length
 * @param  mixed $omis 末尾に追加する文字列
 *
 * @return void
 */
function my_the_short_title($pc_length=48, $sp_length=48, $omis="...") {
	$ret = get_the_title($post->ID);
	$ret_length = mb_strlen($ret, 'utf8');
	$length = (is_mobile()) ? $sp_length : $pc_length;
	if($ret_length > $length) {
		$ret = mb_strimwidth($ret, 0, $length * 2, $omis, 'utf8');
	}
	echo $ret;
}