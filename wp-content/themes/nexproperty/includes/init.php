<?php

NexProperty\Assets::instance();
NexProperty\Customizer::instance();

locate_template( '/includes/theme-setup.php', true, false );
locate_template( '/includes/tgm_pa/configuration.php', true, false );
locate_template( '/includes/ocdi/configuration.php', true, false );