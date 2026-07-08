"use client";

import { useEffect, useRef, useState } from "react";
import { Clock, Briefcase, MapPin, Building2 } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

const stats = [
  { value: 24, suffix: "+", label: "Years Experience", labelDari: "سال تجربه", labelPashto: "د تجربې کالونه", icon: Clock },
  { value: 200, suffix: "+", label: "Projects Completed", labelDari: "پروژه تکمیل شده", labelPashto: "بشپړ شوي پروژې", icon: Briefcase },
  { value: 38, suffix: "+", label: "Provinces Covered", labelDari: "ولایت تحت پوشش", labelPashto: "پوښل شوي ولایتونه", icon: MapPin },
  { value: 6, suffix: "", label: "Companies", labelDari: "شرکت", labelPashto: "شرکتونه", icon: Building2 },
];

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

export default function StatsShowcase() {
  const { lang } = useI18n();
  const sectionRef = useRef<HTMLDivElement>(null);
  const [isVisible, setIsVisible] = useState(false);

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          setIsVisible(true);
          observer.disconnect();
        }
      },
      { threshold: 0.3 }
    );
    if (sectionRef.current) observer.observe(sectionRef.current);
    return () => observer.disconnect();
  }, []);

  return (
    <section ref={sectionRef} className="about-section py-16 bg-[#080F1A] relative overflow-hidden">
      {/* Background Pattern */}
      <div className="absolute inset-0 grid-pattern opacity-30" />
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(201,162,39,0.05)_0%,_transparent_70%)]" />

      <div className="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* 4 columns on all screen sizes */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
          {stats.map((stat, idx) => {
            const Icon = stat.icon;
            return (
              <div
                key={idx}
                className={`text-center group transition-all duration-700 ${isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'}`}
                style={{ transitionDelay: `${idx * 100}ms` }}
              >
                {/* Smaller icon container */}
                <div className="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-[#C9A227]/5 border border-[#C9A227]/10 mb-3 group-hover:bg-[#C9A227]/10 group-hover:border-[#C9A227]/20 transition-all duration-500">
                  <Icon className="w-5 h-5 text-[#C9A227]" />
                </div>
                {/* Smaller number */}
                <div className="text-2xl md:text-3xl font-bold text-white mb-1">
                  <AnimatedCounter end={stat.value} suffix={stat.suffix} isVisible={isVisible} />
                </div>
                {/* Smaller label */}
                <p className="text-white/40 text-xs font-medium uppercase tracking-wider">
                  {lang === "en" ? stat.label : lang === "dari" ? stat.labelDari : stat.labelPashto}
                </p>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}