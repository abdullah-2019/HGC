// app/projects/types.ts
export interface Project {
  id: number;
  slug: string;
  nameEn: string;
  nameDari: string;
  locationEn: string;
  locationDari: string;
  clientEn: string;
  clientDari: string;
  duration: string;
  status: "completed" | "ongoing" | "planned";
  category: string;
  descriptionEn: string;
  descriptionDari: string;
  coverImage: string;
  completionPercent: number;
  companyColor: string;
  companySlug: string;
}

export interface CompanyFilterItem {
  id: string;
  slug: string;
  nameEn: string;
  nameDari: string;
  icon: string;
  color: string;
}