"use client";

import Image from "next/image";
import { useState } from "react";
import { X, ChevronLeft, ChevronRight } from "lucide-react";

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
  const gallery = project?.gallery || [];
  const [lightboxOpen, setLightboxOpen] = useState(false);
  const [activeIndex, setActiveIndex] = useState(0);

  if (gallery.length === 0) {
    return (
      <section className="py-16 bg-[#0A1628]">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <h2 className="text-2xl font-bold text-white mb-4">Project Gallery</h2>
          <p className="text-white/30">No gallery images available.</p>
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
    <section className="py-16 bg-[#0A1628]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 className="text-2xl font-bold text-white mb-2">Project Gallery</h2>
        <p className="text-white/40 text-sm mb-8">
          {gallery.length} image{gallery.length > 1 ? "s" : ""}
        </p>

        {/* Grid */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          {gallery.map((img, idx) => (
            <button
              key={idx}
              onClick={() => openLightbox(idx)}
              className="group relative aspect-[4/3] rounded-xl overflow-hidden bg-white/5 border border-white/5 text-left hover:border-[#C9A227]/30 transition-all duration-300"
            >
              <Image
                src={img.src}
                alt={img.captionEn || `Gallery image ${idx + 1}`}
                fill
                className="object-cover transition-transform duration-500 group-hover:scale-105"
                sizes="(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 33vw"
                unoptimized={img.src.startsWith("http")}
              />
              {/* Overlay */}
              <div className="absolute inset-0 bg-gradient-to-t from-[#0A1628]/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
              {/* Caption */}
              <div className="absolute bottom-0 left-0 right-0 p-4 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                <p className="text-white text-sm font-medium line-clamp-2">
                  {img.captionEn}
                </p>
              </div>
            </button>
          ))}
        </div>
      </div>

      {/* Lightbox */}
      {lightboxOpen && (
        <div
          className="fixed inset-0 z-50 bg-[#0A1628]/95 backdrop-blur-sm flex items-center justify-center"
          onClick={closeLightbox}
        >
          {/* Close */}
          <button
            onClick={closeLightbox}
            className="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/10 border border-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors"
          >
            <X className="w-5 h-5" />
          </button>

          {/* Prev */}
          {gallery.length > 1 && (
            <button
              onClick={(e) => { e.stopPropagation(); goPrev(); }}
              className="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/10 border border-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors"
            >
              <ChevronLeft className="w-5 h-5" />
            </button>
          )}

          {/* Image */}
          <div
            className="relative w-full max-w-5xl mx-4 aspect-[16/10]"
            onClick={(e) => e.stopPropagation()}
          >
            <Image
              src={gallery[activeIndex].src}
              alt={gallery[activeIndex].captionEn || "Gallery image"}
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
              className="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/10 border border-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors"
            >
              <ChevronRight className="w-5 h-5" />
            </button>
          )}

          {/* Caption bar */}
          <div className="absolute bottom-4 left-1/2 -translate-x-1/2 bg-[#0A1628]/80 border border-white/10 rounded-lg px-4 py-2 text-center">
            <p className="text-white text-sm">
              {activeIndex + 1} / {gallery.length}
            </p>
            <p className="text-white/50 text-xs mt-1">
              {gallery[activeIndex].captionEn}
            </p>
          </div>
        </div>
      )}
    </section>
  );
}