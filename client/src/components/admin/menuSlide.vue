<template lang="">
    <div class="w-full p-4 gap-y-4 flex flex-col justify-start items-start">
        <div><img src="../../assets/logo_shop.png" class="h-20" alt=""></div>
        <div class="flex flex-col justify-start items-start gap-y-4">
            <div class="cursor-pointer" @click="$router.push('/admin/dashboard')">Dashboard</div>
            <div class="cursor-pointer" @click="$router.push('/admin/produit')">Produit</div>
            <div class="cursor-pointer" @click="$router.push('/admin/bibliotheque')">Bibliotheque</div>
            <div>Client</div>
            <div></div>
        </div>
        <div></div>
    </div>
</template>
<script>
export default {

}
</script>
<style lang="">
    
</style>