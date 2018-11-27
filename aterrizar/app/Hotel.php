<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    
    public function getAverageRatingAttribute() {

        return $this->votes === 0 ?: $this->ratings / $this->votes;
    }
}
