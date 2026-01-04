<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
  use HasFactory;

  protected $keyType = 'string';

  public $incrementing = false;

  protected $fillable = [
    'author_id',
    'title',
    'description',
    'level',
    'price',
    'image_url',
    'public',
    'status'
  ];

  protected static function boot()
  {
    parent::boot();

    static::creating(function ($model) {
      if (empty($model->id)) {
        $model->id = (string) Str::uuid();
      }
    });
  }

  public function isInWishlist(): bool
  {
    /** @var \App\Models\User $user */
    $user = Auth::user();

    return $user
      ? $user->wishlist()->where('course_id', $this->id)->exists()
      : false;
  }

  public function getLevelKeyAttribute(): string
  {
    return match ((int) $this->level) {
      1 => 'beginner',
      2 => 'intermediate',
      3 => 'advanced',
      default => 'unknown',
    };
  }

  public function getAverageRatingAttribute()
  {
    $avg = $this->reviews()
      ->where('status', 'approved')
      ->where('rating', '>', 0)
      ->avg('rating');

    return $avg ? round($avg, 1) : null;
  }

  public function getApprovedReviewsAttribute()
  {
    return $this->reviews()->where('status', 'approved')->get();
  }

  public function getReviewsWithRatingAttribute()
  {
    return $this->getApprovedReviewsAttribute()->where('rating', '>', 0);
  }

  public function getLessonCountAttribute()
  {
    return $this->sections->flatMap(fn($section) => $section->lessons)->count();
  }

  public function getQuizzesCountAttribute()
  {
    return $this->sections
      ->flatMap(fn($section) => $section->lessons)
      ->flatMap(fn($lesson) => $lesson->steps)
      ->whereIn('type', ['quiz_multiple', 'quiz_single', 'quiz_code'])
      ->count();
  }

  public function getIsCompletableAttribute(): bool
  {
    if ($this->sections->isEmpty()) {
      return false;
    }

    foreach ($this->sections as $section) {
      if ($section->lessons->isEmpty()) {
        return false;
      }

      foreach ($section->lessons as $lesson) {
        if ($lesson->steps->isEmpty()) {
          return false;
        }
      }
    }

    return true;
  }

  public function markPending()
  {
    if ($this->status === 'rejected') {
      $this->update(['status' => 'pending']);
    }
  }

  public function getFirstLessonAttribute()
  {
    return $this->sections->flatMap->lessons->first();
  }

  public function reviewBy(?User $user)
  {
    if (!$user) {
      return null;
    }

    return $this->reviews()->where('user_id', $user->id)->first();
  }

  public function isAuthoredBy(?User $user): bool
  {
    if (!$user) {
      return false;
    }

    return $this->author_id === $user->id;
  }

  public function isEnrolled(?User $user): bool
  {
    if (!$user) {
      return false;
    }

    return Enrollment::where('course_id', $this->id)
      ->where('user_id', $user->id)
      ->exists();
  }

  public function getStudentsCountAttribute(): int
  {
    return $this->enrollments->count();
  }

  public function sections()
  {
    return $this->hasMany(Section::class)->orderBy('position');
  }

  public function author()
  {
    return $this->belongsTo(User::class, 'author_id');
  }

  public function reviews()
  {
    return $this->hasMany(Review::class);
  }

  public function enrollments()
  {
    return $this->hasMany(Enrollment::class);
  }

  public function students()
  {
    return $this->belongsToMany(User::class, 'enrollments')
      ->withTimestamps()
      ->withPivot('purchased_at');
  }

  public function wishlists()
  {
    return $this->hasMany(Wishlist::class, 'course_id');
  }
}
