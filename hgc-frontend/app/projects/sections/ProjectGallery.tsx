"use client";

import { useState } from "react";
import Image from "next/image";
import { X, ChevronLeft, ChevronRight, ZoomIn } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import ScrollReveal from "@/components/ScrollReveal";

interface ProjectGalleryProps {
  project: any;
}

export default function ProjectGallery({ project }: ProjectGalleryProps) {
  const { lang } = useI18n();
  const [lightbox, setLightbox] = useState<number | null>(null);

  if (!project.gallery || project.gallery.length === 0) return null;

  const openLightbox = (idx: number) => setLightbox(idx);
  const closeLightbox = () => setLightbox(null);
  const goNext = () => setLightbox((prev) => (prev !== null ? (prev + 1) % project.gallery.length : null));
  const goPrev = () => setLightbox((prev) => (prev !== null ? (prev - 1 + project.gallery.length) % project.gallery.length : null));

  return (
    <section className="relative py-20 lg:py-28 bg-[#0A1628]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <ScrollReveal className="text-center mb-16">
          <span className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-6">
            <ZoomIn className="w-4 h-4" />
            {lang === "en" ? "Gallery" : lang === "dari" ? "گالری" : "ګالري"}
          </span>
          <h2 className="text-3xl lg:text-4xl font-bold text-white">
            {lang === "en" ? "Project Gallery" : lang === "dari" ? "گالری پروژه" : "د پروژې ګالري"}
          </h2>
        </ScrollReveal>

        {/* Grid */}
        <div className="grid grid-cols-2 lg:grid-cols-3 gap-4">
          {project.gallery.map((img: any, idx: number) => (
            <ScrollReveal key={idx} delay={idx * 0.08}>
              <button
                onClick={() => openLightbox(idx)}
                className="group relative aspect-[4/3] rounded-xl overflow-hidden bg-white/5"
              >
                <Image
                  src={img.src}
                  alt={lang === "en" ? img.captionEn : img.captionDari}
                  fill
                  className="object-cover transition-transform duration-500 group-hover:scale-110"
                  sizes="(max-width: 768px) 50vw, 33vw"
                />
                <div className="absolute inset-0 bg-[#0A1628]/0 group-hover:bg-[#0A1628]/40 transition-colors duration-300" />
                <div className="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                  <ZoomIn className="w-8 h-8 text-white" />
                </div>
                <div className="absolute bottom-0 left-0 right-0 p-4 bg-[#0A1628]/80 backdrop-blur-sm translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                  <p className="text-white/80 text-xs text-left">
                    {lang === "en" ? img.captionEn : img.captionDari}
                  </p>
                </div>
              </button>
            </ScrollReveal>
          ))}
        </div>
      </div>

      {/* Lightbox */}
      {lightbox !== null && (
        <div className="fixed inset-0 z-50 bg-[#0A1628]/95 backdrop-blur-sm flex items-center justify-center" onClick={closeLightbox}>
          <button onClick={closeLightbox} className="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
            <X className="w-6 h-6" />
          </button>
          
          <button onClick={(e) => { e.stopPropagation(); goPrev(); }} className="absolute left-6 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
            <ChevronLeft className="w-6 h-6" />
          </button>
          
          <button onClick={(e) => { e.stopPropagation(); goNext(); }} className="absolute right-6 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
            <ChevronRight className="w-6 h-6" />
          </button>

          <div className="relative w-[90vw] h-[80vh] max-w-6xl" onClick={(e) => e.stopPropagation()}>
            <Image
              src={project.gallery[lightbox].src}
              alt={lang === "en" ? project.gallery[lightbox].captionEn : project.gallery[lightbox].captionDari}
              fill
              className="object-contain"
              sizes="90vw"
            />
          </div>
          
          <p className="absolute bottom-6 left-1/2 -translate-x-1/2 text-white/60 text-sm">
            {lightbox + 1} / {project.gallery.length}
          </p>
        </div>
      )}
    </section>
  );
}