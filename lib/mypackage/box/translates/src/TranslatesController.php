<?php
namespace Box\Translates;
use App\Http\Controllers\Controller;
use App\User;
class TranslatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = ["first_name"=>"truong","last_name"=>"nguyen","email"=>"tryong@gmail.com"];
        return view('Translates::admin')->with('users', $users);
    }
}