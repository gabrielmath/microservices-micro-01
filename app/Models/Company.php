<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property int $category_id
 * @property string $uuid
 * @property string $name
 * @property string $url
 * @property string $whatsapp
 * @property string $email
 * @property string|null $phone
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string|null $youtube
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereWhatsapp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereYoutube($value)
 * @mixin \Eloquent
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'uuid',
        'name',
        'url',
        'phone',
        'whatsapp',
        'email',
        'facebook',
        'instagram',
        'youtube'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCompanies(string $filter = '')
    {
        $companies = $this->with(['category'])
            ->where(function ($q) use ($filter) {
                if ($filter != '') {
                    $q->where('name', "LIKE", "%{$filter}%")
                        ->orWhere('uuid', $filter)
                        ->orWhere('url', "LIKE", "%{$filter}%")
                        ->orWhere('category_id', $filter)
                        ->orWhere('email', $filter)
                        ->orWhere('phone', $filter)
                        ->orWhere('whatsapp', $filter)
                        ->orWhere('facebook', $filter)
                        ->orWhere('instagram', $filter)
                        ->orWhere('youtube', $filter);
                }
            })
            ->paginate();

        return $companies;
    }
}
