<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Stats extends Model {

    protected $table = 'stats';
    public $incrementing = false;
    public $primaryKey = 'id_stats';
    protected $dates = ['created_at', 'updated_at'];

    /* Querys otimizadas */
    
    public static function queryStats($whereFields = FALSE)
    {
        $where = '';
        
        if ($whereFields) {
            $where = "WHERE
                        " . $whereFields . " ";
        }
        
        $query = "SELECT
                        SUM(stats.qtd) AS hits,
                        COUNT(url.id) AS urlCount
                    FROM
                        user
                    INNER JOIN
                        url ON url.id_user = user.id_user
                    INNER JOIN
                        stats ON stats.id_url = url.id_url
                    " . $where . ";";

        $result = DB::select($query);
        
        return $result;
    }
    
    public static function queryTop10($whereFields = FALSE)
    {
        $where = '';
        
        if ($whereFields) {
            $where = "WHERE
                        " . $whereFields . " ";
        }
        
        $query = "SELECT
                        url.id_url AS id,
                        SUM(stats.qtd) AS hits,
                        url.url AS url,
                        url.id AS short
                    FROM
                        user
                    INNER JOIN
                        url ON url.id_user = user.id_user
                    INNER JOIN
                        stats ON stats.id_url = url.id_url
                    " . $where . "
                    GROUP BY
                        url.id_url
                    ORDER BY
                        stats.qtd DESC
                    LIMIT
                        10;";

        $result = DB::select($query);
        
        return $result;
    }
}
