"use client";

import { useEffect, useRef, useState } from "react";
import { Clock, Briefcase, MapPin, Building2 } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { getText, safeArray } from "./about-utils";

const iconMap: Record<string, React.ElementType> = {
  Clock,
  Briefcase,
  MapPin,
  Building2,
};

interface LocalizedText {
  en: string | null;
  dari: string | null;
  pashto: string | null;
}

interface AboutStat {
  key: string;
  value: number;
  suffix: string;
  label: LocalizedText;
  icon: string;
}

interface StatsShowcaseProps {
  stats: AboutStat[];
}

function AnimatedCounter({ end, suffix, isVisible }: { end: number; suffix: string; isVisible: boolean }) {
  const [count, setCount] = useState(0);

  useEffect(() => {
    if (!isVisible) return;
    let start = 0;
    const duration = 2000;
    const increment = end / (duration / 16);
    const timer = setInterval(() => {
      start += increment;
      if (start >= end) {
        setCount(end);
        clearInterval(timer);
      } else {
        setCount(Math.floor(start));
      }
    }, 16);
    return () => clearInterval(timer);
  }, [isVisible, end]);

  return (
    <span className="counter-number">
      {count.toLocaleString()}
      <span className="text-[#C9A227]">{suffix}</span>
    </span>
  );
}

const fallbackStats: AboutStat[] = [
  { key: "years_experience", value: 24, suffix: "+", label: { en: "Years Experience", dari: "سال تجربه", pashto: "د تجربې کالونه" }, icon: "Clock" },
  { key: "projects_completed", value: 200, suffix: "+", label: { en: "Projects Completed", dari: "پروژه تکمیل شده", pashto: "بشپړ شوي پروژې" }, icon: "Briefcase" },
  { key: "provinces_covered", value: 38, suffix: "+", label: { en: "Provinces Covered", dari: "ولایت تحت پوشش", pashto: "پوښل شوي ولایتونه" }, icon: "MapPin" },
  { key: "companies_in_group", value: 6, suffix: "", label: { en: "Companies", dari: "شرکت", pashto: "شرکتونه" }, icon: "Building2" },
];

export default function StatsShowcase({ stats }: StatsShowcaseProps) {
  const { lang } = useI18n();
  const sectionRef = useRef<HTMLDivElement>(null);
  const [isVisible, setIsVisible] = useState(false);

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => { if (entry.isIntersecting) { setIsVisible(true); observer.disconnect(); } },
      { threshold: 0.3 }
    );
    if (sectionRef.current) observer.observe(sectionRef.current);
    return () => observer.disconnect();
  }, []);

  const displayStats = safeArray(stats, fallbackStats);

  return (
    <section ref={sectionRef} className="about-section py-16 bg-[#080F1A] relative overflow-hidden">
      <div className="absolute inset-0 grid-pattern opacity-30" />
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(201,162,39,0.05)_0%,_transparent_70%)]" />
      <div className="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
          {displayStats.map((stat, idx) => {
            const Icon = iconMap[stat.icon] || Building2;
            return (
              <div
                key={stat.key || idx}
                className={`text-center group transition-all duration-700 ${isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'}`}
                style={{ transitionDelay: `${idx * 100}ms` }}
              >
                <div className="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-[#C9A227]/5 border border-[#C9A227]/10 mb-3 group-hover:bg-[#C9A227]/10 group-hover:border-[#C9A227]/20 transition-all duration-500">
                  <Icon className="w-5 h-5 text-[#C9A227]" />
                </div>
                <div className="text-2xl md:text-3xl font-bold text-white mb-1">
                  <AnimatedCounter end={stat.value} suffix={stat.suffix} isVisible={isVisible} />
                </div>
                <p className="text-white/40 text-xs font-medium uppercase tracking-wider">
                  {getText(stat.label, lang)}
                </p>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}