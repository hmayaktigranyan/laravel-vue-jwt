<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name','team_id'];

    /**
     * Get team.
     */
    public function team()
    {
        return $this->belongsTo('App\Model\Team');
    }
}
