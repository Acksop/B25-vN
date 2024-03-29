<?php

/**
 * A test to make sure PEAR DB can be found
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   Database
 * @package    DB
 * @author     Daniel Convissor <danielc@php.net>
 * @copyright  1997-2007 The PHP Group
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    $Id: skipif.inc 284375 2009-07-19 16:26:16Z danielc $
 * @link       http://pear.php.net/package/DB
 */

/**
 * Set up the include_path, error_reporting and PATH_SEPARATOR
 */
require_once dirname(__FILE__) . '/include.inc';

if (! include_once 'DB.php') {
    print 'skip could not find DB.php';
}
