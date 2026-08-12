"use client";

import { useEffect, useRef, useState } from "react";
import { Eye, Compass, Lightbulb, Heart } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { getText, safeArray, safeObject, safeString } from "./about-utils";

const iconMap: Record<string, React.ElementType> = {
  Compass, Lightbulb, Heart, Eye,
};

interface LocalizedText {
  en: string | null;
  dari: string | null;
  pashto: string | null;
}

interface AboutVisionPillar {
  icon: string;
  title: LocalizedText;
  description: LocalizedText;
}

interface AboutVisionData {
  sectionLabel: LocalizedText;
  title: LocalizedText;
  description: LocalizedText;
  image: string;
  badge: { value: string; label: LocalizedText };
  pillars: AboutVisionPillar[];
}

interface VisionSectionProps {
  vision: AboutVisionData | null;
}

const fallback: AboutVisionData = {
  sectionLabel: { en: "Our Vision", dari: "چشم‌انداز ما", pashto: "زموږ لید" },
  title: { en: "A Trusted Enterprise for Generations", dari: "یک مؤسسه مورد اعتماد برای نسل‌ها", pashto: "د نسلونو لپاره یو باوري سازمان" },
  description: {
    en: "Our vision expresses the Group's aspiration to be associated with sustainable economic value, modern infrastructure, and credible participation in international markets. We envision an Afghanistan where world-class infrastructure powers prosperity for all.",
    dari: "چشم‌انداز ما آرزوی گروه را برای ارتباط با ارزش اقتصادی پایدار، زیرساخت‌های مدرن و مشارکت معتبر در بازارهای بین‌المللی بیان می‌کند. ما افغانستانی را تصور می‌کنیم که زیرساخت‌های درجه جهانی رونق را برای همه به ارمغان بیاورد.",
    pashto: "زموږ لید د ګروپ هیله څرګندوي چې د پایدارې اقتصادي ارزښت، عصري زیربنو، او په نړیوالو بازارونو کې د باوري ګډون سره تړاو ولري. موږ د افغانستان یو تصور لرو چې د نړیوالو معیارونو زیربنا ټولو ته د ګټې ځواک ورکړي.",
  },
  image: "/images/placeholder.png",
  badge: { value: "2030", label: { en: "Vision Target", dari: "هدف چشم‌انداز", pashto: "د لید هدف" } },
  pillars: [
    { icon: "Compass", title: { en: "Trusted Enterprise", dari: "مؤسسه مورد اعتماد", pashto: "باوري سازمان" }, description: { en: "To be recognized as Afghanistan's most trusted conglomerate, synonymous with quality and integrity.", dari: "شناخته شدن به عنوان معتبرترین گروه افغانستان، مترادف با کیفیت و صداقت.", pashto: "د افغانستان تر ټولو باوري شرکت په توګه پیژندل شوي، چې د کیفیت او صداقت مترادم وي." } },
    { icon: "Lightbulb", title: { en: "Innovation Leader", dari: "رهبر نوآوری", pashto: "د نوښت رهبر" }, description: { en: "Pioneering modern infrastructure solutions and sustainable mining practices across the region.", dari: "پیشگام راه‌حل‌های زیرساختی مدرن و شیوه‌های پایدار استخراج معادن در سراسر منطقه.", pashto: "د سیمې په اوږدو کې د عصري زیربنايي حلونو او دوامداره د کانونو د استخراج د کړنو مخکښوالی." } },
    { icon: "Heart", title: { en: "Community Impact", dari: "تأثیر جامعه", pashto: "د ټولنې اغیز" }, description: { en: "Creating lasting positive change through employment, education, and economic development.", dari: "ایجاد تغییر مثبت پایدار از طریق اشتغال، آموزش و توسعه اقتصادی.", pashto: "د دندو، زده‌کړې او اقتصادي پراختیا له لارې دوامداره مثبت بدلون رامنځته کول." } },
  ],
};

