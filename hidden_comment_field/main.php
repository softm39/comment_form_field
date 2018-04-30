<?php 

/**
 * Hidden Field To Comments
 *
 * Hidden Comment Field provides functionality to block more spam by adding hidden field with jquery
 *
 * @package hidden-field-to-comments
 * @since   1.0.1
 */

// init field and value
session_start();
if (!isset($_SESSION["field_name"]))
  $_SESSION["field_name"] = "comment" . mt_rand(10000,100000);
if (!isset($_SESSION["make_date"]))
  $_SESSION["make_date"] = mt_rand(10000,100000);

// add action to the form
add_action("comment_form_logged_in_after","hc_comment_form_html");
add_action("comment_form_after_fields","hc_comment_form_html");

function hc_comment_form_html(){
 $field_name = $_SESSION["field_name"];
 $make_date = $_SESSION["make_date"];
?>
<span class="ph_<?=$field_name;?>" style="display:none;"></span>
<script type="text/javascript">
(function($) {
  $(".ph_<?=$field_name;?>").html("<input type='text' name='<?=$field_name;?>' id='<?=$field_name;?>' value='sigma-01-<?=$make_date;?>' />");
})( jQuery );
</script><?php
}

// process form
add_filter( 'preprocess_comment', function($_data){
 $field_name = $_SESSION["field_name"];
 $make_date = $_SESSION["make_date"];
    if( 
      !isset($_POST[$field_name]) ||
      $_POST[$field_name]!="sigma-01-".$make_date
    )
    die("http/403");
    return $_data;
  },10,2);

