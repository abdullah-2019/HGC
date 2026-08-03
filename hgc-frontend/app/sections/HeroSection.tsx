"use client";

import Link from "next/link";
import { Star, ChevronLeft, ChevronRight } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import Particles from "@/app/components/Particles";
import { useState, useEffect, useCallback } from "react";

/* ── Slide Data ── */
const slides = [
  {
    image: "/images/hero-construction.webp",
    badge: {
      en: "Since 2001 — Building Afghanistan's Future",
      dari: "از سال ۲۰۰۱ — ساختن آینده افغانستان",
      pashto: "له ۲۰۰۱ کال راهیسې — د افغانستان راتلونکی جوړول",
    },
    title: {
      en: [
        { text: "Building ", highlight: false },
        { text: "Afghanistan's", highlight: true },
        { text: "\nFuture", highlight: false },
      ],
      dari: [
        { text: "", highlight: false },
        { text: "آینده", highlight: true },
        { text: " افغانستان", highlight: false },
        { text: "\nرا می سازیم", highlight: false },
      ],
      pashto: [
        { text: "د ", highlight: false },
        { text: "افغانستان", highlight: true },
        { text: "", highlight: false },
        { text: "\nراتلونکی جوړوو", highlight: false },
      ],
    },
    subtitle: {
      en: "Construction • Mining • Logistics • Financial Services — driving national development across 38+ provinces.",
      dari: "ساختمان • استخراج معادن • لوژستیک • خدمات مالی — توسعه ملی در ۳۸+ ولایت.",
      pashto: "ودانۍ • د کانونو استخراج • لوجستیک • مالي خدمات — ملي پراختیا په ۳۸+ ولایتونو کې.",
    },
  },
  {
    image: "/images/hero-mining.webp",
    badge: {
      en: "Responsible Mining Operations",
      dari: "عملیات مسئولانه استخراج معادن",
      pashto: "د مسؤلانه کانونو استخراج عملیات",
    },
    title: {
      en: [
        { text: "Extracting ", highlight: false },
        { text: "Value", highlight: true },
        { text: "\nFrom the Earth", highlight: false },
      ],
      dari: [
        { text: "استخراج ", highlight: false },
        { text: "ارزش", highlight: true },
        { text: "\nاز زمین", highlight: false },
      ],
      pashto: [
        { text: "د ځمکې څخه ", highlight: false },
        { text: "ارزښت", highlight: true },
        { text: "\nاستخراج", highlight: false },
      ],
    },
    subtitle: {
      en: "Sustainable mineral extraction powering Afghanistan's industrial growth and lasting economic impact.",
      dari: "استخراج پایدار مواد معدنی که رشد صنعتی افغانستان را تقویت می‌کند.",
      pashto: "د معدني موادو دوامداره استخراج چې د افغانستان صنعتي وده ځواکمنوي.",
    },
  },
  {
    image: "/images/hero-logistics.webp",
    badge: {
      en: "Nationwide Logistics Network",
      dari: "شبکه لوژستیک سراسری",
      pashto: "د ټول هیواد لوجستیک شبکه",
    },
    title: {
      en: [
        { text: "Connecting ", highlight: false },
        { text: "Every", highlight: true },
        { text: "\nProvince", highlight: false },
      ],
      dari: [
        { text: "اتصال ", highlight: false },
        { text: "هر", highlight: true },
        { text: "\nولایت", highlight: false },
      ],
      pashto: [
        { text: "د ", highlight: false },
        { text: "هر", highlight: true },
        { text: "\nولایت نښلول", highlight: false },
      ],
    },
    subtitle: {
      en: "Reliable transportation and supply chain solutions delivering across all 38+ provinces of Afghanistan.",
      dari: "حمل و نقل و زنجیره تأمین قابل اعتماد در سراسر ۳۸+ ولایت افغانستان.",
      pashto: "د باوري لیږد او عرضې زنځیر حلونه په ټولو ۳۸+ ولایتونو کې.",
    },
  },
];

