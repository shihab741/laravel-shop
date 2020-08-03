<template>
    <div>
        <h1>Navigation</h1>

	        <ul>
	        	<li>
	        		<router-link to="/">Home</router-link>
	        	</li>
	        	<li v-for="category in categories">
	        		<router-link :to="`/product-category/${category.id}`">{{ category.cat_name }}</router-link>
	        	</li>
	        </ul>
    </div>
</template>

<script>
    export default {
        name: "navigation",
        data(){
            return{
                categories:[]
            }
        },
        created(){
            axios.get('/get-categories')
                .then((response =>{
                    this.categories = response.data.categories
                }))
        }
    }
</script>

<style scoped>

</style>