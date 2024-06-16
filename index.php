<?php
get_template_part(HEADER_TPL);

if (is_front_page() || is_home()) {
  get_template_part(HOME_TPL);
} elseif (is_page()) {
  get_template_part(PAGE_TPL);
} elseif (is_singular('post')) {
  get_template_part(POST_TPL);
} elseif (is_404()) {
  get_template_part(NOT_FOUND_TPL);
} else {
  echo "template file is not found";
}

get_template_part(FOOTER_TPL);
