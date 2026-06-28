"use client";

import { useEffect, useRef, useState } from "react";
import { useI18n } from "@/components/useI18nStore";

const milestones = [
  {
    year: "2001",
    title: "Foundation",
    titleDari: "تأسیس",
    desc: "Hafez Construction & Road Company established in Kabul with a vision to rebuild Afghanistan.",
    descDari: "شرکت ساختمانی و سرک حافظ در کابل با چشم‌انداز بازسازی افغانستان تأسیس شد.",
  },
  {
    year: "2005",
    title: "Mining Expansion",
    titleDari: "گسترش استخراج معادن",
    desc: "Launched Al-Bahrain Mining Company to explore Afghanistan's rich mineral resources.",
    descDari: "راه‌اندازی شرکت استخراج معادن البحرین برای اکتشاف منابع معدنی غنی افغانستان.",
  },
  {
    year: "2008",
    title: "Construction Growth",
    titleDari: "رشد ساختمان",
    desc: "Zain Noorain Construction joined the group, expanding our construction capabilities.",
    descDari: "شرکت ساختمانی زین نورین به گروه پیوست و قابلیت‌های ساختمانی ما را گسترش داد.",
  },
  {
    year: "2010",
    title: "Trading Division",
    titleDari: "بخش تجارت",
    desc: "Al-Madinah General Trading established to facilitate local and international commerce.",
    descDari: "تجارت عمومی المدینه برای تسهیل تجارت محلی و بین‌المللی تأسیس شد.",
  },
  {
    year: "2012",
    title: "Financial Services",
    titleDari: "خدمات مالی",
    desc: "Haramain Financial Services launched to support economic growth and investment.",
    descDari: "خدمات مالی حرمین برای حمایت از رشد اقتصادی و سرمایه‌گذاری راه‌اندازی شد.",
  },
  {
    year: "2015",
    title: "Logistics Network",
    titleDari: "شبکه لوژستیک",
    desc: "Al-Koozi Logistics & Transport established nationwide delivery and supply chain network.",
    descDari: "لوجستیک و ترانسپورت الکوزی شبکه تحویل و زنجیره تأمین سراسری را ایجاد کرد.",
  },
  {
    year: "2020",
    title: "200 Projects Milestone",
    titleDari: "نقطه عطف ۲۰۰ پروژه",
    desc: "Completed 200th project across 38 provinces, solidifying our national presence.",
    descDari: "تکمیل ۲۰۰مین پروژه در ۳۸ ولایت، استحکام حضور ملی ما.",
  },
  {
    year: "2024",
    title: "Global Partnerships",
    titleDari: "مشارکت‌های جهانی",
    desc: "Strategic alliances with UNOPS, World Bank, and USACE driving international development.",
    descDari: "اتحادهای استراتژیک با UNOPS، بانک جهانی و USACE که توسعه بین‌المللی را هدایت می‌کند.",
  },
];

export default function Timeline() {
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
      { threshold: 0.1 }
    );
    if (sectionRef.current) observer.observe(sectionRef.current);
    return () => observer.disconnect();
  }, []);

  return (
    <section ref={sectionRef} className="about-section py-24 lg:py-32 bg-[#0A1628] relative overflow-hidden">
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(201,162,39,0.03)_0%,_transparent_70%)]" />

      <div className="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Header */}
        <div className="text-center mb-20">
          <div className="flex items-center justify-center gap-3 mb-6">
            <div className="gold-line" />
            <span className="text-[#C9A227] text-sm font-semibold tracking-wider uppercase">
              {lang === "en" ? "Our Journey" : lang === "dari" ? "سفر ما" : "زموږ سفر"}
            </span>
            <div className="gold-line" />
          </div>
          <h2 className="about-section-title font-bold text-white">
            {lang === "en" ? (
              <>
                Two Decades of <span className="text-gold-gradient">Excellence</span>
              </>
            ) : lang === "dari" ? (
              <>
                دو دهه <span className="text-gold-gradient">excellence</span>
              </>
            ) : (
              <>
                دوه <span className="text-gold-gradient">لسیزې عالي کیفیت</span>
              </>
            )}
          </h2>
        </div>

        {/* Timeline */}
        <div className="relative">
          <div className="timeline-connector" />

          {milestones.map((item, idx) => {
            const isLeft = idx % 2 === 0;
            return (
              <div
                key={idx}
                className={`relative flex items-center mb-16 last:mb-0 ${
                  isLeft ? "lg:flex-row" : "lg:flex-row-reverse"
                } flex-col lg:gap-12`}
              >
                {/* Content Card */}
                <div
                  className={`lg:w-1/2 transition-all duration-700 ${
                    isVisible ? "opacity-100 translate-y-0" : "opacity-0 translate-y-8"
                  }`}
                  style={{ transitionDelay: `${idx * 100}ms` }}
                >
                  <div className={`glass-card rounded-2xl p-6 lg:p-8 ${isLeft ? "lg:text-right" : "lg:text-left"} text-center`}>
                    <span className="inline-block px-3 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-bold mb-3">
                      {item.year}
                    </span>
                    <h3 className="text-white font-bold text-xl mb-2">
                      {lang === "en" ? item.title : item.titleDari}
                    </h3>
                    <p className="text-white/50 text-sm leading-relaxed">
                      {lang === "en" ? item.desc : item.descDari}
                    </p>
                  </div>
                </div>

                {/* Center Dot */}
                <div className="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 hidden lg:block">
                  <div className="w-4 h-4 rounded-full bg-[#C9A227] border-4 border-[#0A1628] shadow-lg shadow-[#C9A227]/30" />
                </div>

                {/* Spacer for other side */}
                <div className="lg:w-1/2 hidden lg:block" />
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}