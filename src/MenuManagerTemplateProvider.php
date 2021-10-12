<?php

namespace Heyday\MenuManager;

use SilverStripe\ORM\DataObject;
use SilverStripe\View\TemplateGlobalProvider;

class MenuManagerTemplateProvider implements TemplateGlobalProvider
{
    /**
     * @return array
     */
    public static function get_template_global_variables()
    {
        return [
            'MenuSet' => 'MenuSet'
        ];
    }

    /**
     * @param $name
     * @return DataObject
     */
    public static function MenuSet($name)
    {
        $filters = ['Name' => $name];

        //Subsite check
        if (class_exists('SilverStripe\Subsites\State\SubsiteState')) {
            $filters["SubsiteID"] = \SilverStripe\Subsites\State\SubsiteState::singleton()->getSubsiteId();
        }

        return MenuSet::get()
            ->filter($filters)->first();
    }
}
