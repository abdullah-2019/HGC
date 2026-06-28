"use client";

import { useEffect, useRef, useState } from "react";
import { Target, CheckCircle2 } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

const missionPoints = [
  {
    text: "Deliver world-class infrastructure projects that exceed client expectations",
    textDari: "ارائه پروژه‌های زیرساختی درجه یک که فراتر از انتظارات مشتری باشد",
  },
  {
    text: "Extract and export Afghanistan's mineral wealth responsibly and sustainably",
    textDari: "استخراج و صادرات ثروت معدنی افغانستان به صورت مسئولانه و پایدار",
  },
  {
    text: "Create employment opportunities and build local capacity nationwide",
    textDari: "ایجاد فرصت‌های شغلی و ایجاد ظرفیت محلی در سراسر کشور",
  },
  {
    text: "Maintain the highest standards of safety, quality, and environmental stewardship",
    textDari: "حفظ بالاترین استانداردهای ایمنی، کیفیت و سرپرستی محیط زیست",
  },
];

export default function MissionSection() {
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
      { threshold: 0.2 }
    );
    if (sectionRef.current) observer.observe(sectionRef.current);
    return () => observer.disconnect();
  }, []);

  return (
    <section ref={sectionRef} className="about-section py-24 lg:py-32 bg-[#080F1A] relative overflow-hidden">
      {/* Decorative Background */}
      <div className="absolute top-0 right-0 w-1/2 h-full bg-[radial-gradient(circle_at_top_right,_rgba(201,162,39,0.06)_0%,_transparent_60%)]" />
      <div className="absolute -bottom-20 -left-20 w-80 h-80 bg-[#C9A227]/5 rounded-full blur-3xl" />

      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
          {/* Image Side */}
          <div className={`relative transition-all duration-1000 ${isVisible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-12'}`}>
            <div className="relative">
              <div className="relative rounded-2xl overflow-hidden aspect-square">
                <div className="absolute inset-0 bg-[url('/images/mission.jpg')] bg-cover bg-center img-zoom" />
                <div className="absolute inset-0 bg-gradient-to-br from-[#0A1628]/30 to-transparent" />
              </div>

              {/* Quote Card */}
              <div className="absolute -bottom-8 -right-4 lg:-right-8 bg-[#0A1628] border border-[#C9A227]/20 rounded-2xl p-6 shadow-2xl max-w-[280px]">
                <Target className="w-8 h-8 text-[#C9A227] mb-3" />
                <p className="text-white/80 text-sm italic leading-relaxed">
                  &ldquo;{lang === "en"
                    ? "To enable long-term value creation across strategic industries."
                    : lang === "dari"
                      ? "ایجاد ارزش بلندمدت در صنایع استراتژیک."
                      : "د ستراتیژیکو صنعتونو کې د اوږدمهاله ارزښت رامنځته کول."}&rdquo;
                </p>
              </div>

              {/* Decorative */}
              <div className="absolute -top-4 -left-4 w-full h-full border border-[#C9A227]/10 rounded-2xl -z-10" />
            </div>
          </div>

          {/* Text Side */}
          <div className={`transition-all duration-1000 delay-200 ${isVisible ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-12'}`}>
            <div className="flex items-center gap-3 mb-6">
              <div className="gold-line" />
              <span className="text-[#C9A227] text-sm font-semibold tracking-wider uppercase">
                {lang === "en" ? "Our Mission" : lang === "dari" ? "ماموریت ما" : "زموږ ماموریت"}
              </span>
            </div>

            <h2 className="about-section-title font-bold text-white mb-8">
              {lang === "en" ? (
                <>
                  Enabling <span className="text-gold-gradient">Long-Term Value</span> Creation
                </>
              ) : lang === "dari" ? (
                <>
                  ایجاد <span className="text-gold-gradient">ارزش بلندمدت</span>
                </>
              ) : (
                <>
                  د <span className="text-gold-gradient">اوږدمهاله ارزښت</span> رامنځته کول
                </>
              )}
            </h2>

            <p className="about-body-text text-white/60 mb-10">
              {lang === "en"
                ? "Our mission reflects our role as a diversified platform supporting mining, construction, logistics, and financial services through structured governance, quality standards, and disciplined operations."
                : lang === "dari"
                  ? "ماموریت ما نقش ما را به عنوان یک پلتفرم متنوع منعکس می‌کند که از استخراج معادن، ساختمان، لوژستیک و خدمات مالی از طریق حاکمیت ساختاریافته، استانداردهای کیفی و عملیات منضبط پشتیبانی می‌کند."
                  : "زموږ ماموریت زموږ د رول په توګه د یوې متنوعې پلیټ فارم په توګه منعکسوي چې د جوړولو، د کانونو استخراج، لوجستیک او مالي خدماتو د جوړولو حکومتولي، د کیفیت معیارونو او منضبطو عملیاتو له لارې ملاتړ کوي."}
            </p>

            {/* Mission Points */}
            <div className="space-y-5">
              {missionPoints.map((point, idx) => (
                <div
                  key={idx}
                  className={`flex items-start gap-4 transition-all duration-700 ${isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'}`}
                  style={{ transitionDelay: `${400 + idx * 150}ms` }}
                >
                  <div className="flex-shrink-0 w-6 h-6 rounded-full bg-[#C9A227]/10 flex items-center justify-center mt-0.5">
                    <CheckCircle2 className="w-4 h-4 text-[#C9A227]" />
                  </div>
                  <p className="text-white/70 text-sm leading-relaxed">
                    {lang === "en" ? point.text : point.textDari}
                  </p>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}