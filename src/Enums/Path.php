<?php

namespace App\Enums;

enum Path: string {
	case CACHE = APP_DIR . "/src/cache";
	case PUBLIC = APP_DIR . "/public";
	case LAYOUT = APP_DIR . "/src/views/layouts";
	case COMPONENT_ACTIONS = APP_DIR . "/src/views/components/actions";
	case COMPONENT_FORMS = APP_DIR . "/src/views/components/forms";
	case COMPONENT_DRAWERS = APP_DIR . "/src/views/components/drawers";
	case COMPONENT_NAVBARS = APP_DIR . "/src/views/components/navbars";
	case COMPONENT_TILES = APP_DIR . "/src/views/components/tiles";
}
