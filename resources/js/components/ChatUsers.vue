<template>
    <ul class="list-group" style="cursor: pointer">
        <li v-for="user in users" v-bind:key="user.id" @click="openChat(user.id)" class="list-group-item d-flex justify-content-between align-items-center">
            {{user.name}}
            <i class="material-icons">open_in_new</i>
        </li>
    </ul>
</template>

<script>
    export default {
        //props: ['users'],

        data() {
            return {
                newMessage: '',
                users:[]
            }
        },
        mounted() {
            this.fetchUsers();
            this.currentUser(); debugger;
             Echo.join('chat')
            .joining((user) => { debugger;
                axios.put('/api/user/'+ user.id +'/online?api_token=' + user.api_token, {});
            })
            .leaving((user) => { debugger;
                axios.put('/api/user/'+ user.id +'/offline?api_token=' + user.api_token, {});
            })
            .listen('UserOnline', (e) => { debugger;
                this.friend = e.user;
            })
            .listen('UserOffline', (e) => { debugger;
                this.friend = e.user;
            });
        },

        created(){
           
        },
        methods: {
            // sendMessage(userId) {
            //     this.$router.push('message/'+userId);
            // }
            currentUser(){
                axios.get('/user').then(response => {
                    localStorage.user = JSON.stringify(response.data);
                    localStorage.userId = response.data.id;
                });
            },
            fetchUsers(){
                axios.get('/all-users').then(response => {
                    this.users = response.data;
                });
            },

            openChat(userId){
                axios.get('/messages').then(response => {
                    this.$router.push('message/'+userId);
                });
            }

        }    
    }
</script>