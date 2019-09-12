<?php

/**
 * テスト用のテンプレートファイルを表示する。
 * ログインしており、かつGETパラメータに「?renewal」がついた時だけ専用のテンプレートファイルを表示する。
 * 
 * $pagesのkeyにはテスト対象ページのスラッグ 、valueにはテスト対象ページのIDを入れる。
 * テスト用に作成したテンプレートファイルは/course-templateディレクトリ内に格納する。
 *
 * @param  mixed $template
 *
 * @return void
 */
function my_change_page_template_load( $template ) {
  if ( is_user_logged_in() && isset( $_GET['renewal'] ) ) {
    $pages = array(
      'flow'						 => 7616,
      'schedule'				 => 7629,
      'exam_information' => 7647,
      'support'					 => 7660,
      'apartment'				 => 7686,
      'scholarship'			 => 7708,
    );
    foreach ( $pages as $name => $id ) {
      if ( is_page( $id ) ) {
        $file = '/course-template/' . $name . '.php';
        $template = locate_template( array( $file ) );
      }
    }
  }
  return $template;
}
add_filter( 'template_include', 'my_change_page_template_load', 10, 1 );