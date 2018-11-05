<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Box\Entity\Resources\ResourcesEntity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
class Resources extends Controller
{
    public function __construct(ResourcesEntity $resources)
    {
        $this->resources = $resources;
    }
    public function getList()
    {
        $resources=  $this->resources->all(15);
        if($resources== true)
        {
            return view('resources.list',
                ["resources" => $resources]);;
        }
        else
        {
            $message = $this->resources->errors()?:$this->resources->errorQuery();
            Session::flash('error', $message);
            $resources = [];
            return view('resources.list',
                ["resources" => $resources]);
        }

    }

    public function getFind($id)
    {
        $resources=  $this->resources->find($id);
        if($resources== true)
        {
            Session::flash('message', 'find success');
            return view('resources.find',
                ["resources" => $resources]);
        }
        else
        {
            $message = $this->resources->errors()?:$this->resources->errorQuery();
            Session::flash('error', $message);
            return redirect('admin/resources/');
        }

    }
    public function getCreate()
    {
        return view('resources.create');
    }

    public function postCreate(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data = [
            'resources_title'=>$request->title,
            'resources_description'=>$request->description,
            'files'=> $file,
            'resources_path' => null,
            'resources_thumb' => null,
            'resources_type' => $request->tags,
            'resources_lang_code' => $request->lang_code
        ];
            $resources=  $this->resources->create($data);
            if($resources== true)
            {
                Session::flash('message', 'Create new resourcess success');
                return redirect('admin/resources/');
            }
            else
            {
                $messageQuery = $this->resources->errorQuery();
                $message = $this->resources->errors();
                Session::flash('messageQuery', $messageQuery);
                Session::flash('error', $message);
                return view('resources.create');
            }
        }
        else
        {
            Session::flash('messageQuery', 'khong co file');
            return view('resources.create');
        }

//        $resources=  $this->resources->create($data);
//        if($resources== true)
//        {
//            Session::flash('message', 'Create new resourcess success');
//            return redirect('admin/resources/');
//        }
//        else
//        {
//            $messageQuery = $this->resources->errorQuery();
//            $message = $this->resources->errors();
//            Session::flash('messageQuery', $messageQuery);
//            Session::flash('error', $message);
//            return view('resources.create');
//        }
    }

    public function getUpdate($id)
    {
        $resources_destail=  $this->resources->find($id);
        return view('resources.update',['resources_destail'=>$resources_destail]);
    }

    public function postUpdate(Request $request ,$id)
    {
        $data = [
            'id' => $id,
            'resources_title'=>$request->title,
            'resources_description'=>$request->description,
            'resources_path' => null,
            'resources_thumb' => null,
            'resources_type' => $request->tags,
            'resources_lang_code' => $request->lang_code
        ];
        $resources=  $this->resources->update($data);
        if($resources== true)
        {
            Session::flash('message', 'Update categorie ssuccess');
            return redirect('admin/resources/');
        }
        else
        {
            $message = $this->resources->errors()?:$this->resources->errorQuery();
            Session::flash('error', $message);
            return view('resources.update');
        }
    }

    public function getAllTrash()
    {
        $resources=  $this->resources->allTrash(15);
        return view('resources.trash',['resources'=>$resources]);
    }

    public function getRecover($id)
    {
        $resources=  $this->resources->trash($id,false);
        return redirect('admin/resources/allTrash');
    }
    public function getTrash($id)
    {
        $resources=  $this->resources->trash($id);
        return redirect('admin/resources/');
    }

    public function getDelete($id)
    {
        $resources=  $this->resources->delete($id);
        return redirect('admin/resources/allTrash');
    }
}
