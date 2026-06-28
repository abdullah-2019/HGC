"use client";

import { useEffect, useRef, useState } from "react";
import { Eye, Compass, Lightbulb, Heart } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

const visionPillars = [
  {
    icon: Compass,
    title: "Trusted Enterprise",
    titleDari: "مؤسسه مورد اعتماد",
    desc: "To be recognized as Afghanistan's most trusted conglomerate, synonymous with quality and integrity.",
    descDari: "شناخته شدن به عنوان معتبرترین گروه افغانستان، مترادف با کیفیت و صداقت.",
  },
  {
    icon: Lightbulb,
    title: "Innovation Leader",
    titleDari: "رهبر نوآوری",
    desc: "Pioneering modern infrastructure solutions and sustainable mining practices across the region.",
    descDari: "پیشگام راه‌حل‌های زیرساختی مدرن و شیوه‌های پایدار استخراج معادن در سراسر منطقه.",
  },
  {
    icon: Heart,
    title: "Community Impact",
    titleDari: "تأثیر جامعه",
    desc: "Creating lasting positive change through employment, education, and economic development.",
    descDari: "ایجاد تغییر مثبت پایدار از طریق اشتغال، آموزش و توسعه اقتصادی.",
  },
];

export default function VisionSection() {
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
    <section ref={sectionRef} className="about-section py-24 lg:py-32 bg-[#0A1628] relative overflow-hidden">
      {/* Background Effects */}
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_rgba(201,162,39,0.05)_0%,_transparent_60%)]" />
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[#C9A227]/3 rounded-full blur-3xl" />

      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
          {/* Text Side */}
          <div className={`transition-all duration-1000 ${isVisible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-12'}`}>
            <div className="flex items-center gap-3 mb-6">
              <div className="gold-line" />
              <span className="text-[#C9A227] text-sm font-semibold tracking-wider uppercase">
                {lang === "en" ? "Our Vision" : lang === "dari" ? "چشم‌انداز ما" : "زموږ لید"}
              </span>
            </div>

            <h2 className="about-section-title font-bold text-white mb-8">
              {lang === "en" ? (
                <>
                  A <span className="text-gold-gradient">Trusted Enterprise</span> for Generations
                </>
              ) : lang === "dari" ? (
                <>
                  یک <span className="text-gold-gradient">مؤسسه مورد اعتماد</span> برای نسل‌ها
                </>
              ) : (
                <>
                  د نسلونو لپاره یو <span className="text-gold-gradient">باوري سازمان</span>
                </>
              )}
            </h2>

            <p className="about-body-text text-white/60 mb-10">
              {lang === "en"
                ? "Our vision expresses the Group's aspiration to be associated with sustainable economic value, modern infrastructure, and credible participation in international markets. We envision an Afghanistan where world-class infrastructure powers prosperity for all."
                : lang === "dari"
                  ? "چشم‌انداز ما آرزوی گروه را برای ارتباط با ارزش اقتصادی پایدار، زیرساخت‌های مدرن و مشارکت معتبر در بازارهای بین‌المللی بیان می‌کند. ما افغانستانی را تصور می‌کنیم که زیرساخت‌های درجه جهانی رونق را برای همه به ارمغان بیاورد."
                  : "زموږ لید د ګروپ هیله څرګندوي چې د پایدارې اقتصادي ارزښت، عصري زیربنو، او په نړیوالو بازارونو کې د باوري ګډون سره تړاو ولري. موږ د افغانستان یو تصور لرو چې د نړیوالو معیارونو زیربنا ټولو ته د ګټې ځواک ورکړي."}
            </p>

            {/* Vision Pillars */}
            <div className="space-y-6">
              {visionPillars.map((pillar, idx) => {
                const Icon = pillar.icon;
                return (
                  <div
                    key={idx}
                    className={`glass-card rounded-xl p-5 flex items-start gap-4 transition-all duration-700 ${isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'}`}
                    style={{ transitionDelay: `${300 + idx * 150}ms` }}
                  >
                    <div className="flex-shrink-0 w-12 h-12 rounded-xl bg-[#C9A227]/10 flex items-center justify-center">
                      <Icon className="w-6 h-6 text-[#C9A227]" />
                    </div>
                    <div>
                      <h4 className="text-white font-semibold mb-1">
                        {lang === "en" ? pillar.title : pillar.titleDari}
                      </h4>
                      <p className="text-white/50 text-sm leading-relaxed">
                        {lang === "en" ? pillar.desc : pillar.descDari}
                      </p>
                    </div>
                  </div>
                );
              })}
            </div>
          </div>

          {/* Image Side */}
          <div className={`relative transition-all duration-1000 delay-200 ${isVisible ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-12'}`}>
            <div className="relative">
              <div className="relative rounded-2xl overflow-hidden aspect-[3/4]">
                <div className="absolute inset-0 bg-[url('/images/vision.jpg')] bg-cover bg-center img-zoom" />
                <div className="absolute inset-0 bg-gradient-to-t from-[#0A1628]/50 via-transparent to-[#0A1628]/20" />
              </div>

              {/* Floating Vision Badge */}
              <div className="absolute top-8 -left-4 lg:-left-8 bg-[#0A1628] border border-[#C9A227]/30 rounded-2xl p-5 shadow-2xl">
                <Eye className="w-8 h-8 text-[#C9A227] mb-2" />
                <p className="text-white font-bold text-lg">2030</p>
                <p className="text-white/50 text-xs">
                  {lang === "en" ? "Vision Target" : lang === "dari" ? "هدف چشم‌انداز" : "د لید هدف"}
                </p>
              </div>

              {/* Decorative Rings */}
              <div className="absolute -bottom-6 -right-6 w-48 h-48 border border-[#C9A227]/10 rounded-full" />
              <div className="absolute -bottom-6 -right-6 w-32 h-32 border border-[#C9A227]/20 rounded-full" />
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}