<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Curl\Curl;
use App\Models as Model;

class UserController extends Controller {

    public $caracters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    public $server;

    public function __construct() {
        $this->server = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        $this->caracters = str_split($this->caracters);
    }

    public function addUrlUser(Request $request, $id) {
        try {
            $data = $request->all();
//            $server = 'http://' . $_SERVER['HTTP_HOST'] . '/';
            if (isset($data['url'])) {
                $validateUser = Model\Users::where('id', array($id))->get()->toArray();
                if (count($validateUser) == 0) {
                    abort('404');
                } else {
                    $idUser = $validateUser[0]['id_user'];
                    $validateUserUrl = Model\Urls::where('url', array($data['url']))->where('id_user', array($idUser))->get()->toArray();
                    if (count($validateUserUrl) == 0) {
                        $newUserUrl = New Model\Urls();
                        $newUserUrl->id_user = $idUser;
                        $newUserUrl->url = $data['url'];

                        $insertUserUrl = $newUserUrl->save();
                        
                        $findId = Model\Urls::where('url', array($data['url']))->where('id_user', array($idUser))->get()->toArray();
                        
                        $idUrl = $findId[0]['id_url'];
                        $short = $this->encode($idUrl);
                        
                        $updateFields = array('id' => $short);

                        $updUserUrl = New Model\Urls();
                        $updUserUrl->id_url = $idUrl;
                        
                        $updateUserUrl = $updUserUrl->where('id_url', $idUrl)->update($updateFields);

                        $newStats = New Model\Stats();
                        $newStats->id_user = $idUser;
                        $newStats->id_url = $idUrl;
                        $newStats->qtd = 0;

                        $saveStats = $newStats->save();

                        if ($insertUserUrl) {
                            $json['id'] = $idUrl;
                            $json['hits'] = 0;
                            $json['url'] = $data['url'];
                            $json['shortUrl'] = $this->server . $short;
                            return response()->json($json, 201);
                        } else {
                            abort('404');
                        }
                    } else {
                        $json['url'] = $data['url'];
                        return response()->json($json, '409');
                    }
                }
            } else {
                abort('404');
            }
        } catch (Exception $e) {
            abort('404');
        }
    }

    public function addUser(Request $request) {
        try {
            $data = $request->all();
            if (isset($data['id'])) {
                $validateUser = Model\Users::where('id', array($data['id']))->get()->toArray();
                if (count($validateUser) == 0) {
                    $newUser = New Model\Users();
                    $newUser->id = $data['id'];

                    $insertUser = $newUser->save();

                    if ($insertUser) {
                        $json['id'] = $data['id'];
                        return response()->json($json, 201);
                    } else {
                        abort('404');
                    }
                } else {
                    $json['id'] = $data['id'];
                    return response()->json($json, '409');
                }
            } else {
                abort('404');
            }
        } catch (Exception $e) {
            abort('404');
        }
    }

    public function delUser($id) {
        try {
            if (isset($id)) {
                $validateUser = Model\Users::where('id', array($id))->get()->toArray();
                if (count($validateUser) == 0) {
                    abort('404');
                } else {
                    $idUser = $validateUser[0]['id_user'];
                    $newUser = New Model\Users();
                    $newUser->id_user = $idUser;

                    $deleteUser = $newUser->destroy($idUser);

                    if ($deleteUser) {
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

    public function stats($id) {
        try {
            if (isset($id)) {
                $validateUser = Model\Users::where('id', array($id))->get()->toArray();
                if (count($validateUser) == 0) {
                    abort('404');
                } else {
                    $c = 0;
                    $where = "user.id = '" . $id . "'";
                    $hits = Model\Stats::queryStats($where);
                    $json['hits'] = $hits[0]->hits * 1;
                    $json['urlCount'] = $hits[0]->urlCount * 1;
                    $top10 = Model\Stats::queryTop10($where);
                    foreach ($top10 as $item) {
                        $json['topUrls'][$c]['id'] = $item->id;
                        $json['topUrls'][$c]['hits'] = $item->hits * 1;
                        $json['topUrls'][$c]['url'] = $item->url;
                        $json['topUrls'][$c]['shortUrl'] = $this->server . $item->short;
                        $c++;
                    }
                    
                    return response()->json($json);
                }
            } else {
                abort('404');
            }
        } catch (Exception $e) {
            abort('404');
        }
    }

    public function encode($id) {
        if ($id == 0)
            return $this->caracters[0];

        $result = '';
        $base = count($this->caracters);

        while ($id > 0) {
            $result[] = $this->caracters[($id % $base)];
            $id = floor($id / $base);
        }

        $key = array_reverse($result);

        return join("", $key);
    }

    public function decode($short) {
        $id = 0;
        $base = count($this->caracters);

        $inShort = str_split($short);

        foreach ($inShort as $caracter) {
            $posicao = array_search($caracter, $this->caracters);

            $id = $id * $base + $posicao;
        }

        return $id;
    }

}
