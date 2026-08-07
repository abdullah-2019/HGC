"use client";

import { useEffect, useRef, useState } from "react";
import { Target, CheckCircle2 } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { getText, safeArray, safeObject, safeString } from "./about-utils";

interface LocalizedText {
  en: string | null;
  dari: string | null;
  pashto: string | null;
}

interface AboutMissionPoint {
  text: LocalizedText;
}

interface AboutMissionData {
  sectionLabel: LocalizedText;
  title: LocalizedText;
  description: LocalizedText;
  image: string;
  quote: LocalizedText;
  points: AboutMissionPoint[];
}

interface MissionSectionProps {
  mission: AboutMissionData | null;
}

const fallback: AboutMissionData = {
  sectionLabel: { en: "Our Mission", dari: "ماموریت ما", pashto: "زموږ ماموریت" },
  title: { en: "Enabling Long-Term Value Creation", dari: "ایجاد ارزش بلندمدت", pashto: "د اوږدمهاله ارزښت رامنځته کول" },
  description: {
    en: "Our mission reflects our role as a diversified platform supporting mining, construction, logistics, and financial services through structured governance, quality standards, and disciplined operations.",
    dari: "ماموریت ما نقش ما را به عنوان یک پلتفرم متنوع منعکس می‌کند که از استخراج معادن، ساختمان، لوژستیک و خدمات مالی از طریق حاکمیت ساختاریافته، استانداردهای کیفی و عملیات منضبط پشتیبانی می‌کند.",
    pashto: "زموږ ماموریت زموږ د رول په توګه د یوې متنوعې پلیټ فارم په توګه منعکسوي چې د جوړولو، د کانونو استخراج، لوجستیک او مالي خدماتو د جوړولو حکومتولي، د کیفیت معیارونو او منضبطو عملیاتو له لارې ملاتړ کوي.",
  },
  image: "/images/placeholder.png",
  quote: { en: "To enable long-term value creation across strategic industries.", dari: "ایجاد ارزش بلندمدت در صنایع استراتژیک.", pashto: "د ستراتیژیکو صنعتونو کې د اوږدمهاله ارزښت رامنځته کول." },
  points: [
    { text: { en: "Deliver world-class infrastructure projects that exceed client expectations", dari: "ارائه پروژه‌های زیرساختی درجه یک که فراتر از انتظارات مشتری باشد", pashto: "د پیرودونکو د تمه څخه لوړو نړیوالو معیارونو زیربنايي پروژو وړاندې کول" } },
    { text: { en: "Extract and export Afghanistan's mineral wealth responsibly and sustainably", dari: "استخراج و صادرات ثروت معدنی افغانستان به صورت مسئولانه و پایدار", pashto: "د افغانستان د معدني شتمنیو مسؤلانه او دوامداره استخراج او صادرول" } },
    { text: { en: "Create employment opportunities and build local capacity nationwide", dari: "ایجاد فرصت‌های شغلی و ایجاد ظرفیت محلی در سراسر کشور", pashto: "د دندو فرصتونو رامنځته کول او په ټول هیواد کې د سیمه ییز ظرفیت جوړول" } },
    { text: { en: "Maintain the highest standards of safety, quality, and environmental stewardship", dari: "حفظ بالاترین استانداردهای ایمنی، کیفیت و سرپرستی محیط زیست", pashto: "د خوندیتوب، کیفیت او چاپیریال ساتنې تر ټولو لوړو معیارونو ساتل" } },
  ],
};

