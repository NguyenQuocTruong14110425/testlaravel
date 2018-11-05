<?php namespace Box\Entity\Lib;

use Exception;
use Faker\Provider\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

abstract class BasicEntity
{
    protected  $entity;

    protected  $id;

    protected $error;

    protected $lang_code;

    /**
     * @param array $data
     * @return array|bool
     */
    public function CheckAndUpdateLangCode(array $data)
    {
        try {
            if (count($data) > 0) {
                if (isset($data[$this->field_lang]) == false) {
                    $locale = App::getLocale();
                    $data[$this->field_lang] = $locale;
                }
            }
            return $data;
        }
        catch (Exception $e)
        {
            $this->error = $e->getMessage();
            return false;
        }
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function CreateOrUpdate(array $attributes)
    {
        try {
            $data = [];
            foreach ($this->fillable as $key => $value) {
                if (isset($attributes[$value])) {
                    $data[$value] = $attributes[$value];
                }
            }
            $data = $this->CheckAndUpdateLangCode($data);
            if (isset($data[$this->primaryKey]) == false) {
                $data['created_at'] =  now();
                $flag = DB::table($this->table)->insertGetId($data);
                    $this->id = $flag;
            } else {
                $data['updated_at'] = now();
                $this->id = $data[$this->primaryKey];
                $flag = DB::table($this->table)
                    ->where($this->primaryKey, $this->id)
                    ->update($data);
            }
            if ($flag>0) {
                return true;
            }
            return false;
        }
        catch (Exception $e)
        {
            $this->error = $e->getMessage();
            return false;
        }
    }

    /**
     * @param array $arrId
     * @param array $attributes
     * @return bool
     */
    public function CreateOrUpdateMutilRow(array $arrId,array $attributes)
    {
        try
        {
            if (empty($arrId) == true) {
                foreach ($attributes as $key=>$value)
                {
                    $value['created_at'] =  now();
                    $attributes[$key] = $value;
                    $attributes = $this->CheckAndUpdateLangCode($attributes);
                }
                DB::table($this->table)->insert($attributes);
                return true;
            } else if(empty($table) == false && empty($arrId) == false)
                {
                    foreach ($attributes as $key=>$value)
                    {
                        $value['updated_at'] =  now();
                        $attributes[$key] = $value;
                        $attributes = $this->CheckAndUpdateLangCode($attributes);
                    }
                    foreach ($arrId as $index=>$nodeValue)
                    {
                        $query = DB::table($this->table)->where($this->primaryKey,$nodeValue)->update($attributes[$index]);
                        if($query == false)
                        {
                            return false;
                        }
                    }
                    return true;
            }
            else
            {
                $this->error = 'Can run query update or insert';
                return false;
            }
        }
        catch (Exception $e)
        {
            $this->error = $e->getMessage();
            return false;
        }
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function CreateMutilRow(array $attributes)
    {
        try
        {
            if (empty($table) == false) {
                foreach ($attributes as $key=>$value)
                {
                   $value['created_at'] =  now();
                   $attributes[$key] = $value;
                   $attributes = $this->CheckAndUpdateLangCode($attributes);
                }
                DB::table($this->table)->insert($attributes);
                return true;
            } else {
                $this->error = 'Can find name table insert';
                return false;
            }
        }
        catch (Exception $e)
        {
            $this->error = $e->getMessage();
            return false;
        }
    }

    /**
     * @param array $arrId
     * @param array $attributes
     * @return bool
     */
    public function UpdateMutilRow(array $arrId,array $attributes)
    {
        try
        {
            if (empty($arrId) == false) {
                foreach ($attributes as $key=>$value)
                {
                    $value['updated_at'] =  now();
                    $attributes[$key] = $value;
                    $attributes = $this->CheckAndUpdateLangCode($attributes);
                }
                foreach ($arrId as $index=>$nodeValue)
                {
                    $query = DB::table($this->table)->where($this->primaryKey,$nodeValue)->update($attributes[$index]);
                    if($query == false)
                    {
                        return false;
                    }
                }
                return true;
            } else {
                $this->error = 'name table or id not found for update';
                return false;
            }
        }
        catch (Exception $e)
        {
            $this->error = $e->getMessage();
            return false;
        }
    }

    public function UploadResource($resource, $type)
    {
        try {
            $pathSave = base_path('../public/upload/' . $type);
            $pathThumb = base_path('../public/upload/thumb/');
            $fileName = $type . '_' . $resource['files']->getClientOriginalName();
            $resource['files']->move($pathSave, $fileName);
            $image_resize = Image::make($resource['files']->getRealPath());
            $image_resize->resize(300, 300);
            $image_resize->save($pathThumb .$fileName );
            return true;
        }
        catch (Exception $e)
        {
            $this->error = $e->getMessage();
            return false;
        }
    }
    /**
     * @param array $arrID
     * @return bool
     */

    public function DeleteMutilRow(array $arrID)
    {
        try
        {
            if (empty($arrID) == false) {
                $path = storage_path('logs/delete.txt');
                $totalLine = count(file($path));
                $cotent = "\r\n #". $totalLine . ':delete row from '. $this->primaryKey .' /id:' .implode(",", $arrID) .' from table /tb:' .$this->table .' at time /t:' . now();
                $query = DB::table($this->table)
                    ->where('IsDelete','=',1)
                    ->whereIn($this->primaryKey,$arrID)
                    ->delete();
                if($query == true)
                {
                    $this->WriteLog($path,$cotent);
                    return true;
                }
                return false;
            } else {
                $this->error = 'id of table '. $this->table .'not found for delete';
                return false;
            }
        }
        catch (Exception $e)
        {
            $this->error = $e->getMessage();
            return false;
        }
    }

    /**
     * @param null $pagin
     * @param null $lang
     * @return bool|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function findAll($pagin = null,$lang = null)
    {
        try
        {
            if(empty($lang) == true)
            {
                $lang = App::getLocale();
            }
            if(empty($pagin) == false)
            {
                $result = DB::table($this->table)
                    ->where($this->field_lang , '=', $lang)
                    ->where('IsDelete','=',0)
                    ->paginate($pagin);
            }
            else
            {
                $result = DB::table($this->table)
                    ->where($this->field_lang , '=', $lang)
                    ->where('IsDelete','=',0)
                    ->get();
            }
            return $result;
        }
        catch (Exception $e)
        {
            $this->error = $e->getMessage();
            return false;
        }
    }

    /**
     * @return bool|\Illuminate\Support\Collection
     */
    public function findAllTrash($pagin = null,$lang = null)
    {
        try
        {
            if(empty($lang) == true)
            {
                $lang = App::getLocale();
            }
            if(empty($pagin) == false)
            {
                $result = DB::table($this->table)
                    ->where($this->field_lang , '=', $lang)
                    ->where('IsDelete','=',1)
                    ->paginate($pagin);
            }
            else
            {
                $result = DB::table($this->table)
                    ->where($this->field_lang , '=', $lang)
                    ->where('IsDelete','=',1)
                    ->get();
            }
            return $result;
        }
        catch (Exception $e)
        {
            $this->error = $e->getMessage();
            return false;
        }
    }
    /**
     * @param $id: is id need find
     * @return bool|Model|\Illuminate\Database\Query\Builder|null|object
     */
    public function findOnebyId($id)
    {
        try
        {
            if (empty($id) == false ) {
                $result = DB::table($this->table)
                    ->where($this->primaryKey,$id)
                    ->first();
                return $result;
            } else {
                $this->error = 'Id can not null!';
                return false;
            }
        }
        catch (Exception $e)
        {
            $this->error = $e->getMessage();
            return false;
        }
    }

    /**
     * @param $table: name table
     * @param $keyFiled: key condition field
     * @param array $Attributes: value condition
     * @return bool|\Illuminate\Support\Collection
     */
    public function findMany($keyFiled, array $Attributes)
    {
        try
        {
            if ( empty($Attributes) == false && empty($keyFiled) == false ) {

                $result = DB::table($this->table)
                    ->whereIn($keyFiled,$Attributes)
                    ->get();
                return $result;
            } else {
                $this->error = 'field or attributes can not null!';
                return false;
            }
        }
        catch (Exception $e)
        {
            $this->error = $e->getMessage();
            return false;
        }
    }
    public function TrashOrRecover($id,$trash = true)
    {
        try
        {
            if ( empty($id) == false ) {
                if($trash == true)
                {
                    $data['IsDelete'] = '1';
                }
                else
                {
                    $data['IsDelete'] = '0';
                }
                $data['updated_at'] = now();
                $flag = DB::table($this->table)
                    ->where($this->primaryKey, $id)
                    ->update($data);
                if($flag == true)
                {
                    return true;
                }
                return false;

            } else {
                $this->error = 'id or table can not null!';
                return false;
            }
        }
        catch (Exception $e)
        {
            $this->error = $e->getMessage();
            return false;
        }
    }
    public function WriteLog($file,$content)
    {
        $f = fopen($file,"a+");
        file_put_contents($file,$content,FILE_APPEND);
        fclose($f);
    }
}