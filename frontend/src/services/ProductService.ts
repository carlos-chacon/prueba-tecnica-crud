import type { ProductsList } from "@/modules/products/types";
import {API_URL} from "../common/constants";

const endPoint = 'products';

export default {
    async getProducts(numberPage: number | string | null, q?: string): Promise<ProductsList> {
      try {
        const response = await fetch(`${API_URL}/${endPoint}/?page=${numberPage}&q=${q}`);
        const data = await response.json();
        return data;
      } catch (error) {
        console.error('Error al obtener los productos:', error);
        throw error;
      }
    },
  
    async addProduct(producto: any): Promise<any> {
      try {
        const response = await fetch(`${API_URL}/${endPoint}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(producto),
        });
        const data = await response.json();
        return data;
      } catch (error) {
        console.error('Error al agregar el producto:', error);
        throw error;
      }
    },
  
    async updateProduct(id: number, producto: any): Promise<any> {
      try {
        const response = await fetch(`${API_URL}/${endPoint}/${id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(producto),
        });
        const data = await response.json();
        return data;
      } catch (error) {
        console.error('Error al actualizar el producto:', error);
        throw error;
      }
    },
  
    async deleteProduct(id: number): Promise<void> {
      try {
        const response = await fetch(`${API_URL}/${endPoint}/${id}`, {
          method: 'DELETE',
        });
        if (!response.ok) {
          throw new Error('Error al eliminar el producto');
        }
      } catch (error) {
        console.error('Error al eliminar el producto:', error);
        throw error;
      }
    },
  };
  