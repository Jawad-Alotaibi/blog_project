<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{

    /*

- belongsTo(User::class): This tells Laravel that the Follow record "belongs to" an instance of the User model.
  This is a one-to-many inverse relationship, meaning many Follow records can belong to a single User.

- 'user_id': This is the foreign key. It explicitly tells Laravel to use the user_id column in your follows table to find the related User record.
  Without this, Laravel would assume the foreign key is user_doing_the_following_id based on the method name.

    */
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
