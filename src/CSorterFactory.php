<?php

class CSorterFactory
{
    private static $instance = null;
    private $_sorterFactoryMethods = array();
    
    /**
     * Creates an ISorter, implementing the requested characteristics
     * @param $spec integer
     * @return ISorter
     * @throws UnknownSorterException
     */
    public static function create( $spec=0 )
    {
        $self       = self::getInstance();
        $factory    = $self->getFactoryMethod( $spec );
        
        if (is_callable($factory)) {
            return call_user_func( $factory ); // TODO: pass user defined callback in case it is a usort variant
        }
        
        throw new UnknownSorterException( $spec );
    }

    /**
     * Allows to register custom sorters.
     */
    public static function registerSorter( $spec, $factoryMethod )
    {
        $self = self::getInstance();
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
        $this->registerSorter( ISorter::USE_ASORT , array($this,'createASortWrapper')  );
        $this->registerSorter( ISorter::USE_ARSORT, array($this,'createARSortWrapper') );
        $this->registerSorter( ISorter::USE_KRSORT, array($this,'createKRSortWrapper') );
        $this->registerSorter( ISorter::USE_KSORT , array($this,'createKSortWrapper')  );
        $this->registerSorter( ISorter::USE_RSORT , array($this,'createRSortWrapper')  );
        $this->registerSorter( ISorter::USE_SORT  , array($this,'createSortWrapper')   );
        $this->registerSorter( ISorter::USE_UASORT, array($this,'createUASortWrapper') );
        $this->registerSorter( ISorter::USE_UKSORT, array($this,'createUKSortWrapper') );
        $this->registerSorter( ISorter::USE_USORT , array($this,'createUSortWrapper')  );
    }

    private function createASortWrapper() {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        return new CSortWrapper( 'asort' );
    }
    
    private function createARSortWrapper() {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        return new CSortWrapper( 'arsort' );
    }
    
    private function createKRSortWrapper() {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        return new CSortWrapper( 'krsort' );
    }
    
    private function createKSortWrapper() {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        return new CSortWrapper( 'ksort' );
    }
    
    private function createRSortWrapper() {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        return new CSortWrapper( 'rsort' );
    }
    
    private function createSortWrapper() {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        return new CSortWrapper( 'sort' );
    }
    
    // TODO: requires callback
    private function createUASortWrapper() {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        return new CSortWrapper( 'uasort' );
    }
    
    // TODO: requires callback
    private function createUKSortWrapper() {
        require_once dirname(__FILE__).'/CSortWrapper.php';
        return new CSortWrapper( 'uksort' );
    }
    
    // TODO: requires callback
    private function createUSortWrapper() {
         require_once dirname(__FILE__).'/CSortWrapper.php';
       return new CSortWrapper( 'usort' );
    }
    
    private function getFactoryMethod( $spec ) {
        return $this->_sorterFactoryMethods[ (string)$spec ];
    }
}