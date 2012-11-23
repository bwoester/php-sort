<?php

require_once dirname(__FILE__).'/../src/CSorterFactory.php';
require_once dirname(__FILE__).'/../src/ISorter.php';

$a = array( 'b', 'a', 'c' );

$sorter = CSorterFactory::create( ISorter::MAINTAIN_KEY_ASSOCIATION );
print_r( $a );
$sorter->sort( $a );
print_r( $a );

