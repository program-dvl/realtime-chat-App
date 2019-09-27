<!-- resources/views/chat.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default">
                {{-- <div class="panel-heading">Chats</div> --}}
                {{-- <router-view></router-view> --}}
                <app></app>
                {{-- <chat-users :users="{{$users}}"></chat-users> --}}
                {{-- <div class="panel-body" id="messageSection">
                    <chat-messages :messages="messages"></chat-messages>
                </div>
                <div class="panel-footer" id="chatForm">
                    <chat-form
                        v-on:messagesent="addMessage"
                        :user="{{ Auth::user() }}"
                    ></chat-form>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection