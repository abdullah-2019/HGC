"use client";

import { useState, useEffect, useCallback } from "react";
import { ChevronLeft, ChevronRight } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { getText, safeArray, safeString } from "./about-utils";

interface LocalizedText {
  en: string | null;
  dari: string | null;
  pashto: string | null;
}

interface AboutCarouselSlide {
  image: string;
  title: LocalizedText;
  location: LocalizedText;
}

interface ImageCarouselProps {
  slides: AboutCarouselSlide[];
}

const fallbackSlides: AboutCarouselSlide[] = [
  { image: "/images/placeholder.png", title: { en: "Kabul-Kandahar Highway", dari: "اساس سرک کابل-کندهار", pashto: "د کابل-کندهار لویه لاره" }, location: { en: "Kandahar Province", dari: "ولایت کندهار", pashto: "د کندهار ولایت" } },
  { image: "/images/placeholder.png", title: { en: "Badakhshan Mining Operations", dari: "عملیات استخراج بدخشان", pashto: "د بدخشان د کانونو استخراج" }, location: { en: "Badakhshan Province", dari: "ولایت بدخشان", pashto: "د بدخشان ولایت" } },
  { image: "/images/placeholder.png", title: { en: "Solar Power Installation", dari: "نصب برق خورشیدی", pashto: "د سولري برق نصبول" }, location: { en: "Nangarhar Province", dari: "ولایت ننگرهار", pashto: "د ننګرهار ولایت" } },
  { image: "/images/placeholder.png", title: { en: "Construction Excellence", dari: "excellence ساختمان", pashto: "د جوړونې بریا" }, location: { en: "Kabul Province", dari: "ولایت کابل", pashto: "د کابل ولایت" } },
  { image: "/images/placeholder.png", title: { en: "Logistics & Transport", dari: "لوژستیک و ترانسپورت", pashto: "لوجستیک او ترانسپورت" }, location: { en: "Nationwide", dari: "سراسر کشور", pashto: "په ټول هیواد کې" } },
];

export default function ImageCarousel({ slides }: ImageCarouselProps) {
  const { lang } = useI18n();
  const [current, setCurrent] = useState(0);
  const [isAutoPlaying, setIsAutoPlaying] = useState(true);

  const displaySlides = safeArray(slides, fallbackSlides);

  const next = useCallback(() => {
    setCurrent((prev) => (prev + 1) % displaySlides.length);
  }, [displaySlides.length]);

  const prev = useCallback(() => {
    setCurrent((prev) => (prev - 1 + displaySlides.length) % displaySlides.length);
  }, [displaySlides.length]);

  useEffect(() => {
    if (!isAutoPlaying) return;
    const timer = setInterval(next, 5000);
    return () => clearInterval(timer);
  }, [isAutoPlaying, next]);

  const currentSlide = displaySlides[current];

  return (
    <section className="about-section py-24 bg-[#0A1628]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <div className="flex items-center justify-center gap-3 mb-6">
            <div className="gold-line" />
            <span className="text-[#C9A227] text-sm font-semibold tracking-wider uppercase">
              {lang === "en" ? "Our Work" : lang === "dari" ? "کارهای ما" : "زموږ کارونه"}
            </span>
            <div className="gold-line" />
          </div>
          <h2 className="about-section-title font-bold text-white">
            {lang === "en" ? (<>Projects That <span className="text-gold-gradient">Define Us</span></>) :
             lang === "dari" ? (<>پروژه‌هایی که <span className="text-gold-gradient">ما را تعریف می‌کنند</span></>) :
             (<>پروژې چې <span className="text-gold-gradient">موږ تعریفوي</span></>)}
          </h2>
        </div>

        <div className="relative rounded-2xl overflow-hidden aspect-[21/9] lg:aspect-[21/8] group"
          onMouseEnter={() => setIsAutoPlaying(false)}
          onMouseLeave={() => setIsAutoPlaying(true)}>
          {displaySlides.map((slide, idx) => (
            <div key={idx} className={`absolute inset-0 transition-all duration-1000 ease-out ${idx === current ? 'opacity-100 scale-100' : 'opacity-0 scale-105'}`}>
              <div className="absolute inset-0 bg-cover bg-center" style={{ backgroundImage: `url(${safeString(slide.image, "/images/placeholder.png")})` }} />
              <div className="absolute inset-0 bg-gradient-to-t from-[#0A1628] via-[#0A1628]/30 to-transparent" />
              <div className="absolute inset-0 bg-gradient-to-r from-[#0A1628]/60 to-transparent" />
            </div>
          ))}

          <div className="absolute bottom-0 left-0 right-0 p-8 lg:p-12">
            <div className="max-w-2xl">
              <p className="text-[#C9A227] text-sm font-medium mb-2 tracking-wider uppercase">
                {getText(currentSlide?.location, lang)}
              </p>
              <h3 className="text-2xl lg:text-4xl font-bold text-white mb-2">
                {getText(currentSlide?.title, lang)}
              </h3>
            </div>
          </div>

          <button onClick={prev} className="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-[#0A1628]/60 backdrop-blur-sm border border-white/10 flex items-center justify-center text-white hover:bg-[#C9A227] hover:border-[#C9A227] hover:text-[#0A1628] transition-all duration-300 opacity-0 group-hover:opacity-100">
            <ChevronLeft className="w-6 h-6" />
          </button>
          <button onClick={next} className="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-[#0A1628]/60 backdrop-blur-sm border border-white/10 flex items-center justify-center text-white hover:bg-[#C9A227] hover:border-[#C9A227] hover:text-[#0A1628] transition-all duration-300 opacity-0 group-hover:opacity-100">
            <ChevronRight className="w-6 h-6" />
          </button>

          <div className="absolute bottom-8 right-8 lg:right-12 flex items-center gap-2">
            {displaySlides.map((_, idx) => (
              <button key={idx} onClick={() => setCurrent(idx)} className={`carousel-dot ${idx === current ? "active" : ""}`} />
            ))}
          </div>

          <div className="absolute bottom-0 left-0 right-0 h-1 bg-white/5">
            <div className="h-full bg-[#C9A227] transition-all duration-500 ease-out" style={{ width: `${((current + 1) / displaySlides.length) * 100}%` }} />
          </div>
        </div>
      </div>
    </section>
  );
}