"use client";

import { useMemo } from "react";
import { useI18n } from "@/components/useI18nStore";
import ScrollReveal from "@/components/ScrollReveal";
import ProjectCard from "./ProjectCard";

interface ProjectsGridProps {
  activeCompany: string;
}

// Demo data - replace with API call
const allProjects = [
  {
    id: 1,
    slug: "kabul-kandahar-highway",
    nameEn: "Kabul-Kandahar Highway Rehabilitation",
    nameDari: "ترمیم اساس سرک کابل - کندهار",
    locationEn: "Kandahar",
    locationDari: "کندهار",
    clientEn: "Ministry of Public Works",
    clientDari: "وزارت فواید عامه",
    budget: "558,378,156 AFN",
    duration: "2023 - 2025",
    status: "completed" as const,
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
    budget: "6,198,630 AFN",
    duration: "2023",
    status: "completed" as const,
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
    budget: "5,165,990 AFN",
    duration: "2023 - 2024",
    status: "completed" as const,
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
    budget: "20,000,000 AFN",
    duration: "2024 - 2025",
    status: "ongoing" as const,
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
    budget: "45,000,000 AFN",
    duration: "2022 - 2026",
    status: "ongoing" as const,
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
    budget: "12,500,000 AFN",
    duration: "2024 - 2025",
    status: "ongoing" as const,
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
    budget: "35,000,000 AFN",
    duration: "2025 - 2026",
    status: "planned" as const,
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
    budget: "8,000,000 AFN",
    duration: "2024",
    status: "completed" as const,
    category: "Commercial",
    descriptionEn: "Modern wholesale trading center with 200 vendor stalls and cold storage facilities.",
    descriptionDari: "مرکز تجارت عمده مدرن با ۲۰۰ دکان فروشنده و تاسیسات ذخیره سرد.",
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
    budget: "18,000,000 AFN",
    duration: "2023 - 2024",
    status: "completed" as const,
    category: "Mining",
    descriptionEn: "High-capacity stone crushing plant producing aggregate for national road construction projects.",
    descriptionDari: "کارخانه سنگ شکنی با ظرفیت بالا تولید کننده سنگدانه برای پروژه های ساخت سرک ملی.",
    coverImage: "/images/placeholder.png",
    completionPercent: 100,
    companyColor: "#1A237E",
    companySlug: "albahrain",
  },
];

export default function ProjectsGrid({ activeCompany }: ProjectsGridProps) {
  const { lang } = useI18n();

  const filteredProjects = useMemo(() => {
    if (activeCompany === "all") return allProjects;
    return allProjects.filter((p) => p.companySlug === activeCompany);
  }, [activeCompany]);

  return (
    <section className="relative py-16 lg:py-24 bg-[#0A1628]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Results count */}
        <ScrollReveal>
          <div className="flex items-center justify-between mb-10">
            <p className="text-white/40 text-sm">
              {lang === "en"
                ? `Showing ${filteredProjects.length} project${filteredProjects.length !== 1 ? "s" : ""}`
                : lang === "dari"
                  ? `${filteredProjects.length} پروژه نمایش داده شده`
                  : `${filteredProjects.length} پروژه ښودل شوې`}
            </p>
            <div className="flex items-center gap-2">
              <span className="w-2 h-2 rounded-full bg-green-400" />
              <span className="text-white/30 text-xs">
                {lang === "en" ? "Completed" : lang === "dari" ? "تکمیل شده" : "بشپړه شوې"}
              </span>
              <span className="w-2 h-2 rounded-full bg-amber-400 ml-3" />
              <span className="text-white/30 text-xs">
                {lang === "en" ? "In Progress" : lang === "dari" ? "در حال اجرا" : "جریان لري"}
              </span>
              <span className="w-2 h-2 rounded-full bg-blue-400 ml-3" />
              <span className="text-white/30 text-xs">
                {lang === "en" ? "Planned" : lang === "dari" ? "برنامه‌ریزی" : "پلان شوی"}
              </span>
            </div>
          </div>
        </ScrollReveal>

        {/* Grid */}
        {filteredProjects.length > 0 ? (
          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {filteredProjects.map((project, idx) => (
              <ScrollReveal key={project.id} delay={idx * 0.08}>
                <ProjectCard project={project} />
              </ScrollReveal>
            ))}
          </div>
        ) : (
          <div className="text-center py-20">
            <div className="w-20 h-20 mx-auto rounded-full bg-white/[0.03] flex items-center justify-center mb-6">
              <span className="text-4xl">🔍</span>
            </div>
            <h3 className="text-xl font-bold text-white mb-2">
              {lang === "en"
                ? "No projects found"
                : lang === "dari"
                  ? "هیچ پروژه‌ای یافت نشد"
                  : "هیڅ پروژه ونه موندل شوه"}
            </h3>
            <p className="text-white/40 text-sm">
              {lang === "en"
                ? "Try selecting a different company filter."
                : lang === "dari"
                  ? "لطفاً یک فیلتر شرکت دیگر انتخاب کنید."
                  : "مهرباني وکړئ بل شرکت فلټر غوره کړئ."}
            </p>
          </div>
        )}
      </div>
    </section>
  );
}