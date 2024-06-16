<?php
namespace initial_settings;

require_once(__DIR__.'/EnqueueScripts.class.php');
new EnqueueScripts();

require_once(__DIR__.'/EssentialFeaturesActivator.class.php');
new EssentialFeaturesActivator();
