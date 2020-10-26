<?php 
/**
 * Plugin Name: Verified User by Role - Asikinaja.com
 * Plugin URI:  https://asikinaja.com
 * Description: Membuat badge verified pada user role
 * Version:     0.1
 * Author:      @permanart
 * Author URI:  https://asikinaja.com/
 *
 */


function add_verification_bagdge_to_authors($display_name) {
  global $authordata;

  if (!is_object($authordata))
      return $display_name;

  $icon_roles = array(
      'administrator',
      'editor',
      'um_verified-user',
  );

  $found_role = false;
  foreach ($authordata->roles as $role) {
      if (in_array(strtolower($role), $icon_roles)) {
          $found_role = true;
          break;
      }
  }

  if (!$found_role)
      return $display_name;

  $result = sprintf('%s <i title="%s" class="fa fa-check-circle"></i>',
      $display_name,
      __('This is a Verified Author', 'text-domain-here')
  );

  return $result;
}
add_filter( 'the_author', 'add_verification_bagdge_to_authors' );

function my_comment_author( $author = '' ) {
  // Get the comment ID from WP_Query

  $comment = get_comment( $comment_ID );

  if ( ! empty($comment->comment_author) ) {
      if (!empty($comment->user_id)){
          $user=get_userdata($comment->user_id);
          $author=$user->display_name.' '. do_shortcode('[this_is_verified-sc]'); // This is where i used the shortcode
      } else {
          $author = $comment->comment_author;
      }
  } else {
      $author = $comment->comment_author;
  }

  return $author;
}
add_filter('get_comment_author', 'my_comment_author', 10, 1);

function add_verification_bagdge_to_authors_sc($display_name) {
    global $authordata;

    if (!is_object($authordata))
        return $display_name;

    $icon_roles = array(
        'administrator',
	'editor',
  'um_verified-user'
	
    );

    $found_role = false;
    foreach ($authordata->roles as $role) {
        if (in_array(strtolower($role), $icon_roles)) {
            $found_role = true;
            break;
        }
    }

    if (!$found_role)
        return $display_name;

    $result = sprintf('%s <i title="%s" class="fa fa-check-circle"></i>', $display_name,  __('This is a Verified Author', 'text-domain-here') );

    return $result;
}
add_shortcode( 'this_is_verified-sc', 'add_verification_bagdge_to_authors_sc' );

  ?>
