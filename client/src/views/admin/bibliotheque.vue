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
                            <th>pdf</th>
                            <th>nom</th>
                            <th>type</th>
                            <th>taille</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in biblios">
                            <td class="overflow-y-hidden"><embed :src="'http://localhost:8000/storage/'+item.pdf"  height="200" ></td>
                            <td>{{item.name}}</td>
                            <td>{{item.type}}</td>
                            <td>{{item.taille+' octet'}}</td>
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

       <div class="w-screen h-screen flex justify-center items-center bg-slate-800 bg-opacity-50 fixed z-10 top-0 right-0 " v-show="modal_ajout">
        <div class="w-[60vw] flex flex-col justify-center items-center bg-white p-4">
            <div class="w-full flex justify-end items-center">
                <div class="fa fa-times" @click="modal_ajout=false"></div>
            </div>
            <div class="w-full flex justify-start items-center">
                <div>
                    <h5>Ajout de Livre</h5>
                </div>
            </div>
            <div class="w-full flex flex-col justify-start items-center gap-y-4">
                <div class="w-full flex flex-col justify-center items-center ">
                    <div class="w-full"><label for="" class="text-gray-500 text-sm">Nom du livre</label></div>
                    <div class="w-full"><input type="text" class="focus:outline-none p-1 border w-full" required v-model="name"></div>
                </div>
                <div class="w-full flex flex-col justify-center items-center ">
                    <div class="w-full"><label for="" class="text-gray-500 text-sm">Pdf</label></div>
                    <div class="w-full"><input type="file" class="focus:outline-none p-1 border w-full" accept=".pdf,.doc,.docx,.txt" @change="handleFile" ></div>
                </div>
            </div>
            <div class="w-full flex justify-end items-center">
                <div>
                    <button class="px-3 py-1 bg-blue-500  text-white focus:outline-none my-2" @click="addBiblio()">
                        <div v-if="loadAjout">ajout...</div>
                        <div v-else>Ajouter</div>
                    </button>
                    
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import menuSide from '../../components/admin/menuSlide.vue'
export default {
    components: {
        menuSide
    },
    data() {
        return {
            loadAjout:false,
            modal_ajout: false,
            type:'',
            taille:'',
            name:'',
            pdf:null,
            biblios:null
        }
    },
    mounted(){
        this.getBiblio()
    },methods:{
        handleFile(event){
            this.pdf=event.target.files[0];
            this.type=this.pdf.type
            this.taille=this.pdf.size
        },
        addBiblio(){
            this.loadAjout=true
            const form = new FormData()
            form.append('name',this.name)
            form.append('pdf',this.pdf)
            form.append('type',this.type)
            form.append('taille',this.taille)
            axios.post('http://localhost:8000/api/addBiblio',form)
            .then(response=>{
                console.log(response.data)
                this.loadAjout=false
                this.getBiblio()
            })
        },getBiblio(){
            axios.post('http://localhost:8000/api/getBiblio',{
                search:''
            })
            .then(response=>{
                this.biblios=response.data.data
            })
        }
    }
}
</script>
<style lang="">
    
</style>