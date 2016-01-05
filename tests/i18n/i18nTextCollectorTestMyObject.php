<?php
/**
 * @package sapphire
 * @subpackage tests
 */
class i18nTextCollectorTestMyObject extends DataObject implements TestOnly
{
    public static $db = array(
        'FirstProperty' => 'Varchar',
        'SecondProperty' => 'Int'
    );
    
    public static $has_many = array(
        'Relation' => 'Group'
    );
    
    public static $singular_name = "My Object";
    
    public static $plural_name = "My Objects";
}
