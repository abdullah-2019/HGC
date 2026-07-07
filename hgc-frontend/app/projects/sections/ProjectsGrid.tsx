"use client";

import { useI18n } from "@/components/useI18nStore";
import ScrollReveal from "@/components/ScrollReveal";
import ProjectCard from "./ProjectCard";

interface ProjectsGridProps {
  projects: any[];
  loading: boolean;
  error: string | null;
}

export default function ProjectsGrid({ projects, loading, error }: ProjectsGridProps) {
  const { lang } = useI18n();

  if (loading) {
    return (
      <section className="relative py-16 lg:py-24 bg-[#0A1628]">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {[1, 2, 3, 4, 5, 6].map((i) => (
              <div key={i} className="bg-white/[0.02] border border-white/5 rounded-2xl overflow-hidden animate-pulse">
                <div className="aspect-[16/10] bg-white/5" />
                <div className="p-6 space-y-3">
                  <div className="h-4 bg-white/5 rounded w-1/4" />
                  <div className="h-6 bg-white/5 rounded w-3/4" />
                  <div className="h-4 bg-white/5 rounded w-full" />
                  <div className="h-4 bg-white/5 rounded w-2/3" />
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
      <section className="relative py-16 lg:py-24 bg-[#0A1628]">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <div className="w-20 h-20 mx-auto rounded-full bg-red-500/10 flex items-center justify-center mb-6">
            <span className="text-4xl">⚠️</span>
          </div>
          <h3 className="text-xl font-bold text-white mb-2">
            {lang === "en" ? "Error Loading Projects" : lang === "dari" ? "خطا در بارگذاری پروژه‌ها" : "د پروژو په لوډولو کې تېروتنه"}
          </h3>
          <p className="text-white/40 text-sm">{error}</p>
        </div>
      </section>
    );
  }

  return (
    <section className="relative py-16 lg:py-24 bg-[#0A1628]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Results count */}
        <ScrollReveal>
          <div className="flex items-center justify-between mb-10">
            <p className="text-white/40 text-sm">
              {lang === "en"
                ? `Showing ${projects.length} project${projects.length !== 1 ? "s" : ""}`
                : lang === "dari"
                  ? `${projects.length} پروژه نمایش داده شده`
                  : `${projects.length} پروژه ښودل شوې`}
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
        {projects.length > 0 ? (
          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {projects.map((project, idx) => (
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