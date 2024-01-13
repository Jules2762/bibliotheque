<template lang="">
    <div class="w-screen flex justify-center items-center">
        <div class="w-[95vw] flex justify-end items-center">
            <div class="border w-fit flex justify-end items-center gap-x-4">
                <div><input type="text" v-model="search" placeholder="Search ..." class="focus:outline-none p-1 py-2 w-full"></div>
                <div>
                    <button class="px-3 py-2 text-white bg-gray-500" @click="Search()">
                        <div v-if="searching===false">Search</div>
                        <div v-else >Search...</div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    components:{
        
    }
}
</script>
<style lang="">
    
</style>