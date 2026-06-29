"use client";

import React, { useState, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";
import {
  X,
  ChevronLeft,
  ChevronRight,
  ZoomIn,
  Download,
  Share2,
  MapPin,
  Calendar,
  Camera,
  Grid3x3,
  LayoutGrid,
} from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import ScrollReveal from "@/components/ScrollReveal";

interface PhotoItem {
  id: string;
  src: string;
  title: string;
  location: string;
  date: string;
  company: string;
  companyColor: string;
  category: string;
  aspect: "landscape" | "portrait" | "square";
}

const photos: PhotoItem[] = [
  {
    id: "p1",
    src: "https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=1200&q=80",
    title: "Kabul Ring Road Aerial View",
    location: "Kabul, Afghanistan",
    date: "2026-06-15",
    company: "HCRC",
    companyColor: "#B22222",
    category: "infrastructure",
    aspect: "landscape",
  },
  {
    id: "p2",
    src: "https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1200&q=80",
    title: "Construction Site at Dawn",
    location: "Mazar-e-Sharif",
    date: "2026-06-10",
    company: "Zain Noorain",
    companyColor: "#F57C00",
    category: "construction",
    aspect: "landscape",
  },
  {
    id: "p3",
    src: "https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1200&q=80",
    title: "Mining Operations Overview",
    location: "Logar Province",
    date: "2026-05-28",
    company: "Al-Bahrain",
    companyColor: "#1A237E",
    category: "mining",
    aspect: "landscape",
  },
  {
    id: "p4",
    src: "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1200&q=80",
    title: "Modern Commercial Complex",
    location: "Kandahar",
    date: "2026-05-20",
    company: "Al-Madinah",
    companyColor: "#2E7D32",
    category: "architecture",
    aspect: "portrait",
  },
  {
    id: "p5",
    src: "https://images.unsplash.com/photo-1587351021759-3e566b6af7cc?w=1200&q=80",
    title: "Regional Hospital Construction",
    location: "Mazar-e-Sharif",
    date: "2026-06-05",
    company: "Zain Noorain",
    companyColor: "#F57C00",
    category: "healthcare",
    aspect: "landscape",
  },
  {
    id: "p6",
    src: "https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?w=1200&q=80",
    title: "Logistics Fleet on Highway",
    location: "Kabul-Kandahar Highway",
    date: "2026-05-15",
    company: "Al-Koozi",
    companyColor: "#00838F",
    category: "logistics",
    aspect: "landscape",
  },
  {
    id: "p7",
    src: "https://images.unsplash.com/photo-1518005020951-eccb494ad742?w=1200&q=80",
    title: "Green Building Initiative",
    location: "Kabul",
    date: "2026-04-22",
    company: "HCRC",
    companyColor: "#B22222",
    category: "sustainability",
    aspect: "square",
  },
  {
    id: "p8",
    src: "https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=1200&q=80",
    title: "Financial Services Center",
    location: "Kabul",
    date: "2026-05-01",
    company: "Haramain",
    companyColor: "#FFD700",
    category: "finance",
    aspect: "landscape",
  },
  {
    id: "p9",
    src: "https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=1200&q=80",
    title: "Bridge Construction Progress",
    location: "Panjshir Valley",
    date: "2026-06-01",
    company: "HCRC",
    companyColor: "#B22222",
    category: "infrastructure",
    aspect: "landscape",
  },
  {
    id: "p10",
    src: "https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?w=1200&q=80",
    title: "City Skyline at Sunset",
    location: "Kabul",
    date: "2026-05-10",
    company: "HGC",
    companyColor: "#C9A227",
    category: "urban",
    aspect: "portrait",
  },
  {
    id: "p11",
    src: "https://images.unsplash.com/photo-1541976590-713941681591?w=1200&q=80",
    title: "Heavy Machinery at Work",
    location: "Herat",
    date: "2026-05-25",
    company: "Al-Bahrain",
    companyColor: "#1A237E",
    category: "mining",
    aspect: "landscape",
  },
  {
    id: "p12",
    src: "https://images.unsplash.com/photo-1497366216548-37526070297c?w=1200&q=80",
    title: "Office Interior Design",
    location: "Kabul",
    date: "2026-04-15",
    company: "Al-Madinah",
    companyColor: "#2E7D32",
    category: "interior",
    aspect: "square",
  },
];

export default function PhotoGallery() {
  const { lang, dir } = useI18n();
  const [activeCategory, setActiveCategory] = useState("all");
  const [selectedPhoto, setSelectedPhoto] = useState<PhotoItem | null>(null);
  const [selectedIndex, setSelectedIndex] = useState(0);
  const [layout, setLayout] = useState<"masonry" | "grid">("masonry");
  const isRTL = dir === "rtl";

  const categoryKeys = [
    { key: "all", label: t(lang, "media.photoGallery.all") },
    { key: "infrastructure", label: t(lang, "media.photoGallery.infrastructure") },
    { key: "construction", label: t(lang, "media.photoGallery.construction") },
    { key: "mining", label: t(lang, "media.videoGallery.mining") },
    { key: "architecture", label: t(lang, "media.photoGallery.architecture") },
    { key: "healthcare", label: t(lang, "media.videoGallery.healthcare") },
    { key: "logistics", label: t(lang, "media.videoGallery.logistics") },
    { key: "sustainability", label: t(lang, "media.videoGallery.sustainability") },
    { key: "finance", label: t(lang, "media.photoGallery.finance") },
    { key: "urban", label: t(lang, "media.photoGallery.urban") },
    { key: "interior", label: t(lang, "media.photoGallery.interior") },
  ];

  const filtered = activeCategory === "all"
    ? photos
    : photos.filter((p) => p.category === activeCategory);

  const openLightbox = (photo: PhotoItem, index: number) => {
    setSelectedPhoto(photo);
    setSelectedIndex(index);
  };

  const goNext = () => {
    const next = (selectedIndex + 1) % filtered.length;
    setSelectedIndex(next);
    setSelectedPhoto(filtered[next]);
  };

  const goPrev = () => {
    const prev = (selectedIndex - 1 + filtered.length) % filtered.length;
    setSelectedIndex(prev);
    setSelectedPhoto(filtered[prev]);
  };

  useEffect(() => {
    const handleKey = (e: KeyboardEvent) => {
      if (!selectedPhoto) return;
      if (e.key === "ArrowRight") goNext();
      if (e.key === "ArrowLeft") goPrev();
      if (e.key === "Escape") setSelectedPhoto(null);
    };
    window.addEventListener("keydown", handleKey);
    return () => window.removeEventListener("keydown", handleKey);
  }, [selectedPhoto, selectedIndex, filtered]);

  return (
    <section className="py-24 relative">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Header */}
        <ScrollReveal>
          <div className="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12">
            <div>
              <div className="flex items-center gap-3 mb-4">
                <div className="w-10 h-10 rounded-xl bg-[#C9A227]/10 flex items-center justify-center">
                  <Camera className="w-5 h-5 text-[#C9A227]" />
                </div>
                <span className="text-[#C9A227] text-sm font-semibold uppercase tracking-[0.2em]">
                  {t(lang, "media.photoGallery.sectionSubtitle")}
                </span>
              </div>
              <h2 className="text-3xl lg:text-5xl font-bold text-white">
                {t(lang, "media.photoGallery.sectionTitle")}
              </h2>
              <p className="text-white/40 mt-3 max-w-xl">
                {t(lang, "media.photoGallery.description")}
              </p>
            </div>

            <div className="flex items-center gap-3">
              {/* Layout Toggle */}
              <div className="flex items-center bg-white/5 rounded-lg p-1 border border-white/5">
                <button
                  onClick={() => setLayout("masonry")}
                  className={`p-2 rounded-md transition-all ${layout === "masonry" ? "bg-[#C9A227]/20 text-[#C9A227]" : "text-white/40 hover:text-white"}`}
                >
                  <LayoutGrid className="w-4 h-4" />
                </button>
                <button
                  onClick={() => setLayout("grid")}
                  className={`p-2 rounded-md transition-all ${layout === "grid" ? "bg-[#C9A227]/20 text-[#C9A227]" : "text-white/40 hover:text-white"}`}
                >
                  <Grid3x3 className="w-4 h-4" />
                </button>
              </div>
            </div>
          </div>
        </ScrollReveal>

        {/* Category Filter */}
        <ScrollReveal delay={0.1}>
          <div className="flex items-center gap-2 overflow-x-auto pb-4 mb-8 scrollbar-hide">
            {categoryKeys.map((cat) => (
              <button
                key={cat.key}
                onClick={() => setActiveCategory(cat.key)}
                className={`px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap transition-all duration-300 ${
                  activeCategory === cat.key
                    ? "bg-[#C9A227] text-[#0A1628]"
                    : "bg-white/5 text-white/50 hover:bg-white/10 hover:text-white border border-white/5"
                }`}
              >
                {cat.label}
              </button>
            ))}
          </div>
        </ScrollReveal>

        {/* Photo Grid */}
        <motion.div
          layout
          className={
            layout === "masonry"
              ? "columns-1 sm:columns-2 lg:columns-3 gap-4 space-y-4"
              : "grid grid-cols-2 lg:grid-cols-3 gap-4"
          }
        >
          <AnimatePresence mode="popLayout">
            {filtered.map((photo, idx) => (
              <motion.div
                key={photo.id}
                layout
                initial={{ opacity: 0, scale: 0.9 }}
                animate={{ opacity: 1, scale: 1 }}
                exit={{ opacity: 0, scale: 0.9 }}
                transition={{ duration: 0.4, delay: idx * 0.03 }}
                className={`group relative overflow-hidden rounded-2xl cursor-pointer break-inside-avoid ${
                  layout === "grid" ? "aspect-[4/3]" : ""
                }`}
                onClick={() => openLightbox(photo, idx)}
              >
                <div
                  className={`bg-cover bg-center transition-transform duration-700 group-hover:scale-110 ${
                    layout === "masonry"
                      ? photo.aspect === "portrait"
                        ? "h-[420px]"
                        : photo.aspect === "square"
                        ? "h-[300px]"
                        : "h-[280px]"
                      : "h-full"
                  }`}
                  style={{ backgroundImage: `url(${photo.src})` }}
                />
                <div className="absolute inset-0 bg-[#0A1628]/0 group-hover:bg-[#0A1628]/50 transition-colors duration-500" />

                {/* Hover Info */}
                <div className="absolute inset-0 flex flex-col justify-end p-5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                  <div className="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                    <h3 className="text-white font-semibold text-lg">{photo.title}</h3>
                    <div className="flex items-center gap-3 mt-2 text-white/60 text-sm">
                      <span className="flex items-center gap-1">
                        <MapPin className="w-3.5 h-3.5" />
                        {photo.location}
                      </span>
                      <span className="flex items-center gap-1">
                        <Calendar className="w-3.5 h-3.5" />
                        {new Date(photo.date).toLocaleDateString(lang === "en" ? "en-US" : lang === "dari" ? "fa-AF" : "ps-AF", { month: "short", year: "numeric" })}
                      </span>
                    </div>
                  </div>
                </div>

                {/* Company Badge */}
                <div
                  className={`absolute top-3 ${isRTL ? "left-3" : "right-3"} px-2 py-1 rounded-md text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-sm`}
                  style={{
                    backgroundColor: `${photo.companyColor}30`,
                    color: photo.companyColor,
                  }}
                >
                  {photo.company}
                </div>

                {/* Zoom Icon */}
                <div className={`absolute top-3 ${isRTL ? "right-3" : "left-3"} w-9 h-9 rounded-lg bg-white/10 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300`}>
                  <ZoomIn className="w-4 h-4 text-white" />
                </div>
              </motion.div>
            ))}
          </AnimatePresence>
        </motion.div>
      </div>

      {/* Lightbox */}
      <AnimatePresence>
        {selectedPhoto && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-50 bg-[#0A1628]/98 backdrop-blur-xl flex items-center justify-center"
            onClick={() => setSelectedPhoto(null)}
          >
            {/* Navigation */}
            <button
              onClick={(e) => { e.stopPropagation(); goPrev(); }}
              className={`absolute ${isRTL ? "right-4" : "left-4"} top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors z-10`}
            >
              {isRTL ? <ChevronRight className="w-6 h-6" /> : <ChevronLeft className="w-6 h-6" />}
            </button>
            <button
              onClick={(e) => { e.stopPropagation(); goNext(); }}
              className={`absolute ${isRTL ? "left-4" : "right-4"} top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors z-10`}
            >
              {isRTL ? <ChevronLeft className="w-6 h-6" /> : <ChevronRight className="w-6 h-6" />}
            </button>

            {/* Close */}
            <button
              onClick={() => setSelectedPhoto(null)}
              className="absolute top-6 right-6 w-11 h-11 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors z-10"
            >
              <X className="w-5 h-5" />
            </button>

            {/* Image */}
            <motion.div
              key={selectedPhoto.id}
              initial={{ scale: 0.9, opacity: 0 }}
              animate={{ scale: 1, opacity: 1 }}
              exit={{ scale: 0.9, opacity: 0 }}
              className="max-w-6xl max-h-[80vh] w-full mx-4"
              onClick={(e) => e.stopPropagation()}
            >
              <div className="relative rounded-2xl overflow-hidden bg-[#0A1628] border border-white/10">
                <img
                  src={selectedPhoto.src}
                  alt={selectedPhoto.title}
                  className="w-full max-h-[70vh] object-contain"
                />

                {/* Info Bar */}
                <div className="p-6 flex items-center justify-between">
                  <div>
                    <h3 className="text-white font-bold text-xl">{selectedPhoto.title}</h3>
                    <div className="flex items-center gap-4 mt-2 text-white/40 text-sm">
                      <span className="flex items-center gap-1.5">
                        <MapPin className="w-4 h-4" />
                        {selectedPhoto.location}
                      </span>
                      <span className="flex items-center gap-1.5">
                        <Calendar className="w-4 h-4" />
                        {new Date(selectedPhoto.date).toLocaleDateString(lang === "en" ? "en-US" : lang === "dari" ? "fa-AF" : "ps-AF", { month: "long", day: "numeric", year: "numeric" })}
                      </span>
                      <span
                        className="px-2 py-0.5 rounded text-xs font-semibold"
                        style={{
                          backgroundColor: `${selectedPhoto.companyColor}20`,
                          color: selectedPhoto.companyColor,
                        }}
                      >
                        {selectedPhoto.company}
                      </span>
                    </div>
                  </div>
                  <div className="flex items-center gap-2">
                    <button className="p-2.5 rounded-lg bg-white/5 hover:bg-white/10 text-white/60 hover:text-white transition-colors">
                      <Share2 className="w-5 h-5" />
                    </button>
                    <button className="p-2.5 rounded-lg bg-white/5 hover:bg-white/10 text-white/60 hover:text-white transition-colors">
                      <Download className="w-5 h-5" />
                    </button>
                  </div>
                </div>
              </div>

              {/* Thumbnail Strip */}
              <div className="flex items-center justify-center gap-2 mt-4">
                {filtered.map((p, i) => (
                  <button
                    key={p.id}
                    onClick={() => { setSelectedPhoto(p); setSelectedIndex(i); }}
                    className={`w-16 h-12 rounded-lg overflow-hidden border-2 transition-all ${
                      i === selectedIndex ? "border-[#C9A227] opacity-100" : "border-transparent opacity-40 hover:opacity-70"
                    }`}
                  >
                    <div
                      className="w-full h-full bg-cover bg-center"
                      style={{ backgroundImage: `url(${p.src})` }}
                    />
                  </button>
                ))}
              </div>
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>
    </section>
  );
}
