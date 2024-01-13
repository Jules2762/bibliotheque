<template lang="">
    <div class="w-screen flex justify-center items-center py-2  bg-white ">
        <div class="w-11/12  flex justify-between items-start ">
            <div class="w-16 flex items-start justify-start"><img src="../../assets/logo_shop.png"  alt=""></div>
            <div class="flex justify-between  gap-x-8  items-center ">
                <div class='flex justify-around items-center mx-20 gap-x-12 text-center'>
                    <div class='cursor-pointer text-center'>Accueil</div>
                    <div class="cursor-pointer text-center">Service</div>
                    <div class="cursor-pointer text-center">Contact</div>
                    <div class="cursor-pointer text-center">A propos</div>
                </div>
                <div><button class=" py-1 px-4 " @click="$router.push('/signup')">S'inscrire</button></div>      
                <div><button class="bg-blue-400 hover:bg-blue-500 text-white text-center py-1 px-4 " @click="$router.push('/signin')">Se connecter</button></div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    methods:{
        
    }
}
</script>
<style lang="">
    
</style>