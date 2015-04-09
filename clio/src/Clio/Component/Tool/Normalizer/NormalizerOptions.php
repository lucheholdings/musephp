<?php
namespace Clio\Component\Tool\Normalizer;

/**
 * NormalizerOptions 
 * 
 * @final
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
final class NormalizerOptions 
{
    /**
     * if type and data is differ, then prefer data 
     */
    const OPT_PREFER_DATA = 'prefer_data';
    
    /*
     * If normalized data is an array and elements of the data include null value element, then replace the null field.
     */
    const OPT_COMPACT     = 'compact';

    /*
     * If normalized data is array and only one element, then develop array to single scalar value
     */
    const OPT_PREFER_SCALAR = 'prefer_scalar';
}

