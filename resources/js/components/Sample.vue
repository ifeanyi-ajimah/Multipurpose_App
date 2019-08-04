<template>


</template>

<script>


export default {

  components: {

  },

  mounted() {

  },

  data(){
    return {
        auth:{},


    }
},

methods:{

    loadAuth(){
                axios.get('/profile')
                .then((response)=> {

                })
                .catch((error)=>{

                })
                .finally(() => {

                });
            },

},

}
</script>

<style >



</style>


