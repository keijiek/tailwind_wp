<?php
/**
 * 定数
 */
// パス用の定数
const TPL_DIR = 'templates';
const VIEWS_DIR = TPL_DIR. '/views';
const HEADER_TPL = TPL_DIR . '/header_part/header_part';
const FOOTER_TPL = TPL_DIR . '/footer_part/footer_part';
const HOME_TPL = VIEWS_DIR . '/home';
const PAGE_TPL = VIEWS_DIR . '/page';
const POST_TPL = VIEWS_DIR . '/post';
const NOT_FOUND_TPL =  VIEWS_DIR. '/not_found';

/**
 * カスタムポストのスラグ
 */


/** ************************************************************
 * requires
 */

// common functions
require_once(__DIR__.'/include/common/common_funcs.php');

// initial_settings's entry point
require_once(__DIR__ . '/include/initial_settings/export.php');
