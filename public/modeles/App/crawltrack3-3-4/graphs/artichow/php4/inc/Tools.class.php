<?php
/*
 * This work is hereby released into the Public Domain.
 * To view a copy of the public domain dedication,
 * visit http://creativecommons.org/licenses/publicdomain/ or send a letter to
 * Creative Commons, 559 Nathan Abbott Way, Stanford, California 94305, USA.
 *
 */
require_once dirname(__FILE__) . "/../Graph.class.php";

/**
 * Objects capable of being positioned
 *
 * @package Artichow
 */

registerInterface('Positionable');

/**
 * Manage left, right, top and bottom sides
 *
 * @package Artichow
 */
class awSide
{

    /**
     * Left side
     *
     * @var int
     */
    var $left = 0;

    /**
     * Right side
     *
     * @var int
     */
    var $right = 0;

    /**
     * Top side
     *
     * @var int
     */
    var $top = 0;

    /**
     * Bottom side
     *
     * @var int
     */
    var $bottom = 0;

    /**
     * Build the side
     *
     * @param mixed $left            
     * @param mixed $right            
     * @param mixed $top            
     * @param mixed $bottom            
     */
    function awSide($left = NULL, $right = NULL, $top = NULL, $bottom = NULL)
    {
        $this->set($left, $right, $top, $bottom);
    }

    /**
     * Change side values
     *
     * @param mixed $left            
     * @param mixed $right            
     * @param mixed $top            
     * @param mixed $bottom            
     */
    function set($left = NULL, $right = NULL, $top = NULL, $bottom = NULL)
    {
        if ($left !== NULL) {
            $this->left = (float) $left;
        }
        if ($right !== NULL) {
            $this->right = (float) $right;
        }
        if ($top !== NULL) {
            $this->top = (float) $top;
        }
        if ($bottom !== NULL) {
            $this->bottom = (float) $bottom;
        }
    }

    /**
     * Add values to each side
     *
     * @param mixed $left            
     * @param mixed $right            
     * @param mixed $top            
     * @param mixed $bottom            
     */
    function add($left = NULL, $right = NULL, $top = NULL, $bottom = NULL)
    {
        if ($left !== NULL) {
            $this->left += (float) $left;
        }
        if ($right !== NULL) {
            $this->right += (float) $right;
        }
        if ($top !== NULL) {
            $this->top += (float) $top;
        }
        if ($bottom !== NULL) {
            $this->bottom += (float) $bottom;
        }
    }
}

registerClass('Side');
?>