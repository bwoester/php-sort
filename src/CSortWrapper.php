<?php

require_once dirname(__FILE__).'/ISorter.php';

class CSortWrapper implements ISorter
{
    public $sortFunctionName = 'sort';
    public $sortFlags = SORT_REGULAR;
    public $comparisonCallback = null;
    
    public function sort( &$a )
    {
        call_user_func_array(
            $this->sortFunctionName,
            is_callable( $this->comparisonCallback )
                ? array( &$a, $this->comparisonCallback )
                : array( &$a )
        );
    }
}