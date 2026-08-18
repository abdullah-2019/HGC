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
  const isRTL = lang !== "en";

  useEffect(() => {
    const handleScroll = () => setScrollY(window.scrollY);
    window.addEventListener("scroll", handleScroll, { passive: true });
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  const parallaxOffset = scrollY * 0.3;

  const statusConfig = {
    completed: { bg: "bg-emerald-950/60", text: "text-emerald-400", border: "border-emerald-500/30", icon: CheckCircle2 },
    ongoing: { bg: "bg-amber-950/60", text: "text-amber-400", border: "border-amber-500/30", icon: Clock },
    planned: { bg: "bg-blue-950/60", text: "text-blue-400", border: "border-blue-500/30", icon: Clock },
  };

  const status = statusConfig[project.status as keyof typeof statusConfig] || statusConfig.ongoing;
  const StatusIcon = status.icon;

  return (
    <section 
      className="relative w-full overflow-hidden bg-[#F8FAFC]" 
      style={{ height: "75vh", minHeight: 500, maxHeight: 900 }}
      dir={isRTL ? "rtl" : "ltr"}
    >
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

      {/* Edge vignette overlay (No bottom fade inside here) */}
      <div 
        className="absolute inset-0 pointer-events-none" 
        style={{ 
          background: "radial-gradient(circle, rgba(15,43,91,0) 40%, rgba(15,43,91,0.4) 100%)" 
        }} 
      />

      {/* CLEAN TRANSITION MASK: Blends the entire section smoothly into the page without a cloudy gray middle step */}
      <div 
        className="absolute inset-0 pointer-events-none z-[1]" 
        style={{ 
          background: "linear-gradient(to bottom, rgba(248, 250, 252, 0) 70%, rgba(248, 250, 252, 1) 100%)" 
        }} 
      />

      {/* Content */}
      <div className="relative z-10 flex flex-col justify-end h-full pb-16 lg:pb-24 px-4 sm:px-6 lg:px-8">
        <div className="max-w-7xl mx-auto w-full">
          
          {/* Status badge */}
          <div className={`inline-flex items-center gap-2 px-4 py-2 rounded-full ${status.bg} ${status.text} border ${status.border} mb-6 backdrop-blur-[4px]`}>
            <StatusIcon className="w-4 h-4" />
            <span className="text-sm font-medium text-start">
              {project.status === "completed"
                ? (lang === "en" ? "Completed" : lang === "dari" ? "تکمیل شده" : "بشپړه شوې")
                : project.status === "ongoing"
                  ? (lang === "en" ? "In Progress" : lang === "dari" ? "در حال اجرا" : "جریان لري")
                  : (lang === "en" ? "Planned" : lang === "dari" ? "برنامه‌ریزی شده" : "پلان شوی")}
            </span>
            {project.completionDate && (
              <span className="text-white/70 text-xs ms-1">
                • {project.completionDate}
              </span>
            )}
          </div>

          {/* Title */}
          <h1 className="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-white mb-4 leading-tight max-w-4xl text-start drop-shadow-[0_4px_12px_rgba(0,0,0,0.8)]">
            {lang === "en" ? project.nameEn : project.nameDari}
          </h1>

          {/* Tagline */}
          {project.taglineEn && (
            <p className="text-xl text-hgc-gold-bright font-medium mb-8 max-w-2xl text-start drop-shadow-[0_2px_6px_rgba(0,0,0,0.9)]">
              {lang === "en" ? project.taglineEn : project.taglineDari}
            </p>
          )}

          {/* Meta row container */}
          <div className="inline-flex flex-wrap items-center gap-x-6 gap-y-3 px-6 py-3 rounded-xl bg-slate-900/60 backdrop-blur-[6px] border border-white/10 text-white text-sm shadow-md">
            <span className="flex items-center gap-2">
              <MapPin className="w-4 h-4 text-hgc-gold-bright filter drop-shadow-[0_1px_2px_rgba(0,0,0,0.4)]" />
              <span className="text-start font-medium">{lang === "en" ? project.location : project.locationDari}</span>
            </span>
            <span className="flex items-center gap-2">
              <Calendar className="w-4 h-4 text-hgc-gold-bright filter drop-shadow-[0_1px_2px_rgba(0,0,0,0.4)]" />
              <span className="text-start font-medium">{lang === "en" ? project.duration : project.durationDari}</span>
            </span>
            <span className="flex items-center gap-2">
              <span className="w-2.5 h-2.5 rounded-full border border-white/20 shadow-inner" style={{ backgroundColor: project.companyColor || "#D4AF37" }} />
              <span className="text-start font-medium">{lang === "en" ? project.contractor : project.contractorDari}</span>
            </span>
          </div>
        </div>
      </div>
    </section>
  );
}