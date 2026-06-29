"use client";

import Link from "next/link";
import Image from "next/image";
import { ArrowRight } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import ScrollReveal from "@/components/ScrollReveal";

const allProjects = [
  { slug: "kabul-kandahar-highway", nameEn: "Kabul-Kandahar Highway", nameDari: "اساس سرک کابل - کندهار", image: "/images/projects/highway-kabul-kandahar.jpg", category: "Roads", color: "#B22222" },
  { slug: "badakhshan-police-hq", nameEn: "Badakhshan Police HQ", nameDari: "قومندانی امنیه بدخشان", image: "/images/projects/badakhshan-police-hq.jpg", category: "Buildings", color: "#B22222" },
  { slug: "nangarhar-solar-150kw", nameEn: "Nangarhar Solar System", nameDari: "سیستم سولری ننگرهار", image: "/images/projects/nangarhar-solar.jpg", category: "Solar", color: "#F57C00" },
  { slug: "kharwar-district-building", nameEn: "Kharwar District Building", nameDari: "ساختمان ولسوالی خروار", image: "/images/projects/kharwar-building.jpg", category: "Buildings", color: "#B22222" },
  { slug: "lead-zinc-extraction-badakhshan", nameEn: "Lead & Zinc Mining", nameDari: "استخراج سرب و روی", image: "/images/projects/mining-badakhshan.jpg", category: "Mining", color: "#1A237E" },
  { slug: "kabul-logistics-hub", nameEn: "Kabul Logistics Hub", nameDari: "مرکز لوجستیک کابل", image: "/images/projects/kabul-logistics.jpg", category: "Logistics", color: "#00838F" },
  { slug: "herat-solar-microgrid", nameEn: "Herat Solar Microgrid", nameDari: "میکروگرید سولری هرات", image: "/images/projects/herat-solar.jpg", category: "Solar", color: "#F57C00" },
  { slug: "mazar-sharif-trading-center", nameEn: "Mazar Trading Center", nameDari: "مرکز تجارت مزار", image: "/images/projects/mazar-trading.jpg", category: "Commercial", color: "#2E7D32" },
  { slug: "kandahar-crushed-stone", nameEn: "Kandahar Stone Quarry", nameDari: "معدن سنگ کندهار", image: "/images/projects/kandahar-quarry.jpg", category: "Mining", color: "#1A237E" },
];

interface RelatedProjectsProps {
  currentSlug: string;
}

export default function RelatedProjects({ currentSlug }: RelatedProjectsProps) {
  const { lang } = useI18n();
  const related = allProjects.filter((p) => p.slug !== currentSlug).slice(0, 3);

  return (
    <section className="relative py-20 lg:py-28 bg-[#0A1628]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <ScrollReveal className="flex items-center justify-between mb-12">
          <div>
            <span className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-4">
              {lang === "en" ? "Related" : lang === "dari" ? "مرتبط" : "اړوند"}
            </span>
            <h2 className="text-3xl lg:text-4xl font-bold text-white">
              {lang === "en" ? "Other Projects" : lang === "dari" ? "پروژه‌های دیگر" : "نورې پروژې"}
            </h2>
          </div>
          <Link href="/projects" className="hidden sm:inline-flex items-center gap-2 text-[#C9A227] hover:gap-3 transition-all">
            {lang === "en" ? "View All" : lang === "dari" ? "مشاهده همه" : "ټول وګورئ"}
            <ArrowRight className="w-5 h-5" />
          </Link>
        </ScrollReveal>

        <div className="grid md:grid-cols-3 gap-6">
          {related.map((project, idx) => (
            <ScrollReveal key={project.slug} delay={idx * 0.1}>
              <Link href={`/projects/${project.slug}`} className="group block">
                <div className="relative aspect-[16/10] rounded-xl overflow-hidden mb-4">
                  <Image
                    src={project.image}
                    alt={lang === "en" ? project.nameEn : project.nameDari}
                    fill
                    className="object-cover transition-transform duration-500 group-hover:scale-105"
                    sizes="(max-width: 768px) 100vw, 33vw"
                  />
                  <div className="absolute inset-0 bg-[#0A1628]/30 group-hover:bg-[#0A1628]/10 transition-colors" />
                  <div className="absolute top-3 left-3">
                    <span className="px-2.5 py-1 rounded-md text-xs font-medium text-white/80" style={{ backgroundColor: `${project.color}30` }}>
                      {project.category}
                    </span>
                  </div>
                </div>
                <h3 className="text-white font-semibold group-hover:text-[#C9A227] transition-colors">
                  {lang === "en" ? project.nameEn : project.nameDari}
                </h3>
              </Link>
            </ScrollReveal>
          ))}
        </div>
      </div>
    </section>
  );
}