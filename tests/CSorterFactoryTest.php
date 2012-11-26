<?php

class CSorterFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider createTestData
     */    
    public function testCreate( $spec, $comparisonCallback, $expected )
    {
        require_once dirname(__FILE__).'/../src/CSorterFactory.php';
        $sorter = CSorterFactory::create( $spec, $comparisonCallback );
        $this->assertEquals( $sorter, $expected );
    }
    
    public function createTestData()
    {
        require_once dirname(__FILE__).'/../src/CSortWrapper.php';
        require_once dirname(__FILE__).'/../src/ISorter.php';
        
        $testData = array();
        
        // test sort() wrapper
        $spec = ISorter::USE_SORT;
        $comparisonCallback = null;
        $expected = new CSortWrapper();
        $expected->sortFunctionName = 'sort';
        $expected->sortFlags = SORT_REGULAR;
        $testData[] = array( $spec, $comparisonCallback, $expected );

        // test asort() wrapper
        $spec = ISorter::USE_ASORT;
        $comparisonCallback = null;
        $expected = new CSortWrapper();
        $expected->sortFunctionName = 'asort';
        $expected->sortFlags = SORT_REGULAR;
        $testData[] = array( $spec, $comparisonCallback, $expected );

        return $testData;
    }
}
