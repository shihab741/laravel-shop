export default {
    state:{
        product:[],
        getProductsByCatId:[],
        productDetailsById:[]
    },

    getters:{
        getProduct(state){
            return state.product
        },
        getProductsByCatId(state){
            return state.getProductsByCatId
        },
        productDetailsById(state){
            return state.productDetailsById
        },

    },

    actions:{
        allProducts(context){
            axios.get('/all-products')
                .then((response)=>{
                    context.commit('products',response.data.products)
                })
        },
        allProductsByCategory(context, payload){
            axios.get('/all-products-by-category/'+payload)
                .then((response)=>{
                    context.commit('getProductsByCatId', response.data.productsByCategory)
                })
        },
        productDetailsById(context,payload){
            axios.get('/single/'+payload)
                .then((response)=>{
                    // console.log(response.data.singleProduct)
                    context.commit('productDetailsById',response.data.productDetails)
                })
        },

    },
    
    mutations:{
        products(state,data){
            return state.product = data
        },
        getProductsByCatId(state,payload){
            return state.getProductsByCatId = payload
        },
        productDetailsById(state,payload){
            return state.productDetailsById = payload
        },
    }
}