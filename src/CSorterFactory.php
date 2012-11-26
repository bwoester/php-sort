<?php

class CSorterFactory
{
    private static $instance = null;
    private $_sorterFactoryMethods = array();
    
    /**
     * Creates an ISorter, implementing the requested characteristics
     * @param $spec integer constructed by using ISort constants
     * @return ISorter
     * @throws UnknownSorterException
     * @code
     * $sorter = CSorterFactory::create( ISorter::COMPARE_CASE_INSENSITIVE | ISorter::ORDER_DESC );
     * @endcode
     */
    public static function create( $spec=0, $comparisonCallback=null )
    {
        $self       = self::getInstance();
        $factory    = $self->getFactoryMethod( $spec );
        
        if (is_callable($factory)) {
            return is_callable($comparisonCallback)
                ? call_user_func_array( $factory, array($comparisonCallback) )
                : call_user_func_array( $factory, array() );
        }
        
        require_once dirname(__FILE__).'/CUnknownSorterException.php'; 
        throw new CUnknownSorterException( $spec );
    }

    /**
     * Allows to register custom sorters.
     * 
     * @param $spec integer used to identify the sorter
     * @param $factoryMethod callable to be called when the registered sorter
     *        is requested. The factory method will be called without
     *        parameters if the sorter is not using custom comparison. The
     *        factory method will be called with one parameter (a callable) if
     *        sorter is a usort variant (uses a user defined callback to
     *        compare array items).
     */
    public static function registerSorter( $spec, $factoryMethod )
    {
        $self = self::getInstance();
        // cast spec to string, to avoid allocation a big array
        $self->_sorterFactoryMethods[ (string)$spec ] = $factoryMethod;
    }

    private static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new CSorterFactory();
            self::$instance->init();
        }
        
        return self::$instance;
    }
    
    private function init()
    {
        $this->registerSorter( ISorter::USE_ASORT       , array($this,'createASortWrapper')         );
        $this->registerSorter( ISorter::USE_ARSORT      , array($this,'createARSortWrapper')        );
        $this->registerSorter( ISorter::USE_KRSORT      , array($this,'createKRSortWrapper')        );
        $this->registerSorter( ISorter::USE_KSORT       , array($this,'createKSortWrapper')         );
        $this->registerSorter( ISorter::USE_NATCASESORT , array($this,'createNatCaseSortWrapper')   );
        $this->registerSorter( ISorter::USE_NATSORT     , array($this,'createNatSortWrapper')       );
        $this->registerSorter( ISorter::USE_RSORT       , array($this,'createRSortWrapper')         );
        $this->registerSorter( ISorter::USE_SORT        , array($this,'createSortWrapper')          );
        $this->registerSorter( ISorter::USE_UASORT      , array($this,'createUASortWrapper')        );
        $this->registerSorter( ISorter::USE_UKSORT      , array($this,'createUKSortWrapper')        );
        $this->registerSorter( ISorter::USE_USORT       , array($this,'createUSortWrapper')         );
    }

    private function createASortWrapper()
    {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        $sorter = new CSortWrapper();
        $sorter->sortFunctionName = 'asort';
        $sorter->sortFlags = SORT_REGULAR;
        return $sorter;
    }
    
    private function createARSortWrapper()
    {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        $sorter = new CSortWrapper();
        $sorter->sortFunctionName = 'arsort';
        $sorter->sortFlags = SORT_REGULAR;
        return $sorter;
    }
    
    private function createKRSortWrapper()
    {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        $sorter = new CSortWrapper();
        $sorter->sortFunctionName = 'krsort';
        $sorter->sortFlags = SORT_REGULAR;
        return $sorter;
    }
    
    private function createKSortWrapper()
    {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        $sorter = new CSortWrapper();
        $sorter->sortFunctionName = 'ksort';
        $sorter->sortFlags = SORT_REGULAR;
        return $sorter;
    }
    
    private function createNatCaseSortWrapper()
    {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        $sorter = new CSortWrapper();
        $sorter->sortFunctionName = 'natcasesort';
        $sorter->sortFlags = null;
        return $sorter;
    }
    
    private function createNatSortWrapper()
    {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        $sorter = new CSortWrapper();
        $sorter->sortFunctionName = 'natsort';
        $sorter->sortFlags = null;
        return $sorter;
    }
    
    private function createRSortWrapper()
    {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        $sorter = new CSortWrapper();
        $sorter->sortFunctionName = 'rsort';
        $sorter->sortFlags = SORT_REGULAR;
        return $sorter;
    }
    
    private function createSortWrapper()
    {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        $sorter = new CSortWrapper();
        $sorter->sortFunctionName = 'sort';
        $sorter->sortFlags = SORT_REGULAR;
        return $sorter;
    }
    
    private function createUASortWrapper( $comparisonCallback )
    {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        $sorter = new CSortWrapper();
        $sorter->sortFunctionName = 'uasort';
        $sorter->sortFlags = null;
        $sorter->comparisonCallback = $comparisonCallback;
        return $sorter;
    }
    
    private function createUKSortWrapper( $comparisonCallback )
    {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        $sorter = new CSortWrapper();
        $sorter->sortFunctionName = 'uksort';
        $sorter->sortFlags = null;
        $sorter->comparisonCallback = $comparisonCallback;
        return $sorter;
    }
    
    private function createUSortWrapper( $comparisonCallback )
    {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        $sorter = new CSortWrapper();
        $sorter->sortFunctionName = 'usort';
        $sorter->sortFlags = null;
        $sorter->comparisonCallback = $comparisonCallback;
        return $sorter;
    }
    
    private function getFactoryMethod( $spec )
    {
        return $this->_sorterFactoryMethods[ (string)$spec ];
    }
}