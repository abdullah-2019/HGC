"use client";

import { useEffect, useState } from "react";
import Image from "next/image";
import { ArrowLeft, MapPin, Calendar, CheckCircle2, Clock } from "lucide-react";
import Link from "next/link";
import { useI18n } from "@/components/useI18nStore";

interface ProjectHeroProps {
  project: any;
}

export default function ProjectHero({ project }: ProjectHeroProps) {
  const { lang } = useI18n();
  const [scrollY, setScrollY] = useState(0);

  useEffect(() => {
    const handleScroll = () => setScrollY(window.scrollY);
    window.addEventListener("scroll", handleScroll, { passive: true });
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  const parallaxOffset = scrollY * 0.3;

  const statusConfig = {
    completed: { bg: "bg-green-500/10", text: "text-green-600", border: "border-green-500/30", icon: CheckCircle2 },
    ongoing: { bg: "bg-amber-500/10", text: "text-amber-600", border: "border-amber-500/30", icon: Clock },
    planned: { bg: "bg-blue-500/10", text: "text-blue-600", border: "border-blue-500/30", icon: Clock },
  };

  const status = statusConfig[project.status as keyof typeof statusConfig] || statusConfig.ongoing;
  const StatusIcon = status.icon;

  return (
    <section className="relative w-full overflow-hidden" style={{ height: "75vh", minHeight: 500, maxHeight: 900 }}>
      {/* Parallax Background */}
      <div className="absolute inset-0 w-full h-[120%]" style={{ transform: `translateY(${parallaxOffset}px)` }}>
        <Image
          src={project.heroImage}
          alt={lang === "en" ? project.nameEn : project.nameDari}
          fill
          className="object-cover"
          priority
          sizes="100vw"
        />
      </div>

      {/* Overlays */}
      <div className="absolute inset-0 bg-hgc-navy/50" />
      <div className="absolute inset-0" style={{ background: "linear-gradient(to bottom, rgba(15,43,91,0.3) 0%, rgba(15,43,91,0.85) 70%, #F8FAFC 100%)" }} />

      {/* Content */}
      <div className="relative z-10 flex flex-col justify-end h-full pb-16 lg:pb-24 px-4 sm:px-6 lg:px-8">
        <div className="max-w-7xl mx-auto w-full">
          {/* Status badge */}
          <div className={`inline-flex items-center gap-2 px-4 py-2 rounded-full ${status.bg} ${status.text} border ${status.border} mb-6 backdrop-blur-sm`}>
            <StatusIcon className="w-4 h-4" />
            <span className="text-sm font-medium">
              {project.status === "completed"
                ? (lang === "en" ? "Completed" : lang === "dari" ? "تکمیل شده" : "بشپړه شوې")
                : project.status === "ongoing"
                  ? (lang === "en" ? "In Progress" : lang === "dari" ? "در حال اجرا" : "جریان لري")
                  : (lang === "en" ? "Planned" : lang === "dari" ? "برنامه‌ریزی شده" : "پلان شوی")}
            </span>
            {project.completionDate && (
              <span className="text-white/50 text-xs ml-1">
                • {project.completionDate}
              </span>
            )}
          </div>

          {/* Title */}
          <h1 className="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-white mb-4 leading-tight max-w-4xl">
            {lang === "en" ? project.nameEn : project.nameDari}
          </h1>

          {/* Tagline */}
          {project.taglineEn && (
            <p className="text-xl text-hgc-gold mb-8 max-w-2xl">
              {lang === "en" ? project.taglineEn : project.taglineDari}
            </p>
          )}

          {/* Meta row */}
          <div className="flex flex-wrap items-center gap-6 text-white/60 text-sm">
            <span className="flex items-center gap-2">
              <MapPin className="w-4 h-4 text-hgc-gold" />
              {lang === "en" ? project.location : project.locationDari}
            </span>
            <span className="flex items-center gap-2">
              <Calendar className="w-4 h-4 text-hgc-gold" />
              {lang === "en" ? project.duration : project.durationDari}
            </span>
            <span className="flex items-center gap-2">
              <span className="w-2 h-2 rounded-full" style={{ backgroundColor: project.companyColor }} />
              {lang === "en" ? project.contractor : project.contractorDari}
            </span>
          </div>
        </div>
      </div>
    </section>
  );
}