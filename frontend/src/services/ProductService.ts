import Swal from 'sweetalert2'
import type { Product, ProductsList } from '@/modules/products/types'
import { API_URL } from '../common/constants'

const endPoint = 'products'

export default {
  async getProducts(numberPage: number | string | null, q?: string): Promise<ProductsList> {
    try {
      const response = await fetch(`${API_URL}/${endPoint}/?page=${numberPage}&q=${q}`)
      const data = await response.json()
      if (response.ok) {
        return data
      }
      throw { response, message: data }
    } catch (error) {
      showAlertError(error)
      throw error
    }
  },

  async getProduct(id: string | any): Promise<Product> {
    try {
      const response = await fetch(`${API_URL}/${endPoint}/${id}`)
      const data = await response.json()
      if (response.ok) {
        return data
      }
      throw { response, message: data }
    } catch (error) {
      showAlertError(error)
      throw error
    }
  },

  async addProduct(producto: any): Promise<Product> {
    try {
      const response = await fetch(`${API_URL}/${endPoint}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(producto)
      })
      const data = await response.json()
      if (response.ok) {
        showAlertOk()
        return data
      }
      throw { response, message: data }
    } catch (error: any) {
      showAlertError(error)
      throw error
    }
  },

  async updateProduct(id: any, producto: any): Promise<Product> {
    try {
      const response = await fetch(`${API_URL}/${endPoint}/${id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(producto)
      })
      const data = await response.json()
      if (response.ok) {
        showAlertOk()
        return data
      }
      throw { response, message: data }
    } catch (error: any) {
      showAlertError(error)
      throw error
    }
  },

  async deleteProduct(id: any): Promise<object> {
    try {
      const response = await fetch(`${API_URL}/${endPoint}/${id}`, {
        method: 'DELETE'
      })
      const data = await response.json()
      if (response.ok) {
        showAlertOk()
        return data
      }
      throw { response, message: data }
    } catch (error) {
      showAlertError(error)
      throw error
    }
  }
}

const showAlertOk = (): void => {
  Swal.fire({
    text: '',
    icon: 'success',
    confirmButtonText: 'OK'
  })
}

const showAlertError = (error: any): void => {
  const { response, message } = error
  const { ok, status, statusText } = response
  const arrayString = message ? JSON.stringify(message) : statusText
  Swal.fire({
    text: arrayString,
    icon: 'error',
    confirmButtonText: 'OK'
  })
}