export default function HeroSection() {
  const { lang } = useI18n();
  const [activeSlide, setActiveSlide] = useState(0);
  const [isPaused, setIsPaused] = useState(false);
  const [progress, setProgress] = useState(0);

  const SLIDE_DURATION = 6000;

  const nextSlide = useCallback(() => {
    setActiveSlide((prev) => (prev + 1) % slides.length);
    setProgress(0);
  }, []);

  const prevSlide = useCallback(() => {
    setActiveSlide((prev) => (prev - 1 + slides.length) % slides.length);
    setProgress(0);
  }, []);

  /* Auto-play with progress */
  useEffect(() => {
    if (isPaused) return;
    const start = Date.now();
    const timer = setInterval(() => {
      const elapsed = Date.now() - start;
      const pct = Math.min((elapsed / SLIDE_DURATION) * 100, 100);
      setProgress(pct);
      if (elapsed >= SLIDE_DURATION) nextSlide();
    }, 50);
    return () => clearInterval(timer);
  }, [isPaused, activeSlide, nextSlide]);

  const goTo = (idx: number) => {
    setActiveSlide(idx);
    setProgress(0);
  };

  const current = slides[activeSlide];

  return (
    <section
      className="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden select-none"
      onMouseEnter={() => setIsPaused(true)}
      onMouseLeave={() => setIsPaused(false)}
    >
      {/* ── Background Carousel with Ken Burns ── */}
      {slides.map((slide, idx) => {
        const isActive = idx === activeSlide;
        return (
          <div
            key={idx}
            className={`absolute inset-0 transition-opacity duration-1000 ease-[cubic-bezier(0.4,0,0.2,1)] ${isActive ? "opacity-100 z-[1]" : "opacity-0 z-0"
              }`}
          >
            <div
              className={`absolute inset-0 bg-cover bg-center transition-transform duration-[8000ms] ease-linear ${isActive ? "scale-110" : "scale-100"
                }`}
              style={{ backgroundImage: `url('${slide.image}')` }}
            />
            {/* Lighter overlays so images are visible */}
            <div className="absolute inset-0 bg-gradient-to-b from-[#0A1628]/40 via-[#0A1628]/30 to-[#0A1628]/70" />
            <div className="absolute inset-0 bg-gradient-to-r from-[#0A1628]/50 via-transparent to-[#0A1628]/50" />
          </div>
        );
      })}

      {/* Subtle grid overlay */}
      <div className="absolute inset-0 opacity-[0.07] pointer-events-none z-[2]">
        <div
          className="absolute inset-0"
          style={{
            backgroundImage: `linear-gradient(rgba(201,162,39,0.4) 1px, transparent 1px), linear-gradient(90deg, rgba(201,162,39,0.4) 1px, transparent 1px)`,
            backgroundSize: "80px 80px",
          }}
        />
      </div>

      <div className="absolute inset-0 z-[2] pointer-events-none">
        <Particles count={25} />
      </div>

      {/* ── Arrow Navigation ── */}
      <button
        onClick={prevSlide}
        className="absolute left-6 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full border border-white/10 bg-white/5 text-white/70 hover:text-white hover:bg-white/10 hover:border-[#C9A227]/40 transition-all duration-300 backdrop-blur-md hidden sm:flex items-center justify-center group"
        aria-label="Previous slide"
      >
        <ChevronLeft className="w-5 h-5 group-hover:-translate-x-0.5 transition-transform" />
      </button>
      <button
        onClick={nextSlide}
        className="absolute right-6 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full border border-white/10 bg-white/5 text-white/70 hover:text-white hover:bg-white/10 hover:border-[#C9A227]/40 transition-all duration-300 backdrop-blur-md hidden sm:flex items-center justify-center group"
        aria-label="Next slide"
      >
        <ChevronRight className="w-5 h-5 group-hover:translate-x-0.5 transition-transform" />
      </button>

      {/* ── Content ── */}
      <div className="relative z-10 max-w-5xl mx-auto px-6 sm:px-8 text-center">
        {/* Badge */}
        <div
          key={`badge-${activeSlide}`}
          className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#C9A227]/10 border border-[#C9A227]/20 mb-6 sm:mb-8 animate-[fadeInUp_0.6s_ease-out_both]"
        >
          <Star className="w-3.5 h-3.5 text-[#C9A227]" />
          <span className="text-[#C9A227] text-xs sm:text-sm font-medium tracking-wide uppercase">
            {current.badge[lang]}
          </span>
        </div>

        {/* Title — smaller, more refined */}
        <h1
          key={`title-${activeSlide}`}
          className="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-5 sm:mb-6 leading-[1.1] tracking-tight animate-[fadeInUp_0.6s_ease-out_0.1s_both]"
        >
          {current.title[lang].map((part, i) =>
            part.text === "\n" ? (
              <br key={i} />
            ) : (
              <span
                key={i}
                className={part.highlight ? "text-[#C9A227]" : ""}
              >
                {part.text}
              </span>
            )
          )}
        </h1>

        {/* Subtitle */}
        <p
          key={`subtitle-${activeSlide}`}
          className="text-base sm:text-lg text-white/70 max-w-2xl mx-auto leading-relaxed animate-[fadeInUp_0.6s_ease-out_0.2s_both]"
        >
          {current.subtitle[lang]}
        </p>
      </div>

      {/* ── Bottom Controls ── */}
      <div className="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex flex-col items-center gap-4">
        {/* Progress Dots */}
        <div className="flex items-center gap-3">
          {slides.map((_, idx) => (
            <button
              key={idx}
              onClick={() => goTo(idx)}
              className="relative h-1 rounded-full overflow-hidden transition-all duration-300 bg-white/20"
              style={{ width: idx === activeSlide ? 48 : 8 }}
              aria-label={`Go to slide ${idx + 1}`}
            >
              {idx === activeSlide && (
                <div
                  className="absolute inset-y-0 left-0 bg-[#C9A227] rounded-full transition-all duration-100 ease-linear"
                  style={{ width: `${progress}%` }}
                />
              )}
            </button>
          ))}
        </div>

        {/* Slide counter */}
        <div className="text-[10px] sm:text-xs font-medium text-white/30 tracking-[0.2em] uppercase">
          <span className="text-white/60">0{activeSlide + 1}</span>
          <span className="mx-2">/</span>
          <span>0{slides.length}</span>
        </div>
      </div>

      {/* Bottom vignette for depth */}
      <div className="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-[#0A1628] to-transparent z-[5] pointer-events-none" />
    </section>
  );
}