"use client";

import { Star, ChevronLeft, ChevronRight } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import Particles from "@/app/components/Particles";
import { useState, useEffect, useCallback, useRef } from "react";

const SLIDE_DURATION = 5000;

const slides = [
  {
    image: "/images/hero-construction.webp",
    kenBurns: "zoom-in", // or "zoom-out", "pan-left", "pan-right"
    badge: {
      en: "Since 2001 — Building Afghanistan's Future",
      dari: "از سال ۲۰۰۱ — ساختن آینده افغانستان",
      pashto: "له ۲۰۰۱ کال راهیسې — د افغانستان راتلونکی جوړول",
    },
    title: {
      en: ["Building ", "Afghanistan's", "\nFuture"],
      dari: ["", "آینده", " افغانستان", "\nرا می سازیم"],
      pashto: ["د ", "افغانستان", "", "\nراتلونکی جوړوو"],
    },
    highlights: { en: [1], dari: [1], pashto: [1] },
    subtitle: {
      en: "Construction • Mining • Logistics • Financial Services — driving national development across 38+ provinces.",
      dari: "ساختمان • استخراج معادن • لوژستیک • خدمات مالی — توسعه ملی در ۳۸+ ولایت.",
      pashto: "ودانۍ • د کانونو استخراج • لوجستیک • مالي خدمات — ملي پراختیا په ۳۸+ ولایتونو کې.",
    },
  },
  {
    image: "/images/contact-hero.webp",
    kenBurns: "pan-right",
    badge: {
      en: "Responsible Mining Operations",
      dari: "عملیات مسئولانه استخراج معادن",
      pashto: "د مسؤلانه کانونو استخراج عملیات",
    },
    title: {
      en: ["Extracting ", "Value", "\nFrom the Earth"],
      dari: ["استخراج ", "ارزش", "\nاز زمین"],
      pashto: ["د ځمکې څخه ", "ارزښت", "\nاستخراج"],
    },
    highlights: { en: [1], dari: [1], pashto: [1] },
    subtitle: {
      en: "Sustainable mineral extraction powering Afghanistan's industrial growth and lasting economic impact.",
      dari: "استخراج پایدار مواد معدنی که رشد صنعتی افغانستان را تقویت می‌کند.",
      pashto: "د معدني موادو دوامداره استخراج چې د افغانستان صنعتي وده ځواکمنوي.",
    },
  },
  {
    image: "/images/hero-logistics.webp",
    kenBurns: "zoom-out",
    badge: {
      en: "Nationwide Logistics Network",
      dari: "شبکه لوژستیک سراسری",
      pashto: "د ټول هیواد لوجستیک شبکه",
    },
    title: {
      en: ["Connecting ", "Every", "\nProvince"],
      dari: ["اتصال ", "هر", "\nولایت"],
      pashto: ["د ", "هر", "\nولایت نښلول"],
    },
    highlights: { en: [1], dari: [1], pashto: [1] },
    subtitle: {
      en: "Reliable transportation and supply chain solutions delivering across all 38+ provinces of Afghanistan.",
      dari: "حمل و نقل و زنجیره تأمین قابل اعتماد در سراسر ۳۸+ ولایت افغانستان.",
      pashto: "د باوري لیږد او عرضې زنځیر حلونه په ټولو ۳۸+ ولایتونو کې.",
    },
  },
];

/* ── Ken Burns keyframe helper (per-slide) ── */
const getKenBurnsClass = (type: string) => {
  switch (type) {
    case "zoom-in":
      return "animate-[kenBurnsIn_10s_ease-out_forwards]";
    case "zoom-out":
      return "animate-[kenBurnsOut_10s_ease-out_forwards]";
    case "pan-right":
      return "animate-[kenBurnsRight_10s_ease-out_forwards]";
    case "pan-left":
      return "animate-[kenBurnsLeft_10s_ease-out_forwards]";
    default:
      return "animate-[kenBurnsIn_10s_ease-out_forwards]";
  }
};

