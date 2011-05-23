<?php
require_once 'zee/core/Filter.class.php';

abstract class FilterHelper {
	const PRE_FILTER = 1;
	const POST_FILTER = 2;
	
	
	static public function execFilters($type) {
		//filters
		if (self::PRE_FILTER == $type) {
			$filters = $GLOBALS['appGlobal']['PRE_FILTERS'];
		} elseif (self::POST_FILTER) {
			$filters = $GLOBALS['appGlobal']['POST_FILTERS'];
		}
		if (count($filters)>0) {
			//do all filters
			foreach ($filters as $filter) {
				if (!class_exists($filter)) {
					require_once 'filter/'.$filter.'.class.php';
				}
				$filterInstance = new $filter();
				$filterInstance->init();
			}
		}
	}
}

