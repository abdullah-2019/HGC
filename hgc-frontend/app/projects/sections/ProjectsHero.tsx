"use client";

import { useEffect, useRef, useState } from "react";
import { ChevronDown, Briefcase } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

export default function ProjectsHero() {
  const { lang, dir } = useI18n();
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

      {/* Overlays */}
      {/* <div className="absolute inset-0 bg-[#0A1628]/70" />
      <div
        className="absolute inset-0"
        style={{
          background:
            "linear-gradient(to bottom, rgba(10,22,40,0.2) 0%, rgba(10,22,40,0.8) 70%, #0A1628 100%)",
        }}
      /> */}

      {/* Gold accent line */}
      <div className="absolute top-0 left-0 right-0 h-[2px]">
        <div
          className="h-full w-full"
          style={{
            background: "linear-gradient(90deg, transparent, #C9A227, transparent)",
            backgroundSize: "200% 100%",
            animation: "shimmerLine 3s ease-in-out infinite",
          }}
        />
      </div>

      {/* Content */}
      <div className="relative z-10 flex flex-col items-center justify-center h-full px-4 text-center">
        <div
          className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#C9A227]/10 border border-[#C9A227]/20 mb-6"
          style={{ animation: "fadeInDown 1s ease-out 0.3s both" }}
        >
          <Briefcase className="w-4 h-4 text-[#C9A227]" />
          <span className="text-[#C9A227] text-sm font-medium tracking-wider uppercase">
            {lang === "en"
              ? "Portfolio"
              : lang === "dari"
                ? "نمونه کارها"
                : "پورټفولیو"}
          </span>
        </div>

        <h1
          className="text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-bold text-white mb-6 tracking-tight"
          style={{
            animation: "fadeInUp 1s ease-out 0.5s both",
            textShadow: "0 4px 30px rgba(0,0,0,0.3)",
          }}
        >
          {lang === "en" ? (
            <>
              Our <span className="text-[#C9A227]">Projects</span>
            </>
          ) : lang === "dari" ? (
            <>
              <span className="text-[#C9A227]">پروژه‌های</span> ما
            </>
          ) : (
            <>
              زموږ <span className="text-[#C9A227]">پروژې</span>
            </>
          )}
        </h1>

        <p
          className="text-lg sm:text-xl text-white/60 max-w-2xl leading-relaxed"
          style={{ animation: "fadeInUp 1s ease-out 0.7s both" }}
        >
          {lang === "en"
            ? "From national highways to solar power systems, explore our portfolio of transformative infrastructure across Afghanistan."
            : lang === "dari"
              ? "از بزرگراه‌های ملی تا سیستم‌های برق خورشیدی، نمونه کارهای زیرساخت‌های تحول‌آفرین ما را در سراسر افغانستان کاوش کنید."
              : "له ملي لویو لارو څخه تر سولري برق سیسټمونو پورې، زموږ د بدلون راوړونکو زیربناوونو پورټفولیو په افغانستان کې وګورئ."}
        </p>

        {/* Scroll indicator */}
        <div
          className="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2"
          style={{ animation: "fadeInUp 1s ease-out 1.2s both" }}
        >
          <span className="text-white/40 text-xs tracking-widest uppercase">
            {lang === "en" ? "Explore" : lang === "dari" ? "کاوش" : "وګورئ"}
          </span>
          <ChevronDown className="w-5 h-5 text-[#C9A227] animate-bounce" />
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