export default function VisionSection({ vision }: VisionSectionProps) {
  const { lang } = useI18n();
  const sectionRef = useRef<HTMLDivElement>(null);
  const [isVisible, setIsVisible] = useState(false);

  const isRtl = lang === "dari" || lang === "pashto";

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => { if (entry.isIntersecting) { setIsVisible(true); observer.disconnect(); } },
      { threshold: 0.2 }
    );
    if (sectionRef.current) observer.observe(sectionRef.current);
    return () => observer.disconnect();
  }, []);

  const data: AboutVisionData = {
    sectionLabel: safeObject(vision?.sectionLabel, fallback.sectionLabel),
    title: safeObject(vision?.title, fallback.title),
    description: safeObject(vision?.description, fallback.description),
    image: safeString(vision?.image, fallback.image),
    badge: safeObject(vision?.badge, fallback.badge),
    pillars: safeArray(vision?.pillars, fallback.pillars),
  };

  const sectionLabel = getText(data.sectionLabel, lang);
  const title = getText(data.title, lang);
  const description = getText(data.description, lang);
  const badgeLabel = getText(data.badge.label, lang);

  const renderTitle = () => {
    if (!title) return null;
    if (lang === "en") { const parts = title.split("Trusted Enterprise"); if (parts.length === 2) return <>{parts[0]}<span className="text-gold-gradient">Trusted Enterprise</span>{parts[1]}</>; }
    if (lang === "dari") { const parts = title.split("مؤسسه مورد اعتماد"); if (parts.length === 2) return <>{parts[0]}<span className="text-gold-gradient">مؤسسه مورد اعتماد</span>{parts[1]}</>; }
    const parts = title.split("باوري سازمان"); if (parts.length === 2) return <>{parts[0]}<span className="text-gold-gradient">باوري سازمان</span>{parts[1]}</>;
    return <>{title}</>;
  };

  return (
    <section
      ref={sectionRef}
      dir={isRtl ? "rtl" : "ltr"}
      className="about-section py-24 lg:py-32 bg-hgc-about-bg relative overflow-hidden"
    >
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_rgba(212,175,55,0.05)_0%,_transparent_60%)]" />
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-hgc-about-gold/5 rounded-full blur-3xl" />
      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid lg:grid-cols-2 gap-16 lg:gap-24 items-start">
          {/* Text Content */}
          <div
            className={`relative transition-all duration-1000 order-2 lg:order-1 rtl:lg:order-2 ${
              isVisible
                ? "opacity-100 translate-x-0"
                : isRtl
                ? "opacity-0 translate-x-12"
                : "opacity-0 -translate-x-12"
            }`}
          >
            <div className="flex items-center gap-3 mb-6">
              <div className="gold-line" />
              <span className="text-hgc-about-gold text-sm font-semibold tracking-wider uppercase">{sectionLabel}</span>
            </div>
            <h2 className="about-section-title font-bold text-hgc-about-text mb-8">{renderTitle()}</h2>
            <p className="about-body-text text-hgc-about-text-secondary mb-10">{description}</p>
            <div className="space-y-6">
              {data.pillars.map((pillar, idx) => {
                const Icon = iconMap[pillar.icon] || Compass;
                return (
                  <div
                    key={idx}
                    className={`glass-card rounded-xl p-5 flex items-start gap-4 transition-all duration-700 ${
                      isVisible ? "opacity-100 translate-y-0" : "opacity-0 translate-y-4"
                    }`}
                    style={{ transitionDelay: `${300 + idx * 150}ms` }}
                  >
                    <div className="flex-shrink-0 w-12 h-12 rounded-xl bg-hgc-about-gold/10 flex items-center justify-center">
                      <Icon className="w-6 h-6 text-hgc-about-gold" />
                    </div>
                    <div>
                      <h4 className="text-hgc-about-text font-semibold mb-1">{getText(pillar.title, lang)}</h4>
                      <p className="text-hgc-about-text-muted text-sm leading-relaxed">{getText(pillar.description, lang)}</p>
                    </div>
                  </div>
                );
              })}
            </div>
          </div>

          {/* Image Side */}
          <div
            className={`relative transition-all duration-1000 delay-200 order-1 lg:order-2 rtl:lg:order-1 ${
              isVisible
                ? "opacity-100 translate-x-0"
                : isRtl
                ? "opacity-0 -translate-x-12"
                : "opacity-0 translate-x-12"
            }`}
          >
            <div className="relative">
              <div className="relative rounded-2xl overflow-hidden aspect-[3/4]">
                <div className="absolute inset-0 bg-cover bg-center img-zoom" style={{ backgroundImage: `url(${data.image})` }} />
                <div className="absolute inset-0 bg-gradient-to-t from-hgc-navy-deep/50 via-transparent to-hgc-navy-deep/20" />
              </div>

              {/* Floating Badge Card */}
              <div
                className={`absolute top-8 bg-white border border-hgc-about-gold/30 rounded-2xl p-5 shadow-xl ${
                  isRtl ? "-right-4 lg:-right-8" : "-left-4 lg:-left-8"
                }`}
              >
                <Eye className="w-8 h-8 text-hgc-about-gold mb-2" />
                <p className="text-hgc-about-text font-bold text-lg">{data.badge.value}</p>
                <p className="text-hgc-about-text-muted text-xs">{badgeLabel}</p>
              </div>

              {/* Decorative rings */}
              <div
                className={`absolute -bottom-6 w-48 h-48 border border-hgc-about-gold/10 rounded-full ${
                  isRtl ? "-left-6" : "-right-6"
                }`}
              />
              <div
                className={`absolute -bottom-6 w-32 h-32 border border-hgc-about-gold/20 rounded-full ${
                  isRtl ? "-left-6" : "-right-6"
                }`}
              />
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}