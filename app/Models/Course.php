<?php

namespace App\Models;

use App\Models\Traits\HasImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
    use HasFactory, HasImage, Traits\Enrollable, SoftDeletes;

    protected $fillable = ['title', 'description', 'user_id', 'slug', 'thumbnail'];


    public function author()
    {
        return $this->belongsTo(User::class, 'user_id'); // A course belongs to one author (user)
    }

    public function user()
    {
        return $this->author();
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope('hide_deleteds', function (Builder $builder) {
            $user = Auth::user();

            $builder->orWhereNotNull((new static)->getDeletedAtColumn());

            $builder->where(function ($query) use ($user) {
                $query->orWhereNull((new static)->getDeletedAtColumn());

                $query->orWhere('user_id', $user?->id);
            });
        });
    }

}
