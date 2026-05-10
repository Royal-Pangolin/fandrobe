<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'image_url',
    ];

    public $timestamps = false;

    /**
     * Mapa slug → clave de traducción para las categorías del seeder.
     */
    private static array $translationMap = [
        'camisetas'  => 'messages.cat_camisetas',
        'sudaderas'  => 'messages.cat_sudaderas',
        'gorras'     => 'messages.cat_gorras',
        'accesorios' => 'messages.cat_accesorios',
        'vinilo'     => 'messages.cat_vinilo',
        'posters'    => 'messages.cat_posters',
    ];

    /**
     * Nombre traducido de la categoría.
     */
    public function getTranslatedNameAttribute(): string
    {
        $key = self::$translationMap[$this->slug] ?? null;
        return $key ? __($key) : $this->name;
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
