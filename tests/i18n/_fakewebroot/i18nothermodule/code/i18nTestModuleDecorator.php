<?php
class i18nTestModuleDecorator extends DataObjectDecorator
{
    public function extraStatics()
    {
        return array(
            'db' => array(
                'MyExtraField' => 'Varchar'
            )
        );
    }
}
