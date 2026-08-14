// AboutStory.tsx
"use client";

import { useEffect, useRef, useState } from "react";
import { Building2, Globe, TrendingUp } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { getText, safeArray, safeObject, safeString, safeNumber } from "./about-utils";

const iconMap: Record<string, React.ElementType> = {
  Building2,
  Globe,
  TrendingUp,
};

interface LocalizedText {
  en: string | null;
  dari: string | null;
  pashto: string | null;
}

interface AboutStoryHighlight {
  icon: string;
  label: LocalizedText;
  value: string;
}

interface AboutStoryData {
  sectionLabel: LocalizedText;
  title: LocalizedText;
  foundedYear: number;
  paragraphs: LocalizedText[];
  mainImage: string;
  floatingCard: {
    value: string;
    label: LocalizedText;
  };
  highlights: AboutStoryHighlight[];
}

interface AboutStoryProps {
  story: AboutStoryData | null;
}

const fallback: AboutStoryData = {
  sectionLabel: { en: "Our Story", dari: "داستان ما", pashto: "زموږ کیسه" },
  title: { en: "Leading Afghan Conglomerate Since 2001", dari: "گروپ پیشرو افغان از سال ۲۰۰۱", pashto: "مخکښ افغان ګروپ له ۲۰۰۱ کال راهیسې" },
  foundedYear: 2001,
  paragraphs: [
    { en: "Hafez Group of Companies (HGC) was founded in 2001 with a singular vision: to rebuild and transform Afghanistan's infrastructure landscape. What began as a modest construction firm has evolved into one of the nation's most diversified and respected conglomerates.", dari: "گروپ کمپنی‌های حافظ (HGC) در سال ۲۰۰۱ با یک چشم‌انداز واحد تأسیس شد: بازسازی و تحول چشم‌انداز زیرساخت‌های افغانستان. آنچه که به عنوان یک شرکت ساختمانی متواضع آغاز شد، به یکی از متنوع‌ترین و محترم‌ترین گروه‌های کشور تبدیل شده است.", pashto: "د حافظ شرکتونو ګروپ (HGC) په ۲۰۰۱ کال کې د یوې واحدې لید سره تاسیس شو: د افغانستان د زیربنو د منظرې بیا رغونه او بدلون. هغه څه چې د یوې عادي جوړونې شرکت په توګه پیل شول، په هیواد کې یو له تر ټولو متنوع او محترمو ګروپونو څخه واوښت." },
    { en: "Today, HGC operates six specialized companies across construction, mining, logistics, and financial services. With over 200 completed projects spanning 38+ provinces, we have built a reputation for quality, reliability, and innovation that extends beyond Afghanistan's borders.", dari: "امروز، HGC شش شرکت تخصصی در ساختمان، استخراج معادن، لوژستیک و خدمات مالی اداره می‌کند. با بیش از ۲۰۰ پروژه تکمیل شده در ۳۸+ ولایت، ما اعتباری برای کیفیت، قابلیت اطمینان و نوآوری ساخته‌ایم که فراتر از مرزهای افغانستان گسترش یافته است.", pashto: "نن ورځ، HGC په جوړونو، د کانونو استخراج، لوجستیک او مالي خدماتو کې شپږ تخصصي شرکتونه اداره کوي. په ۳۸+ ولایتونو کې د ۲۰۰+ بشپړو شویو پروژو سره، موږ د کیفیت، باوري والي او نوښت لپاره یو اعتبار رامنځته کړی چې د افغانستان له پولو څخه هاخوا خپریږي." },
    { en: "Our partnerships with international organizations including UNOPS, World Bank, USACE, and UNICEF reflect our commitment to global standards and sustainable development. We don't just build structures — we build trust, communities, and the foundation for Afghanistan's prosperous future.", dari: "مشارکت‌های ما با سازمان‌های بین‌المللی از جمله UNOPS، بانک جهانی، USACE و UNICEF تعهد ما را به استانداردهای جهانی و توسعه پایدار منعکس می‌کند. ما فقط سازه‌ها را نمی‌سازیم — ما اعتماد، جوامع و بنیان آینده شکوفای افغانستان را می‌سازیم.", pashto: "زموږ د UNOPS، نړیوال بانک، USACE، او UNICEF په ګډون د نړیوالو سازمانونو سره شریکي زموږ د نړیوالو معیارونو او پایدارې پراختیا ته ژمنه منعکسوي. موږ یوازې جوړښتونه نه جوړوو — موږ باور، ټولنې، او د افغانستان د ګټور راتلونکي بنسټ جوړوو." },
  ],
  mainImage: "/images/placeholder.png",
  floatingCard: { value: "24+", label: { en: "Years of Excellence", dari: "سال excellence2", pashto: "د عالي کیفیت کالونه" } },
  highlights: [
    { icon: "Building2", label: { en: "6 Companies", dari: "۶ شرکت", pashto: "۶ شرکتونه" }, value: "6" },
    { icon: "Globe", label: { en: "38+ Provinces", dari: "۳۸+ ولایت", pashto: "۳۸+ ولایتونه" }, value: "38+" },
    { icon: "TrendingUp", label: { en: "200+ Projects", dari: "۲۰۰+ پروژه", pashto: "۲۰۰+ پروژې" }, value: "200+" },
  ],
};

