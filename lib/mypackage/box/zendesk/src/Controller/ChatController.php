<?php
namespace Box\Zendesk\Controller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Box\Zendesk\Utilities\OAuth;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use Box\Zendesk\Exceptions\ApiResponseException;
use Psy\Util\Json;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('Zendesk::Chat.index');
    }
    public function GETChat(Request $request)
    {
        $service_url = 'https://rtm.zopim.com/stream/hello';
        $username = $request->UserName;
        $password = $request->Password;
        $method = 'POST';
        $data = 'https://rtm.zopim.com/stream/hello';
        $header = ['Authorization: Bearer uBcAH2uvHpQJOcWDiiGHxbuwK0cmeWcVKbE53KK8'];
        $Array_post = array(
            CURLOPT_URL => $service_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER =>$header
        );
        $curl = curl_init($service_url);
        curl_setopt_array($curl,$Array_post);
        $response = curl_exec($curl);
        $err = curl_error($curl);  //if you need
        curl_close ($curl);
        return response()->json(json_decode($response));
    }
     public function PostChat(Request $request)
    {
        $service_url = $request->URL;
        $formData =  '{
        "visitor": {
            "phone": "",
                        "notes": "",
                        "id": "1.12345",
                        "name": "John",
                        "email": "visitor_john@doe.com"
                    },
                    "message": "Hi there truong!",
                    "type": "offline_msg",
                    "timestamp": '.time().',
                    "session": {
            "browser": "Safari",
                        "city": "Orlando",
                        "country_code": "US",
                        "country_name": "United States",
                        "end_date": "2014-10-09T05:46:47Z",
                        "id": "141109.654464.1KhqS0Nw",
                        "ip": "67.32.299.96",
                        "platform": "Mac OS",
                        "region": "Florida",
                        "start_date": "2014-10-09T05:28:31Z",
                        "user_agent": "'.$_SERVER['HTTP_USER_AGENT'].'"
                    }
                }';
        $username = $request->UserName;
        $password = $request->Password;
        $method = $request->Method;
        $header = $request->Header;
        $Array_post = array(
            CURLOPT_URL => $service_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERPWD => $username . ":". $password,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => $formData,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER =>$header
        );
        $curl = curl_init($service_url);
        curl_setopt_array($curl,$Array_post);
        $response = curl_exec($curl);
        $err = curl_error($curl);  //if you need
        curl_close ($curl);
        return response()->json(json_decode($response));
    }
    public function PutChat(Request $request)
    {
        $service_url = $request->URL;
        $formData =  '{"visitor.name" : "Truong"}';
        $username = $request->UserName;
        $password = $request->Password;
        $method = $request->Method;
        $header = $request->Header;
        $Array_post = array(
            CURLOPT_URL => $service_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERPWD => $username . ":". $password,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => $formData,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER =>$header
        );
        $curl = curl_init($service_url);
        curl_setopt_array($curl,$Array_post);
        $response = curl_exec($curl);
        $err = curl_error($curl);  //if you need
        curl_close ($curl);
        return response()->json(json_decode($response));
    }
}