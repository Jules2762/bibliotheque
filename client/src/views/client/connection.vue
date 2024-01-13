<template lang="">
    <div class="w-screen h-screen flex justify-center items-center">
        <div class='w-1/2 flex justify-center items-center'>icon</div>
        <div class='w-1/2 flex justify-center items-center'>
            <form >
                <div class='w-full flex flex-col justify-center items-center gap-y-4'>
                    <div>
                        <div>email</div>
                        <div><input type="email" class='focus:outline-none border w-full p-1' v-model="email" required></div>
                    </div>
                    <div>
                        <div>password</div>
                        <div><input type="password" class='focus:outline-none border w-full p-1' v-model="password" required></div>
                    </div>
                    <div>
                        <button @click.prevent='connection()' class='bg-blue-400 hover:bg-blue-500 px-3 py-1 text-white' v-if='loadingConnection===false'>Signin</button>
                        <button  class='bg-blue-400 hover:bg-blue-300 px-3 py-1 text-white' v-else>loading...</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
// import axios from 'axios'
export default {
    data() {
        return {
            email: '',
            password: '',
            loadingConnection: false
        }
    }, methods: {
        connection() {
            this.loadingConnection=true
            axios.post('http://localhost:8000/api/login', {
                email: this.email,
                password: this.password
            },{
                withCredentials:true
            })
                .then(response => {
                    console.log(JSON.stringify(response))
                    if(response.data.message){
                        
                        this.error=false
                        this.$router.push('/home')
                    } else {
                        this.error=true
                       
                    }
                    this.loadingConnection=false
                })
        }
    }
}
</script>
<style lang="">
    
</style>