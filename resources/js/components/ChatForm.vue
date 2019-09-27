<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" style="height:auto" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">

        <span class="input-group-btn" style="margin-left: 10px;">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                <i class="material-icons">send</i>
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage
                });

                this.newMessage = ''
            }
        }    
    }
</script>