<?php

namespace emteknetnz\Inverter;

use SilverStripe\View\TemplateGlobalProvider;
use SilverStripe\Core\Manifest\VersionProvider;

class CmsVersionDetector implements TemplateGlobalProvider
{
    public static function get_template_global_variables()
    {
        return [
            'CmsHasSkipLink' => [
                'method' => 'detectVersion',
                'casting' => 'Boolean',
            ],
        ];
    }

    /**
     * Detects the current Silverstripe CMS version.
     *
     * @return string|null The CMS version, or null if not detected.
     */
    public static function detectVersion(): bool
    {
        $version = (new VersionProvider)->getModuleVersion('silverstripe/cms');
        $version = str_replace('.x-dev', '', $version);
        if ($version === '6') {
            $version = '6.99.99';
        }
        return version_compare($version, '6.2', '>=');
    }
}