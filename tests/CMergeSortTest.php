<?php

class CMergeSortTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */    
    public function testSort( $a, $expected )
    {
        require_once dirname(__FILE__).'/../src/CMergeSort.php';
        CMergeSort::sort( $a );
        $this->assertEquals( $a, $expected );
    }
    
    public function provider()
    {
        $testData = array();
        
        // test behavior on empty arrays (should not crash!)
        $a = array();
        $expected = array();
        $testData[] = array( $a, $expected );
        
        return $testData;
    }
}