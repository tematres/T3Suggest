<?php
/**
 * Tematres Suggest
 *
 * @copyright Copyright 2025 Diego Ferreyra
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * A t3_suggests row.
 *
 * @package Omeka\Plugins\CollectionTree
 */
class T3Suggest extends Omeka_Record_AbstractRecord
{
    public $id;
    public $element_id;
    public $suggest_endpoint;
}
