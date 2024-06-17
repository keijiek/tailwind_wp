<article class="prose prose-slate mt-8 max-w-none">
  <?php
  if (have_posts()) {
    while (have_posts()) {
      the_post();
  ?>
      <h1><?php echo get_the_title() ?></h1>
  <?php
      the_content();
    }
  }
  ?>
</article>
