<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Curl\Curl;
use App\Models as Model;

class UrlController extends Controller {

    public function __construct() {
        
    }

    public function url($id) {
        try {
            if (isset($id)) {
                $validateUrl = Model\Urls::where('id', array($id))->get()->toArray();
                if (count($validateUrl) == 0) {
                    abort('404');
                } else {
                    $url = $validateUrl[0]['url'];
                    $idUrl = $validateUrl[0]['id_url'];
                    $countUrl = Model\Stats::where('id_url', array($idUrl))->get()->toArray();
                    $idStats = $countUrl[0]['id_stats'];
                    $qtd = $countUrl[0]['qtd'] + 1;
                    
                    $updateFields = array('qtd' => $qtd);
                        
                    $updStatsUrl = New Model\Stats();
                    $updStatsUrl->id_url = $idUrl;
                    
                    $updateStatsUrl = $updStatsUrl->where('id_url', $idUrl)->update($updateFields);
                    
                    return redirect($url, 301);
                }
            } else {
                abort('404');
            }
        } catch (Exception $e) {
            abort('404');
        }
    }

    public function delUrl($id) {
        try {
            if (isset($id)) {
                $validateUrl = Model\Urls::where('id', array($id))->get()->toArray();
                if (count($validateUrl) == 0) {
                    abort('404');
                } else {
                    $idUrl = $validateUrl[0]['id_url'];
                    
                    $newUrl = New Model\Urls();
                    $newUrl->id_url = $idUrl;

                    $deleteUrl = $newUrl->destroy($idUrl);

                    if ($deleteUrl) {
                        abort('200');
                    } else {
                        abort('404');
                    }
                }
            } else {
                abort('404');
            }
        } catch (Exception $e) {
            abort('404');
        }
    }

}
