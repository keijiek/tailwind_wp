<?php

namespace initial_settings;

class EnqueueScripts
{
  const TAILWIND = 'tailwind';
  const ALPINE = 'alpine';
  const PRISM = 'prism';
  private $is_develop;

  public function __construct(bool $is_develop = \false)
  {
    $this->is_develop = $is_develop;
    add_action('wp_enqueue_scripts', [&$this, 'enqueue_scripts']);
  }

  public function enqueue_scripts()
  {
    $this->enqueue_something(self::TAILWIND, 'assets/dist/css/tailwind.css', []);
    $this->enqueue_something(self::ALPINE, 'assets/dist/js/index.js', []);
    $this->enqueue_prism();
  }

  private function enqueue_prism() {
    $this->enqueue_something(self::PRISM, 'assets/prism/prism.css', [self::TAILWIND]);
    $this->enqueue_something(self::PRISM, 'assets/prism/prism.js', [self::ALPINE], true);
  }

  private function enqueue_something(string $handler, string $file_path, array $depends = [], bool $in_footer = \false)
  {
    $version = $this->get_version_hash($file_path);
    if (preg_match('/\.(css)$/i', $file_path)) {
      wp_enqueue_style($handler, get_theme_file_uri($file_path), $depends, $version);
    } elseif (preg_match('/\.(js)$/i', $file_path)) {
      wp_enqueue_script($handler, get_theme_file_uri($file_path), $depends, $version, $in_footer);
    }
  }

  private function get_version_hash(string $file_path)
  {
    return $this->is_develop ? (new \DateTimeImmutable())->format('YmdHis') : filemtime(get_theme_file_path($file_path));
  }
}