export default function HeroSection() {
  const { lang } = useI18n();
  const [active, setActive] = useState(0);
  const [isPaused, setIsPaused] = useState(false);
  const [direction, setDirection] = useState<"next" | "prev">("next");
  const progressRef = useRef<HTMLDivElement>(null);

  const goTo = useCallback(
    (idx: number, dir: "next" | "prev" = "next") => {
      setDirection(dir);
      setActive(idx);
    },
    []
  );

  const next = useCallback(() => {
    setDirection("next");
    setActive((p) => (p + 1) % slides.length);
  }, []);

  const prev = useCallback(() => {
    setDirection("prev");
    setActive((p) => (p - 1 + slides.length) % slides.length);
  }, []);

  /* Autoplay */
  useEffect(() => {
    if (isPaused) return;
    const t = setInterval(next, SLIDE_DURATION);
    return () => clearInterval(t);
  }, [isPaused, next]);

  const current = slides[active];

  return (
    <section
      className="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden select-none"
      onMouseEnter={() => setIsPaused(true)}
      onMouseLeave={() => setIsPaused(false)}
    >
      {/* ── Background Layers ── */}
      {slides.map((slide, idx) => {
        const isActive = idx === active;
        const isPrev =
          idx === (active - 1 + slides.length) % slides.length;
        const isNext = idx === (active + 1) % slides.length;
        const isLeaving = isPrev || isNext;

        /* 
         * EXIT TRANSFORMS:
         * When navigating NEXT, the previous slide exits left (scale up + pan left).
         * When navigating PREV, the next slide exits right (scale up + pan right).
         */
        const exitTransform =
          isPrev && direction === "next"
            ? "scale-[1.12] -translate-x-[8%] opacity-0"
            : isNext && direction === "prev"
              ? "scale-[1.12] translate-x-[8%] opacity-0"
              : "scale-105 opacity-0";

        return (
          <div
            key={idx}
            className={`absolute inset-0 will-change-transform transition-all duration-[1400ms] ease-[cubic-bezier(0.4,0,0.2,1)] ${
              isActive
                ? "opacity-100 z-[1] scale-100 translate-x-0"
                : isLeaving
                  ? exitTransform
                  : "opacity-0 z-0 scale-105"
            }`}
          >
            {/* 
              Image with Ken Burns — ALWAYS animating, not just when active.
              This ensures the animation state is preserved so when a slide
              returns it doesn't jump from a reset position.
            */}
            <div
              className={`absolute inset-[-5%] w-[110%] h-[110%] bg-cover bg-center will-change-transform ${getKenBurnsClass(
                slide.kenBurns
              )}`}
              style={{ backgroundImage: `url('${slide.image}')` }}
            />
          </div>
        );
      })}

      {/* Overlays — lighter so images show through */}
      <div className="absolute inset-0 z-[2] bg-gradient-to-b from-[#0A1628]/50 via-[#0A1628]/30 to-[#0A1628]/80" />
      <div className="absolute inset-0 z-[2] bg-gradient-to-r from-[#0A1628]/60 via-transparent to-[#0A1628]/60" />

      {/* Grid + Particles */}
      <div className="absolute inset-0 z-[3] opacity-[0.06] pointer-events-none">
        <div
          className="absolute inset-0"
          style={{
            backgroundImage: `linear-gradient(rgba(201,162,39,0.35) 1px, transparent 1px), linear-gradient(90deg, rgba(201,162,39,0.35) 1px, transparent 1px)`,
            backgroundSize: "80px 80px",
          }}
        />
      </div>
      <div className="absolute inset-0 z-[3] pointer-events-none">
        <Particles count={20} />
      </div>

      {/* ── Arrows ── */}
      <button
        onClick={prev}
        className="absolute left-6 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full border border-white/10 bg-white/[0.03] text-white/50 hover:text-white hover:bg-white/10 hover:border-[#C9A227]/30 transition-all duration-300 backdrop-blur-md hidden sm:flex items-center justify-center group"
        aria-label="Previous"
      >
        <ChevronLeft className="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" />
      </button>
      <button
        onClick={next}
        className="absolute right-6 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full border border-white/10 bg-white/[0.03] text-white/50 hover:text-white hover:bg-white/10 hover:border-[#C9A227]/30 transition-all duration-300 backdrop-blur-md hidden sm:flex items-center justify-center group"
        aria-label="Next"
      >
        <ChevronRight className="w-4 h-4 group-hover:translate-x-0.5 transition-transform" />
      </button>

      {/* ── Content ── */}
      <div className="relative z-10 max-w-4xl mx-auto px-6 text-center">
        {/* Badge */}
        <div
          key={`b-${active}`}
          className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#C9A227]/10 border border-[#C9A227]/20 mb-6 overflow-hidden"
        >
          <div className="animate-[slideDown_0.5s_ease-out_both] flex items-center gap-2">
            <Star className="w-3.5 h-3.5 text-[#C9A227]" />
            <span className="text-[#C9A227] text-xs font-medium tracking-widest uppercase">
              {current.badge[lang]}
            </span>
          </div>
        </div>

        {/* Title — cinematic line reveal */}
        <div className="overflow-hidden mb-5">
          <h1
            key={`t-${active}`}
            className="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-[1.1] tracking-tight animate-[slideUp_0.7s_ease-out_0.1s_both]"
          >
            {current.title[lang].map((part, i) =>
              part === "\n" ? (
                <br key={i} />
              ) : (
                <span
                  key={i}
                  className={
                    current.highlights[lang].includes(i)
                      ? "text-[#C9A227]"
                      : ""
                  }
                >
                  {part}
                </span>
              )
            )}
          </h1>
        </div>

        {/* Subtitle */}
        <div className="overflow-hidden">
          <p
            key={`s-${active}`}
            className="text-base sm:text-lg text-white/70 max-w-2xl mx-auto leading-relaxed animate-[slideUp_0.7s_ease-out_0.25s_both]"
          >
            {current.subtitle[lang]}
          </p>
        </div>
      </div>

      {/* ── Bottom Controls ── */}
      <div className="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex flex-col items-center gap-5">
        {/* Progress Dots */}
        <div className="flex items-center gap-2.5">
          {slides.map((_, idx) => (
            <button
              key={idx}
              onClick={() => goTo(idx, idx > active ? "next" : "prev")}
              className="group relative h-[3px] rounded-full overflow-hidden bg-white/15 transition-all duration-500 hover:bg-white/25"
              style={{ width: idx === active ? 56 : 10 }}
              aria-label={`Slide ${idx + 1}`}
            >
              {idx === active && (
                <div
                  ref={idx === active ? progressRef : null}
                  className="absolute inset-y-0 left-0 bg-[#C9A227] rounded-full"
                  style={{
                    animation: isPaused
                      ? "none"
                      : `progress ${SLIDE_DURATION}ms linear forwards`,
                  }}
                />
              )}
            </button>
          ))}
        </div>

        {/* Counter */}
        <div className="flex items-center gap-3 text-[11px] font-medium tracking-[0.25em] text-white/30 uppercase">
          <span className="text-white/70 tabular-nums">0{active + 1}</span>
          <span className="w-8 h-px bg-white/20" />
          <span className="tabular-nums">0{slides.length}</span>
        </div>
      </div>

      {/* Bottom vignette */}
      <div className="absolute bottom-0 left-0 right-0 h-40 bg-gradient-to-t from-[#0A1628] via-[#0A1628]/50 to-transparent z-[5] pointer-events-none" />
    </section>
  );
}