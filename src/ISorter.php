<?php

/**
 * Sorter characteristics are specified using the following bit field:
 * 
 * 0000 0000 0000 0000
 * |||| |||| |||| |||L Sort by key (1) or by value (0)
 * |||| |||| |||| ||L Sort order: ascending (0) or descending (1)
 * |||| |||| |||| |L Maintain key association (1) or don't mind (0). Sorting by
 * |||| |||| |||| |  key implies maintaining key association automatically.
 * |||| |||| |||| L Use a stable sort implementation (1) or don't mind (0).
 * |||| |||| ||LL Define compare mode: regular (00), numeric (01), string (10)
 * |||| |||| ||   or user defined/ callback (11).
 * |||| |||| |L Compare case sensitive (0) or case insensitive (1). Comparing
 * |||| |||| |  case insensitive implies compare mode string automatically.
 * |||| |||| L Compare natural (1) or not (0). Applying natural comparing
 * |||| ||||   implies compare mode string automatically.
 * |||| |||L Compare locale (1) or not (0). Applying locale comparing implies
 * |||| |||  compare mode string automatically.
 * LLLL LLL Currently not used.
 * 
 * @TODO: keep in mind locale comparison won't always work. Maybe implement a
 *        workaround?
 *        See: "http://sgehrig.wordpress.com/2008/09/24/on-how-to-sort-an-array-of-utf-8-strings/"
 *        Also see: "http://stackoverflow.com/a/6088651/386711"
 *        Also see: "http://de3.php.net/manual/en/collator.sort.php"
 */
interface ISorter
{
    public function sort( &$a );


    // --- constants to define sort characteristics ---------------------------
    
    const SORT_BY_VALUE = 0;
    const SORT_BY_KEY   = 5;    // SORT_BY_KEY := 1; imply MAINTAIN_KEY_ASSOCIATION => 1 | 4 = 5
    
    const ORDER_ASC     = 0;
    const ORDER_DESC    = 2;
    
    const MAINTAIN_KEY_ASSOCIATION = 4;
    
    const SORT_STABLE = 8;


    // --- constants to define compare characteristics ------------------------
    
    const COMPARE_REGULAR           =   0;
    const COMPARE_NUMERIC           =  16;
    const COMPARE_STRING            =  32;
    const COMPARE_CASE_INSENSITIVE  =  96; // COMPARE_CASE_INSENSITIVE := 64; imply COMPARE_STRING => 64 | 32 = 96
    const COMPARE_NATURAL           = 160; // COMPARE_NATURAL := 128; imply COMPARE_STRING => 128 | 32 = 160
    const COMPARE_LOCALE_STRING     = 288; // COMPARE_LOCALE_STRING := 256; imply COMPARE_STRING => 256 | 32 = 288
    const COMPARE_USER_DEFINED      =  48;
    

    // --- shortcuts for php's built-in sort methods --------------------------
    
    const USE_ASORT     = 4;    // MAINTAIN_KEY_ASSOCIATION
    const USE_ARSORT    = 6;    // MAINTAIN_KEY_ASSOCIATION | ORDER_DESC
    
    const USE_KRSORT    = 7;    // SORT_BY_KEY | ORDER_DESC
    const USE_KSORT     = 5;    // SORT_BY_KEY
    
    /* MAINTAIN_KEY_ASSOCIATION                          0000 0100
     * COMPARE_NATURAL (implies COMPARE_STRING)          1010 0000 
     * COMPARE_CASE_INSENSITIVE (implies COMPARE_STRING) 0110 0000
     *                                                   ---------
     * Bitwise OR                                        1110 0100 (228)
     */
    const USE_NATCASESORT = 228; // MAINTAIN_KEY_ASSOCIATION | COMPARE_NATURAL | COMPARE_CASE_INSENSITIVE
    
    /* MAINTAIN_KEY_ASSOCIATION                          0000 0100
     * COMPARE_NATURAL (implies COMPARE_STRING)          1010 0000 
     *                                                   ---------
     * Bitwise OR                                        1010 0100 (164)
     */
    const USE_NATSORT     = 164; // MAINTAIN_KEY_ASSOCIATION | COMPARE_NATURAL
    
    const USE_RSORT = 2;    // ORDER_DESC
    const USE_SORT  = 0;    // well... nothing special. Just sort.

    const USE_UASORT    = 52;   // COMPARE_USER_DEFINED | MAINTAIN_KEY_ASSOCIATION
    const USE_UKSORT    = 53;   // COMPARE_USER_DEFINED | SORT_BY_KEY
    const USE_USORT     = 48;   // COMPARE_USER_DEFINED
}