"use client";

import React, { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { Play, Clock, Eye, X, Volume2, Maximize2, ChevronLeft, ChevronRight, Film } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import ScrollReveal from "@/components/ScrollReveal";

interface VideoItem {
  id: string;
  thumbnail: string;
  title: string;
  description: string;
  company: string;
  companyColor: string;
  duration: string;
  views: number;
  date: string;
  category: string;
}

const videos: VideoItem[] = [
  {
    id: "v1",
    thumbnail: "https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&q=80",
    title: "25 Years of Building Afghanistan",
    description: "A comprehensive documentary chronicling HGC's journey from a single construction firm to a national conglomerate.",
    company: "HGC",
    companyColor: "#C9A227",
    duration: "12:45",
    views: 12847,
    date: "2026-05-01",
    category: "documentary",
  },
  {
    id: "v2",
    thumbnail: "https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=800&q=80",
    title: "Kabul Ring Road: Engineering Marvel",
    description: "Behind-the-scenes look at the construction of Phase II connecting 12 districts of Kabul.",
    company: "HCRC",
    companyColor: "#B22222",
    duration: "08:30",
    views: 8932,
    date: "2026-06-15",
    category: "engineering",
  },
  {
    id: "v3",
    thumbnail: "https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&q=80",
    title: "Mining the Future: Al-Bahrain Operations",
    description: "Exploring sustainable mineral extraction across Logar, Bamyan, and Herat provinces.",
    company: "Al-Bahrain",
    companyColor: "#1A237E",
    duration: "10:15",
    views: 6541,
    date: "2026-06-10",
    category: "mining",
  },
  {
    id: "v4",
    thumbnail: "https://images.unsplash.com/photo-1587351021759-3e566b6af7cc?w=800&q=80",
    title: "Mazar Hospital: Healthcare Infrastructure",
    description: "Documenting the construction of the $45 million regional hospital serving northern Afghanistan.",
    company: "Zain Noorain",
    companyColor: "#F57C00",
    duration: "06:45",
    views: 5210,
    date: "2026-06-05",
    category: "healthcare",
  },
  {
    id: "v5",
    thumbnail: "https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=800&q=80",
    title: "Digital Finance Revolution",
    description: "How Haramain Exchange is transforming remittance services with cutting-edge digital platforms.",
    company: "Haramain",
    companyColor: "#FFD700",
    duration: "05:20",
    views: 9876,
    date: "2026-05-28",
    category: "fintech",
  },
  {
    id: "v6",
    thumbnail: "https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?w=800&q=80",
    title: "Logistics Without Borders",
    description: "Following Al-Koozi's fleet expansion to 200 vehicles covering all 34 provinces.",
    company: "Al-Koozi",
    companyColor: "#00838F",
    duration: "07:10",
    views: 4321,
    date: "2026-05-20",
    category: "logistics",
  },
  {
    id: "v7",
    thumbnail: "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&q=80",
    title: "Kandahar Trade Center Grand Opening",
    description: "Highlights from the inauguration of the 50,000 sqm modern commercial complex.",
    company: "Al-Madinah",
    companyColor: "#2E7D32",
    duration: "04:30",
    views: 7654,
    date: "2026-05-15",
    category: "commerce",
  },
  {
    id: "v8",
    thumbnail: "https://images.unsplash.com/photo-1518005020951-eccb494ad742?w=800&q=80",
    title: "Green Building Initiative Launch",
    description: "HCRC's commitment to sustainable construction with solar integration and eco-friendly materials.",
    company: "HCRC",
    companyColor: "#B22222",
    duration: "09:00",
    views: 3456,
    date: "2026-04-22",
    category: "sustainability",
  },
];

export default function VideoGallery() {
  const { lang, dir } = useI18n();
  const [activeCategory, setActiveCategory] = useState("all");
  const [selectedVideo, setSelectedVideo] = useState<VideoItem | null>(null);
  const isRTL = dir === "rtl";

  const categoryKeys = [
    { key: "all", label: t(lang, "media.videoGallery.all") },
    { key: "documentary", label: t(lang, "media.videoGallery.documentary") },
    { key: "engineering", label: t(lang, "media.videoGallery.engineering") },
    { key: "mining", label: t(lang, "media.videoGallery.mining") },
    { key: "healthcare", label: t(lang, "media.videoGallery.healthcare") },
    { key: "fintech", label: t(lang, "media.videoGallery.fintech") },
    { key: "logistics", label: t(lang, "media.videoGallery.logistics") },
    { key: "commerce", label: t(lang, "media.videoGallery.commerce") },
    { key: "sustainability", label: t(lang, "media.videoGallery.sustainability") },
  ];

  const filtered = activeCategory === "all"
    ? videos
    : videos.filter((v) => v.category === activeCategory);

  return (
    <section className="py-24 relative">
      <div className="absolute inset-0 bg-[#C9A227]/[0.02]" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        {/* Header */}
        <ScrollReveal>
          <div className="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12">
            <div>
              <div className="flex items-center gap-3 mb-4">
                <div className="w-10 h-10 rounded-xl bg-[#C9A227]/10 flex items-center justify-center">
                  <Film className="w-5 h-5 text-[#C9A227]" />
                </div>
                <span className="text-[#C9A227] text-sm font-semibold uppercase tracking-[0.2em]">
                  {t(lang, "media.videoGallery.sectionSubtitle")}
                </span>
              </div>
              <h2 className="text-3xl lg:text-5xl font-bold text-white">
                {t(lang, "media.videoGallery.sectionTitle")}
              </h2>
              <p className="text-white/40 mt-3 max-w-xl">
                {t(lang, "media.videoGallery.description")}
              </p>
            </div>

            {/* Category Filter */}
            <div className="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-hide">
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
          </div>
        </ScrollReveal>

        {/* Video Grid */}
        <motion.div layout className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <AnimatePresence mode="popLayout">
            {filtered.map((video, idx) => (
              <motion.div
                key={video.id}
                layout
                initial={{ opacity: 0, y: 30 }}
                animate={{ opacity: 1, y: 0 }}
                exit={{ opacity: 0, scale: 0.95 }}
                transition={{ duration: 0.4, delay: idx * 0.05 }}
                className="group relative"
              >
                <div className="relative rounded-2xl overflow-hidden bg-white/[0.02] border border-white/5 hover:border-white/10 transition-all duration-500">
                  {/* Thumbnail */}
                  <div className="relative h-56 overflow-hidden">
                    <div
                      className="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
                      style={{ backgroundImage: `url(${video.thumbnail})` }}
                    />
                    <div className="absolute inset-0 bg-[#0A1628]/40 group-hover:bg-[#0A1628]/20 transition-colors duration-500" />

                    {/* Play Button */}
                    <div className="absolute inset-0 flex items-center justify-center">
                      <motion.button
                        whileHover={{ scale: 1.1 }}
                        whileTap={{ scale: 0.95 }}
                        onClick={() => setSelectedVideo(video)}
                        className="w-16 h-16 rounded-full bg-[#C9A227]/90 flex items-center justify-center shadow-2xl shadow-[#C9A227]/20 group-hover:bg-[#C9A227] transition-colors"
                      >
                        <Play className="w-7 h-7 text-[#0A1628] ml-1" fill="currentColor" />
                      </motion.button>
                    </div>

                    {/* Duration Badge */}
                    <div className={`absolute bottom-3 ${isRTL ? "left-3" : "right-3"} px-2.5 py-1 rounded-lg bg-black/60 backdrop-blur-sm text-white text-xs font-medium`}>
                      {video.duration}
                    </div>

                    {/* Company Badge */}
                    <div
                      className={`absolute top-3 ${isRTL ? "right-3" : "left-3"} px-2.5 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm`}
                      style={{
                        backgroundColor: `${video.companyColor}20`,
                        color: video.companyColor,
                        border: `1px solid ${video.companyColor}30`,
                      }}
                    >
                      {video.company}
                    </div>
                  </div>

                  {/* Content */}
                  <div className="p-5 space-y-3">
                    <h3 className="text-white font-semibold text-lg leading-snug group-hover:text-[#C9A227] transition-colors duration-300 line-clamp-2">
                      {video.title}
                    </h3>
                    <p className="text-white/40 text-sm leading-relaxed line-clamp-2">
                      {video.description}
                    </p>
                    <div className="flex items-center justify-between pt-2">
                      <div className="flex items-center gap-4 text-white/30 text-xs">
                        <span className="flex items-center gap-1.5">
                          <Clock className="w-3.5 h-3.5" />
                          {video.duration}
                        </span>
                        <span className="flex items-center gap-1.5">
                          <Eye className="w-3.5 h-3.5" />
                          {video.views.toLocaleString()}
                        </span>
                      </div>
                      <span className="text-white/20 text-xs">
                        {t(lang, `media.videoGallery.${video.category}`) || video.category}
                      </span>
                    </div>
                  </div>
                </div>
              </motion.div>
            ))}
          </AnimatePresence>
        </motion.div>
      </div>

      {/* Video Lightbox */}
      <AnimatePresence>
        {selectedVideo && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-50 bg-[#0A1628]/98 backdrop-blur-xl flex items-center justify-center p-4"
            onClick={() => setSelectedVideo(null)}
          >
            <motion.div
              initial={{ scale: 0.9, opacity: 0 }}
              animate={{ scale: 1, opacity: 1 }}
              exit={{ scale: 0.9, opacity: 0 }}
              className="relative w-full max-w-5xl"
              onClick={(e) => e.stopPropagation()}
            >
              {/* Close */}
              <button
                onClick={() => setSelectedVideo(null)}
                className="absolute -top-14 right-0 w-11 h-11 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors"
              >
                <X className="w-5 h-5" />
              </button>

              {/* Video Player Mock */}
              <div className="rounded-2xl overflow-hidden bg-[#0A1628] border border-white/10">
                <div
                  className="relative h-[60vh] bg-cover bg-center flex items-center justify-center"
                  style={{ backgroundImage: `url(${selectedVideo.thumbnail})` }}
                >
                  <div className="absolute inset-0 bg-[#0A1628]/50" />
                  <motion.button
                    whileHover={{ scale: 1.1 }}
                    className="relative w-20 h-20 rounded-full bg-[#C9A227] flex items-center justify-center shadow-2xl shadow-[#C9A227]/30"
                  >
                    <Play className="w-8 h-8 text-[#0A1628] ml-1" fill="currentColor" />
                  </motion.button>
                </div>

                {/* Controls Bar */}
                <div className="p-6">
                  <div className="flex items-center justify-between mb-4">
                    <div>
                      <h3 className="text-white font-bold text-xl">{selectedVideo.title}</h3>
                      <div className="flex items-center gap-3 mt-1">
                        <span
                          className="text-sm font-medium"
                          style={{ color: selectedVideo.companyColor }}
                        >
                          {selectedVideo.company}
                        </span>
                        <span className="text-white/30 text-sm">
                          {t(lang, `media.videoGallery.${selectedVideo.category}`) || selectedVideo.category}
                        </span>
                      </div>
                    </div>
                    <div className="flex items-center gap-3">
                      <button className="p-2.5 rounded-lg bg-white/5 hover:bg-white/10 text-white/60 hover:text-white transition-colors">
                        <Volume2 className="w-5 h-5" />
                      </button>
                      <button className="p-2.5 rounded-lg bg-white/5 hover:bg-white/10 text-white/60 hover:text-white transition-colors">
                        <Maximize2 className="w-5 h-5" />
                      </button>
                    </div>
                  </div>

                  {/* Progress */}
                  <div className="flex items-center gap-3">
                    <span className="text-white/40 text-xs w-10">00:00</span>
                    <div className="flex-1 h-1 bg-white/10 rounded-full overflow-hidden">
                      <div className="w-0 h-full bg-[#C9A227] rounded-full" />
                    </div>
                    <span className="text-white/40 text-xs w-10 text-right">{selectedVideo.duration}</span>
                  </div>

                  <p className="text-white/40 text-sm mt-4 leading-relaxed">
                    {selectedVideo.description}
                  </p>
                </div>
              </div>
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>
    </section>
  );
}
