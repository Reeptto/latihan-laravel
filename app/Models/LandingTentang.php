<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingTentang extends Model
{
    protected $table = 'landing_tentang';
    protected $fillable = [
        'key',
        'title',
        'value',
        'type',
        'status'
    ];

    public static function getValue(string $key,  $default = null)
    {
        $record = static::where('key', $key)->first();
        if (!$record) return $default;

        // Jika type json, decode
        if ($record->type === 'json') {
            $decoded = json_decode($record->value, true);
            return $decoded ?? $default;
        }

        return $record->value ?? $default;
    }

    public static function setValue(string $key, $value, string $type = 'text')
    {
        $val = is_array($value) || is_object($value) ? json_encode($value) : $value;
        return static::updateOrCreate(['key' => $key], [
            'value' => $val,
            'type' => $type,
        ]);
    }
}
