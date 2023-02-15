<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Requests\UserRegisterRequest;
    use App\Models\UserModel;
    use App\Utils\JSONResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    
    
    class UserProfileController extends Controller
    {
        
        private $http_response;
        
        public function __construct(JSONResponse $JSONResponse)
        {
            $this->http_response = $JSONResponse;
        }
    /*
       |-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       | Register User ( Personal User )
       |----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
        public function UserRegister(UserRegisterRequest $request)
        {
            try{
                $validatedData = $request->validated();
                $user = UserModel::create_user($validatedData);
                return $this->http_response->ok_http($user);
            }catch (\Exception $exception)
            {
                $failed_process = $exception->getMessage();
                return $this->http_response->failed_http($failed_process);
            }
        }
        
        /*
       |-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       | Login User ( Personal User )
       |----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
        public function UserLogin(Request $request)
        {
            $credentials = $request->all();
            try{
                if(Auth::attempt($credentials))
                {
                    $user_token = UserModel::login_user($credentials);
                    return $this->http_response->ok_http($user_token);
                } else {
                    $auth = 'Unauth. User';
                    return $this->http_response->failed_http($auth);
                }
                
            }catch (\Exception $exception)
            {
                $auth_exc = 'Exception : ' . $exception->getMessage();
                return $this->http_response->failed_http($auth_exc);
            }
        }
        /*
       |-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       | Logout User ( Personal User )
       |----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
       
    }
