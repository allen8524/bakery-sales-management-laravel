<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    public const COKIND = ['선택', '대기업', '중소기업', '벤처', '개인'];

    protected $fillable = [
        'coname', 'cotel', 'startday', 'cokind',
    ];

    protected $casts = [
        'startday' => 'date',
    ];

    public function getCokindLabelAttribute(): string
    {
        return self::COKIND[$this->cokind] ?? '';
    }
}
