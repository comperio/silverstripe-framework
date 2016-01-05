<?php
/**
 * @package sapphire
 * @subpackage tests
 */
class i18nTextCollectorTestMySubObject extends i18nTextCollectorTestMyObject implements TestOnly
{
    public static $db = array(
        'SubProperty' => 'Varchar',
    );
    
    public static $has_many = array(
        'SubRelation' => 'Group'
    );
    
    public static $singular_name = "My Sub Object";
    
    public static $plural_name = "My Sub Objects";
}
