"use client";

import Link from "next/link";
import { ArrowRight, Phone, Star, ChevronLeft, ChevronRight } from "lucide-react";
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
      en: "Construction • Mining • Logistics • Financial Services — A diversified conglomerate driving national development across 38+ provinces.",
      dari: "ساختمان • استخراج معادن • لوژستیک • خدمات مالی — یک گروپ متنوع که توسعه ملی را در بیش از ۳۸ ولایت هدایت می کند.",
      pashto: "ودانۍ • د کانونو استخراج • لوجستیک • مالي خدمات — یو متنوع ګروپ چې په ۳۸+ ولایتونو کې ملي پراختیا رهبري کوي.",
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
      en: "Sustainable mineral extraction and processing that powers Afghanistan's industrial growth and creates lasting economic impact.",
      dari: "استخراج و فرآوری پایدار مواد معدنی که رشد صنعتی افغانستان را تقویت می کند و تأثیر اقتصادی پایدار ایجاد می کند.",
      pashto: "د معدني موادو دوامداره استخراج او پروسس چې د افغانستان صنعتي وده ځواکمنوي او دوامداره اقتصادي اغیز رامنځته کوي.",
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
      en: "Reliable transportation and supply chain solutions delivering materials and goods across all 38+ provinces of Afghanistan.",
      dari: "راه حل‌های قابل اعتماد حمل و نقل و زنجیره تأمین که مواد و کالاها را در سراسر ۳۸+ ولایت افغانستان تحویل می دهد.",
      pashto: "د باوري لیږد او د عرضې زنځیر حلونه چې مواد او توکي په افغانستان کې په ټولو ۳۸+ ولایتونو کې ورسوي.",
    },
  },
];

export default function HeroSection() {
  const { lang } = useI18n();
  const [activeSlide, setActiveSlide] = useState(0);
  const [isPaused, setIsPaused] = useState(false);

  const nextSlide = useCallback(() => {
    setActiveSlide((prev) => (prev + 1) % slides.length);
  }, []);

  const prevSlide = useCallback(() => {
    setActiveSlide((prev) => (prev - 1 + slides.length) % slides.length);
  }, []);

  /* Auto-play every 6 seconds */
  useEffect(() => {
    if (isPaused) return;
    const timer = setInterval(nextSlide, 6000);
    return () => clearInterval(timer);
  }, [isPaused, nextSlide]);

  const current = slides[activeSlide];

  return (
    <section
      className="relative min-h-screen flex items-center justify-center overflow-hidden"
      onMouseEnter={() => setIsPaused(true)}
      onMouseLeave={() => setIsPaused(false)}
    >
      {/* ── Background Carousel ── */}
      {slides.map((slide, idx) => (
        <div
          key={idx}
          className={`absolute inset-0 transition-opacity duration-1000 ease-in-out ${idx === activeSlide ? "opacity-100" : "opacity-0"
            }`}
        >
          <div
            className="absolute inset-0 bg-cover bg-center"
            style={{ backgroundImage: `url('${slide.image}')` }}
          />
          <div className="absolute inset-0 bg-[#0A1628]/85" />
          <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_transparent_0%,_#0A1628_70%)]" />
        </div>
      ))}

      {/* Grid overlay */}
      <div className="absolute inset-0 opacity-10 pointer-events-none">
        <div
          className="absolute inset-0"
          style={{
            backgroundImage: `linear-gradient(rgba(201,162,39,0.3) 1px, transparent 1px), linear-gradient(90deg, rgba(201,162,39,0.3) 1px, transparent 1px)`,
            backgroundSize: "60px 60px",
          }}
        />
      </div>

      <Particles count={30} />

      {/* ── Arrow Navigation ── */}
      <button
        onClick={prevSlide}
        className="absolute left-4 top-1/2 -translate-y-1/2 z-20 p-3 rounded-full bg-white/5 border border-white/10 text-white hover:bg-white/10 hover:border-[#C9A227]/50 transition-all duration-300 backdrop-blur-sm hidden sm:flex items-center justify-center"
        aria-label="Previous slide"
      >
        <ChevronLeft className="w-5 h-5" />
      </button>
      <button
        onClick={nextSlide}
        className="absolute right-4 top-1/2 -translate-y-1/2 z-20 p-3 rounded-full bg-white/5 border border-white/10 text-white hover:bg-white/10 hover:border-[#C9A227]/50 transition-all duration-300 backdrop-blur-sm hidden sm:flex items-center justify-center"
        aria-label="Next slide"
      >
        <ChevronRight className="w-5 h-5" />
      </button>

      {/* ── Content ── */}
      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {/* Badge */}
        <div
          key={`badge-${activeSlide}`}
          className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#C9A227]/10 border border-[#C9A227]/20 mb-8 animate-fade-in"
        >
          <Star className="w-4 h-4 text-[#C9A227]" />
          <span className="text-[#C9A227] text-sm font-medium">
            {current.badge[lang]}
          </span>
        </div>

        {/* Title */}
        <h1
          key={`title-${activeSlide}`}
          className="text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-bold text-white mb-6 leading-tight tracking-tight animate-fade-in-up"
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
          className="text-xl text-white/60 max-w-3xl mx-auto mb-12 leading-relaxed animate-fade-in-up"
          style={{ animationDelay: "100ms" }}
        >
          {current.subtitle[lang]}
        </p>

        {/* CTAs */}
        <div
          key={`ctas-${activeSlide}`}
          className="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up"
          style={{ animationDelay: "200ms" }}
        >
          <Link
            href="/projects"
            className="group flex items-center gap-2 px-8 py-4 bg-[#C9A227] text-[#0A1628] font-bold rounded-xl hover:bg-[#C9A227]/90 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-[#C9A227]/20"
          >
            {t(lang, "common.viewProjects")}
            <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
          </Link>
          <Link
            href="/contact"
            className="flex items-center gap-2 px-8 py-4 border-2 border-white/20 text-white font-semibold rounded-xl hover:bg-white/5 hover:border-[#C9A227]/50 transition-all duration-300"
          >
            <Phone className="w-5 h-5" />
            {t(lang, "common.contactUs")}
          </Link>
        </div>
      </div>

      {/* ── Dot Indicators ── */}
      <div className="absolute bottom-24 left-1/2 -translate-x-1/2 z-20 flex items-center gap-3">
        {slides.map((_, idx) => (
          <button
            key={idx}
            onClick={() => setActiveSlide(idx)}
            className={`relative h-2 rounded-full transition-all duration-500 ${idx === activeSlide
                ? "w-8 bg-[#C9A227]"
                : "w-2 bg-white/30 hover:bg-white/50"
              }`}
            aria-label={`Go to slide ${idx + 1}`}
          >
            {idx === activeSlide && (
              <span className="absolute inset-0 rounded-full bg-[#C9A227] animate-pulse opacity-50" />
            )}
          </button>
        ))}
      </div>

      {/* Scroll indicator */}
      <div className="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 animate-bounce">
        <div className="w-6 h-10 rounded-full border-2 border-white/20 flex items-start justify-center p-2">
          <div className="w-1.5 h-3 bg-[#C9A227] rounded-full animate-pulse" />
        </div>
      </div>
    </section>
  );
}