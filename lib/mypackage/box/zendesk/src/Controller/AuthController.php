<?php
namespace Box\Zendesk\Controller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Box\Zendesk\Utilities\OAuth;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use Box\Zendesk\Exceptions\ApiResponseException;
use Psy\Util\Json;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('Zendesk::index');
    }
     public function checkAuth(Request $request)
    {

        $service_url = 'https://www.zopim.com/api/v2/chats';
        $formData = '{
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
        $curl = curl_init($service_url);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $service_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERPWD => "truong160196@gmail.com:0123Truong",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => $formData,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);  //if you need
        curl_close ($curl);
        dd(json_decode($response));
            $state = base64_encode(serialize($_POST));
            // Get the oAuth URI using the utility function
            $oAuthUrl= OAuth::getAuthUrl(
                $_POST['subdomain'],
                [
                    'client_id' => $_POST['client_id'],
                    'state' => $state,
                ]
            );
//            header('Location: ' . $oAuthUrl);
//            $params = unserialize(base64_decode($oAuthUrl));
            $tempURL= 'response_type=code&client_id='.$request->client_id . '&state=';
            $url = parse_url($oAuthUrl);
            $url_state = str_replace($tempURL,'',$url['query']);
            $params = unserialize(base64_decode($url_state));
            $params['code'] = '200';
            $params['redirect_uri'] = 'https://' . $_SERVER['HTTP_HOST'] . '/testlaravel/zendesk/';
            dd($oAuthUrl);
            try {
                // Request for an access token by passing an instance of GuzzleHttp\Client, your Zendesk subdomain, and the
                // following params ['client_id', 'client_secret', 'redirect_uri']
                $response = OAuth::getAccessToken(new Client(), $params['subdomain'], $params);
                $access_token =  $response->access_token;
                dd($access_token);
            } catch (ApiResponseException $e) {
                $error =  $e->getMessage();
                dd($error);
            }
        return redirect('/zendesk');
    }
}