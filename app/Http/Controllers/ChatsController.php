<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $users = User::all()->except(Auth::id());
        return view('chat',compact('users'));
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $toUser = $data['user'];

        $message = $user->messages()->create([
            'message' => $request->input('message'),
            'to_user_id' => $toUser
        ]);
        $sendTo = User::find($toUser);
        broadcast(new MessageSent($user, $message, $sendTo))->toOthers();

        return ['status' => 'Message Sent!'];
    }

    public function getUsers(){
        $users = User::all()->except(Auth::id());
        return $users;
    }

    public function getUser($id){
        return User::find($id);
    }

    public function fetchChat($id){
        $data = Message::with(['sender','recipient'])->whereIn('user_id',[$id,Auth::id()])->whereIn('to_user_id',[$id,Auth::id()])->orderBy('created_at', 'ASC')->get();
        return $data;
    }

    public function online(User $user){
        $user->status = 'online';
        $user->save();

        broadcast(new UserOnline($user));
    }

    public function offline(){
        $user->status = 'offline';
        $user->save();

        broadcast(new UserOffline($user));
    }
}
