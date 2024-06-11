<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Realty;
use App\Models\Event;
use App\Models\Wallet;
use App\Models\Notifications;
use App\Models\Feedback;

use Illuminate\Support\Facades\Hash;
use Twilio;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\UploadHelper;
use JWTAuth;

use Mail;
use App\Mail\RegisterMail;

class AuthRepository
{

    public function __construct()
    {
        try {
          $token = JWTAuth::getToken();
            $this->user =   JWTAuth::toUser($token ) ;
        } catch (\Throwable $th) {
            //throw $th;
        }
       
    }

    public function register(array $data): User
    {
        $data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' =>  $data['phone'],
            'password' => Hash::make($data['password'])
        ];
        return User::create($data);
    }
    
    public function feedback(array $data): Feedback
    {
        $data = [
            'user_id'  => $this->user->id,
            'email' => $data['email'],
            'phone' => $data['phone'],
            'title' => $data['title'],
            'body'  => $data['body'],
        ];
        return Feedback::create($data);
    }
    public function sendcode($data): User | null
    {
        $email=$data['email'];
        $user= User::where('email',$email)->first();

        if($user==null){
            return null;
        }
        $new = [
                'email' =>  $data['email'],
                 'code' => rand(1000,9999),
            ];
        $user->update($new);

        $data = [
            'title' => 'Zokak Register Account',
            'body' => 'This Code:'.$user->code
        ];
    
        try {
            Mail::to($user->email)->send(new RegisterMail($data));
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $user;
     
    }

    public function updateLocation($data): User
    {
        $userData = [
            'lat'   =>  $data['lat'],
            'lng'   =>  $data['lng'],
        ];
        $user= User::find($this->user->id);
        $user->update($userData);
        return $user;
    }
    public function changePassword($data): User | null
    {
        $new = [
            'password'   => Hash::make($data['password'])
        ];
        $code =(string)$data['code'];
       
        $user= User::where('email',$data['email'])->where('code',$code)->first();
         if($user){
            $user->update($new);
            return $user;
        }else{
        return null;
        }

    }

    public function updateUserInfo($data): User
    {
        $new = [
            'phone' =>  $data['phone'],
            'lat'   =>  $data['lat'],
            'lng'   =>  $data['lng'],
        ];
        $user= User::where('phone',$data['phone'])->first();
        $user->update($new);
        return $user;
    }

    public function updateFmcUserToken($data): User
    {
        $new = [
            'lat'   =>  $data['lat'],
            'lng'   =>  $data['lng'],
            'fcm_token' =>  $data['fcm_token'],
        ];
        $user= User::find($this->user->id);
        $user->update($new);
        return $user;
    }
    
    public function sendcodeFirst($data): User
    {
        $data = [
            'phone' =>  $data['phone']??'',
            'code' => rand(1000,9999),
            'email' =>  $data['email'],
            'name' =>  $data['name']??'',
            'password' =>   Hash::make($data['password'])
        ];
        //dd( $data);
        $user= User::create($data);

        $data = [
            'title' => 'Zokak Register Account',
            'body' => 'This Code:'.$user->code
        ];
    
   
            Mail::to($user->email)->send(new RegisterMail($data));


        return $user;

     
    }
    public function following($id)
    {
        try {
            $this->user->increment('following');
            $userOther = User::find($id);
            $userOther->increment('follower');
            $this->user->following()->attach($id);
            return 'Ok';
        } catch (\Throwable $th) {
            return 'following befor';
        }

    }

    public function unfollowing($id)
    {
        try {
            $this->user->decrement('following');
            $userOther = User::find($id);
            $userOther->decrement('follower');
            $this->user->following()->detach($id);
            return 'Ok';
        } catch (\Throwable $th) {
            return 'following befor';
        }
    }
    

    public function addWishlistsRealty($id)
    {
        try {
            $this->user->wishlists_realty()->attach($id);
            return 'Ok';
        } catch (\Throwable $th) {
            return null;
        }

    }
    public function removeWishlistRealty($id)
    {
        try {
            $this->user->wishlists_realty()->detach($id);
            return 'Ok';
        } catch (\Throwable $th) {
            return null;
        }
    }
    public function loginCheck(array $data)
    {
        $user= User::where('email', $data['email']??'')->where('code', $data['code']??'');
        if($user){
            $data = [
                'phone_verified_at' => Carbon::today(),
                'is_valid' => 1
            ];
            $user->update($data);
            return $user->first();
        }
        else return null;

    }

    public function topHunters()
    {

        $users = User::where('role_id','2')->where('id','!=',$this->user->id)->with('followers')->paginate(10);
        $following =  User::find($this->user->id)->following()->pluck('id');
        $users->getCollection()->transform(function($user) use ($following) {
            $user->is_following = $following->contains($user->id);
            return $user;
        });

        return $users;
    }
    public function notification()
    {
        $Notifications =  Notifications::where('user_id',$this->user->id)->paginate(10);
        return $Notifications;
    }
    public function popularHunters(): Paginator
    {
        return User::where('role_id','2')->orderBy('id', 'desc')
            ->paginate(10);
    }
    public function hunters(): Paginator
    {
        return User::where('role_id','2')->orderBy('id', 'desc')
            ->paginate(10);
    }
    public function infoHunters($id): User
    {
        $user= User::with('wishlists_brands')->with('wallet')->with('following')->with('followers')->find($id);

        $user->wishlists()->with('event.tags')->get();
        return  $user;
    }

    public function update(int $id, array $data): User|null
    {
        $user = User::find($id);
        if (!empty($data['image'])) {
            $titleShort ='pic';
            $data['image'] = UploadHelper::update('image', $data['image'], $titleShort . '-' . time(),'storage', $user->image);
        } else {
            $data['image'] = $user->image;
        }

        if (is_null($user)) {
            return null;
        }

        // If everything is OK, then update.
        $user->update($data);

        // Finally return the updated user.
        return $this->getByID($user->id);
    }
    public function getByID(int $id): User|null
    {
        return User::find($id);
    }
}
