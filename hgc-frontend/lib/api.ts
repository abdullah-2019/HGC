const API_BASE_URL = process.env.NEXT_PUBLIC_API_URL || "http://localhost:8000/api";

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
  return fetchAPI("/companies", { lang });
}

export function getFeaturedCompanies(lang: string = "en"): Promise<APIResponse<CompanyListItem[]>> {
  return fetchAPI("/companies/featured", { lang });
}

export function getCompanyBySlug(slug: string, lang: string = "en"): Promise<APIResponse<CompanyDetail>> {
  return fetchAPI(`/companies/${slug}`, { lang });
}