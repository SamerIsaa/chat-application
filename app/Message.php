<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['sender_id' , 'reciver_id' , 'content' , 'conversion_id' , 'readed_at'];
}
