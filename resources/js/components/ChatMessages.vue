<style>

.f-right{
    float: right;
    clear: both; display: block; position: relative;
}
.f-left{
    float: left;
    clear: both; display: block; position: relative;
}
</style>
<template>
    <div>
        <ul class="list-group">
            <li class="list-group-item active"><i style="vertical-align: middle; cursor: pointer;" @click="backToUsers" class="material-icons">keyboard_backspace</i>
                <span style="margin-left:15px">{{toUser.name}}</span>
            </li>
        </ul>
        <ul class="chat" style="margin:15px">
            <li class="left clearfix" v-for="message in messages" v-bind:key="message.id">
                <div class="chat-body clearfix">
                    <div class="headline">
                        <h6 v-if="user == message.to_user_id" v-bind:class="user == message.to_user_id ? 'f-right' : 'f-left'">
                            <strong>{{ message.sender.name }}</strong>
                        </h6>
                        <h6 v-if="user == message.user_id" v-bind:class="user == message.to_user_id ? 'f-right' : 'f-left'">
                           <strong> {{ message.sender.name }}</strong>
                        </h6>
                        <p v-bind:class="user == message.to_user_id ? 'f-right' : 'f-left'">
                            <span> {{ message.message }} </span>
                        </p>
                    </div>
                </div>
            </li>
        </ul>
        <div class="panel-footer" id="chatForm">
            <chat-form
                v-on:messagesent="addMessage"
                :user="user"
            ></chat-form>
        </div>
    </div>
</template>

<script>
  export default {
    // name: 'chatMessages',
  //  props: ['messages'],

    data() {
        return {
            user: '',
            messages: [],
            toUser: ''
        }
    },

    created() {
        Echo.private('chat.'+localStorage.userId)
        .listen('MessageSent', (e) => {
            this.fetchMessages();
        });
    },

    mounted() {
        this.user = this.$route.params.id;
        this.fetchMessages();
        this.getToUser();
    },

    methods:{
        fetchMessages() {
            axios.get('/messages/'+this.user).then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
            axios.post('/messages',message).then(response => {
              console.log(response.data);
               this.fetchMessages()
            });
        },

        getToUser(){
            axios.get('/user/'+this.user).then(response => {
              this.toUser = response.data;
            });
        },

        backToUsers(){
            this.$router.push('/');
        }


    }
  };
</script>