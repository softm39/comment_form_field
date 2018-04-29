<?php 

$make_date = md5("sigma".date("YMDHIS")."fig") ;
//$make_date = "";

add_action("comment_form_logged_in_after","hc_comment_form_html");
add_action("comment_form_after_fields","hc_comment_form_html");

function hc_comment_form_html(){
  global $make_date;
?>
<input type="hidden" name="softm_catch_comment_spam" id="softm_catch_comment_spam" value="" />
<script type="text/javascript">
(function($) {
  $("[name=softm_catch_comment_spam]").val("sigma-01-<?=$make_date;?>");
})( jQuery );
</script><?php
}

add_filter( 'preprocess_comment', function($_data){
    global $make_date;
    if( 
      !isset($_POST['softm_catch_comment_spam']) ||
      $_POST['softm_catch_comment_spam']!="sigma-01-".$make_date
    )
    die("http/403");
    return $_data;
  },10,2);



