<article class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

	<header role="header">
		<?php if ($new): ?>
			<span class="new"><?php print $new ?></span>
		<?php endif; ?>

		<?php print render($title_prefix); ?>
		<h3<?php print $title_attributes; ?>><?php print $title ?></h3>
		<?php print render($title_suffix); ?>
	</header>

  <section class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the links now so that we can render them later.
      hide($content['links']);
      print render($content);
    ?>
    <?php if ($signature): ?>
    <div class="user-signature clearfix">
      <?php print $signature ?>
    </div>
    <?php endif; ?>
  </section>

	<footer role="contentinfo">
  	<?php print $picture ?>
    <?php print $permalink; ?>
    <?php print $submitted; ?>
	</footer>

  <?php print render($content['links']) ?>
</article>
