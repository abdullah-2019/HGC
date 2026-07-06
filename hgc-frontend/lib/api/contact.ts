const API_BASE = process.env.NEXT_PUBLIC_API_URL 
  ? `${process.env.NEXT_PUBLIC_API_URL}/api` 
  : "http://localhost:8000/api";

export interface ContactInfo {
  id: number;
  // English
  address: string | null;
  phones: string | null;
  email: string | null;
  office_hours: string | null;
  // Dari
  address_dari: string | null;
  phones_dari: string | null;
  email_dari: string | null;
  office_hours_dari: string | null;
  // Pashto
  address_pashto: string | null;
  phones_pashto: string | null;
  email_pashto: string | null;
  office_hours_pashto: string | null;
  // Social
  facebook: string | null;
  x: string | null;
  linkedin: string | null;
  telegram: string | null;
  instagram: string | null;
  youtube: string | null;
  whatsapp: string | null;
  // Map
  map_embed_url: string | null;
  map_lat: string | null;
  map_lng: string | null;
  created_at: string;
  updated_at: string;
}

export async function fetchContactInfo(): Promise<ContactInfo> {
  const res = await fetch(`${API_BASE}/contact-info`, {
    cache: "no-store",
  });

  if (!res.ok) {
    const text = await res.text();
    throw new Error(`HTTP ${res.status}: ${text.substring(0, 200)}`);
  }

  const json = await res.json();

  if (!json.success || !json.data) {
    throw new Error("Invalid API response");
  }

  return json.data;
}

export interface ContactSubmissionPayload {
  name: string;
  email: string;
  phone?: string;
  subject: string;
  message: string;
}

export async function submitContactForm(payload: ContactSubmissionPayload) {
  const res = await fetch(`${API_BASE}/contact-submissions`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
    body: JSON.stringify(payload),
  });

  const json = await res.json();

  if (!res.ok) {
    throw new Error(json.message || `HTTP ${res.status}`);
  }

  return json;
}