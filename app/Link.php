<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use SoftDeletes;
    protected $table = 'links';
    public $timestamps = true;
    protected $fillable = ['url'];
    protected $appends = array('short_url');
    private $appendDecimals = 10**10;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

    /**
     * @return string
     */
    public function getShortUrlAttribute() {
        return $this->toBase($this->id*$this->appendDecimals);
    }

    /**
     * @param $query
     * @param $short_url
     * @return mixed
     */
    public function scopeSortUrl($query, $short_url)
    {
        return $query->where('id', $this->to10($short_url)/$this->appendDecimals);
    }

    /**
     * @param $num
     * @param int $b
     * @return string
     */
    private function toBase($num, $b=62) {
        $base='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $r = $num  % $b ;
        $res = $base[$r];
        $q = floor($num/$b);
        while ($q) {
            $r = $q % $b;
            $q =floor($q/$b);
            $res = $base[$r].$res;
        }
        return $res;
    }

    /**
     * @param $num
     * @param int $b
     * @return bool|float|int
     */
    private function to10($num, $b=62) {
        $base='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $limit = strlen($num);
        $res=strpos($base,$num[0]);
        for($i=1;$i<$limit;$i++) {
            $res = $b * $res + strpos($base,$num[$i]);
        }
        return $res;
    }
}
