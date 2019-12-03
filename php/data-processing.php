<?php

/**
 * 入力した年月日から曜日を抽出して、まとめて出力する。
 *
 * @param  mixed $date 形式は"Y年m月j日"で入力する。
 *
 * @return void 出力は"Y年m月j日(w)"となる。
 */
function my_date_wi_week($date) {
	$format = "n月j日(";
	$week = array( "日", "月", "火", "水", "木", "金", "土" );
	$ym = array("年", "月");

	$working_date = str_replace("日", "", $working_date);
	$str_date = str_replace($ym, "-", $working_date);
	$datetime = new DateTime($str_date);
	echo $datetime->format($format).$week[$datetime->format('w')].')';
}