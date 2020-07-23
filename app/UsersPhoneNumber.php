<?php
namespace App;

//this is causing me problems..

use Illuminate\Database\Eloquent\Model;

class UsersPhoneNumber extends Model
{
   protected $table= "users_phone_number"; //tells Eloquent the table name to make use of.
   protected $fillable = [                  //tells Eloquent to make the field mass assignable
        'phone_number'
    ];
}
