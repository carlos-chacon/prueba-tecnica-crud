export interface CommitsType {
  html_url: string
  sha: string
  author: string
  commit: string
}

export interface ResponseProducts {
    data: ProductsList
}

export interface ProductsList {
  current_page: number;
  data: Product[];
  first_page_url: string;
  from: number;
  last_page: number;
  last_page_url: string;
  links: LinkPage[];
  next_page_url?: any;
  path: string;
  per_page: number;
  prev_page_url?: any;
  to: number;
  total: number;
}

export interface LinkPage {
  url?: string;
  label: string;
  active: boolean;
}

export interface Product {
  id: number;
  name: string;
  description: string;
  price: number;
  quantity: number;
  image: string;
  category: string;
  brand: string;
  sku: string;
  weight: string;
  dimensions: string;
  featured: boolean;
  on_sale: boolean;
  created_at: string;
  updated_at: string;
}