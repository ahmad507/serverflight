<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Support\Facades\Hash;
    use Laravel\Passport\HasApiTokens;
    use Spatie\Permission\Traits\HasRoles;
    
    class UserModel extends Authenticatable
    {
        use Notifiable;
        use SoftDeletes;
        use HasRoles;
        use HasApiTokens;
        
        protected $table = 'users';
        protected  $guarded = ['id'];
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'first_name', 'last_name', 'username', 'email', 'password',
        ];
        
        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password', 'remember_token',
        ];
        
        /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];
        
        
        /**
         * Creates a new user based on the input provided.
         * @param $user_details
         * @return mixed
         */
        public static function create_user($user_details)
        {
            $user = UserModel::create([
                'first_name' => $user_details['first_name'],
                'last_name' => $user_details['last_name'],
                'username' => $user_details['username'],
                'email' => $user_details['email'],
                'password' => Hash::make($user_details['password']),
            ]);
            
            return $user;
        }
    
        /**
         * @param $credentials
         * @return array|\Illuminate\Http\JsonResponse
         */
        public static function login_user($credentials)
        {
            $username = $credentials['username'];
            $password = $credentials['password'];
            $user = UserModel::where('username', $username)->first();
            
            if (!empty($user))
            {
                if(!Hash::check($password, $user->password)) {
                    return response()->json(['message' => 'email/password salah'], 400);
                }
                $tokenResult = $user->createToken('Personal Acces Token')->accessToken;
                $data = [
                    'token' => $tokenResult,
                    'type' => 'Bearer'
                ];
                return $data;
            }
            
        }
        
    }
