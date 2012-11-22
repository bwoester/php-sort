<?php

abstract class CSorter implements ISorter
{
    const SORT_BY_VALUE     = 0;    // default if not specified
    const SORT_BY_KEY       = 1 | self::MAINTAIN_KEY_ASSOCIATION;
    
    const COMPARE_BY_CALLBACK  = 2;
    
    const MAINTAIN_KEY_ASSOCIATION = 4;
    
    const ORDER_ASC     = 0;    // default if not specified
    const ORDER_DESC    = 8;
    
    const REQUIRE_STABLE    = 16;
    
    const ASORT       = self::SORT_BY_VALUE | self::MAINTAIN_KEY_ASSOCIATION;
    const ARSORT      = self::SORT_BY_VALUE | self::MAINTAIN_KEY_ASSOCIATION | self::ORDER_DESC;
    const KRSORT      = self::SORT_BY_KEY | self::ORDER_DESC;
    const KSORT       = self::SORT_BY_KEY;
    // const NATCASESORT = self::SORT_BY_VALUE | self::MAINTAIN_KEY_ASSOCIATION;
    // const NATSORT     = self::SORT_BY_VALUE | self::MAINTAIN_KEY_ASSOCIATION;
    const RSORT       = self::SORT_BY_VALUE | self::ORDER_DESC;
    const SORT        = self::SORT_BY_VALUE;
    const UASORT      = self::SORT_BY_VALUE | self::COMPARE_BY_CALLBACK | self::MAINTAIN_KEY_ASSOCIATION;
    const UKSORT      = self::SORT_BY_KEY | self::COMPARE_BY_CALLBACK;
    const USORT       = self::SORT_BY_VALUE | self::COMPARE_BY_CALLBACK;
}