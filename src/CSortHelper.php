<?php

class CSortHelper
{
    /**
     * @see "http://www.codecodex.com/wiki/Merge_sort#PHP"
     */
    public static function mergeSort( &$a )
    {
        if (count($a) <= 1) {
            return;
        }
        
    	$b = array_splice( $a, count($a) / 2 );
        
    	self::mergeSort( $a );
    	self::mergeSort( $b );
    	
        $o = array();
        
        // as long as one of the arrays contains data...
    	while (!empty($a) || !empty($b))
        {
            // if one of the array is empty, shift from the other
    		if (empty($a) || empty($b))
            {
                $o[] = empty($a) ? array_shift($b) : array_shift($a);
    		}
            // otherwise, shift the smaller value
            else
            {
                $o[] = $a[0] > $b[0] ? array_shift($b) : array_shift($a);
    		}
    	}
        
    	$a = $o;
    }
    
    public static function compareRegular( $a, $b ) {
        return $a < $b;
    }
    
}
