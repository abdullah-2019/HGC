"use client";

import { useEffect, useRef, useState } from "react";
import { Shield, Users, Leaf, Zap, Handshake, Award } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { getText, safeArray, safeObject } from "./about-utils";

const iconMap: Record<string, React.ElementType> = {
  Shield, Users, Leaf, Zap, Handshake, Award,
};

interface LocalizedText {
  en: string | null;
  dari: string | null;
  pashto: string | null;
}

interface AboutCoreValue {
  icon: string;
  title: LocalizedText;
  description: LocalizedText;
}

interface AboutCoreValuesData {
  sectionLabel: LocalizedText;
  sectionTitle: LocalizedText;
  sectionDescription: LocalizedText;
  values: AboutCoreValue[];
}

interface CoreValuesProps {
  coreValues: AboutCoreValuesData | null;
}

const fallback: AboutCoreValuesData = {
  sectionLabel: { en: "What Drives Us", dari: "آنچه ما را هدایت می‌کند", pashto: "هغه څه چې موږ هدایت کوي" },
  sectionTitle: { en: "Our Core Values", dari: "ارزش‌های اصلی ما", pashto: "زموږ اصلي ارزښتونه" },
  sectionDescription: { en: "The principles that guide every decision, every project, and every relationship we build.", dari: "اصولی که هر تصمیم، هر پروژه و هر رابطه‌ای که ما می‌سازیم را هدایت می‌کند.", pashto: "هغه اصول چې هر تصمیم، هر پروژه، او هر اړیکه چې موږ یې جوړوو هدایت کوي." },
  values: [
    { icon: "Shield", title: { en: "Integrity", dari: "صداقت", pashto: "صداقت" }, description: { en: "We conduct every operation with unwavering honesty, transparency, and ethical standards that earn lasting trust.", dari: "ما هر عملیاتی را با صداقت بی‌نقص، شفافیت و استانداردهای اخلاقی که اعتماد پایدار را به دست می‌آورد، انجام می‌دهیم.", pashto: "موږ هر عملیات د بې باورۍ صداقت، شفافیت او اخلاقي معیارونو سره ترسره کوو چې دوامداره باور ترلاسه کوي." } },
    { icon: "Users", title: { en: "Excellence", dari: "برتری", pashto: "بریا" }, description: { en: "We pursue the highest quality in every project, every product, and every interaction with our stakeholders.", dari: "ما بالاترین کیفیت را در هر پروژه، هر محصول و هر تعامل با ذینفعان خود دنبال می‌کنیم.", pashto: "موږ په هر پروژه، هر محصول او په خپلو ګټه اخیستونکو سره په هر تعامل کې تر ټولو لوړ کیفیت تعقیبوو." } },
    { icon: "Leaf", title: { en: "Sustainability", dari: "پایداری", pashto: "دوامداره والی" }, description: { en: "We are committed to responsible resource management and environmental stewardship for future generations.", dari: "ما متعهد به مدیریت مسئولانه منابع و سرپرستی محیط زیست برای نسل‌های آینده هستیم.", pashto: "موږ د راتلونکو نسلونو لپاره د مسؤلانه سرچینو مدیریت او د چاپیریال ساتنې ته ژمن یو." } },
    { icon: "Zap", title: { en: "Innovation", dari: "نوآوری", pashto: "نوښت" }, description: { en: "We embrace modern technologies and creative solutions to overcome challenges and deliver superior results.", dari: "ما فناوری‌های مدرن و راه‌حل‌های خلاقانه را برای غلبه بر چالش‌ها و ارائه نتایج برتر می‌پذیریم.", pashto: "موږ د ننګونو د ګاللو او د غوره پایلو د وړاندې کولو لپاره عصري تکنالوژیو او خلاقه حلونه منو." } },
    { icon: "Handshake", title: { en: "Partnership", dari: "مشارکت", pashto: "شریکي" }, description: { en: "We build collaborative relationships with clients, communities, and governments based on mutual respect.", dari: "ما روابط همکاری با مشتریان، جوامع و دولت‌ها بر اساس احترام متقابل ایجاد می‌کنیم.", pashto: "موږ د پیرودونکو، ټولنو او حکومتونو سره د متقابل درناوي پر بنسټ د همکارۍ اړیکې جوړوو." } },
    { icon: "Award", title: { en: "Accountability", dari: "پاسخگویی", pashto: "د ځواب ورکولو مسؤلیت" }, description: { en: "We take ownership of our actions and deliver on our promises with consistency and reliability.", dari: "ما مالکیت اعمال خود را بر عهده می‌گیریم و با ثبات و قابلیت اطمینان به وعده‌های خود عمل می‌کنیم.", pashto: "موږ د خپلو کړنو مالکیت اخلو او په دوامداره او باوري توګه خپلو ژمنو ته عمل کوو." } },
  ],
};

