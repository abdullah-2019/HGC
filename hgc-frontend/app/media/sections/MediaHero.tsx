"use client";

import React, { useState, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { Play, ChevronLeft, ChevronRight } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";

interface FeaturedMedia {
  id: string;
  type: "video" | "image";
  thumbnail: string;
  title: string;
  subtitle: string;
  company: string;
  duration: string;
  views: number;
}

const featuredMedia: FeaturedMedia[] = [
  {
    id: "hero-1",
    type: "video",
    thumbnail: "https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1600&q=80",
    title: "Building Afghanistan's Future",
    subtitle: "A documentary on 25 years of transformative infrastructure, mining, and logistics across the nation.",
    company: "Hafez Group of Companies",
    duration: "12:45",
    views: 12847,
  },
  {
    id: "hero-2",
    type: "image",
    thumbnail: "https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=1600&q=80",
    title: "Kabul Ring Road — Phase II Completion",
    subtitle: "Connecting 12 districts and transforming daily commutes for millions of Afghans.",
    company: "HCRC",
    duration: "",
    views: 8932,
  },
  {
    id: "hero-3",
    type: "video",
    thumbnail: "https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1600&q=80",
    title: "Deep Beneath the Earth",
    subtitle: "Exploring Al-Bahrain Mining's responsible extraction operations across 5 Afghan provinces.",
    company: "Al-Bahrain Mining",
    duration: "08:30",
    views: 6541,
  },
];

export default function MediaHero() {
  const { lang, dir } = useI18n();
  const [current, setCurrent] = useState(0);
  const [progress, setProgress] = useState(0);

  useEffect(() => {
    const timer = setInterval(() => {
      setProgress((p) => {
        if (p >= 100) {
          setCurrent((c) => (c + 1) % featuredMedia.length);
          return 0;
        }
        return p + 0.5;
      });
    }, 100);
    return () => clearInterval(timer);
  }, []);

  useEffect(() => {
    setProgress(0);
  }, [current]);

  const goNext = () => {
    setCurrent((c) => (c + 1) % featuredMedia.length);
  };

  const goPrev = () => {
    setCurrent((c) => (c - 1 + featuredMedia.length) % featuredMedia.length);
  };

  const item = featuredMedia[current];
  const isRTL = dir === "rtl";

  return (
    <section className="relative h-screen min-h-[700px] max-h-[900px] overflow-hidden" dir={dir}>
      {/* Background */}
      <AnimatePresence mode="wait">
        <motion.div
          key={item.id}
          initial={{ opacity: 0, scale: 1.1 }}
          animate={{ opacity: 1, scale: 1 }}
          exit={{ opacity: 0 }}
          transition={{ duration: 1.2, ease: "easeOut" }}
          className="absolute inset-0"
        >
          <div
            className="absolute inset-0 bg-cover bg-center"
            style={{ backgroundImage: `url(${item.thumbnail})` }}
          />
          <div className="absolute inset-0 bg-[#0A1628]/60" />
          <div className="absolute inset-0 bg-[#0A1628]/40 via-transparent to-transparent" />
          <div className="absolute bottom-0 left-0 right-0 h-1/2" style={{ background: "linear-gradient(to top, #0A1628 0%, transparent 100%)" }} />
        </motion.div>
      </AnimatePresence>

      {/* Floating Particles */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none">
        {[...Array(15)].map((_, i) => (
          <motion.div
            key={i}
            className="absolute w-1.5 h-1.5 bg-[#C9A227]/20 rounded-full"
            style={{
              left: `${Math.random() * 100}%`,
              top: `${Math.random() * 100}%`,
            }}
            animate={{
              y: [0, -30, 0],
              opacity: [0.2, 0.6, 0.2],
            }}
            transition={{
              duration: 4 + Math.random() * 4,
              repeat: Infinity,
              delay: Math.random() * 3,
            }}
          />
        ))}
      </div>

      {/* Content */}
      <div className="relative z-10 h-full flex flex-col justify-end max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div className="grid lg:grid-cols-2 gap-12 items-end">
          {/* Left: Text Content */}
          <AnimatePresence mode="wait">
            <motion.div
              key={item.id}
              initial={{ opacity: 0, y: 50 }}
              animate={{ opacity: 1, y: 0 }}
              exit={{ opacity: 0, y: -30 }}
              transition={{ duration: 0.6, delay: 0.2 }}
              className="space-y-6"
            >
              {/* Badge */}
              <div className="flex items-center gap-3">
                <span className="px-3 py-1.5 rounded-full bg-[#C9A227]/15 text-[#C9A227] text-xs font-bold uppercase tracking-wider border border-[#C9A227]/20">
                  {t(lang, "media.hero.badgeFeatured")} {item.type === "video" ? t(lang, "media.hero.badgeDocumentary") : t(lang, "media.hero.badgePhotography")}
                </span>
                <span className="px-3 py-1.5 rounded-full bg-white/5 text-white/50 text-xs font-medium border border-white/10">
                  {item.company}
                </span>
              </div>

              {/* Title */}
              <h1 className="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-[1.1]">
                {item.title}
              </h1>

              {/* Subtitle */}
              <p className="text-white/50 text-lg leading-relaxed max-w-xl">
                {item.subtitle}
              </p>

              {/* Meta */}
              <div className="flex items-center gap-6 text-white/40 text-sm">
                {item.duration && (
                  <span className="flex items-center gap-2">
                    <Play className="w-4 h-4" />
                    {item.duration}
                  </span>
                )}
                <span className="flex items-center gap-2">
                  <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                  {item.views.toLocaleString()} {t(lang, "media.videoGallery.views")}
                </span>
              </div>

              {/* CTA */}
              <div className="flex items-center gap-4 pt-2">
                <button className="group flex items-center gap-3 px-8 py-4 bg-[#C9A227] text-[#0A1628] font-bold rounded-xl hover:bg-[#C9A227]/90 transition-all duration-300">
                  {item.type === "video" ? (
                    <>
                      <Play className="w-5 h-5" fill="currentColor" />
                      {t(lang, "media.hero.watchNow")}
                    </>
                  ) : (
                    <>
                      <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                      </svg>
                      {t(lang, "media.hero.viewFullscreen")}
                    </>
                  )}
                </button>
              </div>
            </motion.div>
          </AnimatePresence>

          {/* Right: Slide Navigation */}
          <div className="hidden lg:flex flex-col items-end gap-3">
            {featuredMedia.map((slide, idx) => (
              <button
                key={slide.id}
                onClick={() => setCurrent(idx)}
                className={`group relative flex items-center gap-4 p-3 rounded-xl transition-all duration-500 ${
                  idx === current
                    ? "bg-white/10 border border-white/20 w-80"
                    : "bg-white/5 border border-transparent hover:bg-white/10 w-72 opacity-60 hover:opacity-100"
                }`}
              >
                <div className="relative w-20 h-14 rounded-lg overflow-hidden flex-shrink-0">
                  <div
                    className="absolute inset-0 bg-cover bg-center"
                    style={{ backgroundImage: `url(${slide.thumbnail})` }}
                  />
                  {slide.type === "video" && (
                    <div className="absolute inset-0 flex items-center justify-center bg-black/30">
                      <Play className="w-4 h-4 text-white" fill="white" />
                    </div>
                  )}
                </div>
                <div className={`flex-1 min-w-0 ${isRTL ? "text-right" : "text-left"}`}>
                  <p className={`text-sm font-medium truncate ${idx === current ? "text-white" : "text-white/50"}`}>
                    {slide.title}
                  </p>
                  <p className="text-white/30 text-xs mt-0.5">{slide.company}</p>
                </div>
                <div className={`w-1 h-10 rounded-full transition-all duration-300 ${idx === current ? "bg-[#C9A227]" : "bg-white/10"}`} />
              </button>
            ))}
          </div>
        </div>

        {/* Bottom Controls */}
        <div className="mt-12 flex items-center justify-between">
          {/* Progress Bar */}
          <div className="flex-1 max-w-md">
            <div className="h-0.5 bg-white/10 rounded-full overflow-hidden">
              <motion.div
                className="h-full bg-[#C9A227] rounded-full"
                style={{ width: `${progress}%` }}
              />
            </div>
            <div className="flex items-center justify-between mt-2 text-white/30 text-xs">
              <span>0{current + 1} / 0{featuredMedia.length}</span>
              <span>{t(lang, "media.hero.autoPlaying")}</span>
            </div>
          </div>

          {/* Nav Buttons */}
          <div className="flex items-center gap-3 ml-8">
            <button
              onClick={goPrev}
              className="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white/50 hover:text-white hover:bg-white/10 transition-all"
            >
              {isRTL ? <ChevronRight className="w-5 h-5" /> : <ChevronLeft className="w-5 h-5" />}
            </button>
            <button
              onClick={goNext}
              className="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white/50 hover:text-white hover:bg-white/10 transition-all"
            >
              {isRTL ? <ChevronLeft className="w-5 h-5" /> : <ChevronRight className="w-5 h-5" />}
            </button>
          </div>
        </div>
      </div>
    </section>
  );
}
