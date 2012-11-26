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
        $this->assertEquals( $expected, $sorter );
    }
    
    public function createTestData()
    {
        require_once dirname(__FILE__).'/../src/CSortHelper.php';
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

        // test arsort() wrapper
        $spec = ISorter::USE_ARSORT;
        $comparisonCallback = null;
        $expected = new CSortWrapper();
        $expected->sortFunctionName = 'arsort';
        $expected->sortFlags = SORT_REGULAR;
        $testData[] = array( $spec, $comparisonCallback, $expected );

        // test krsort() wrapper
        $spec = ISorter::USE_KRSORT;
        $comparisonCallback = null;
        $expected = new CSortWrapper();
        $expected->sortFunctionName = 'krsort';
        $expected->sortFlags = SORT_REGULAR;
        $testData[] = array( $spec, $comparisonCallback, $expected );

        // test ksort() wrapper
        $spec = ISorter::USE_KSORT;
        $comparisonCallback = null;
        $expected = new CSortWrapper();
        $expected->sortFunctionName = 'ksort';
        $expected->sortFlags = SORT_REGULAR;
        $testData[] = array( $spec, $comparisonCallback, $expected );

        // test natcasesort() wrapper
        $spec = ISorter::USE_NATCASESORT;
        $comparisonCallback = null;
        $expected = new CSortWrapper();
        $expected->sortFunctionName = 'natcasesort';
        $expected->sortFlags = null;
        $testData[] = array( $spec, $comparisonCallback, $expected );

        // test natsort() wrapper
        $spec = ISorter::USE_NATSORT;
        $comparisonCallback = null;
        $expected = new CSortWrapper();
        $expected->sortFunctionName = 'natsort';
        $expected->sortFlags = null;
        $testData[] = array( $spec, $comparisonCallback, $expected );

        // test uasort() wrapper
        $spec = ISorter::USE_UASORT;
        $comparisonCallback = array('CSortHelper', 'compareRegular');
        $expected = new CSortWrapper();
        $expected->sortFunctionName = 'uasort';
        $expected->sortFlags = null;
        $expected->comparisonCallback = $comparisonCallback;
        $testData[] = array( $spec, $comparisonCallback, $expected );

        // test uksort() wrapper
        $spec = ISorter::USE_UKSORT;
        $comparisonCallback = array('CSortHelper', 'compareRegular');
        $expected = new CSortWrapper();
        $expected->sortFunctionName = 'uksort';
        $expected->sortFlags = null;
        $expected->comparisonCallback = $comparisonCallback;
        $testData[] = array( $spec, $comparisonCallback, $expected );

        // test usort() wrapper
        $spec = ISorter::USE_USORT;
        $comparisonCallback = array('CSortHelper', 'compareRegular');
        $expected = new CSortWrapper();
        $expected->sortFunctionName = 'usort';
        $expected->sortFlags = null;
        $expected->comparisonCallback = $comparisonCallback;
        $testData[] = array( $spec, $comparisonCallback, $expected );

        return $testData;
    }
}
