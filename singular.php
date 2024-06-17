<?php
get_template_part(HEADER_TPL);
/**
 * if (is_singular('CustomPostType1')) {
 *  get_template_part(CustomPostType1_template);
 * } elseif (is_singular('CustomPostType2')){
 *  get_template_part(CustomPostType_template);
 * } else {
 * }
 * ...と、分岐を作って、
 * 最期に何もなければ、汎用投稿テンプレートに飛ばす
 */
get_template_part(PAGE_TPL);
get_template_part(FOOTER_TPL);
