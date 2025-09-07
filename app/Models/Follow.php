<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
 public function userDoingTheFollowing()
 {
     return $this->belongsTo(User::class, 'user_id');
 }
 /*
    The belongsTo method in Laravel Eloquent defines an inverse relationship where the current model (e.g., Follow)
    references another model (e.g., User) via a foreign key.

    Meaning:
    This tells Laravel:
    “This Follow record belongs to a single User, whose ID is stored in the user_id column.”

    Use belongsTo when your table has a foreign key pointing to another table’s primary key.

 */
  public function userBeingFollowed()
 {
    return $this->belongsTo(User::class, 'followeduser');

 }
}
