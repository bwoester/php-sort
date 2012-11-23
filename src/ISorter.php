<?php

/**
 * Sorter characteristics are specified using the following bit field:
 * 
 * 0000 0000 0000 0000
 * |||| |||| |||| |||L Sort by key (1) or by value (0)
 * |||| |||| |||| |LL Sort order: ascending (00), descending (01) or user
 * |||| |||| |||| |   defined (10). 11 is invalid (undefined behavior).
 * |||| |||| |||| L Maintain key association (1) or not (0). Sorting by key
 * |||| |||| ||||   always implies maintaining key association automatically.
 * |||| |||| |||L Use a stable sort implementation (1) or don't mind (0).
 * LLLL LLLL LLL Currently not used.
 */
interface ISorter
{
    public function sort( &$a );
    
    // --- constants to define sort characteristics ---------------------------
    
    const SORT_BY_KEY   = 9;    // (0001|1000), maintaining key assoc implied.
    const SORT_BY_VALUE = 0;
    
    const ORDER_ASC             = 0;
    const ORDER_DESC            = 2;
    const ORDER_USER_DEFINED    = 4;
    
    const MAINTAIN_KEY_ASSOCIATION = 8;
    
    const SORT_STABLE = 16;
    
    // --- shortcuts for php's built-in sort methods --------------------------
    
    const USE_ASORT     = 8;    // MAINTAIN_KEY_ASSOCIATION
    const USE_ARSORT    = 10;   // MAINTAIN_KEY_ASSOCIATION | ORDER_DESC
    
    const USE_KRSORT    = 11;   // SORT_BY_KEY | ORDER_DESC
    const USE_KSORT     = 9;    // SORT_BY_KEY
    
    // const USE_NATCASESORT = MAINTAIN_KEY_ASSOCIATION | ???;
    // const USE_NATSORT     = MAINTAIN_KEY_ASSOCIATION | ???;
    
    const USE_RSORT = 2;    // ORDER_DESC
    const USE_SORT  = 0;    // well... nothing special. Just sort.

    const USE_UASORT    = 12;   // ORDER_USER_DEFINED | MAINTAIN_KEY_ASSOCIATION
    const USE_UKSORT    = 13;   // ORDER_USER_DEFINED | SORT_BY_KEY
    const USE_USORT     = 4;    // ORDER_USER_DEFINED
}