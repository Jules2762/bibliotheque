<template lang="">
    <div class="overflow-x-hidden">
        <headerHome></headerHome>
    <div class="w-screen flex justify-center items-center">
        <div class="w-[95vw] flex justify-between items-center py-4">
            <div class="flex justify-start items-center gap-x-4">
                <div class="border py-1 px-3 text-gray-500" @click="panier=true">
                    panier <span class="bg-red-600 px-1 text-white rounded-full"> {{countPanier}}</span>
                </div>
                <div></div>
            </div>
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
    <div class='w-screen flex justify-center items-center  bg-slate-50'>
        <div class="w-[95vw] grid lg:grid-cols-4 md:grid-cols-3 gap-y-4 py-4  gap-x-4 flex-wrap justify-between items-start" >
           <div v-for="product in produits"  class='bg-white p-4 '>
                <!-- <div><img src="../../assets/alexander.jpg" alt=""></div> -->
                <div><img :src="'http://localhost:8000/storage/'+product.image"></div>

                <div><h6>{{product.name}}</h6></div>
                <div>
                    <p>{{product.price+' '+product.unite}}</p>
                </div>
                <div class="w-full flex justify-between items-center gap-x-4">
                    <div class="border py-1 w-4/12 flex justify-center items-center">
                        <div>like</div>
                    </div>
                    <div class="w-8/12">
                        <button class="bg-blue-400 w-full py-1 text-white" @click="addPanier(product.id)">
                        <div v-if="addingPanier"><span class="fas fa-circle-notch animate-spin"></span></div>
                        <div v-else>Ajouter au panier</div>
                        </button>
                    </div>
                </div>
           </div>
        </div>
    </div>
    <div v-if="loadingContent" class="w-full flex justify-center items-center p-4">
            <div class="fas fa-circle-notch animate-spin"></div>
        </div>
    <div class="w-screen flex justify-center items-center">
        <div class="w-[95vw] flex justify-center items-center  gap-x-4">
            <div>
                <button v-if="current_page>1" @click="prevPage()" class="px-3 py-1 bg-blue-400 text-white">Prev</button>
                <button v-else  class="px-3 py-1 bg-gray-400 text-white">Prev</button>
            </div>
            <div class="flex justify-center items-center gap-x-4">
                <button class="border px-3 py-1" :class="{'bg-blue-400 text-white':current_page==i}" v-for="i in last_page" @click="current_page=i,goPage(i)">{{i}}</button>
                
            </div>
            <div>
                <button v-if="current_page<last_page" @click="nextPage()" class="px-3 py-1 bg-blue-400 text-white" >Next</button>
                <button v-else class="px-3 py-1 bg-slate-400 text-white" >Next</button>
        
            </div>
        </div>
    </div>
    <div class="fixed top-0 left-0 z-10 flex flex-col justify-center items-center   w-[30vw] max-h-[100vh] bg-white shadow-sm shadow-gray-300" v-if="panier">
        <div class="w-full flex justify-end items-center p-4">
            <div class="fa fa-times" @click="panier=false">

            </div>
        </div>
        <div class="w-full flex flex-col justify-center items-start gap-y-4 p-4 overflow-y-auto h-[90vh]">
            <div v-for="item in paniers">
                {{
                    item.nombre
                }}
            </div>
        </div>
    </div>
    <footerVue></footerVue>
    </div>
   
    
</template>
<script>
import headerHome from '@/components/client/headerHome.vue';
import footerVue from '@/components/client/footer.vue';
import axios from 'axios';
export default {
    components: {
        headerHome,
        footerVue
    },
    data() {
        return {
            addingPanier: false,
            countPanier: 0,
            loadingContent: false,
            produits: null,
            current_page: 1,
            last_page: 0,
            search: '',
            i: 1,
            searching: false,
            paniers: null, page: 1,
            panier: false
        }
    }, mounted() {
        this.getPanier()
        this.loadingContent = true
        axios.post('http://localhost:8000/api/getProduit', { search: this.search })
            .then(response => {
                this.produits = response.data.data
                this.last_page = response.data.last_page
                console.log(this.last_page)
                this.loadingContent = false
            })

    }, methods: {
        getPanier() {
            axios.post(`http://localhost:8000/api/getPanier`, {
                client_id: localStorage.getItem('myId')
            })
                .then(response => {
                    this.countPanier = response.data.length
                    this.paniers = response.data
                })
        },
        Search() {

            this.searching = true
            this.current_page--
            axios.post(`http://localhost:8000/api/getProduit`, { search: this.search })
                .then(response => {
                    this.produits = response.data.data
                    this.last_page = response.data.last_page
                    console.log(this.last_page)
                    console.log(this.current_page)
                    this.searching = false
                })


        }, addPanier(id) {
            this.addingPanier = true
            axios.post(`http://localhost:8000/api/addPanier`, { client_id: localStorage.getItem('myId'), produit_id: id })
                .then(response => {
                    this.addingPanier = false

                })
            this.getPanier()
        },
        goPage(page) {
            this.loadingContent = true
            axios.post(`http://localhost:8000/api/getProduit?page=${page}`, { search: this.search })
                .then(response => {
                    this.produits = response.data.data
                    this.last_page = response.data.last_page
                    console.log(this.last_page)
                    console.log(this.current_page)
                    this.loadingContent = false
                })

        },
        prevPage() {

            if (this.current_page > 1) {
                this.loadingContent = true
                this.current_page--
                axios.post(`http://localhost:8000/api/getProduit?page=${this.current_page}`, { search: this.search })
                    .then(response => {
                        this.produits = response.data.data
                        this.last_page = response.data.last_page
                        console.log(this.last_page)
                        console.log(this.current_page)
                        this.loadingContent = false
                    })
            }
        }, nextPage() {

            if (this.last_page > this.current_page) {
                this.loadingContent = true
                this.current_page++
                axios.post(`http://localhost:8000/api/getProduit?page=${this.current_page}`, { search: this.search })
                    .then(response => {
                        this.produits = response.data.data
                        this.last_page = response.data.last_page
                        console.log(this.last_page)
                        console.log(this.current_page)
                        this.loadingContent = false
                    })
            }
        }
    }, computed() {
        this.getPanier()
    }

}
</script>
<style lang="">
    
</style>