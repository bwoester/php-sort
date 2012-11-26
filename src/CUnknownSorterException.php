<?php

class CUnknownSorterException extends Exception
{
    public function __construct( $spec ) {
        parent::__construct( "Unknown sorter spec: '{$spec}'", $spec );
    }
}