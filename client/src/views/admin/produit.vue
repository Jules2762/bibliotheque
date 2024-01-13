<template lang="">
    <div class="w-screen bg-slate-50 flex justify-between items-start gap-x-4">
        <div class="w-3/12 h-screen bg-white">
            <menuSide></menuSide>
        </div>
        <div class="w-9/12 flex gap-y-4 flex-col justify-start items-center">
            <div></div>
            <div class="w-full p-4 bg-white flex justify-between items-center">
                <div>
                    <button class="px-3 py-1 border text-gray-500 flex justify-center items-center gap-x-2" @click="modal_ajout=true"><div class="fas fa-plus"></div><div>Ajout</div></button>
                </div>
                <div class="flex justify-end items-center gap-x-4">
                    <div></div>
                    <div class="border flex">
                        <div>
                            <input type="text" class="p-1 focus:outline-none">
                        </div>
                        <div>
                            <button class="px-3 py-1 bg-blue-400 text-white">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full p-4 bg-white">
                <table class="min-w-full">
                    <thead>
                        <tr class="text-left">
                            <th>image</th>
                            <th>nom</th>
                            <th>prix</th>
                            <th>unite</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in prod">
                            <td @click="showModalDetails('http://localhost:8000/storage/'+item.image)"><img :src="'http://localhost:8000/storage/'+item.image" alt="image produit" class="w-20" v-if="item.image"></td>
                            <td>{{item.name}}</td>
                            <td>{{item.price}}</td>
                            <td>{{item.unite}}</td>
                            <td class='flex justify-center items-center gap-x-4'>
                                <div class="flex justify-center items-center"><div class='fa fa-eye'></div></div>
                                <div class="flex justify-center items-center"><div class='fa fa-pen'></div></div>
                                <div class="flex justify-center items-center"><div class='fa fa-trash'></div></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- modal ajout -->
    <div class="w-screen h-screen flex justify-center items-center bg-slate-800 bg-opacity-50 fixed z-10 top-0 right-0 " v-show="modal_ajout">
        <div class="w-[60vw] flex flex-col justify-center items-center bg-white p-4">
            <div class="w-full flex justify-end items-center">
                <div class="fa fa-times" @click="modal_ajout=false"></div>
            </div>
            <div class="w-full flex justify-start items-center">
                <div>
                    <h5>Ajout de produit</h5>
                </div>
            </div>
            <div class="w-full flex flex-col justify-start items-center gap-y-4">
                <div class="w-full flex flex-col justify-center items-center ">
                    <div class="w-full"><label for="" class="text-gray-500 text-sm">Nom du produit</label></div>
                    <div class="w-full"><input type="text" class="focus:outline-none p-1 border w-full" required v-model="name"></div>
                </div>
                <div class="w-full flex flex-col justify-center items-center ">
                    <div class="w-full"><label for="" class="text-gray-500 text-sm">prix(Ariary)</label></div>
                    <div class="w-full"><input type="number" class="focus:outline-none p-1 border w-full" required v-model="price"></div>
                </div>
                <div class="w-full flex flex-col justify-center items-center ">
                    <div class="w-full"><label for="" class="text-gray-500 text-sm">Image</label></div>
                    <div class="w-full"><input type="file" class="focus:outline-none p-1 border w-full" accept=".jpg,.jpeg,.png" @change="handleFile" ></div>
                </div>
            </div>
            <div class="w-full flex justify-end items-center">
                <div>
                    <button class="px-3 py-1 bg-blue-500  text-white focus:outline-none my-2" @click="addProduit()">
                        <div v-if="loadAjout">ajout...</div>
                        <div v-else>Ajouter</div>
                    </button>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- modal detail -->
    <div class="w-screen h-screen flex justify-center items-center bg-slate-800 bg-opacity-50 fixed z-10 top-0 right-0 " v-show="modal_details">
        <div class="w-fit h-fit flex flex-col justify-center items-center bg-white p-4">
            <div class="w-full flex justify-end items-center">
                <div class="fa fa-times" @click="modal_details=false"></div>
            </div>
            <div class=" flex justify-start items-center">
                <div >
                    <img :src="img" class="max-w-full max-h-[85vh]">
                </div>
            </div>
        <div></div>
        </div>
    </div>

</template>
<script>
import axios from 'axios';
import menuSide from '../../components/admin/menuSlide.vue'
export default {
    components:{menuSide},
    data() {
        return {
            modal_ajout: false,
            modal_details:false,
            name: '',
            price: 0,
            file: null,
            loadAjout:false,
            prod:null,
            search:'',
            img:''
        }
    },
    mounted(){
        this.getProduit()
    }, methods: {
        handleFile(event){
            this.file=event.target.files[0]
           
    },getProduit(){
        axios.post('http://localhost:8000/api/getProduit')
        .then(response=>{
            this.prod=response.data.data
        })

    },
        addProduit() {
        
            this.loadAjout=true
            const datas = new FormData();
            datas.append('name',this.name)
            datas.append('price',this.price)
            datas.append('file',this.file)
            axios.post('http://localhost:8000/api/addProduit', datas)
                .then(response => {
                    this.getProduit()
                    this.loadAjout=false
                })
                this.name=''
                this.price=0
        },
        showModalDetails(img){
            this.modal_details=true
            this.img=img
        }
        
    }
}
</script>
<style lang="">
    
</style>