export default function MissionSection({ mission }: MissionSectionProps) {
  const { lang } = useI18n();
  const sectionRef = useRef<HTMLDivElement>(null);
  const [isVisible, setIsVisible] = useState(false);

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => { if (entry.isIntersecting) { setIsVisible(true); observer.disconnect(); } },
      { threshold: 0.2 }
    );
    if (sectionRef.current) observer.observe(sectionRef.current);
    return () => observer.disconnect();
  }, []);

  const data: AboutMissionData = {
    sectionLabel: safeObject(mission?.sectionLabel, fallback.sectionLabel),
    title: safeObject(mission?.title, fallback.title),
    description: safeObject(mission?.description, fallback.description),
    image: safeString(mission?.image, fallback.image),
    quote: safeObject(mission?.quote, fallback.quote),
    points: safeArray(mission?.points, fallback.points),
  };

  const sectionLabel = getText(data.sectionLabel, lang);
  const title = getText(data.title, lang);
  const description = getText(data.description, lang);
  const quoteText = getText(data.quote, lang);

  const renderTitle = () => {
    if (!title) return null;
    if (lang === "en") {
      const parts = title.split("Long-Term Value");
      if (parts.length === 2) return <>{parts[0]}<span className="text-gold-gradient">Long-Term Value</span>{parts[1]}</>;
    }
    if (lang === "dari") {
      const parts = title.split("ارزش بلندمدت");
      if (parts.length === 2) return <>{parts[0]}<span className="text-gold-gradient">ارزش بلندمدت</span>{parts[1]}</>;
    }
    const parts = title.split("اوږدمهاله ارزښت");
    if (parts.length === 2) return <>{parts[0]}<span className="text-gold-gradient">اوږدمهاله ارزښت</span>{parts[1]}</>;
    return <>{title}</>;
  };

  return (
    <section ref={sectionRef} className="about-section py-24 lg:py-32 bg-hgc-bg relative overflow-hidden border-y border-hgc-border">
      <div className="absolute top-0 right-0 w-1/2 h-full bg-[radial-gradient(circle_at_top_right,_rgba(212,175,55,0.06)_0%,_transparent_60%)]" />
      <div className="absolute -bottom-20 -left-20 w-80 h-80 bg-hgc-about-gold/5 rounded-full blur-3xl" />
      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid lg:grid-cols-2 gap-16 lg:gap-24 items-top">
          {/* Image Side */}
          <div className={`relative transition-all duration-1000 ${isVisible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-12'}`}>
            <div className="relative">
              <div className="relative rounded-2xl overflow-hidden aspect-square">
                <div className="absolute inset-0 bg-cover bg-center img-zoom" style={{ backgroundImage: `url(${data.image})` }} />
                <div className="absolute inset-0 bg-gradient-to-br from-hgc-navy-deep/30 to-transparent" />
              </div>

              {/* Floating Quote Card — Light Theme */}
              <div className="absolute -bottom-8 -right-4 lg:-right-8 bg-white border border-hgc-about-card-border rounded-2xl p-6 shadow-xl max-w-[280px]">
                <Target className="w-8 h-8 text-hgc-about-gold mb-3" />
                <p className="text-hgc-about-text-secondary text-sm italic leading-relaxed">&ldquo;{quoteText}&rdquo;</p>
              </div>

              {/* Decorative border */}
              <div className="absolute -top-4 -left-4 w-full h-full border border-hgc-about-gold/10 rounded-2xl -z-10" />
            </div>
          </div>

          {/* Text Content */}
          <div className={`transition-all duration-1000 delay-200 ${isVisible ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-12'}`}>
            <div className="flex items-center gap-3 mb-6">
              <div className="gold-line" />
              <span className="text-hgc-about-gold text-sm font-semibold tracking-wider uppercase">{sectionLabel}</span>
            </div>
            <h2 className="about-section-title font-bold text-hgc-about-text mb-8">{renderTitle()}</h2>
            <p className="about-body-text text-hgc-about-text-secondary mb-10">{description}</p>

            <div className="space-y-5">
              {data.points.map((point, idx) => (
                <div key={idx} className={`flex items-start gap-4 transition-all duration-700 ${isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'}`} style={{ transitionDelay: `${400 + idx * 150}ms` }}>
                  <div className="flex-shrink-0 w-6 h-6 rounded-full bg-hgc-about-gold/10 flex items-center justify-center mt-0.5">
                    <CheckCircle2 className="w-4 h-4 text-hgc-about-gold" />
                  </div>
                  <p className="text-hgc-about-text-secondary text-sm leading-relaxed">{getText(point.text, lang)}</p>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}