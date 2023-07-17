<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Factories\HasFactory, Model, Relations\BelongsToMany};

/**
 * @method static completed(bool $completed)
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'completed'];

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @param Builder $builder
     * @param bool $completed
     *
     * @return Builder
     */
    public function scopeCompleted(Builder $builder, bool $completed = true): Builder
    {
        return $builder->where('completed', $completed);
    }
}
