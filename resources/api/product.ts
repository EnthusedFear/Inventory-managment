import { Product, ProductFormData } from '@/js/types/product.types'
import apiRequest from '../js/utils/request'
import { JSONResponse } from '@/js/types/response.types'

export const getProducts = () => apiRequest.get('product').json<Product[]>()

export const getProduct = (id: Number) =>
    apiRequest.get(`product/${id}`).json<Product>()

export const addProduct = (product: ProductFormData) =>
    apiRequest
        .post(`product`, {
            json: product,
        })
        .json<Product>()

export const updateProduct = (id: Number, product: ProductFormData) =>
    apiRequest
        .patch(`product/${id}`, {
            json: product,
        })
        .json<Product>()

export const deleteProduct = (id: Number) =>
    apiRequest.delete(`product/${id}`).json<JSONResponse>()