export default function CoreValues({ coreValues }: CoreValuesProps) {
  const { lang } = useI18n();
  const sectionRef = useRef<HTMLDivElement>(null);
  const [isVisible, setIsVisible] = useState(false);

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => { if (entry.isIntersecting) { setIsVisible(true); observer.disconnect(); } },
      { threshold: 0.1 }
    );
    if (sectionRef.current) observer.observe(sectionRef.current);
    return () => observer.disconnect();
  }, []);

  const data: AboutCoreValuesData = {
    sectionLabel: safeObject(coreValues?.sectionLabel, fallback.sectionLabel),
    sectionTitle: safeObject(coreValues?.sectionTitle, fallback.sectionTitle),
    sectionDescription: safeObject(coreValues?.sectionDescription, fallback.sectionDescription),
    values: safeArray(coreValues?.values, fallback.values),
  };

  const sectionLabel = getText(data.sectionLabel, lang);
  const sectionTitle = getText(data.sectionTitle, lang);
  const sectionDescription = getText(data.sectionDescription, lang);

  const renderTitle = () => {
    if (!sectionTitle) return null;
    if (lang === "en") { const parts = sectionTitle.split("Values"); if (parts.length === 2) return <>{parts[0]}<span className="text-gold-gradient">Values</span></>; }
    if (lang === "dari") { const parts = sectionTitle.split("اصلی"); if (parts.length === 2) return <>{parts[0]}<span className="text-gold-gradient">اصلی</span>{parts[1]}</>; }
    const parts = sectionTitle.split("ارزښتونه"); if (parts.length === 2) return <>{parts[0]}<span className="text-gold-gradient">ارزښتونه</span></>;
    return <>{sectionTitle}</>;
  };

  return (
    <section ref={sectionRef} className="about-section py-24 lg:py-32 bg-[#080F1A] relative">
      <div className="absolute inset-0 grid-pattern opacity-20" />
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(201,162,39,0.04)_0%,_transparent_60%)]" />
      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <div className="flex items-center justify-center gap-3 mb-6">
            <div className="gold-line" />
            <span className="text-[#C9A227] text-sm font-semibold tracking-wider uppercase">{sectionLabel}</span>
            <div className="gold-line" />
          </div>
          <h2 className="about-section-title font-bold text-white mb-4">{renderTitle()}</h2>
          <p className="text-white/40 max-w-2xl mx-auto">{sectionDescription}</p>
        </div>
        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          {data.values.map((value, idx) => {
            const Icon = iconMap[value.icon] || Shield;
            return (
              <div key={idx} className={`glass-card rounded-2xl p-8 group transition-all duration-700 ${isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'}`} style={{ transitionDelay: `${idx * 100}ms` }}>
                <div className="value-ring inline-flex items-center justify-center w-14 h-14 rounded-full bg-[#C9A227]/5 mb-6 group-hover:bg-[#C9A227]/10 transition-colors">
                  <Icon className="w-7 h-7 text-[#C9A227]" />
                </div>
                <h3 className="text-white font-bold text-xl mb-3 group-hover:text-[#C9A227] transition-colors">{getText(value.title, lang)}</h3>
                <p className="text-white/50 text-sm leading-relaxed">{getText(value.description, lang)}</p>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}