<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Box\Entity\NewsCategories\NewsCategoriesEntity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NewsCategories extends Controller
{

    public function __construct(NewsCategoriesEntity $categories)
    {
        $this->categories = $categories;
        $this->middleware(['auth:admin,user']);
    }
    public function getList(Request $request)
    {
        if(Auth::user()->can('manager'))
        {
            $categories=  $this->categories->all(15);
            if($categories== true)
            {
                return view('categories.list',
                    ["categories" => $categories]);;
            }
            else
            {
                $message = $this->categories->errors()?:$this->categories->errorQuery();
                Session::flash('error', $message);
                $categories = [];
                return view('categories.list',
                    ["categories" => $categories]);
            }
        }
        abort(401);
    }

    public function getFind($id)
    {
        $categories=  $this->categories->find($id);
        if($categories== true)
        {
            Session::flash('message', 'find success');
            return view('categories.find',
                ["categories" => $categories]);
        }
        else
        {
            $message = $this->categories->errors()?:$this->categories->errorQuery();
            Session::flash('error', $message);
            return redirect('admin/categories/');
        }

    }
    public function getCreate()
    {
        return view('categories.create');
    }

    public function postCreate(Request $request)
    {
        $request->user()->authorizeRoles(['manager']);
        $data = [
            'news_categories_title'=>$request->title,
            'news_categories_description'=>$request->description,
            'news_categories_keyword' => $request->keyword,
            'news_categories_avatar' => $request->avatar,
            'news_categories_tags' => $request->tags,
            'news_categories_lang_code' => $request->lang_code
        ];
        $categories=  $this->categories->create($data);
        if($categories== true)
        {
            Session::flash('message', 'Create new categoriess success');
            return redirect('admin/categories/');
        }
        else
        {
            $messageQuery = $this->categories->errorQuery();
            $message = $this->categories->errors();
            Session::flash('messageQuery', $messageQuery);
            Session::flash('error', $message);
            return view('categories.create');
        }
    }

    public function getUpdate($id)
    {
        $news_catagories_destail=  $this->categories->find($id);
        return view('categories.update',['news_catagories_destail'=>$news_catagories_destail]);
    }

    public function postUpdate(Request $request ,$id)
    {
        $data = [
            'id' => $id,
            'news_categories_title'=>$request->title,
            'news_categories_description'=>$request->description,
            'news_categories_keyword' => $request->keyword,
            'news_categories_avatar' => $request->avatar,
            'news_categories_tags' => $request->tags,
            'news_categories_lang_code' => $request->lang_code
        ];
        $categories=  $this->categories->update($data);
        if($categories== true)
        {
            Session::flash('message', 'Update categorie ssuccess');
            return redirect('admin/categories/');
        }
        else
        {
            $message = $this->categories->errors()?:$this->categories->errorQuery();
            Session::flash('error', $message);
            return view('categories.update');
        }
    }

    public function getAllTrash()
    {
        $categories=  $this->categories->allTrash(15);
        return view('categories.trash',['categories'=>$categories]);
    }

    public function getRecover($id)
    {
        $categories=  $this->categories->trash($id,false);
        return redirect('admin/categories/allTrash');
    }
    public function getTrash($id)
    {
        $categories=  $this->categories->trash($id);
        return redirect('admin/categories/');
    }

    public function getDelete($id)
    {
        $categories=  $this->categories->delete($id);
        return redirect('admin/categories/allTrash');
    }
}
