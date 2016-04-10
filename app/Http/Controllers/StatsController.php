<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Curl\Curl;
use App\Models as Model;

class StatsController extends Controller {
    
    public $server;

    public function __construct() {
        $this->server = 'http://' . $_SERVER['HTTP_HOST'] . '/';
    }

    public function stats() {
        try {
            $c = 0;
            $hits = Model\Stats::queryStats();
            $json['hits'] = $hits[0]->hits * 1;
            $json['urlCount'] = $hits[0]->urlCount * 1;
            $top10 = Model\Stats::queryTop10();
            foreach ($top10 as $item) {
                $json['topUrls'][$c]['id'] = $item->id;
                $json['topUrls'][$c]['hits'] = $item->hits * 1;
                $json['topUrls'][$c]['url'] = $item->url;
                $json['topUrls'][$c]['shortUrl'] = $this->server . $item->short;
                $c++;
            }

            return response()->json($json);
        } catch (Exception $e) {
            abort('404');
        }
    }

    public function urlStats($id) {
        try {
            if (isset($id)) {
                if (is_numeric($id)) {
                    $validateUrl = Model\Urls::where('id_url', array($id))->get()->toArray();     
                } else {
                    $validateUrl = Model\Urls::where('id', array($id))->get()->toArray();
                }
                if (count($validateUrl) == 0) {
                    abort('404');
                } else {
                    if (is_numeric($id)) {
                        $where = "url.id_url = '" . $id . "'";
                    } else {
                        $where = "url.id = '" . $id . "'";
                    }
                    $top10 = Model\Stats::queryTop10($where);
                    $json['id'] = $top10[0]->id;
                    $json['hits'] = $top10[0]->hits * 1;
                    $json['url'] = $top10[0]->url;
                    $json['shortUrl'] = $this->server . $top10[0]->short;
                    
                    return response()->json($json);
                }
            } else {
                abort('404');
            }
        } catch (Exception $e) {
            abort('404');
        }
    }

}
