<template>
    <div>
        <h1>Product page</h1>   
        <h3>{{ productDetailsById.product_name }}</h3>
        <h3>{{ productDetailsById.product_price }}</h3>
    </div>
</template>

<script>
    export default {
        name: "singleProduct",
        mounted(){
        	
        },
        computed:{
        	productDetailsById(){
        		return this.$store.getters.productDetailsById
        	}
        },
        methods:{
        	getProductDetails(){
        		this.$store.dispatch("productDetailsById",this.$route.params.id)
        	}
        },
        watch:{
        	$route(to,from){
        		this.getProductDetails();
        	}
        }

    }
</script>

<style scoped>

</style>