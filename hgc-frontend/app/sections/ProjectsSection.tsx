"use client";

import { useState } from "react";
import Link from "next/link";
import { ArrowRight, MapPin, DollarSign, Calendar, Building2 } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

const featuredProjects = [
  {
    id: 1,
    title: "Kabul-Kandahar Highway Rehabilitation",
    titleDari: "ترمیم اساس سرک کابل - کندهار",
    location: "Kandahar",
    locationDari: "کندهار",
    client: "Ministry of Public Works",
    clientDari: "وزارت فواید عامه",
    duration: "2023 - 2025",
    status: "completed",
    category: "roads",
    description: "37km highway rehabilitation from Shah Safa to Manji on the Kabul-Kandahar National Highway.",
  },
  {
    id: 2,
    title: "Badakhshan Police HQ & Hospital",
    titleDari: "قومندانی امنیه و شفاخانه پولیس بدخشان",
    location: "Badakhshan",
    locationDari: "بدخشان",
    client: "Ministry of Interior",
    clientDari: "وزارت داخله",
    duration: "2023",
    status: "completed",
    category: "buildings",
    description: "Construction of special police headquarters and 20-bed hospital in Badakhshan province.",
  },
  {
    id: 3,
    title: "Nangarhar Solar Power System",
    titleDari: "سیستم برق سولری ننگرهار",
    location: "Nangarhar",
    locationDari: "ننگرهار",
    client: "Ministry of Finance",
    clientDari: "وزارت مالیه",
    duration: "2023 - 2024",
    status: "completed",
    category: "solar",
    description: "Supply and installation of 150kW DC solar power system for Nangarhar Customs.",
  },
  {
    id: 4,
    title: "Kharwar District Administrative Building",
    titleDari: "ساختمان اداری ولسوالی خروار",
    location: "Logar",
    locationDari: "لوگر",
    client: "Ministry of Interior",
    clientDari: "وزارت داخله",
    duration: "2024 - 2025",
    status: "ongoing",
    category: "buildings",
    description: "Construction of administrative building for Kharwar district in Logar province.",
  },
];

const projectFilters = [
  { key: "all", label: "All", labelDari: "همه" },
  { key: "roads", label: "Roads", labelDari: "سرک ها" },
  { key: "buildings", label: "Buildings", labelDari: "ساختمان ها" },
  { key: "mining", label: "Mining", labelDari: "معادن" },
  { key: "electrical", label: "Electrical", labelDari: "برق" },
  { key: "solar", label: "Solar", labelDari: "سولری" },
];

export default function ProjectsSection() {
  const { lang } = useI18n();
  const [activeProjectFilter, setActiveProjectFilter] = useState("all");

  const filteredProjects =
    activeProjectFilter === "all"
      ? featuredProjects
      : featuredProjects.filter((p) => p.category === activeProjectFilter);

  return (
    <section className="py-24 bg-[#0A1628] relative">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-12">
          <div>
            <span className="inline-block px-4 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-4">
              {lang === "en" ? "Portfolio" : lang === "dari" ? "نمونه کارها" : "پورټفولیو"}
            </span>
            <h2 className="text-4xl lg:text-5xl font-bold text-white">
              {lang === "en" ? (
                <>
                  Featured <span className="text-[#C9A227]">Projects</span>
                </>
              ) : lang === "dari" ? (
                <>
                  پروژه های <span className="text-[#C9A227]">برجسته</span>
                </>
              ) : (
                <>
                  ټاکل شوې <span className="text-[#C9A227]">پروژې</span>
                </>
              )}
            </h2>
          </div>
          <Link
            href="/projects"
            className="mt-4 lg:mt-0 inline-flex items-center gap-2 text-[#C9A227] font-semibold hover:gap-3 transition-all"
          >
            {lang === "en" ? "View All" : lang === "dari" ? "مشاهده همه" : "ټول وګورئ"}
            <ArrowRight className="w-5 h-5" />
          </Link>
        </div>

        <div className="flex flex-wrap gap-2 mb-10">
          {projectFilters.map((filter) => (
            <button
              key={filter.key}
              onClick={() => setActiveProjectFilter(filter.key)}
              className={`px-5 py-2 rounded-lg text-sm font-medium transition-all ${
                activeProjectFilter === filter.key
                  ? "bg-[#C9A227] text-[#0A1628]"
                  : "bg-white/5 text-white/60 hover:bg-white/10 hover:text-white"
              }`}
            >
              {lang === "en" ? filter.label : filter.labelDari}
            </button>
          ))}
        </div>

        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          {filteredProjects.map((project) => (
            <Link
              key={project.id}
              href={`/projects/${project.id}`}
              className="group relative bg-white/[0.02] border border-white/5 rounded-2xl overflow-hidden hover:border-[#C9A227]/20 transition-all duration-500"
            >
              <div className="aspect-[4/3] relative overflow-hidden">
                <div className="absolute inset-0 bg-[#C9A227]/5 flex items-center justify-center">
                  <Building2 className="w-12 h-12 text-[#C9A227]/20" />
                </div>
                <div className="absolute inset-0 bg-[#0A1628]/40 group-hover:bg-[#0A1628]/20 transition-colors" />
                <div className="absolute top-4 left-4">
                  <span
                    className={`px-3 py-1 rounded-full text-xs font-medium ${
                      project.status === "completed"
                        ? "bg-green-500/20 text-green-400 border border-green-500/20"
                        : "bg-amber-500/20 text-amber-400 border border-amber-500/20"
                    }`}
                  >
                    {project.status === "completed"
                      ? lang === "en"
                        ? "Completed"
                        : lang === "dari"
                          ? "تکمیل شده"
                          : "بشپړه شوې"
                      : lang === "en"
                        ? "Ongoing"
                        : lang === "dari"
                          ? "در حال اجرا"
                          : "جریان لري"}
                  </span>
                </div>
              </div>
              <div className="p-5">
                <div className="flex items-center gap-2 text-white/40 text-xs mb-2">
                  <MapPin className="w-3.5 h-3.5" />
                  {lang === "en" ? project.location : project.locationDari}
                </div>
                <h3 className="text-white font-bold text-lg mb-2 group-hover:text-[#C9A227] transition-colors line-clamp-2">
                  {lang === "en" ? project.title : project.titleDari}
                </h3>
                <div className="flex items-center gap-4 text-xs text-white/40 mb-3">
                  <span className="flex items-center gap-1">
                    <Calendar className="w-3.5 h-3.5" />
                    {project.duration}
                  </span>
                </div>
                <p className="text-white/30 text-xs line-clamp-2">
                  {lang === "en" ? project.client : project.clientDari}
                </p>
              </div>
            </Link>
          ))}
        </div>
      </div>
    </section>
  );
}