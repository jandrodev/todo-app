<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsToMany};

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public const PHP_CATEGORY = 'PHP';
    public const JS_CATEGORY = 'JS';
    public const CSS_CATEGORY = 'CSS';
    public const OTHERS_CATEGORY = 'Otros';

    public static array $masterCategories = [
        self::PHP_CATEGORY,
        self::JS_CATEGORY,
        self::CSS_CATEGORY,
        self::OTHERS_CATEGORY,
    ];


    /**
     * @return BelongsToMany
     */
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }
}
