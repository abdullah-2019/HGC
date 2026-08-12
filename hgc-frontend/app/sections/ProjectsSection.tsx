"use client";

import { useState, useEffect, useMemo } from "react";
import Link from "next/link";
import Image from "next/image";
import { ArrowRight, MapPin, Calendar } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

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
  status: string;
  category: string;
  descriptionEn: string;
  descriptionDari: string;
  coverImage: string;
  completionPercent: number;
  companyColor: string;
  companySlug: string;
}

interface CategoryFilter {
  key: string;
  labelEn: string;
  labelDari: string;
  labelPashto: string;
}

const API_BASE = process.env.NEXT_PUBLIC_API_URL || "https://api.hgc.af";

const CATEGORY_TRANSLATIONS: Record<string, { dari: string; pashto: string }> = {
  "Roads": { dari: "سرک ها", pashto: "سړکونه" },
  "Buildings": { dari: "ساختمان ها", pashto: "ودانۍ" },
  "Mining": { dari: "معادن", pashto: "کانونه" },
  "Electrical": { dari: "برق", pashto: "برق" },
  "Solar": { dari: "سولری", pashto: "سولري" },
  "Infrastructure": { dari: "زیرساخت", pashto: "بنسټیزه جوړښت" },
  "General": { dari: "عمومی", pashto: "عمومي" },
};

