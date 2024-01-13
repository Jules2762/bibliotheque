<template lang="">
    <div class='w-screen flex justify-between items-center'>
        <div></div>
        <div class='w-1/2'>
            <div>
                <div><label for="">name</label></div>
                <div><input type="text" class='w-full border' v-model='name'></div>
            </div>
            <div>
                <div><label for="">email</label></div>
                <div><input type="text" class='w-full border' v-model='email'></div>
            </div>
            <div>
                <div><label for="">password</label></div>
                <div><input type="text" class='w-full border' v-model='password'></div>
            </div>
            <div>
                <button class='bg-blue-500 text-white px-3 py-1' @click.prevent='signup()'>Signup</button>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';


export default {
    data(){
        return {
            name:'',
            email:'',
            password:''
        }
    },
    methods:{
        signup(){
            
            axios.post('http://localhost:8000/api/signup',{
                name:this.name,
                email:this.email,
                password:this.password
            })
            .then(response=>{
                console.log(JSON.stringify(response.data))
            })

        }
    }
}
</script>
<style lang="">
    
</style>