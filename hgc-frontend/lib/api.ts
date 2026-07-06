const API_BASE_URL = process.env.NEXT_PUBLIC_API_URL || "http://localhost:8000";

interface FetchOptions extends RequestInit {
  lang?: string;
}

async function fetchAPI<T>(endpoint: string, options: FetchOptions = {}): Promise<T> {
  const { lang = "en", ...rest } = options;

  const url = `${API_BASE_URL}${endpoint}`;

  const response = await fetch(url, {
    ...rest,
    headers: {
      "Content-Type": "application/json",
      "Accept-Language": lang,
      ...rest.headers,
    },
  });

  if (!response.ok) {
    throw new Error(`API Error: ${response.status} ${response.statusText}`);
  }

  return response.json();
}

// ─── Companies API ───

export interface CompanyListItem {
  id: number;
  slug: string;
  name: string;
  short_name: string;
  description: string;
  sector: string;
  accent_color: string;
  icon_name: string;
  logo_path: string | null;
  founded_year: number | null;
  employee_count: number | null;
}

export interface CompanyDetail {
  id: number;
  slug: string;
  name: string;
  short_name: string;
  description: string;
  sector: string;
  about: string | null;
  mission: string | null;
  vision: string | null;
  accent_color: string;
  icon_name: string;
  logo_path: string | null;
  hero_image_path: string | null;
  email: string | null;
  phone: string | null;
  website: string | null;
  address: string | null;
  latitude: number | null;
  longitude: number | null;
  facebook_url: string | null;
  linkedin_url: string | null;
  twitter_url: string | null;
  instagram_url: string | null;
  founded_year: number | null;
  registration_number: string | null;
  tax_id: string | null;
  employee_count: number | null;
  meta_title: string | null;
  meta_description: string | null;
}

export interface APIResponse<T> {
  success: boolean;
  data: T;
  message?: string;
}

export function getCompanies(lang: string = "en"): Promise<APIResponse<CompanyListItem[]>> {
  return fetchAPI("/api/companies", { lang });
}

export function getFeaturedCompanies(lang: string = "en"): Promise<APIResponse<CompanyListItem[]>> {
  return fetchAPI("/api/companies/featured", { lang });
}

export function getCompanyBySlug(slug: string, lang: string = "en"): Promise<APIResponse<CompanyDetail>> {
  return fetchAPI(`/api/companies/${slug}`, { lang });
}

// ─── Products API ───

export interface ProductImage {
  id: number;
  url: string;
  caption: string | null;
  is_primary: boolean;
}

export interface CategoryItem {
  id: number;
  slug: string;
  name: string;
  description: string | null;
  icon_name: string;
  image_url: string | null;
}

export interface CompanyItem {
  id: number;
  slug: string;
  name: string;
  accent_color: string | null;
}

export interface ProductListItem {
  id: number;
  slug: string;
  name: string;
  tagline: string | null;
  description: string | null;
  category: CategoryItem | null;
  company: CompanyItem | null;
  origin: string | null;
  grade: string | null;
  purity: string | null;
  specifications: Array<{ label: string; value: string }> | null;
  price_range: string | null;
  currency: string;
  unit: string | null;
  availability: "in_stock" | "limited" | "pre_order" | "out_of_stock";
  availability_label: string;
  hero_image_url: string | null;
  thumbnail_url: string | null;
  primary_image: ProductImage | null;
  is_featured: boolean;
}

export interface ProductDetail extends ProductListItem {
  overview: string | null;
  applications: string[] | null;
  packaging: string[] | null;
  delivery_info: string | null;
  images: ProductImage[];
  meta: {
    title: string | null;
    description: string | null;
  } | null;
}

export function getProducts(lang: string = "en", params?: { category?: string; featured?: boolean }): Promise<APIResponse<ProductListItem[]>> {
  const query = new URLSearchParams();
  if (params?.category) query.append("category", params.category);
  if (params?.featured) query.append("featured", "1");
  const qs = query.toString();
  return fetchAPI(`/api/products${qs ? `?${qs}` : ""}`, { lang });
}

export function getFeaturedProducts(lang: string = "en"): Promise<APIResponse<ProductListItem[]>> {
  return fetchAPI("/api/products/featured", { lang });
}

export function getProductBySlug(slug: string, lang: string = "en"): Promise<APIResponse<ProductDetail>> {
  return fetchAPI(`/api/products/${slug}`, { lang });
}

// ─── Categories API ───

export function getCategories(lang: string = "en", type?: string): Promise<APIResponse<CategoryItem[]>> {
  const query = new URLSearchParams();
  if (type) query.append("type", type);
  const qs = query.toString();
  return fetchAPI(`/api/categories${qs ? `?${qs}` : ""}`, { lang });
}

export function getCategoryBySlug(slug: string, lang: string = "en"): Promise<APIResponse<CategoryItem>> {
  return fetchAPI(`/api/categories/${slug}`, { lang });
}