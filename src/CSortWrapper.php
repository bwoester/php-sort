<?php

require_once dirname(__FILE__).'/ISorter.php';

class CSortWrapper implements ISorter
{
    public $sortFunctionName = 'sort';
    public $sortFlags = SORT_REGULAR;
    
    public function sort( &$a ) {
        call_user_func( $this->sortFunctionName, &$a );
    }
}