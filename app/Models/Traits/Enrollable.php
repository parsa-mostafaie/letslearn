<?php
namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait Enrollable
{
  public function enrolledUsers()
  {
    return $this->belongsToMany(User::class)->withTimestamps(); // A course can have many enrolled users
  }

  public function isEnrolledBy(?User $user)
  {
    if (!$user) {
      return false; // If no user is provided, return false
    }

    // Check if the user is enrolled in this course
    return $this->enrolledUsers()->where('users.id', $user->id)->exists();
  }

  public function getIsEnrolledAttribute(){
    return $this->isEnrolledBy(Auth::user());
  }

  public function enroll(?User $user)
  {
    if (!$user) {
      return false; // If no user is provided, return false
    }

    $this->enrolledUsers()->attach($user); // Attach the user to the enrolled users

    return true; // Return true to indicate successful enrollment
  }

  public function unenroll(?User $user)
  {
    if (!$user) {
      return false; // If no user is provided, return false
    }

    // Detach the user from the enrolled users
    $this->enrolledUsers()->detach($user);

    return true; // Return true to indicate successful unenrollment
  }

  public function getTotalEnrollmentCountAttribute(){
    return $this->enrolledUsers()->count();
  }
}