export default function AboutStory({ story }: AboutStoryProps) {
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

  const data: AboutStoryData = {
    sectionLabel: safeObject(story?.sectionLabel, fallback.sectionLabel),
    title: safeObject(story?.title, fallback.title),
    foundedYear: safeNumber(story?.foundedYear, fallback.foundedYear),
    paragraphs: safeArray(story?.paragraphs, fallback.paragraphs),
    mainImage: safeString(story?.mainImage, fallback.mainImage),
    floatingCard: safeObject(story?.floatingCard, fallback.floatingCard),
    highlights: safeArray(story?.highlights, fallback.highlights),
  };

  const sectionLabel = getText(data.sectionLabel, lang);
  const title = getText(data.title, lang);
  const paragraphs = data.paragraphs.map((p) => getText(p, lang));
  const floatingLabel = getText(data.floatingCard.label, lang);

  const renderTitle = () => {
    if (!title) return null;
    const yearStr = lang === "en" ? String(data.foundedYear) : toPersianNumber(data.foundedYear);
    const parts = title.split(String(data.foundedYear));
    if (parts.length === 2) return <>{parts[0]}<span className="text-gold-gradient">{yearStr}</span>{parts[1]}</>;
    return <>{title}</>;
  };

  return (
    <section ref={sectionRef} className="about-section py-24 lg:py-32 bg-hgc-about-bg" dir={lang === 'dari' || lang === 'pashto' ? 'rtl' : 'ltr'}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid lg:grid-cols-2 gap-16 lg:gap-24 items-start">
          {/* Text Content */}
          <div className={`transition-all duration-1000 ${isVisible ? 'opacity-100 translate-x-0' : 'opacity-0 ' + (lang === 'dari' || lang === 'pashto' ? 'translate-x-12' : '-translate-x-12')} ${lang === 'dari' || lang === 'pashto' ? 'text-right' : 'text-left'}`}>
            <div className={`flex items-center gap-3 mb-6 ${lang === 'dari' || lang === 'pashto' ? 'flex-row-reverse' : ''}`}>
              <div className="flex items-center gap-3 mb-6">
                <div className="gold-line" />
                <span className="text-hgc-about-gold text-sm font-semibold tracking-wider uppercase">{sectionLabel}</span>
              </div>
            </div>
            <h2 className={`about-section-title font-bold text-hgc-about-text mb-8 ${lang === 'dari' || lang === 'pashto' ? 'text-right' : 'text-left'}`}>{renderTitle()}</h2>
            <div className="story-content text-hgc-about-text-secondary leading-relaxed space-y-4">
              {paragraphs.map((paragraph, idx) => (
                <div
                  key={idx}
                  dangerouslySetInnerHTML={{ __html: paragraph }}
                />
              ))}
            </div>
            <div className="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-10">
              {data.highlights.map((item, idx) => {
                const Icon = iconMap[item.icon] || Building2;
                return (
                  <div key={idx} className="glass-card rounded-xl p-4 text-center group" style={{ transitionDelay: `${idx * 100}ms` }}>
                    <div className="w-10 h-10 mx-auto rounded-lg bg-hgc-about-gold/10 flex items-center justify-center mb-2 group-hover:bg-hgc-about-gold/20 transition-colors">
                      <Icon className="w-5 h-5 text-hgc-about-gold" />
                    </div>
                    <p className="text-hgc-about-text-secondary text-xs font-medium">{getText(item.label, lang)}</p>
                  </div>
                );
              })}
            </div>
          </div>

          {/* Image Side */}
          <div className={`relative transition-all duration-1000 delay-300 ${isVisible ? 'opacity-100 translate-x-0' : 'opacity-0 ' + (lang === 'dari' || lang === 'pashto' ? '-translate-x-12' : 'translate-x-12')}`}>
            <div className="relative">
              <div className="relative rounded-2xl overflow-hidden aspect-[4/5]">
                <div className="absolute inset-0 bg-cover bg-center img-zoom" style={{ backgroundImage: `url(${data.mainImage})` }} />
                <div className="absolute inset-0 bg-gradient-to-t from-hgc-navy/40 via-transparent to-transparent" />
              </div>

              {/* Floating Card */}
              <div className={`absolute -bottom-6 bg-white border border-hgc-about-card-border rounded-2xl p-5 shadow-xl glow-gold max-w-[200px] ${lang === 'dari' || lang === 'pashto' ? '-right-6' : '-left-6'}`}>
                <p className="text-hgc-about-gold text-3xl font-bold mb-1">{data.floatingCard.value}</p>
                <p className="text-hgc-about-text-muted text-sm">{floatingLabel}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section >
  );
}

function toPersianNumber(num: number): string {
  const persianDigits = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
  return String(num).split("").map((d) => persianDigits[parseInt(d)] || d).join("");
}