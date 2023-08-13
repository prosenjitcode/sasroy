<?php

namespace App\Http\Controllers;

use Hash;

use App\Models\User;
use App\Models\Admin;
use App\Helper\ImageManager;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use ParagonIE\ConstantTime\Base64;

class LoginController extends Controller
{
    use HttpResponses,ImageManager;
    public function userDetails()
    {

        return new UserResource(Auth::user());
    }

    public function index()
    {

        return UserResource::collection(User::latest()->paginate());
    }

    public function userUpdate(Request $request)
    {
      
        $user = User::find(Auth::user()->id);
         $oldPath = "images/profiles/".$user->image_url;

        if($request->avatar!=''){
            $photo = time().'.jpg';
            file_put_contents('images/profiles/'.$photo,base64_decode($request->avatar));
            $user->image_url = $photo;
            $user->update();
            if (File::exists(public_path($oldPath))&& !empty($oldPath)) {
                        unlink($oldPath);
                    }
            return new UserResource($user);
        }
           
           
        
       
    }

    public function adminDashboard()
    {
        $users = Admin::all();
        $success =  $users;

        return response()->json($success, 200);
    }


    public function userLogin(Request $request)
    {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors()->all(),401);
            }

            if (auth()->guard('user')->attempt(['email' => request('email'), 'password' => request('password')])) {

                config(['auth.guards.api.provider' => 'user']);

                $user = User::select('users.*')->find(auth()->guard('user')->user()->id);
                $success =  $user;
                $success['token'] =  $user->createToken('MyApp', ['user'])->accessToken;

                return $this->success($success);
            } else {
                return $this->error("Your credential not match.",401);
            }


    }

    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->all(),401);
        }

        if (auth()->guard('admin')->attempt(['email' => request('email'), 'password' => request('password')])) {

            config(['auth.guards.api.provider' => 'admin']);

            $admin = Admin::select('admins.*')->find(auth()->guard('admin')->user()->id);
            $success =  $admin;
            $success['token'] =  $admin->createToken('MyApp', ['admin'])->accessToken;

            return $this->success($success);
            } else {
                return $this->error("Your credential not match.",401);
            }
    }

    function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors()->all(),401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($user) {
            return response()->json(['user'=>$user]);
        }
    }

    function logout(){

        if (Auth::check()) {
           Auth::user()->tokens->each(function ($token,$key) {
                $token->delete();
           });
        }
        // $user = Auth::user()->token();
        // $user->revoke();
        return $this->success('Logout');
    }
}
