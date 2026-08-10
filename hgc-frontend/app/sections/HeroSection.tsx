"use client";

import { Star, ChevronLeft, ChevronRight, Loader2 } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import Particles from "@/app/components/Particles";
import { useState, useEffect, useCallback, useRef } from "react";

const SLIDE_DURATION = 5000;

interface Slide {
  id: number;
  image: string;
  ken_burns: string;
  badge: string;
  title: string[];
  highlights: number[];
  subtitle: string;
}

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
  const [slides, setSlides] = useState<Slide[]>([]);
  const [active, setActive] = useState(0);
  const [isPaused, setIsPaused] = useState(false);
  const [direction, setDirection] = useState<"next" | "prev">("next");
  const [loading, setLoading] = useState(true);
  const progressRef = useRef<HTMLDivElement>(null);

  /* Fetch slides from API — re-fetches when language changes */
  useEffect(() => {
    const fetchSlides = async () => {
      try {
        setLoading(true);
        const apiUrl = `${process.env.NEXT_PUBLIC_API_URL}/api/hero-slides?lang=${lang}`;
        const res = await fetch(apiUrl, {
          headers: { Accept: "application/json" },
        });

        if (!res.ok) throw new Error(`HTTP ${res.status}`);

        const contentType = res.headers.get("content-type");
        if (!contentType?.includes("application/json")) {
          const text = await res.text();
          throw new Error(`Expected JSON, got: ${text.substring(0, 100)}`);
        }

        const json = await res.json();
        if (json.success) {
          setSlides(json.data);
          setActive(0);
        }
      } catch (err) {
        console.error("Hero slides fetch error:", err);
        setSlides([]);
      } finally {
        setLoading(false);
      }
    };

    fetchSlides();
  }, [lang]);

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
  }, [slides.length]);

  const prev = useCallback(() => {
    setDirection("prev");
    setActive((p) => (p - 1 + slides.length) % slides.length);
  }, [slides.length]);

  /* Autoplay */
  useEffect(() => {
    if (isPaused || slides.length === 0) return;
    const t = setInterval(next, SLIDE_DURATION);
    return () => clearInterval(t);
  }, [isPaused, next, slides.length]);

  /* Loading state */
  if (loading) {
    return (
      <section className="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden select-none bg-[#0F2B5B]">
        <Loader2 className="w-10 h-10 text-[#D4AF37] animate-spin" />
      </section>
    );
  }

  /* Empty state */
  if (slides.length === 0) {
    return (
      <section className="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden select-none bg-[#0F2B5B]">
        <p className="text-white/50 text-sm">No slides available</p>
      </section>
    );
  }

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

        const exitTransform =
          isPrev && direction === "next"
            ? "scale-[1.12] -translate-x-[8%] opacity-0"
            : isNext && direction === "prev"
              ? "scale-[1.12] translate-x-[8%] opacity-0"
              : "scale-105 opacity-0";

        return (
          <div
            key={slide.id}
            className={`absolute inset-0 will-change-transform transition-all duration-[1400ms] ease-[cubic-bezier(0.4,0,0.2,1)] ${
              isActive
                ? "opacity-100 z-[1] scale-100 translate-x-0"
                : isLeaving
                  ? exitTransform
                  : "opacity-0 z-0 scale-105"
            }`}
          >
            <div
              className={`absolute inset-[-5%] w-[110%] h-[110%] bg-cover bg-center will-change-transform ${getKenBurnsClass(
                slide.ken_burns
              )}`}
              style={{ backgroundImage: `url('${slide.image}')` }}
            />
          </div>
        );
      })}

      {/* Dark overlay so white text stays readable */}
      <div className="absolute inset-0 z-[2] bg-gradient-to-b from-[#0F2B5B]/60 via-[#0F2B5B]/30 to-[#0F2B5B]/80" />
      {/* Grid + Particles */}
      <div className="absolute inset-0 z-[3] opacity-[0.06] pointer-events-none">
        <div
          className="absolute inset-0"
          style={{
            backgroundImage: `linear-gradient(rgba(212,175,55,0.4) 1px, transparent 1px), linear-gradient(90deg, rgba(212,175,55,0.4) 1px, transparent 1px)`,
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
        className="absolute left-6 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full border border-white/10 bg-white/[0.03] text-white/50 hover:text-white hover:bg-white/10 hover:border-[#D4AF37]/30 transition-all duration-300 backdrop-blur-md hidden sm:flex items-center justify-center group"
        aria-label="Previous"
      >
        <ChevronLeft className="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" />
      </button>
      <button
        onClick={next}
        className="absolute right-6 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full border border-white/10 bg-white/[0.03] text-white/50 hover:text-white hover:bg-white/10 hover:border-[#D4AF37]/30 transition-all duration-300 backdrop-blur-md hidden sm:flex items-center justify-center group"
        aria-label="Next"
      >
        <ChevronRight className="w-4 h-4 group-hover:translate-x-0.5 transition-transform" />
      </button>

      {/* ── Content ── */}
      <div className="relative z-10 max-w-4xl mx-auto px-6 text-center">
        {/* Badge */}
        <div
          key={`b-${active}`}
          className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#D4AF37]/10 border border-[#D4AF37]/20 mb-6 overflow-hidden"
        >
          <div className="animate-[slideDown_0.5s_ease-out_both] flex items-center gap-2">
            <Star className="w-3.5 h-3.5 text-[#D4AF37]" />
            <span className="text-[#D4AF37] text-xs font-medium tracking-widest uppercase">
              {current.badge}
            </span>
          </div>
        </div>

        {/* Title — FIXED: spaces inserted between parts automatically */}
        <div className="overflow-hidden mb-5">
          <h1
            key={`t-${active}`}
            className="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-[1.1] tracking-tight animate-[slideUp_0.7s_ease-out_0.1s_both]"
          >
            {current.title.map((part, i) => {
              if (part === "") return <br key={i} />;

              const isLast = i === current.title.length - 1;
              const nextIsEmpty = !isLast && current.title[i + 1] === "";

              return (
                <span key={i}>
                  <span
                    className={
                      current.highlights.includes(i)
                        ? "text-[#D4AF37]"
                        : ""
                    }
                  >
                    {part}
                  </span>
                  {!isLast && !nextIsEmpty && " "}
                </span>
              );
            })}
          </h1>
        </div>

        {/* Subtitle */}
        <div className="overflow-hidden">
          <p
            key={`s-${active}`}
            className="text-base sm:text-lg text-white/70 max-w-2xl mx-auto leading-relaxed animate-[slideUp_0.7s_ease-out_0.25s_both]"
          >
            {current.subtitle}
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
                  className="absolute inset-y-0 left-0 bg-[#D4AF37] rounded-full"
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
    </section>
  );
}