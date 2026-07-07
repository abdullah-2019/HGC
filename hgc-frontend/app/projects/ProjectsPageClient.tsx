"use client";

import { useState, useEffect } from "react";
import ProjectsHero from "./sections/ProjectsHero";
import CompanyFilter from "./sections/CompanyFilter";
import ProjectsGrid from "./sections/ProjectsGrid";

// Your .env has: NEXT_PUBLIC_API_URL=http://localhost:8000
// So we append /api here
const API_BASE = `${process.env.NEXT_PUBLIC_API_URL || "http://localhost:8000"}/api`;

// ─── Types ───────────────────────────────────────────────────────────

interface Project {
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

interface CompanyFilterItem {
  id: string;
  slug: string;
  nameEn: string;
  nameDari: string;
  icon: string;
  color: string;
}

// ─── Fallback Data ─────────────────────────────────────────────────

const fallbackProjects: Project[] = [
  {
    id: 1,
    slug: "kabul-kandahar-highway",
    nameEn: "Kabul-Kandahar Highway Rehabilitation",
    nameDari: "ترمیم اساس سرک کابل - کندهار",
    locationEn: "Kandahar",
    locationDari: "کندهار",
    clientEn: "Ministry of Public Works",
    clientDari: "وزارت فواید عامه",
    duration: "2023 - 2025",
    status: "completed",
    category: "Roads",
    descriptionEn: "37km highway rehabilitation from Shah Safa to Manji on the Kabul-Kandahar National Highway including asphalt paving and bridge repairs.",
    descriptionDari: "ترمیم ۳۷ کیلومتری سرک از شاه صفا تا منجی در اساس سرک ملی کابل - کندهار شامل آسفالت و ترمیم پل‌ها.",
    coverImage: "/images/placeholder.png",
    completionPercent: 100,
    companyColor: "#B22222",
    companySlug: "hcrc",
  },
  {
    id: 2,
    slug: "badakhshan-police-hq",
    nameEn: "Badakhshan Police HQ & Hospital",
    nameDari: "قومندانی امنیه و شفاخانه پولیس بدخشان",
    locationEn: "Badakhshan",
    locationDari: "بدخشان",
    clientEn: "Ministry of Interior",
    clientDari: "وزارت داخله",
    duration: "2023",
    status: "completed",
    category: "Buildings",
    descriptionEn: "Construction of special police headquarters and 20-bed hospital facility in Badakhshan province with modern amenities.",
    descriptionDari: "ساختمان قومندانی امنیه ویژه و شفاخانه ۲۰ تختخوابه در ولایت بدخشان با امکانات مدرن.",
    coverImage: "/images/placeholder.png",
    completionPercent: 100,
    companyColor: "#B22222",
    companySlug: "hcrc",
  },
  {
    id: 3,
    slug: "nangarhar-solar-150kw",
    nameEn: "Nangarhar 150kW Solar Power System",
    nameDari: "سیستم برق سولری ۱۵۰ کیلوواتی ننگرهار",
    locationEn: "Nangarhar",
    locationDari: "ننگرهار",
    clientEn: "Ministry of Finance",
    clientDari: "وزارت مالیه",
    duration: "2023 - 2024",
    status: "completed",
    category: "Solar",
    descriptionEn: "Supply and installation of 150kW DC solar power system for Nangarhar Customs Department with battery backup.",
    descriptionDari: "تدارک و نصب سیستم برق سولری ۱۵۰ کیلوواتی DC برای ریاست گمرک ننگرهار با پشتیبان باتری.",
    coverImage: "/images/placeholder.png",
    completionPercent: 100,
    companyColor: "#F57C00",
    companySlug: "zainnoorain",
  },
  {
    id: 4,
    slug: "kharwar-district-building",
    nameEn: "Kharwar District Administrative Building",
    nameDari: "ساختمان اداری ولسوالی خروار",
    locationEn: "Logar",
    locationDari: "لوگر",
    clientEn: "Ministry of Interior",
    clientDari: "وزارت داخله",
    duration: "2024 - 2025",
    status: "ongoing",
    category: "Buildings",
    descriptionEn: "Construction of modern administrative building for Kharwar district with conference facilities and digital infrastructure.",
    descriptionDari: "ساختمان اداری مدرن برای ولسوالی خروار با تاسیسات کنفرانس و زیرساخت دیجیتال.",
    coverImage: "/images/placeholder.png",
    completionPercent: 65,
    companyColor: "#B22222",
    companySlug: "hcrc",
  },
  {
    id: 5,
    slug: "lead-zinc-extraction-badakhshan",
    nameEn: "Lead & Zinc Mining Operation",
    nameDari: "عملیات استخراج سرب و روی",
    locationEn: "Badakhshan",
    locationDari: "بدخشان",
    clientEn: "Al-Bahrain Mining Co.",
    clientDari: "شرکت استخراج معادن البحرین",
    duration: "2022 - 2026",
    status: "ongoing",
    category: "Mining",
    descriptionEn: "Large-scale extraction of sulfide lead and zinc deposits with processing facility and export logistics.",
    descriptionDari: "استخراج در مقیاس بزرگ ذخایر سرب و روی سولفیده با تاسیسات فرآوری و لوجستیک صادرات.",
    coverImage: "/images/placeholder.png",
    completionPercent: 40,
    companyColor: "#1A237E",
    companySlug: "albahrain",
  },
  {
    id: 6,
    slug: "kabul-logistics-hub",
    nameEn: "Kabul Central Logistics Hub",
    nameDari: "مرکز لوجستیک کابل",
    locationEn: "Kabul",
    locationDari: "کابل",
    clientEn: "Al-Koozi Logistics",
    clientDari: "لوجستیک الکوزی",
    duration: "2024 - 2025",
    status: "ongoing",
    category: "Logistics",
    descriptionEn: "Construction of 50,000 sqm warehousing and distribution center with cold chain facilities.",
    descriptionDari: "ساخت مرکز انبارداری و توزیع ۵۰۰۰۰ متر مربع با تاسیسات زنجیره سرد.",
    coverImage: "/images/placeholder.png",
    completionPercent: 30,
    companyColor: "#00838F",
    companySlug: "alkoozi",
  },
  {
    id: 7,
    slug: "herat-solar-microgrid",
    nameEn: "Herat Solar Microgrid Project",
    nameDari: "پروژه میکروگرید سولری هرات",
    locationEn: "Herat",
    locationDari: "هرات",
    clientEn: "Ministry of Energy",
    clientDari: "وزارت انرژی",
    duration: "2025 - 2026",
    status: "planned",
    category: "Solar",
    descriptionEn: "500kW community solar microgrid powering 5 villages with smart metering and battery storage.",
    descriptionDari: "میکروگرید سولری ۵۰۰ کیلوواتی جامعه برای تغذیه ۵ قریه با میتر هوشمند و ذخیره باتری.",
    coverImage: "/images/placeholder.png",
    completionPercent: 0,
    companyColor: "#F57C00",
    companySlug: "zainnoorain",
  },
  {
    id: 8,
    slug: "mazar-sharif-trading-center",
    nameEn: "Mazar-e-Sharif Trading Center",
    nameDari: "مرکز تجارت مزار شریف",
    locationEn: "Balkh",
    locationDari: "بلخ",
    clientEn: "Al-Madinah Trading",
    clientDari: "تجارت المدینه",
    duration: "2024",
    status: "completed",
    category: "Commercial",
    descriptionEn: "Modern wholesale trading center with 200 vendor stalls and cold storage facilities.",
    descriptionDari: "مرکز تجارت عمده فروشی مدرن با ۲۰۰ دکان فروشنده و تاسیسات ذخیره سرد.",
    coverImage: "/images/placeholder.png",
    completionPercent: 100,
    companyColor: "#2E7D32",
    companySlug: "almadinah",
  },
  {
    id: 9,
    slug: "kandahar-crushed-stone",
    nameEn: "Kandahar Crushed Stone Quarry",
    nameDari: "معدن سنگ خرد شده کندهار",
    locationEn: "Kandahar",
    locationDari: "کندهار",
    clientEn: "Ministry of Mines",
    clientDari: "وزارت معادن",
    duration: "2023 - 2024",
    status: "completed",
    category: "Mining",
    descriptionEn: "High-capacity stone crushing plant producing aggregate for national road construction projects.",
    descriptionDari: "کارخانه سنگ شکنی با ظرفیت بالا تولید کننده سنگدانه برای پروژه های ساخت سرک ملی.",
    coverImage: "/images/placeholder.png",
    completionPercent: 100,
    companyColor: "#1A237E",
    companySlug: "albahrain",
  },
];

const fallbackCompanies: CompanyFilterItem[] = [
  { id: "all", slug: "all", nameEn: "All Projects", nameDari: "همه پروژه‌ها", icon: "Building2", color: "#C9A227" },
  { id: "hcrc", slug: "hcrc", nameEn: "Hafez Construction", nameDari: "حافظ ساختمان", icon: "Building2", color: "#B22222" },
  { id: "albahrain", slug: "albahrain", nameEn: "Al-Bahrain Mining", nameDari: "البحرین معادن", icon: "Mountain", color: "#1A237E" },
  { id: "zainnoorain", slug: "zainnoorain", nameEn: "Zain Noorain", nameDari: "زین نورین", icon: "HardHat", color: "#F57C00" },
  { id: "almadinah", slug: "almadinah", nameEn: "Al-Madinah Trading", nameDari: "المدینه تجارت", icon: "Store", color: "#2E7D32" },
  { id: "haramain", slug: "haramain", nameEn: "Haramain Financial", nameDari: "حرمین مالی", icon: "Landmark", color: "#FFD700" },
  { id: "alkoozi", slug: "alkoozi", nameEn: "Al-Koozi Logistics", nameDari: "الکوزی لوجستیک", icon: "Truck", color: "#00838F" },
];

// ─── Component ───────────────────────────────────────────────────────

export default function ProjectsPageClient() {
  const [activeCompany, setActiveCompany] = useState<string>("all");
  const [projects, setProjects] = useState<Project[]>([]);
  const [companies, setCompanies] = useState<CompanyFilterItem[]>([]);
  const [loading, setLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | null>(null);
  const [usingFallback, setUsingFallback] = useState<boolean>(false);

  // Fetch companies for filter
  useEffect(() => {
    fetch(`${API_BASE}/companies/for-filter`)
      .then((res) => {
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        return res.json();
      })
      .then((json: { success: boolean; data?: CompanyFilterItem[] }) => {
        if (json.success && json.data && json.data.length > 0) {
          setCompanies(json.data);
        } else {
          setCompanies(fallbackCompanies);
          setUsingFallback(true);
        }
      })
      .catch((err: Error) => {
        console.warn("Companies API failed, using fallback:", err.message);
        setCompanies(fallbackCompanies);
        setUsingFallback(true);
      });
  }, []);

  // Fetch projects
  useEffect(() => {
    setLoading(true);
    setError(null);

    const url = activeCompany === "all"
      ? `${API_BASE}/projects`
      : `${API_BASE}/projects?company=${encodeURIComponent(activeCompany)}`;

    console.log("Fetching projects from:", url);

    fetch(url)
      .then((res) => {
        console.log("Response status:", res.status);
        if (!res.ok) throw new Error(`HTTP ${res.status}: ${res.statusText}`);
        return res.json();
      })
      .then((json: { success: boolean; data?: Project[]; message?: string }) => {
        console.log("Response data:", json);
        if (json.success && json.data) {
          setProjects(json.data);
          setError(null);
        } else {
          throw new Error(json.message || "Invalid response format");
        }
      })
      .catch((err: Error) => {
        console.error("Projects fetch failed:", err.message);
        const filtered = activeCompany === "all"
          ? fallbackProjects
          : fallbackProjects.filter((p) => p.companySlug === activeCompany);
        setProjects(filtered);
        setUsingFallback(true);
        setError(null);
      })
      .finally(() => {
        setLoading(false);
      });
  }, [activeCompany]);

  return (
    <main className="min-h-screen bg-[#0A1628]">
      <ProjectsHero />
      <CompanyFilter
        activeCompany={activeCompany}
        onCompanyChange={setActiveCompany}
        companies={companies}
      />
      {usingFallback && (
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
          <p className="text-amber-400/60 text-xs text-center">
            ⚠️ Using demo data — API connection unavailable
          </p>
        </div>
      )}
      <ProjectsGrid
        projects={projects}
        loading={loading}
        error={error}
      />
    </main>
  );
}