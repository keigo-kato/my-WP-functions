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


/**
 * timthumを用いて画像を出力する
 * 出力されるHTMLはimgタグであって、画像URL文字列ではないことに注意
 *
 * 引数の$timthumb_paramsには以下の変数をキーとする配列を入れる
 * @param  mixed $img_uri_or_id
 * @param  mixed $thumb_w
 * @param  mixed $thumb_h
 * @param  mixed $zc
 * @param  mixed $alt
 * @param  mixed $noimage_uri
 * @param  mixed $placehold
 *
 * @return void
 */
function my_get_img_src_for_timthumb( $img_uri_or_id, $noimage_uri ) {
	$src = is_numeric( $img_uri_or_id ) ? wp_get_attachment_url( $img_uri_or_id ) : $img_uri_or_id;
	if ( $src && is_string( $src ) ) {
		return str_replace( untrailingslashit( site_url() ), '', $src );
	}
	if ( $noimage_uri ) {
		return str_replace( untrailingslashit( site_url() ), '', $noimage_uri );
	}
	return '';
}
function my_get_img_tag_with_timthumb( $timthumb_params ) {
	$timthumb_params = wp_parse_args( $timthumb_params, array(
		'img_uri_or_id' => '', 
		'thumb_w' => 480, 
		'thumb_h' => 320, 
		'zc' => 1, 
		'alt' => '', 
		'noimage_uri' => '', 
		'placehold' => 'Noimage', 
	) );
	extract( $timthumb_params );

	$img = vsprintf( '<img src="//placehold.jp/%dx%d.png?text=%s" alt="%s">', array(
		esc_attr( $thumb_w ), 
		esc_attr( $thumb_h ), 
		esc_attr( $placehold ), 
		esc_attr( $alt ), 
	) );

	if ( !file_exists( get_stylesheet_directory() . '/scripts/timthumb.php' ) ) return $img;

	$timthumb_src = function_exists( 'my_get_img_src_for_timthumb' ) ? my_get_img_src_for_timthumb( $img_uri_or_id, $noimage_uri ) : '';
	if ( !$timthumb_src ) return $img;

	$img_src = add_query_arg( array(
		'src' => $timthumb_src, 
		'w' => $thumb_w, 
		'h' => $thumb_h, 
		'q' => '100', 
		'zc' => $zc, 
	), get_stylesheet_directory_uri() . '/scripts/timthumb.php' );

	return vsprintf( '<img src="%s" alt="%s">', array(
		esc_attr( $img_src ), 
		esc_attr( $alt ), 
	) );
}

/**
 * カテゴリーのリストをバッジで出力するとき、一つだけまたは全て出力かを選択できる。
 *
 * @param  mixed $is_one
 *
 * @return void
 */
function my_the_cat_list($is_one = true) {
  $wp_cats = get_the_category();
  if(empty($wp_cats[0])) {return false;}

	$catlist = array();
  $cat_items = '';
	foreach( $wp_cats as $cat ) {
		$catlist[] = '<a href="' . get_category_link($cat->term_id) . '" class="entry-meta cat cat-item badge badge-black cat-item-' . $cat->cat_ID . '">' . $cat->cat_name . '</a>';
	}
  echo $cat_items = ($is_one) ? $catlist[0] : implode("\n", $catlist);
}