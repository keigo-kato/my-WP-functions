jQuery(document).ready(function() {

  // ページのロード完了時にDOMが出現していなくてもイベントを発火する。
  // ajaxによってページのロードが完了した後にDOM要素が出現するようなときに有効
  $(document).on('click', '#test', function() {
    console.log('クリック!!');
  });

});
