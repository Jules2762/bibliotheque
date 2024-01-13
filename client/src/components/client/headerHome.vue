<template lang="">
    <div class='w-screen flex justify-center items-center'>
        <div class='w-[95vw] flex justify-between items-center '>
            <div>
                <div class="w-16 flex items-start justify-start"><img src="../../assets/logo_shop.png"  alt=""></div>
            </div>
            <div class='flex justify-end items-center gap-x-4'>
                <div class='flex justify-center items-center gap-x-4'>
                    
                        <div class='cursor-pointer' @click="$router.push('/home')">Accueil</div>
                        <div class='cursor-pointer' @click="$router.push('/shop')">Shop</div>
                        <div>Collection</div>
                        <div>About</div>
                    
                </div>
                <div>
                    <button class='px-3 py-1 bg-blue-500 text-white' @click="logout">Se deconnecter</button>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
export default {
    methods:{
        logout(){
            localStorage.removeItem('myId')
            this.$router.push('/')
        }
    }
}
</script>
<style lang="">
    
</style>