<?php

namespace App\Http\Controllers;

use App\Exceptions\BookStoreException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class PasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {

        $email = $request->only('email');

        //validate email
        $validator = Validator::make($email, [
            'email' => 'required|email'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            Log::warning('Not a registerd email');
            return response()->json([
                'message' => 'Email is not registered',
            ], 402);
        } else {

            $token = JWTAuth::fromUser($user);
            $data = array(
                // 'name' => $user->first_name, "resetlink" => 'http://localhost:4200/resetPassword/' . $token,
                'name' => $user->first_name, "resetlink" => $token,
                "email" => $request->email,
                "fromMail" => env('MAIL_USERNAME'),
                "fromName" => env('APP_NAME'),
            );

            Mail::send('mail', $data, function ($message) use ($data) {
                $message->to($data['email'], $data['name'])->subject('Reset Password');
                $message->from('sayandhv160@gmail.com', 'Sayandh');
            });

            return response()->json([
                'message' => 'Reset link Sent to your Email',
            ], 201);
        }
    }

    public function resetPassword(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'new_password' => 'required|string|min:6|max:50',
                'password_confirmation' => 'required|same:new_password',
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
            $currentUser = JWTAuth::authenticate($request->token);

            if (!$currentUser) {
                Log::warning('Invalid Authorisation Token ');
                throw new bookstoreexception('Invalid Authorization Token', 401);
            } else {
                $user = User::updatePassword($currentUser, $request->new_password);
                Log::info('Password updated successfully');
                return response()->json([
                    'message' => 'Password Reset Successful'
                ], 201);
            }
        } catch (BookStoreException $exception) {
            return response()->json([
                'message' => $exception->message()
            ], $exception->statusCode());
        }
    }

}
