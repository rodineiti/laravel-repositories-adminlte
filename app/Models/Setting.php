<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ["name", "content"];

    public function getSettings()
    {
        $data = [];
        foreach ($this->all() as $setting) {
            $data[$setting->name] = $setting->content;
        }
        return $data;
    }

    public function updateSetting(array $data = [])
    {
        foreach ($data as $item => $value) {
            $this->where("name", $item)->update(["content" => $value]);
        }
    }
}
