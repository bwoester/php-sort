<?php

abstract class CSorter implements ISorter
{
    const SORT_BY_VALUE     = 0;    // default if not specified
    const SORT_BY_KEY       = 1;
    const SORT_BY_CALLBACK  = 2;
    
    const MAINTAIN_KEY_ASSOCIATION = 4;
    
    const ORDER_ASC     = 0;    // default if not specified
    const ORDER_DESC    = 8;
    
    const REQUIRE_STABLE    = 16;
}