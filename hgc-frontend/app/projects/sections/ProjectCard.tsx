"use client";

import Image from "next/image";
import { useState } from "react";
import Link from "next/link";
import { MapPin, Calendar, ArrowUpRight, CheckCircle2 } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

interface ProjectCardProps {
  project: {
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
  };
}

export default function ProjectCard({ project }: ProjectCardProps) {
  const { lang } = useI18n();
  const [isHovered, setIsHovered] = useState(false);

  const statusConfig = {
    completed: {
      bg: "bg-green-500/15",
      text: "text-green-400",
      border: "border-green-500/20",
      labelEn: "Completed",
      labelDari: "تکمیل شده",
    },
    ongoing: {
      bg: "bg-amber-500/15",
      text: "text-amber-400",
      border: "border-amber-500/20",
      labelEn: "In Progress",
      labelDari: "در حال اجرا",
    },
    planned: {
      bg: "bg-blue-500/15",
      text: "text-blue-400",
      border: "border-blue-500/20",
      labelEn: "Planned",
      labelDari: "برنامه‌ریزی شده",
    },
  };

  const status = statusConfig[project.status];

  return (
    <Link
      href={`/projects/${project.slug}`}
      onMouseEnter={() => setIsHovered(true)}
      onMouseLeave={() => setIsHovered(false)}
      className="group relative block"
    >
      <div className="relative bg-white/[0.02] border border-white/5 rounded-2xl overflow-hidden hover:border-[#C9A227]/20 transition-all duration-500 h-full">
        {/* Image Container */}
        <div className="relative aspect-[16/10] overflow-hidden">
          <Image
            src={project.coverImage}
            alt={lang === "en" ? project.nameEn : project.nameDari}
            fill
            className="object-cover transition-transform duration-700 ease-out group-hover:scale-110"
            sizes="(max-width: 768px) 100vw, (max-width: 1200px) 50vw, 33vw"
          />

          {/* Gradient overlay */}
          <div className="absolute inset-0 bg-[#0A1628]/40 group-hover:bg-[#0A1628]/20 transition-colors duration-500" />

          {/* Company color accent bar */}
          <div
            className="absolute top-0 left-0 right-0 h-1 transition-all duration-500"
            style={{
              backgroundColor: project.companyColor,
              opacity: isHovered ? 1 : 0.6,
            }}
          />

          {/* Status badge */}
          <div className="absolute top-4 left-4">
            <span className={`inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium border ${status.bg} ${status.text} ${status.border}`}>
              <CheckCircle2 className="w-3 h-3" />
              {lang === "en" ? status.labelEn : status.labelDari}
            </span>
          </div>

          {/* Completion bar for ongoing projects */}
          {project.status === "ongoing" && (
            <div className="absolute bottom-0 left-0 right-0 h-1 bg-white/10">
              <div
                className="h-full transition-all duration-1000 ease-out"
                style={{
                  width: `${project.completionPercent}%`,
                  backgroundColor: project.companyColor,
                }}
              />
            </div>
          )}

          {/* Hover arrow */}
          <div
            className="absolute top-4 right-4 w-10 h-10 rounded-full bg-[#0A1628]/80 border border-white/10 flex items-center justify-center transition-all duration-300"
            style={{
              opacity: isHovered ? 1 : 0,
              transform: isHovered ? "translateY(0)" : "translateY(-10px)",
            }}
          >
            <ArrowUpRight className="w-4 h-4 text-[#C9A227]" />
          </div>
        </div>

        {/* Content */}
        <div className="p-6">
          {/* Category tag */}
          <span
            className="inline-block px-2.5 py-1 rounded-md text-xs font-medium mb-3"
            style={{
              backgroundColor: `${project.companyColor}15`,
              color: project.companyColor,
            }}
          >
            {project.category}
          </span>

          {/* Title */}
          <h3 className="text-lg font-bold text-white mb-2 group-hover:text-[#C9A227] transition-colors duration-300 line-clamp-2">
            {lang === "en" ? project.nameEn : project.nameDari}
          </h3>

          {/* Description */}
          <p className="text-white/40 text-sm leading-relaxed mb-4 line-clamp-2">
            {lang === "en" ? project.descriptionEn : project.descriptionDari}
          </p>

          {/* Meta info */}
          <div className="flex flex-wrap items-center gap-4 text-xs text-white/30">
            <span className="flex items-center gap-1.5">
              <MapPin className="w-3.5 h-3.5" />
              {lang === "en" ? project.locationEn : project.locationDari}
            </span>
            <span className="flex items-center gap-1.5">
              <Calendar className="w-3.5 h-3.5" />
              {project.duration}
            </span>
          </div>

          {/* Client */}
          <div className="mt-4 pt-4 border-t border-white/5">
            <p className="text-white/30 text-xs">
              <span className="text-white/50">
                {lang === "en" ? "Client: " : lang === "dari" ? "کارفرما: " : "پیرودونکی: "}
              </span>
              {lang === "en" ? project.clientEn : project.clientDari}
            </p>
          </div>
        </div>
      </div>
    </Link>
  );
}