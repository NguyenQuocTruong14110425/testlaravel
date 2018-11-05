<?php
namespace Box\Zendesk\Controller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Box\Zendesk\HttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use Box\Zendesk\Exceptions\ApiResponseException;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function search()
    {
        return view('Zendesk::User.search');
    }
    public function searchPost(Request $request)
    {
        set_time_limit(3000);
        $subdomain = "demoaris";
        $username  = "truong160196@gmail.com";
        $token     = "uBcAH2uvHpQJOcWDiiGHxbuwK0cmeWcVKbE53KK8";

        $client = new HttpClient($subdomain);
        $client->setAuth('basic', ['username' => $username, 'token' => $token]);
        $arr_user = [];
        try {
            // Search the current customer
//            $params = array('query' => $request['query']);
//            $search = $client->users()->search($params);
            $url ='https://www.zopim.com/api/v2/chats';
            $params = [
                'message'=> 'Hi there!',
                "type"=>"offline_msg",
                "timestamp"=> time()
            ];
            $sectionId = 1;
            $param = ["key"=> '266e7109-0d63-4c67-9664-1348fb54d4fb'];
            // verify if this email address exists
//            if (empty($search->users)) {
//                print_r('This email adress could not be found on Zendesk.');
//            } else {
//                foreach ($search->users as $UserData) {
//                    array_push($arr_user,$UserData);
//                }
//            }
        } catch (ApiResponseException $e) {
            echo $e->getMessage();
        }
        return view('Zendesk::User.search');
    }

}