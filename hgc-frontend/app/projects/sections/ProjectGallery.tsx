"use client";

import Image from "next/image";
import { useState } from "react";
import { X, ChevronLeft, ChevronRight } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

interface GalleryImage {
  src: string;
  captionEn: string;
  captionDari: string;
}

interface ProjectGalleryProps {
  project: {
    gallery?: GalleryImage[];
    nameEn?: string;
    nameDari?: string;
  };
}

export default function ProjectGallery({ project }: ProjectGalleryProps) {
  const { lang } = useI18n();
  const isRTL = lang !== "en";
  const gallery = project?.gallery || [];
  const [lightboxOpen, setLightboxOpen] = useState(false);
  const [activeIndex, setActiveIndex] = useState(0);

  if (gallery.length === 0) {
    return (
      <section className="py-16 bg-hgc-bg-alt" dir={isRTL ? "rtl" : "ltr"}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <h2 className="text-2xl font-bold text-hgc-text mb-4">
            {lang === "en" ? "Project Gallery" : lang === "dari" ? "گالری پروژه" : "د پروژې ګالري"}
          </h2>
          <p className="text-hgc-text-muted">
            {lang === "en" ? "No gallery images available." : lang === "dari" ? "هیچ تصویری در گالری موجود نیست." : "په ګالري کې هیڅ انځور شتون نلري."}
          </p>
        </div>
      </section>
    );
  }

  const openLightbox = (index: number) => {
    setActiveIndex(index);
    setLightboxOpen(true);
  };

  const closeLightbox = () => setLightboxOpen(false);

  const goPrev = () => setActiveIndex((i) => (i === 0 ? gallery.length - 1 : i - 1));
  const goNext = () => setActiveIndex((i) => (i === gallery.length - 1 ? 0 : i + 1));

  return (
    <section className="py-16 bg-hgc-bg-alt" dir={isRTL ? "rtl" : "ltr"}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 className="text-2xl font-bold text-hgc-text mb-2 text-start">
          {lang === "en" ? "Project Gallery" : lang === "dari" ? "گالری پروژه" : "د پروژې ګالري"}
        </h2>
        <p className="text-hgc-text-muted text-sm mb-8 text-start">
          {gallery.length} {lang === "en" ? (gallery.length > 1 ? "images" : "image") : lang === "dari" ? "تصویر" : "انځور"}
        </p>

        {/* Grid */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          {gallery.map((img, idx) => (
            <button
              key={idx}
              onClick={() => openLightbox(idx)}
              className="group relative aspect-[4/3] rounded-xl overflow-hidden bg-hgc-surface-elevated border border-hgc-border text-start hover:border-hgc-gold/40 transition-all duration-300"
            >
              <Image
                src={img.src}
                alt={lang === "en" ? (img.captionEn || `Gallery image ${idx + 1}`) : (img.captionDari || `Gallery image ${idx + 1}`)}
                fill
                className="object-cover transition-transform duration-500 group-hover:scale-105"
                sizes="(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 33vw"
                unoptimized={img.src.startsWith("http")}
              />
              {/* Overlay */}
              <div className="absolute inset-0 bg-gradient-to-t from-hgc-navy/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
              {/* Caption */}
              <div className="absolute bottom-0 start-0 end-0 p-4 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                <p className="text-white text-sm font-medium line-clamp-2 text-start">
                  {lang === "en" ? img.captionEn : img.captionDari}
                </p>
              </div>
            </button>
          ))}
        </div>
      </div>

      {/* Lightbox */}
      {lightboxOpen && (
        <div
          className="fixed inset-0 z-50 bg-hgc-bg/95 backdrop-blur-sm flex items-center justify-center"
          onClick={closeLightbox}
        >
          {/* Close */}
          <button
            onClick={closeLightbox}
            className="absolute top-4 end-4 w-10 h-10 rounded-full bg-hgc-surface-elevated border border-hgc-border flex items-center justify-center text-hgc-text hover:bg-hgc-card-hover transition-colors shadow-sm"
          >
            <X className="w-5 h-5" />
          </button>

          {/* Prev */}
          {gallery.length > 1 && (
            <button
              onClick={(e) => { e.stopPropagation(); goPrev(); }}
              className="absolute start-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-hgc-surface-elevated border border-hgc-border flex items-center justify-center text-hgc-text hover:bg-hgc-card-hover transition-colors shadow-sm"
            >
              <ChevronLeft className={`w-5 h-5 ${isRTL ? "rotate-180" : ""}`} />
            </button>
          )}

          {/* Image */}
          <div
            className="relative w-full max-w-5xl mx-4 aspect-[16/10]"
            onClick={(e) => e.stopPropagation()}
          >
            <Image
              src={gallery[activeIndex].src}
              alt={lang === "en" ? (gallery[activeIndex].captionEn || "Gallery image") : (gallery[activeIndex].captionDari || "Gallery image")}
              fill
              className="object-contain"
              sizes="100vw"
              unoptimized={gallery[activeIndex].src.startsWith("http")}
              priority
            />
          </div>

          {/* Next */}
          {gallery.length > 1 && (
            <button
              onClick={(e) => { e.stopPropagation(); goNext(); }}
              className="absolute end-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-hgc-surface-elevated border border-hgc-border flex items-center justify-center text-hgc-text hover:bg-hgc-card-hover transition-colors shadow-sm"
            >
              <ChevronRight className={`w-5 h-5 ${isRTL ? "rotate-180" : ""}`} />
            </button>
          )}

          {/* Caption bar */}
          <div className="absolute bottom-4 start-1/2 -translate-x-1/2 bg-hgc-card border border-hgc-border rounded-lg px-4 py-2 text-center shadow-lg">
            <p className="text-hgc-text text-sm font-medium">
              {activeIndex + 1} / {gallery.length}
            </p>
            <p className="text-hgc-text-muted text-xs mt-1">
              {lang === "en" ? gallery[activeIndex].captionEn : gallery[activeIndex].captionDari}
            </p>
          </div>
        </div>
      )}
    </section>
  );
}