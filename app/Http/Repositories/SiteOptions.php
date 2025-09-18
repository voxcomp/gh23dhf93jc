<?php

/**
 * Collection of site-wide settings
 */

namespace App\Http\Repositories;

use App\Models\SiteOption;

class SiteOptions
{
    protected $table = 'siteoptions';

    public function __construct() {}

    /**
     * Get setting from DB.  Return setting value.
     *
     * @param  $setting_name  string
     * @return string
     */
    public static function get($option): string
    {
        $option = SiteOption::where('name', '=', $option)->first();
        if ($option) {
            return $option->value;
        } else {
            return false;
        }
    }

    /**
     * Set setting to DB.  Return false if not saved.
     *
     * @param  $setting_name  string
     * @param  $setting_value  string
     * @return bool
     */
    public static function set($option, $value): bool
    {
        $get = SiteOption::where('name', '=', $option)->first();
        if (! $get) {
            $newoption = new SiteOption;
            $newoption->name = $option;
            $newoption->value = (string) $value;
            $newoption->save();
            if ($newoption->id) {
                return true;
            }
        } else {
            $get->update(['value' => (string) $value]);

            return true;
        }

        return false;
    }

    /**
     * Delete setting from DB.  Return false if not found.
     *
     * @param  $setting_name  string
     * @return bool
     */
    public function delete($option): bool
    {
        $option = SiteOption::where('name', '=', $option);
        if ($option) {
            $option->delete();
        } else {
            return false;
        }
    }

    /**
     * Return a Collection of all settings.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        $options = SiteOption::get();

        return $options->pluck('value', 'name')->toArray();
    }
}
