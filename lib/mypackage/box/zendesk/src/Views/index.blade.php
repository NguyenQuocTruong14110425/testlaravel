<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #000;
                font-family:  sans-serif;
                font-weight: 400;
                height: 100vh;
                margin: 0;
            }
            .container
            {
                margin-top: 100px;
            }
            .form-control
            {
                color: #1b1e21;
                border-radius: 10px;
                font-weight: 400;
            }
            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <!--Start of Zendesk Chat Script-->
        <script type="text/javascript">
            window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
                d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
            _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
                $.src="https://v2.zopim.com/?66JrUsDcIYOT6Rxs33LlRNcYCGhKcHKM";z.t=+new Date;$.
                    type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
        </script>
        <!--End of Zendesk Chat Script-->
        {{--<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=266e7109-0d63-4c67-9664-1348fb54d4fb"> </script>--}}
    </head>
    <body>
    <?php
    /**
     * This is a sample oAuth flow you can follow in your application.
     */

    use Box\Zendesk\Utilities\OAuth;

    if (isset($_POST['action']) && 'redirect' === $_POST['action']) {
        $state = base64_encode(serialize($_POST));
        // Get the oAuth URI using the utility function
        $oAuthUrl= OAuth::getAuthUrl(
            $_POST['subdomain'],
            [
                'client_id' => $_POST['client_id'],
                'state' => $state,
            ]
        );

        header('Location: ' . $oAuthUrl);
    } elseif (isset($_REQUEST['code'])) {
        /**
         * This block acts as the redirect_uri, once you receive an authorization_code ($_GET['code']).
         */

        $params = unserialize(base64_decode($_GET['state']));
        $params['code'] = $_REQUEST['code'];
        $params['redirect_uri'] = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        dd($params);
        try {
            // Request for an access token by passing an instance of GuzzleHttp\Client, your Zendesk subdomain, and the
            // following params ['client_id', 'client_secret', 'redirect_uri']

            $response = OAuth::getAccessToken(new GuzzleHttp\Client(), $params['subdomain'], $params);
            echo "<h1>Success!</h1>";
            echo "<p>Your OAuth token is: " . $response->access_token . "</p>";
            echo "<p>Use this code before any other API call:</p>";
            echo "<code>&lt;?php<br />\$client = new ZendeskAPI(\$subdomain);<br />\$client->setAuth(\Zendesk\API\Utilities\Auth::OAUTH, ['token' => " . $response->access_token . "]');<br />?&gt;</code>";
        } catch (\Zendesk\API\Exceptions\ApiResponseException $e) {
            echo "<h1>Error!</h1>";
            echo "<p>We couldn't get an access token for you. Please check your credentials and try again.</p>";
            echo "<p>" . $e->getMessage() . "</p>";
        }
    } else {
        // A simple form to help you get started.
        }
        ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form id="form-oauth" method="POST" action="{{URL::to('/zendesk/checkauth')}}">
                    {{ csrf_token() }}
                    <div class="form-group">
                        <label for="subdomain">Subdomain</label>
                        <input type="text" class="form-control" name="subdomain" value="demoaris"
                               required/>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control"
                               value="truong160196@gmail.com" required/>
                    </div>
                    <div class="form-group">
                        <label for="client_id">Client ID</label>
                        <input type="password" id="client_id" class="form-control" name="client_id"
                               value="371535070472" required/>
                    </div>
                    <div class="form-group">
                        <label for="client_secret">Client Secret</label>
                        <input type="password" id="client_secret" class="form-control" name="client_secret" value="639498f57b4be16b0f8e217b689192803d1076d5c491603617dfdf06ce7f64cc"/>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
    </body>
</html>
