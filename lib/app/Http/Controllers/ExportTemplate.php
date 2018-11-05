<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\File;
use Box\Export\ExportPDF;
use Box\Zendesk\HttpClient;
use Illuminate\Support\Facades\Response;

class ExportTemplate extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $arrKey;
    public function __construct()
    {
        $this->getListFile();
    }

    public function getListFile()
    {
        $path = resource_path('lang/vi/');
        $filename = $path . 'auth.php'; // the file to change
        $resutl = fopen($filename, "r");
        $line_of_text = [];
        $arry_key =[];
        while (!feof($resutl)) {
            $value = fgets($resutl);
            $value = str_replace("\n",'',$value);
            $value = str_replace("  ",'',$value);
            $value = str_replace(",",'',$value);
            $value = str_replace("'",'',$value);
            $flag = strpos($value , '=>');
            if($flag != false)
            {
                $arr = explode(' => ',$value);
                if(count($arr)>1)
                {
                    $arrDate = explode('//',$arr[1]);
                    if(count($arrDate)>1)
                    {
                        $line_of_text[$arr[0]] = ["Date" => $arrDate[1],"Value"=>$arrDate[0]];
                    }
                    else
                    {
                        $line_of_text[$arr[0]] =["Value"=>$arr[1]];
                    }
                    array_push($arry_key,$arr[0]);
                }
            }
        }
        $this->arrKey['key'] = $arry_key;
        $this->arrKey['vi'] = $line_of_text;
        return $line_of_text;
    }
    public function index()
    {
        $line_of_text = $this->arrKey['vi'];
        return View('index',[
            'line_of_text'=>$line_of_text,
        ]);
    }

    public function create(Request $request)
    {
        try
        {
            $key = $request->key; // the content after which you want to insert new stuff
            if(in_array($key,$this->arrKey['key']) !=true)
            {
                $pathVi = resource_path('lang/vi/');
                $pathEn = resource_path('lang/en/');
                $filename_vi = $pathVi . 'auth.php'; // the file to change
                $filename_en = $pathEn . 'auth.php'; // the file to change
                $valueVi = $request->value_vi;
                $valueEn = $request->value_en;
                $replace_Vi =  "'" . $key . "' => '" . $valueVi ."',//". now()."\n];";
                $replace_Em =  "'" . $key . "' => '" . $valueEn ."',//". now()."\n];";
                $content_Vi = str_replace('];', $replace_Vi, file_get_contents($filename_vi));
                $content_EN = str_replace('];', $replace_Em, file_get_contents($filename_en));
                file_put_contents($filename_vi,$content_Vi);
                file_put_contents($filename_en,$content_EN);
                return redirect('test');
            }
            else
            {
                abort(401);
            }
        }
        catch (\Exception $e)
        {
            abort(500);
        }

    }

    public function store(Request $request)
    {
        $path = resource_path('lang\vi/');
        $filename = $path . 'auth.php'; // the file to change
        $search = $request->keyword; // the content after which you want to insert new stuff
        $replace = $request->replace;
        $content = str_replace($search, $replace, file_get_contents($filename));
        file_put_contents($filename,$content );
       return redirect('test');
    }

    public function delete($key)
    {
        $path = resource_path('lang/vi/');
        $filename = $path . 'auth.php'; // the file to change
        $resutl = fopen($filename, "r");
        $arr_r = [];
        while (!feof($resutl)) {
            $value = fgets($resutl);
            $flag = strpos($value , $key);
            if($flag == false)
            {
                array_push($arr_r,$value);

            }
        }
        $arr_r = implode("",$arr_r);
        file_put_contents($filename,$arr_r );
        return redirect('test');
    }
}
