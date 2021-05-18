<?php

namespace App\Vendor\Locale;

use App\Vendor\Locale\Models\Locale as DBLocale;
use App\Vendor\Locale\Models\LocaleLanguage;
use Debugbar;
use DebugBar\DebugBar as DebugBarDebugBar;

class Locale
{
    protected $rel_parent;
    protected $language;
    protected $db_locale;

    function __construct(DBLocale $DBlocale)
    {
        $this->db_locale = $DBlocale;
    }

    public function setParent($rel_parent)
    {
        $this->rel_parent = $rel_parent;
    }

    public function getParent()
    {
        return $this->rel_parent;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function store($locale, $id)
    {
        // debugbar::info($locale);
        foreach ($locale as $tag => $lang) {

            foreach ($lang as $language => $value) {

                $rel_anchor = $tag . "." . $language;

                $locale_updateOrCreate[] = $this->db_locale->updateOrCreate(
                    [
                        'rel_parent' => $this->rel_parent,
                        'rel_anchor' => $rel_anchor,
                        'key' => $id,
                    ],
                    [
                        'language' => $language,
                        'tag' => $tag,
                        'value' => $value
                    ]
                );
            }

            // $rel_anchor_item = $key;
            // 
            // ;

            // $locale[] = $this->db_locale->updateOrCreate(
            //     [
            //         'rel_parent' => $this->rel_parent,
            //         'rel_anchor' => $rel_anchor_item,
            //         'key' => $id,
            //     ],
            //     [
            //         'language' => $language,
            //         'tag' => $tag,
            //         'value' => $value
            //     ]
            // );
        }

        // debugbar::info($locale_updateOrCreate);
        return $locale_updateOrCreate;
    }

    public function show($id)
    {
        $search =
            $this->db_locale
            ->where('rel_parent', $this->rel_parent)
            ->where('key', $id)
            ->get()->all();

        foreach ($search as $key) {
            $tag_value[$key['language']] = $key['value'];
            $locale[$key['tag']] = $tag_value;
            // debugbar::info($locale);
        };

        // debugbar::info($locale);
        return $locale;
    }

    public function index()
    {
        $search =
            $this->db_locale
            ->select('tag', 'value', 'key')
            ->where('language', $this->language)
            ->where('rel_parent', $this->rel_parent)
            ->get()->all();

        foreach ($search as $key) {

            $tag_value[$key['tag']] = $key['value'];

            $locale[$key['key']] = $tag_value;


            // debugbar::info($locale);
        };

        // debugbar::info($locale);
        return $locale;
    }
}
