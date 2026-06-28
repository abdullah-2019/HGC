"use client";

import { useEffect, useRef, useState } from "react";
import { Shield, Users, Leaf, Zap, Handshake, Award } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

const values = [
  {
    icon: Shield,
    title: "Integrity",
    titleDari: "صداقت",
    desc: "We conduct every operation with unwavering honesty, transparency, and ethical standards that earn lasting trust.",
    descDari: "ما هر عملیاتی را با صداقت بی‌نقص، شفافیت و استانداردهای اخلاقی که اعتماد پایدار را به دست می‌آورد، انجام می‌دهیم.",
  },
  {
    icon: Users,
    title: "Excellence",
    titleDari: "excellence",
    desc: "We pursue the highest quality in every project, every product, and every interaction with our stakeholders.",
    descDari: "ما بالاترین کیفیت را در هر پروژه، هر محصول و هر تعامل با ذینفعان خود دنبال می‌کنیم.",
  },
  {
    icon: Leaf,
    title: "Sustainability",
    titleDari: "پایداری",
    desc: "We are committed to responsible resource management and environmental stewardship for future generations.",
    descDari: "ما متعهد به مدیریت مسئولانه منابع و سرپرستی محیط زیست برای نسل‌های آینده هستیم.",
  },
  {
    icon: Zap,
    title: "Innovation",
    titleDari: "نوآوری",
    desc: "We embrace modern technologies and creative solutions to overcome challenges and deliver superior results.",
    descDari: "ما فناوری‌های مدرن و راه‌حل‌های خلاقانه را برای غلبه بر چالش‌ها و ارائه نتایج برتر می‌پذیریم.",
  },
  {
    icon: Handshake,
    title: "Partnership",
    titleDari: "مشارکت",
    desc: "We build collaborative relationships with clients, communities, and governments based on mutual respect.",
    descDari: "ما روابط همکاری با مشتریان، جوامع و دولت‌ها بر اساس احترام متقابل ایجاد می‌کنیم.",
  },
  {
    icon: Award,
    title: "Accountability",
    titleDari: "پاسخگویی",
    desc: "We take ownership of our actions and deliver on our promises with consistency and reliability.",
    descDari: "ما مالکیت اعمال خود را بر عهده می‌گیریم و با ثبات و قابلیت اطمینان به وعده‌های خود عمل می‌کنیم.",
  },
];

export default function CoreValues() {
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
    <section ref={sectionRef} className="about-section py-24 lg:py-32 bg-[#080F1A] relative">
      <div className="absolute inset-0 grid-pattern opacity-20" />
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(201,162,39,0.04)_0%,_transparent_60%)]" />

      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Header */}
        <div className="text-center mb-16">
          <div className="flex items-center justify-center gap-3 mb-6">
            <div className="gold-line" />
            <span className="text-[#C9A227] text-sm font-semibold tracking-wider uppercase">
              {lang === "en" ? "What Drives Us" : lang === "dari" ? "آنچه ما را هدایت می‌کند" : "هغه څه چې موږ هدایت کوي"}
            </span>
            <div className="gold-line" />
          </div>
          <h2 className="about-section-title font-bold text-white mb-4">
            {lang === "en" ? (
              <>
                Our Core <span className="text-gold-gradient">Values</span>
              </>
            ) : lang === "dari" ? (
              <>
                ارزش‌های <span className="text-gold-gradient">اصلی</span> ما
              </>
            ) : (
              <>
                زموږ <span className="text-gold-gradient">اصلي ارزښتونه</span>
              </>
            )}
          </h2>
          <p className="text-white/40 max-w-2xl mx-auto">
            {lang === "en"
              ? "The principles that guide every decision, every project, and every relationship we build."
              : lang === "dari"
                ? "اصولی که هر تصمیم، هر پروژه و هر رابطه‌ای که ما می‌سازیم را هدایت می‌کند."
                : "هغه اصول چې هر تصمیم، هر پروژه، او هر اړیکه چې موږ یې جوړوو هدایت کوي."}
          </p>
        </div>

        {/* Values Grid */}
        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          {values.map((value, idx) => {
            const Icon = value.icon;
            return (
              <div
                key={idx}
                className={`glass-card rounded-2xl p-8 group transition-all duration-700 ${isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'}`}
                style={{ transitionDelay: `${idx * 100}ms` }}
              >
                <div className="value-ring inline-flex items-center justify-center w-14 h-14 rounded-full bg-[#C9A227]/5 mb-6 group-hover:bg-[#C9A227]/10 transition-colors">
                  <Icon className="w-7 h-7 text-[#C9A227]" />
                </div>
                <h3 className="text-white font-bold text-xl mb-3 group-hover:text-[#C9A227] transition-colors">
                  {lang === "en" ? value.title : value.titleDari}
                </h3>
                <p className="text-white/50 text-sm leading-relaxed">
                  {lang === "en" ? value.desc : value.descDari}
                </p>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}