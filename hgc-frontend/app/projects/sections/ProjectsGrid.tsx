"use client";

import { useI18n } from "@/components/useI18nStore";
import ScrollReveal from "@/components/ScrollReveal";
import ProjectCard from "./ProjectCard";
import { Project } from "../types";

interface ProjectsGridProps {
  projects: Project[];
  loading: boolean;
  error: string | null;
}

export default function ProjectsGrid({ projects, loading, error }: ProjectsGridProps) {
  const { lang } = useI18n();

  if (loading) {
    return (
      <section className="relative py-16 lg:py-24" style={{ backgroundColor: "#F8FAFC", minHeight: "60vh" }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {[1, 2, 3, 4, 5, 6].map((i) => (
              <div key={i} className="rounded-2xl overflow-hidden animate-pulse"
                style={{ backgroundColor: "#FFFFFF", border: "1px solid #E2E8F0" }}>
                <div className="aspect-[16/10]" style={{ backgroundColor: "#E2E8F0" }} />
                <div className="p-6 space-y-3">
                  <div className="h-4 rounded w-1/4" style={{ backgroundColor: "#E2E8F0" }} />
                  <div className="h-6 rounded w-3/4" style={{ backgroundColor: "#E2E8F0" }} />
                  <div className="h-4 rounded w-full" style={{ backgroundColor: "#E2E8F0" }} />
                  <div className="h-4 rounded w-2/3" style={{ backgroundColor: "#E2E8F0" }} />
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    );
  }

  if (error) {
    return (
      <section className="relative py-16 lg:py-24" style={{ backgroundColor: "#F8FAFC", minHeight: "60vh" }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center flex flex-col items-center justify-center" style={{ minHeight: "50vh" }}>
          <div className="w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-6"
            style={{ backgroundColor: "#FEE2E2" }}>
            <span className="text-4xl">⚠️</span>
          </div>
          <h3 className="text-xl font-bold mb-2" style={{ color: "#0F172A" }}>
            {lang === "en" ? "Error Loading Projects" : lang === "dari" ? "خطا در بارگذاری پروژه‌ها" : "د پروژو په لوډولو کې تېروتنه"}
          </h3>
          <p className="text-sm" style={{ color: "#94A3B8" }}>{error}</p>
        </div>
      </section>
    );
  }

  return (
    <section className="relative py-16 lg:py-24" style={{ backgroundColor: "#F8FAFC", minHeight: "60vh" }}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Results count */}
        <ScrollReveal>
          <div className="flex items-center justify-between mb-10">
            <p className="text-sm" style={{ color: "#94A3B8" }}>
              {lang === "en" ? `Showing ${projects.length} project${projects.length !== 1 ? "s" : ""}`
                : lang === "dari" ? `${projects.length} پروژه نمایش داده شده`
                  : `${projects.length} پروژه ښودل شوې`}
            </p>
            <div className="flex items-center gap-2">
              <span className="w-2 h-2 rounded-full" style={{ backgroundColor: "#22C55E" }} />
              <span className="text-xs" style={{ color: "#94A3B8" }}>{lang === "en" ? "Completed" : lang === "dari" ? "تکمیل شده" : "بشپړه شوې"}</span>
              <span className="w-2 h-2 rounded-full ml-3" style={{ backgroundColor: "#F59E0B" }} />
              <span className="text-xs" style={{ color: "#94A3B8" }}>{lang === "en" ? "In Progress" : lang === "dari" ? "در حال اجرا" : "جریان لري"}</span>
              <span className="w-2 h-2 rounded-full ml-3" style={{ backgroundColor: "#3B82F6" }} />
              <span className="text-xs" style={{ color: "#94A3B8" }}>{lang === "en" ? "Planned" : lang === "dari" ? "برنامه‌ریزی" : "پلان شوی"}</span>
            </div>
          </div>
        </ScrollReveal>

        {projects.length > 0 ? (
          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {projects.map((project, idx) => (
              <ScrollReveal key={project.id} delay={idx * 0.08}>
                <ProjectCard project={project} />
              </ScrollReveal>
            ))}
          </div>
        ) : (
          <div className="flex items-center justify-center" style={{ minHeight: "50vh" }}>
            <div className="text-center rounded-2xl px-12 py-16"
              style={{ backgroundColor: "#FFFFFF", border: "1px solid #E2E8F0", boxShadow: "0 4px 20px rgba(0,0,0,0.04)" }}>
              <div className="w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-6"
                style={{ backgroundColor: "#F1F5F9" }}>
                <span className="text-4xl">🔍</span>
              </div>
              <h3 className="text-xl font-bold mb-2" style={{ color: "#0F172A" }}>
                {lang === "en" ? "No projects found" : lang === "dari" ? "هیچ پروژه‌ای یافت نشد" : "هیڅ پروژه ونه موندل شوه"}
              </h3>
              <p className="text-sm" style={{ color: "#94A3B8" }}>
                {lang === "en" ? "Try selecting a different company filter."
                  : lang === "dari" ? "لطفاً یک فیلتر شرکت دیگر انتخاب کنید."
                    : "مهرباني وکړئ بل شرکت فلټر غوره کړئ."}
              </p>
            </div>
          </div>
        )}
      </div>
    </section>
  );
}