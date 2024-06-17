<?php
namespace initial_settings;

/**
 * ウィジェット活性化
 */
class WidgetsActivator {

  function __construct()
  {
    add_action('widgets_init', [&$this, 'activate_widgets']);
  }

  function activate_widgets() {
    register_sidebar([
      'name' => '検索窓', //ウィジェットの名前を入力
      'id' => 'search-box', //ウィジェットに付けるid名を入力
      'description' => '検索窓用'
    ]);
  }
}
