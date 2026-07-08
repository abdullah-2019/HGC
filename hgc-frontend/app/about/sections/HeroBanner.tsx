"use client";

import Image from "next/image";
import { ChevronDown } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

export default function HeroBanner() {
  const { lang } = useI18n();

  return (
    <section className="about-section relative w-full h-[70vh] min-h-[500px] max-h-[800px] overflow-hidden">
      {/* Background Image - Using Next.js Image */}
      <div className="absolute inset-0">
        <Image
          src="http://localhost:8000/storage/uploads/hero-construction.webp"
          alt="Hero background"
          fill
          className="object-cover"
          style={{ transform: "scale(1.1)" }}
          priority
          unoptimized
        />
        {/* Dark Overlay */}
        <div className="absolute inset-0 bg-gradient-to-b from-[#0A1628]/60 via-[#0A1628]/50 to-[#0A1628]" />
        <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(201,162,39,0.08)_0%,_transparent_70%)]" />
      </div>


      {/* Grid Pattern Overlay */}
      <div className="absolute inset-0 grid-pattern opacity-50" />

      {/* Content */}
      <div className="relative z-10 h-full flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8">
        <div className="text-center max-w-4xl mx-auto">
          {/* Label */}
          <div className="reveal-text inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#C9A227]/10 border border-[#C9A227]/20 mb-8">
            <span className="w-2 h-2 rounded-full bg-[#C9A227] animate-pulse" />
            <span className="text-[#C9A227] text-sm font-medium tracking-wide uppercase">
              {lang === "en" ? "Since 2001" : lang === "dari" ? "از سال ۲۰۰۱" : "له ۲۰۰۱ کال راهیسې"}
            </span>
          </div>

          {/* Title */}
          <h1 className="about-hero-title font-bold text-white mb-6 reveal-text reveal-text-delay-1">
            {lang === "en" ? (
              <>
                Building <span className="text-gold-gradient">Afghanistan's</span> Future
              </>
            ) : lang === "dari" ? (
              <>
                <span className="text-gold-gradient">آینده</span> افغانستان را می‌سازیم
              </>
            ) : (
              <>
                د <span className="text-gold-gradient">افغانستان</span> راتلونکی جوړوو
              </>
            )}
          </h1>

          {/* Subtitle */}
          <p className="about-body-text text-white/60 max-w-2xl mx-auto mb-12 reveal-text reveal-text-delay-2">
            {lang === "en"
              ? "A legacy of excellence spanning over two decades — from construction and mining to logistics and financial services, we are the force behind Afghanistan's infrastructure transformation."
              : lang === "dari"
                ? "میراث excellence بیش از دو دهه — از ساختمان و استخراج معادن تا لوژستیک و خدمات مالی، ما نیروی پشتوانه تحول زیرساخت‌های افغانستان هستیم."
                : "د دوو لسیزو زیاته د عالي کیفیت میراث — له جوړونې او د کانونو استخراج څخه تر لوجستیک او مالي خدماتو پورې، موږ د افغانستان د زیربنو د بدلون ځواک یو."}
          </p>

          {/* Gold Line */}
          <div className="gold-line mx-auto mb-8 reveal-text reveal-text-delay-3" />
        </div>

        {/* Scroll Indicator */}
        <div className="absolute bottom-8 left-1/2 -translate-x-1/2 scroll-indicator reveal-text reveal-text-delay-4">
          <ChevronDown className="w-6 h-6 text-[#C9A227]/60" />
        </div>
      </div>
    </section>
  );
}