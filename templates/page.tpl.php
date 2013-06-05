  <div id="page">

    <header id="page-header" role="header">

      <a href="<?php print $front_page; ?>" rel="home" id="home-link">
      	<?php if ($logo): ?>
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      	<?php endif; ?>

				<?php if ($site_name): ?>
					<?php if ($title): ?>
						<span id="site-name"><?php print $site_name; ?></span>
					<?php else: /* Use h1 when the content title is empty */ ?>
						<h1 id="site-name"><?php print $site_name; ?></h1>
					<?php endif; ?>
        <?php endif; ?>
				<?php if ($site_slogan): ?>
					<div id="site-slogan"><?php print $site_slogan; ?></div>
				<?php endif; ?>
      </a>

      <?php print render($page['header']); ?>

    </header>

    <?php if ($main_menu || $secondary_menu): ?>
      <nav id="navigation" role="navigation">
        <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu'))); ?>
        <?php print theme('links__system_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary-menu'))); ?>
      </nav>
    <?php endif; ?>

    <?php if ($breadcrumb): ?>
      <div id="breadcrumb"><?php print $breadcrumb; ?></div>
    <?php endif; ?>

    <?php print $messages; ?>

    <main id="page-main" role="main">

      <div id="main-content" class="column">
        <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php if ($tabs): ?><nav class="tabs"><?php print render($tabs); ?></nav><?php endif; ?>
        <?php print render($page['help']); ?>
        <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
        <?php print render($page['content']); ?>
        <?php print $feed_icons; ?>
      </div> <!-- #main-content -->

      <?php if ($page['sidebar_first']): ?>
        <section id="sidebar-first" class="column sidebar">
          <?php print render($page['sidebar_first']); ?>
        </section>
      <?php endif; ?>

      <?php if ($page['sidebar_second']): ?>
        <section id="sidebar-second" class="column sidebar">
          <?php print render($page['sidebar_second']); ?>
        </section>
      <?php endif; ?>

		</main>

    <footer id="page-footer" role="footer">
      <?php print render($page['footer']); ?>
    </footer>

  </div> <!-- #page -->
