<?php
namespace initial_settings;

require_once(__DIR__.'/EnqueueScripts.class.php');
new EnqueueScripts();

require_once(__DIR__.'/EssentialFeaturesActivator.class.php');
new EssentialFeaturesActivator();

require_once(__DIR__.'/WidgetsActivator.class.php');
new WidgetsActivator();

require(__DIR__.'/RelativePath.class.php');
new RelativePath();
