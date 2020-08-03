<template>
    <div>
        <h1>This is home</h1>      
    	<div class="col-md-4" v-for="product in products">
            {{ product.product_name }}

            <router-link :to="`/single-product/${product.id}`">{{ product.product_name }}</router-link>

            
    		<img :src="`uploads/product-images/`+`${ product.product_image }`" width="75" height="75">         
    	</div>
    </div>
</template>

<script>
    export default {
        name: "home",
        mounted(){
			this.$store.dispatch("allProducts")
        },
        computed:{
            products(){
                return this.$store.getters.getProduct
            }
        }
    }
</script>

<style scoped>

</style>