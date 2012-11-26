<?php

require_once dirname(__FILE__).'/ISorter.php';

class CSortWrapper implements ISorter
{
    public $sortFunctionName = 'sort';
    public $sortFlags = SORT_REGULAR;
    public $comparisonCallback = null;
    
    public function sort( &$a )
    {
        if (is_callable($this->comparisonCallback))
        {
            call_user_func_array(
                $this->sortFunctionName,
                array( &$a, $this->comparisonCallback )
            );
        }
        else
        {
            call_user_func_array(
                $this->sortFunctionName,
                $this->sortFlags === null
                    ? array( &$a )
                    : array( &$a, $this->sortFlags )
            );
        }
    }
}