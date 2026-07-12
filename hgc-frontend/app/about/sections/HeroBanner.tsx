"use client";

import Image from "next/image";
import { ChevronDown } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { getText, safeString } from "./about-utils";

interface LocalizedText {
  en: string | null;
  dari: string | null;
  pashto: string | null;
}

interface HeroData {
  backgroundImage: string;
  label: LocalizedText;
  title: LocalizedText;
  subtitle: LocalizedText;
}

interface HeroSettings {
  hero: HeroData;
}

interface HeroBannerProps {
  settings: HeroSettings | null;
}

const fallbackHero: HeroData = {
  label: { en: "Since 2001", dari: "از سال ۲۰۰۱", pashto: "له ۲۰۰۱ کال راهیسې" },
  title: { en: "Building Afghanistan's Future", dari: "آینده افغانستان را می‌سازیم", pashto: "د افغانستان راتلونکی جوړوو" },
  subtitle: {
    en: "A legacy of excellence spanning over two decades — from construction and mining to logistics and financial services, we are the force behind Afghanistan's infrastructure transformation.",
    dari: "میراث excellence بیش از دو دهه — از ساختمان و استخراج معادن تا لوژستیک و خدمات مالی، ما نیروی پشتوانه تحول زیرساخت‌های افغانستان هستیم.",
    pashto: "د دوو لسیزو زیاته د عالي کیفیت میراث — له جوړونې او د کانونو استخراج څخه تر لوجستیک او مالي خدماتو پورې، موږ د افغانستان د زیربنو د بدلون ځواک یو.",
  },
  backgroundImage: "/images/hero-construction.webp",
};

export default function HeroBanner({ settings }: HeroBannerProps) {
  const { lang } = useI18n();

  // Merge API hero with fallback — each field independently
  const hero: HeroData = {
    backgroundImage: safeString(settings?.hero?.backgroundImage, fallbackHero.backgroundImage),
    label: settings?.hero?.label ?? fallbackHero.label,
    title: settings?.hero?.title ?? fallbackHero.title,
    subtitle: settings?.hero?.subtitle ?? fallbackHero.subtitle,
  };

  const label = getText(hero.label, lang);
  const title = getText(hero.title, lang);
  const subtitle = getText(hero.subtitle, lang);

  const renderTitle = () => {
    if (lang === "en") {
      const parts = title.split("Afghanistan's");
      if (parts.length === 2) return <>{parts[0]}<span className="text-gold-gradient">Afghanistan&apos;s</span>{parts[1]}</>;
      return title;
    }
    if (lang === "dari") {
      const parts = title.split("آینده");
      if (parts.length === 2) return <><span className="text-gold-gradient">آینده</span>{parts[1]}</>;
      return title;
    }
    const parts = title.split("افغانستان");
    if (parts.length === 2) return <>{parts[0]}<span className="text-gold-gradient">افغانستان</span>{parts[1]}</>;
    return title;
  };

  return (
    <section className="about-section relative w-full h-[70vh] min-h-[500px] max-h-[800px] overflow-hidden">
      <div className="absolute inset-0">
        <Image src={hero.backgroundImage} alt="Hero background" fill className="object-cover" style={{ transform: "scale(1.1)" }} priority unoptimized />
        <div className="absolute inset-0 bg-gradient-to-b from-[#0A1628]/60 via-[#0A1628]/50 to-[#0A1628]" />
        <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(201,162,39,0.08)_0%,_transparent_70%)]" />
      </div>
      <div className="absolute inset-0 grid-pattern opacity-50" />
      <div className="relative z-10 h-full flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8">
        <div className="text-center max-w-4xl mx-auto">
          <div className="reveal-text inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#C9A227]/10 border border-[#C9A227]/20 mb-8">
            <span className="w-2 h-2 rounded-full bg-[#C9A227] animate-pulse" />
            <span className="text-[#C9A227] text-sm font-medium tracking-wide uppercase">{label}</span>
          </div>
          <h1 className="about-hero-title font-bold text-white mb-6 reveal-text reveal-text-delay-1">{renderTitle()}</h1>
          <p className="about-body-text text-white/60 max-w-2xl mx-auto mb-12 reveal-text reveal-text-delay-2">{subtitle}</p>
          <div className="gold-line mx-auto mb-8 reveal-text reveal-text-delay-3" />
        </div>
        <div className="absolute bottom-8 left-1/2 -translate-x-1/2 scroll-indicator reveal-text reveal-text-delay-4">
          <ChevronDown className="w-6 h-6 text-[#C9A227]/60" />
        </div>
      </div>
    </section>
  );
}