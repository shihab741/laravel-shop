import AdminHomeComponent from './components/public/home'
import ProductCategoryComponent from './components/public/product-category'
import SingleProductComponent from './components/public/singleProduct'
export const routes = [
    {
        path: '/',
        component: AdminHomeComponent
    },
    {
        path: '/product-category/:id',
        component: ProductCategoryComponent
    },
    {
        path: '/single-product/:id',
        component: SingleProductComponent
    }

]