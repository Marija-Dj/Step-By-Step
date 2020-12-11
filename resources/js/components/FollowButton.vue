<template>
<div> 
    <button class="btn btn-outline-info  ml-5" @click="followUser" v-text="buttonText"></button>
</div>


</template>

<script>
    export default {
        props: ['userId', 'follows'],

        mounted() {
            console.log('Component mounted.')
        },
        data: function() {
            return {
                status: this.follows,
            }
        },

        methods: {
            followUser(){

                //alert('inside');
                axios.post('/follow/' + this.userId)
                .then( response=>{

                    this.status=! this.status;


                    //alert(response.data);
                    console.log(response.data)
                })
                .catch(error =>{
                    if(error.response.status==401)
                    { 
                        window.location='/login';

                    }
                });
            }
        },
        computed: {
            buttonText(){
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        }
    }
</script>

