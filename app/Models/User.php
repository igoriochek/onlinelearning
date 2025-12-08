<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'avatar',
    'last_login_at',
    'role'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = ['password', 'remember_token'];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function wishlist()
  {
    return $this->hasMany(Wishlist::class);
  }

  public function progress()
  {
    return $this->hasMany(Progress::class);
  }

  public function courses()
  {
    return $this->hasMany(Course::class, 'author_id');
  }

  public function reviews()
  {
    return $this->hasMany(Review::class);
  }

  public function enrollments()
  {
    return $this->hasMany(Enrollment::class);
  }

  public function enrolledCourses()
  {
    return $this->belongsToMany(Course::class, 'enrollments')
      ->withTimestamps()
      ->withPivot('purchased_at');
  }
}
