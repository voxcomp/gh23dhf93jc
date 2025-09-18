<?php

/**
 * Collection of site-wide settings
 */

namespace App\Http\Repositories;

use App\Option;

class Options
{
    protected $table = 'options';

    public function __construct()
    {
        dd($this->table);
    }

    /**
     * Get setting from DB.  Return setting value.
     *
     * @param  $setting_name  string
     */
    public static function get($option): string
    {
        $option = Option::where('option', '=', $option)->first();
        if ($option) {
            return $option->option;
        } else {
            return false;
        }
    }

    /**
     * Set setting to DB.  Return false if not saved.
     *
     * @param  $setting_name  string
     * @param  $setting_value  string
     */
    public static function set($option, $value): bool
    {
        $get = Option::where('option', '=', $option)->first();
        if (! $get) {
            $option = new Option;
            $option->option = $option;
            $option->value = $value;
            $option->save();
            if ($option->id) {
                return true;
            }
        } else {
            $get->update(['value' => $value]);

            return true;
        }

        return false;
    }

    /**
     * Delete setting from DB.  Return false if not found.
     *
     * @param  $setting_name  string
     */
    public function delete($option): bool
    {
        $option = Option::where('option', '=', $option);
        if ($option) {
            $option->delete();
        } else {
            return false;
        }
    }

    /**
     * Return a Collection of all settings.
     */
    public function all(): Collection
    {
        return Option::all();
    }
}
