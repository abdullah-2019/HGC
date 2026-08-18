"use client";

import { useEffect, useRef, useState } from "react";
import { ChevronDown, Briefcase } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

export default function ProjectsHero() {
  const { lang } = useI18n();
  const isRtl = lang === "dari" || lang === "pashto";
  const [scrollY, setScrollY] = useState(0);
  const bannerRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const handleScroll = () => setScrollY(window.scrollY);
    window.addEventListener("scroll", handleScroll, { passive: true });
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  const parallaxOffset = scrollY * 0.3;

  return (
    <section
      ref={bannerRef}
      dir={isRtl ? "rtl" : "ltr"}
      className="relative w-full overflow-hidden"
      style={{ height: "65vh", minHeight: 450, maxHeight: 700 }}
    >
      {/* Parallax Background */}
      <div
        className="absolute inset-0 w-full h-[120%]"
        style={{
          transform: `translateY(${parallaxOffset}px)`,
          willChange: "transform",
        }}
      >
        <div
          className="absolute inset-0 bg-cover bg-center bg-no-repeat"
          style={{
            backgroundImage: `url('${process.env.NEXT_PUBLIC_API_URL}/storage/uploads/project-hero.webp')`
          }}
        />
      </div>

      {/* 1. VIGNETTE OVERLAY: Only darkens edges & bottom where text sits, leaving center bright */}
      <div 
        className="absolute inset-0 pointer-events-none"
        style={{
          background: "radial-gradient(circle, rgba(15,43,91,0) 20%, rgba(15,43,91,0.4) 70%, rgba(15,43,91,0.7) 100%)"
        }}
      />

      {/* Gold accent line */}
      <div className="absolute top-0 left-0 right-0 h-[2px]">
        <div
          className="h-full w-full"
          style={{
            background: "linear-gradient(90deg, transparent, #D4AF37, transparent)",
            backgroundSize: "200% 100%",
            animation: "shimmerLine 3s ease-in-out infinite",
          }}
        />
      </div>

      {/* Content Container */}
      <div className="relative z-10 flex flex-col items-center justify-center h-full px-4 text-center">
        
        {/* Badge */}
        <div
          className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-900/60 backdrop-blur-sm border border-hgc-gold/30 mb-6"
          style={{ animation: "fadeInDown 1s ease-out 0.3s both" }}
        >
          <Briefcase className="w-4 h-4 text-hgc-gold" />
          <span className="text-hgc-gold text-sm font-medium tracking-wider uppercase">
            {lang === "en"
              ? "Portfolio"
              : lang === "dari"
                ? "نمونه کارها"
                : "پورټفولیو"}
          </span>
        </div>

        {/* 2. TITLE: Enhanced Drop Shadow + Text color update to stark white for better separation */}
        <h1
          className="text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-bold text-white mb-6 tracking-tight drop-shadow-[0_4px_12px_rgba(0,0,0,0.8)]"
          style={{
            animation: "fadeInUp 1s ease-out 0.5s both",
          }}
        >
          {lang === "en" ? (
            <>
              Our <span className="text-hgc-gold-bright drop-shadow-[0_2px_8px_rgba(0,0,0,0.9)]">Projects</span>
            </>
          ) : lang === "dari" ? (
            <>
              <span className="text-hgc-gold-bright drop-shadow-[0_2px_8px_rgba(0,0,0,0.9)]">پروژه‌های</span> ما
            </>
          ) : (
            <>
              زموږ <span className="text-hgc-gold-bright drop-shadow-[0_2px_8px_rgba(0,0,0,0.9)]">پروژې</span>
            </>
          )}
        </h1>

        {/* 3. DESCRIPTION: Contained within a subtle frosted-glass background plate */}
        <div 
          className="px-6 py-4 rounded-2xl bg-slate-900/40 backdrop-blur-[4px] border border-white/5 max-w-2xl mx-auto shadow-lg"
          style={{ animation: "fadeInUp 1s ease-out 0.7s both" }}
        >
          <p className="text-white text-base sm:text-lg leading-relaxed font-normal tracking-wide drop-shadow-[0_1px_3px_rgba(0,0,0,0.5)]">
            {lang === "en"
              ? "From national highways to solar power systems, explore our portfolio of transformative infrastructure across Afghanistan."
              : lang === "dari"
                ? "از بزرگراه‌های ملی تا سیستم‌های برق خورشیدی، نمونه کارهای زیرساخت‌های تحول‌آفرین ما را در سراسر افغانستان کاوش کنید."
                : "له ملي لویو لارو څخه تر سولري برق سیسټمونو پورې، زموږ د بدلون راوړونکو زیربناوونو پورټفولیو په افغانستان کې وګورئ."}
          </p>
        </div>

        {/* Scroll indicator */}
        <div
          className="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2"
          style={{ animation: "fadeInUp 1s ease-out 1.2s both" }}
        >
          <span className="text-white/80 text-xs tracking-widest uppercase drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
            {lang === "en" ? "Explore" : lang === "dari" ? "کاوش" : "وګورئ"}
          </span>
          <ChevronDown className="w-5 h-5 text-hgc-gold filter drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)] animate-bounce" />
        </div>
      </div>

      <style jsx>{`
        @keyframes fadeInUp {
          from {
            opacity: 0;
            transform: translateY(40px);
          }
          to {
            opacity: 1;
            transform: translateY(0);
          }
        }
        @keyframes fadeInDown {
          from {
            opacity: 0;
            transform: translateY(-20px);
          }
          to {
            opacity: 1;
            transform: translateY(0);
          }
        }
        @keyframes shimmerLine {
          0% {
            background-position: 200% 0;
          }
          100% {
            background-position: -200% 0;
          }
        }
      `}</style>
    </section>
  );
}