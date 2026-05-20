<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WelcomeMessage extends Model
{
    protected $table = 'welcome_messages';
    protected $primaryKey = 'id';
}
