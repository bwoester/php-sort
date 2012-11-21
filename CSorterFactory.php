<?php

class CSorterFactory
{
    private static $instance = null;
    private $_sorterClasses = array();
    
    public static function create( $spec )
    {
        $self = self::getInstance();
        $class = $self->getSorterClass( $spec );
        return new $lcass();
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
        $this->addSorterClass( CSorter::ASORT       , 'CASortWrapper'       );
        $this->addSorterClass( CSorter::ARSORT      , 'CARSortWrapper'      );
        $this->addSorterClass( CSorter::KRSORT      , 'CKRSortWrapper'      );
        $this->addSorterClass( CSorter::KSORT       , 'CKSortWrapper'       );
        $this->addSorterClass( CSorter::NATCASESORT , 'CNatCaseSortWrapper' );
        $this->addSorterClass( CSorter::NATSORT     , 'CNatSortWrapper'     );
        $this->addSorterClass( CSorter::RSORT       , 'CRSortWrapper'       );
        $this->addSorterClass( CSorter::SORT        , 'CSortWrapper'        );
        $this->addSorterClass( CSorter::UASORT      , 'CUASortWrapper'      );
        $this->addSorterClass( CSorter::UKSORT      , 'CUKSortWrapper'      );
        $this->addSorterClass( CSorter::USORT       , 'CSortWrapper'        );
    }
    
    private function addSorterClass( $spec, $class )
    {
        $this->_sorterClasses[ (string)$spec ] = $class;
    }
    
    private function getSorterClass( $spec )
    {
        return $this->_sorterClasses[ (string)$spec ];
    }
}