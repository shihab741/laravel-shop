<template>
    <div>
        <h1>Category page</h1>   
    	<div class="col-md-4" v-for="product in productsByCategory">
            {{ product.product_name }}
            
            <router-link :to="`/single-product/${product.id}`">{{ product.product_name }}</router-link>
            
			<img :src="`uploads/product-images/`+`${ product.product_image }`" width="75" height="75">   		        
    	</div>
    </div>
</template>

<script>
    export default {
        name: "product-category",
        mounted(){
        	
        },
        computed:{
        	productsByCategory(){
        		return this.$store.getters.getProductsByCatId
        	}
        },
        methods:{
        	getProduct(){
        		this.$store.dispatch("allProductsByCategory",this.$route.params.id)
        	}
        },
        watch:{
        	$route(to,from){
        		this.getProduct();
        	}
        }

    }
</script>

<style scoped>

</style>