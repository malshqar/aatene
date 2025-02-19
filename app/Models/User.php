<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Modules\User\Entities\User as MainModel;
class User extends MainModel implements MustVerifyEmail
{
}