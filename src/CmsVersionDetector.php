<?php

namespace emteknetnz\Inverter;

use SilverStripe\Core\Environment;
use SilverStripe\View\TemplateGlobalProvider;
use SilverStripe\Core\Manifest\VersionProvider;

/**
 * Provides template globals for CMS version detection and inverter toggles.
 */
class CmsVersionDetector implements TemplateGlobalProvider
{
    /**
     * Exposes template global variables for the CMS templates.
     *
     * @return array<string, mixed> Template global definitions.
     */
    public static function get_template_global_variables()
    {
        return [
            'CmsHasSkipLink' => [
                'method' => 'detectVersion',
                'casting' => 'Boolean',
            ],
            'InverterEnabled' => [
                'method' => 'isInverterEnabled',
                'casting' => 'Boolean',
            ],
        ];
    }

    /**
     * Detects the current Silverstripe CMS version.
     *
     * @return bool True when the CMS version is 6.2 or later.
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

    /**
     * Determines if the inverter overlay should be enabled.
     *
     * @return bool True when the inverter is enabled.
     */
    public static function isInverterEnabled(): bool
    {
        $disabled = Environment::getEnv('EMT_INVERTER_DISABLED');
        if ($disabled === null || $disabled === '') {
            return true;
        }

        return filter_var($disabled, FILTER_VALIDATE_BOOLEAN) !== true;
    }
}
