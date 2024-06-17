<?php
namespace initial_settings;

/**
 * メディアにアップロードするファイルを相対パスで保存・参照
 */
class RelativePath {

  function __construct()
  {
    add_filter('wp_get_attachment_url', [&$this, 'delete_domain_from_image_url']);
    add_filter('attachment_link', [&$this, 'delete_domain_from_image_url']);
  }

  function delete_domain_from_image_url($url)
  {
    if (preg_match('/^http(s)?:\/\/[^\/\s]+(.*)$/', $url, $match)) {
      $url = $match[2];
    }
    return $url;
  }
}
