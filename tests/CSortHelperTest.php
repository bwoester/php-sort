<?php

class CSortHelperTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider mergeSortTestData
     */    
    public function testMergeSort( $a, $expected )
    {
        require_once dirname(__FILE__).'/../src/CSortHelper.php';
        CSortHelper::mergeSort( $a );
        $this->assertEquals( $a, $expected );
        $this->assertEquals( array_keys($a), array_keys($expected) );
        $this->assertEquals( array_values($a), array_values($expected) );
    }
    
    public function mergeSortTestData()
    {
        $testData = array();
        
        // test behavior on empty arrays (should not crash!)
        $a = array();
        $expected = array();
        $testData[] = array( $a, $expected );

        // test behavior on even array, pre-sorted
        $a = array( 1, 2 );
        $expected = array( 1, 2 );
        $testData[] = array( $a, $expected );

        // test behavior on even array, reverse pre-sorted
        $a = array( 2, 1 );
        $expected = array( 1, 2 );
        $testData[] = array( $a, $expected );

        // test behavior on even array, randomized
        $a = array( 1, 3, 2, 4 );
        $expected = array( 1, 2, 3, 4 );
        $testData[] = array( $a, $expected );

        // test behavior on odd array, pre-sorted
        $a = array( 1, 2, 3 );
        $expected = array( 1, 2, 3 );
        $testData[] = array( $a, $expected );

        // test behavior on odd array, reverse pre-sorted
        $a = array( 3, 2, 1 );
        $expected = array( 1, 2, 3 );
        $testData[] = array( $a, $expected );

        // test behavior on odd array, randomized
        $a = array( 1, 3, 2 );
        $expected = array( 1, 2, 3 );
        $testData[] = array( $a, $expected );

        // Testing stability.
        // For PHP,  0 and 'somestring' are equal. So an array containing only
        // zeros and a certain string value consists of entries, that are all
        // equal to each other. An algorithm that is not stable might rearrange
        // those equal values when sorting. Since none of them is bigger or
        // smaller than the other, their relative position doesn't matter.
        // MergeSort is a "stable" sort algorithm, so it promises to respect
        // the relative position of equal values. The position of zeros and
        // string values must not change.
        
        // test stable behavior - pass 1
        $a = array( 0, 'test' );
        $expected = array( 0, 'test' );
        $testData[] = array( $a, $expected );
        
        // test stable behavior - pass 2
        $a = array( 0, 'test', 0 );
        $expected = array( 0, 'test', 0 );
        $testData[] = array( $a, $expected );

        // test stable behavior - pass 3
        $a = array( 0, 'test', 0, 0, 'test', 'test', 0, 0, 0, 'test', 'test', 'test' );
        $expected = array( 0, 'test', 0, 0, 'test', 'test', 0, 0, 0, 'test', 'test', 'test' );
        $testData[] = array( $a, $expected );

        // test stable behavior - pass 4
        $a = array( 0, 'test', 0, 0, 'test', 'test', 0, 0, 0, 'test', 'test', 'test', 0, 0, 0, 0, 'test', 'test', 'test', 'test', 0, 0, 0, 0, 0, 'test', 'test', 'test', 'test', 'test', 0, 0, 0, 0, 0, 0, 'test', 'test', 'test', 'test', 'test', 'test' );
        $expected = array( 0, 'test', 0, 0, 'test', 'test', 0, 0, 0, 'test', 'test', 'test', 0, 0, 0, 0, 'test', 'test', 'test', 'test', 0, 0, 0, 0, 0, 'test', 'test', 'test', 'test', 'test', 0, 0, 0, 0, 0, 0, 'test', 'test', 'test', 'test', 'test', 'test' );
        $testData[] = array( $a, $expected );

        // TODO: Provide better tests once we support custom camparison of
        //       objects. Comparing objects with properties "value" and
        //       "position". Compare by value, all values equal, validate
        //       positions.

        return $testData;
    }
}