export default function ProjectsSection() {
  const { lang } = useI18n();
  const isRtl = lang === "dari" || lang === "pashto";
  const [projects, setProjects] = useState<Project[]>([]);
  const [categories, setCategories] = useState<CategoryFilter[]>([]);
  const [activeCategory, setActiveCategory] = useState<string>("all");
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchProjects = async () => {
      try {
        setLoading(true);
        const res = await fetch(`${API_BASE}/api/projects?featured=1`, {
          headers: { Accept: "application/json" },
        });
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const json = await res.json();
        if (json.success) {
          setProjects(json.data);
        } else {
          throw new Error(json.message || "Failed to load projects");
        }
      } catch (err) {
        setError(err instanceof Error ? err.message : "Unknown error");
      } finally {
        setLoading(false);
      }
    };

    fetchProjects();
  }, []);

  useEffect(() => {
    if (projects.length === 0) return;
    const uniqueCategories = Array.from(
      new Set(projects.map((p) => p.category).filter(Boolean))
    );
    const builtCategories: CategoryFilter[] = uniqueCategories.map((cat) => {
      const translations = CATEGORY_TRANSLATIONS[cat] || { dari: cat, pashto: cat };
      return {
        key: cat,
        labelEn: cat,
        labelDari: translations.dari,
        labelPashto: translations.pashto,
      };
    });
    builtCategories.sort((a, b) => a.labelEn.localeCompare(b.labelEn));
    setCategories(builtCategories);
  }, [projects]);

  const filteredProjects = useMemo(() => {
    if (activeCategory === "all") return projects;
    return projects.filter((p) => p.category === activeCategory);
  }, [projects, activeCategory]);

  const getLabel = (filter: CategoryFilter) => {
    if (lang === "dari") return filter.labelDari;
    if (lang === "pashto") return filter.labelPashto;
    return filter.labelEn;
  };

  const getProjectName = (p: Project) => {
    if (lang === "dari") return p.nameDari || p.nameEn;
    if (lang === "pashto") return p.nameEn;
    return p.nameEn;
  };

  const getLocation = (p: Project) => {
    if (lang === "dari") return p.locationDari || p.locationEn;
    if (lang === "pashto") return p.locationEn;
    return p.locationEn;
  };

  const getClient = (p: Project) => {
    if (lang === "dari") return p.clientDari || p.clientEn;
    if (lang === "pashto") return p.clientEn;
    return p.clientEn;
  };

  const getStatusLabel = (status: string) => {
    const isCompleted = status === "completed";
    if (lang === "en") return isCompleted ? "Completed" : "Ongoing";
    if (lang === "dari") return isCompleted ? "تکمیل شده" : "در حال اجرا";
    return isCompleted ? "بشپړه شوې" : "جریان لري";
  };

  const sectionTitle =
    lang === "en"
      ? { pre: "Featured ", highlight: "Projects" }
      : lang === "dari"
        ? { pre: "پروژه های ", highlight: "برجسته" }
        : { pre: "ټاکل شوې ", highlight: "پروژې" };

  const portfolioLabel =
    lang === "en" ? "Portfolio" : lang === "dari" ? "نمونه کارها" : "پورټفولیو";

  const viewAllLabel =
    lang === "en" ? "View All" : lang === "dari" ? "مشاهده همه" : "ټول وګورئ";

  const allLabel =
    lang === "en" ? "All" : lang === "dari" ? "همه" : "ټول";

  if (loading) {
    return (
      <section className="py-24 bg-hgc-bg relative">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="animate-pulse">
            <div className="h-4 w-24 bg-hgc-border rounded-full mb-4" />
            <div className="h-12 w-64 bg-hgc-border rounded-lg mb-12" />
            <div className="flex gap-2 mb-10">
              {[1, 2, 3, 4].map((i) => (
                <div key={i} className="h-9 w-20 bg-hgc-border rounded-lg" />
              ))}
            </div>
            <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
              {[1, 2, 3, 4].map((i) => (
                <div key={i} className="bg-hgc-card-alt border border-hgc-border rounded-2xl overflow-hidden">
                  <div className="aspect-[4/3] bg-hgc-border" />
                  <div className="p-5 space-y-3">
                    <div className="h-3 w-20 bg-hgc-border rounded" />
                    <div className="h-5 w-full bg-hgc-border rounded" />
                    <div className="h-3 w-32 bg-hgc-border rounded" />
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>
    );
  }

  if (error) {
    return (
      <section className="py-24 bg-hgc-bg relative">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <p className="text-red-400 mb-2">Failed to load projects</p>
          <p className="text-hgc-text-muted text-sm">{error}</p>
        </div>
      </section>
    );
  }

  return (
    <section dir={isRtl ? "rtl" : "ltr"} className="py-24 bg-hgc-bg relative">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Header */}
        <div className="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-12">
          <div>
            <span className="inline-block px-4 py-1 rounded-full bg-hgc-gold/10 text-hgc-gold text-sm font-medium mb-4">
              {portfolioLabel}
            </span>
            <h2 className="text-4xl lg:text-5xl font-bold text-hgc-text">
              {sectionTitle.pre}
              <span className="text-hgc-gold">{sectionTitle.highlight}</span>
            </h2>
          </div>
          <Link
            href="/projects"
            className="group mt-4 lg:mt-0 inline-flex items-center gap-2 text-hgc-gold font-semibold hover:gap-3 transition-all"
          >
            {viewAllLabel}
            <ArrowRight className={`w-5 h-5 transition-transform ${isRtl ? "rotate-180 group-hover:-translate-x-1" : "group-hover:translate-x-1"}`} />
          </Link>
        </div>

        {/* Category Filters */}
        {categories.length > 0 && (
          <div className="flex flex-wrap gap-2 mb-10">
            <button
              onClick={() => setActiveCategory("all")}
              className={`px-5 py-2 rounded-lg text-sm font-medium transition-all ${activeCategory === "all"
                ? "bg-hgc-gold text-hgc-text"
                : "bg-hgc-card-alt text-hgc-text-secondary hover:bg-hgc-border hover:text-hgc-text"
                }`}
            >
              {allLabel}
            </button>
            {categories.map((filter) => (
              <button
                key={filter.key}
                onClick={() => setActiveCategory(filter.key)}
                className={`px-5 py-2 rounded-lg text-sm font-medium transition-all ${activeCategory === filter.key
                  ? "bg-hgc-gold text-hgc-text"
                  : "bg-hgc-card-alt text-hgc-text-secondary hover:bg-hgc-border hover:text-hgc-text"
                  }`}
              >
                {getLabel(filter)}
              </button>
            ))}
          </div>
        )}

        {/* Projects Grid */}
        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          {filteredProjects.map((project) => (
            <Link
              key={project.id}
              href={`/projects/${project.slug}`}
              className="group relative bg-hgc-card-alt border border-hgc-border rounded-2xl overflow-hidden hover:border-hgc-gold/20 transition-all duration-500"
            >
              <div className="aspect-[4/3] relative overflow-hidden">
                <Image
                  src={project.coverImage}
                  alt={getProjectName(project)}
                  fill
                  className="object-cover group-hover:scale-105 transition-transform duration-700"
                  sizes="(max-width: 768px) 100vw, (max-width: 1200px) 50vw, 25vw"
                />
                <div className="absolute inset-0 bg-hgc-overlay/10 group-hover:bg-hgc-overlay/5 transition-colors" />

                <div className={`absolute top-4 ${isRtl ? "right-4" : "left-4"}`}>
                  <span
                    className={`px-3 py-1 rounded-full text-xs font-medium border ${project.status === "completed"
                      ? "bg-green-500/20 text-green-600 border-green-500/20"
                      : "bg-amber-500/20 text-amber-600 border-amber-500/20"
                      }`}
                  >
                    {getStatusLabel(project.status)}
                  </span>
                </div>

                {project.completionPercent > 0 && project.completionPercent < 100 && (
                  <div className={`absolute bottom-4 ${isRtl ? "left-4" : "right-4"}`}>
                    <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-hgc-text/70 text-hgc-surface backdrop-blur-sm border border-hgc-border">
                      {project.completionPercent}%
                    </span>
                  </div>
                )}
              </div>

              <div className="p-5">
                <div className="flex items-center gap-2 text-hgc-text-muted text-xs mb-2">
                  <MapPin className="w-3.5 h-3.5 shrink-0" />
                  {getLocation(project)}
                </div>
                <h3 className="text-hgc-text font-bold text-lg mb-2 group-hover:text-hgc-gold transition-colors line-clamp-2">
                  {getProjectName(project)}
                </h3>
                <div className="flex items-center gap-4 text-xs text-hgc-text-muted mb-3">
                  <span className="flex items-center gap-1">
                    <Calendar className="w-3.5 h-3.5 shrink-0" />
                    {project.duration}
                  </span>
                </div>
                <p className="text-hgc-text-muted text-xs line-clamp-2">
                  {getClient(project)}
                </p>
              </div>
            </Link>
          ))}
        </div>

        {filteredProjects.length === 0 && (
          <div className="text-center py-16">
            <p className="text-hgc-text-muted">
              {lang === "en"
                ? "No projects found in this category."
                : lang === "dari"
                  ? "هیچ پروژه ای در این دسته بندی یافت نشد."
                  : "په دې کټګورۍ کې هیڅ پروژه ونه موندل شوه."}
            </p>
          </div>
        )}
      </div>
    </section>
  );
}