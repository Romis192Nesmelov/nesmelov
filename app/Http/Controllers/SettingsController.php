<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SettingsController extends Controller
{
    use HelperTrait;
    
    private $settings;

    public function __construct()
    {
        $this->settings = simplexml_load_file(Config::get('app.settings_xml'));
    }

    // Seo
    public function getSeoTags()
    {
        $tags = ['title' => ''];
        if ($this->settings->seo->title) $tags['title'] = (string)$this->settings->seo->title;
        foreach ($this->metas as $meta => $params) {
            $tags[$meta] = (string)$this->settings->seo->$meta;
        }
        return $tags;
    }
    
    public function getSettings()
    {
        return (array)$this->settings->settings;
    }

    public function getRequisites()
    {
        return (array)$this->settings->requisites;
    }

    public function saveSeoTags(Request $request)
    {
        if ($request->has('title')) $this->settings->seo->title = $request->input('title');
        foreach ($this->metas as $meta => $params) {
            $this->settings->seo->$meta = $request->input($meta);
        }
        $this->save();
    }

    public function saveSettings($fieldsSettings, $fieldsRequisites)
    {
        foreach ($fieldsSettings as $name => $val) {
            $this->settings->settings->$name = $val;
        }

        foreach ($fieldsRequisites as $name => $val) {
            $this->settings->requisites->$name = $val;
        }

        $this->save();
    }

    private function save()
    {
        $this->settings->asXML(Config::get('app.settings_xml'));
    }
}
