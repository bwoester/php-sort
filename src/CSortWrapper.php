<?php

require_once dirname(__FILE__).'/ISorter.php';

class CSortWrapper implements ISorter
{
    public $sortFunctionName;
    
    public function __construct( $sortFunctionName='sort' ) {
        $this->sortFunctionName = $sortFunctionName;
    }
    
    public function sort( &$a ) {
        call_user_func( $this->sortFunctionName, &$a );
    }
}