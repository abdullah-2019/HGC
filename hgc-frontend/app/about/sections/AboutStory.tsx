"use client";

import { useEffect, useRef, useState } from "react";
import { Building2, Globe, TrendingUp } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

export default function AboutStory() {
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

  const highlights = [
    { icon: Building2, label: "6 Companies", labelDari: "۶ شرکت" },
    { icon: Globe, label: "38+ Provinces", labelDari: "۳۸+ ولایت" },
    { icon: TrendingUp, label: "200+ Projects", labelDari: "۲۰۰+ پروژه" },
  ];

  return (
    <section ref={sectionRef} className="about-section py-24 lg:py-32 bg-[#0A1628]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
          {/* Text Content */}
          <div className={`transition-all duration-1000 ${isVisible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-12'}`}>
            <div className="flex items-center gap-3 mb-6">
              <div className="gold-line" />
              <span className="text-[#C9A227] text-sm font-semibold tracking-wider uppercase">
                {lang === "en" ? "Our Story" : lang === "dari" ? "داستان ما" : "زموږ کیسه"}
              </span>
            </div>

            <h2 className="about-section-title font-bold text-white mb-8">
              {lang === "en" ? (
                <>
                  Leading Afghan Conglomerate Since{" "}
                  <span className="text-gold-gradient">2001</span>
                </>
              ) : lang === "dari" ? (
                <>
                  گروپ پیشرو افغان از سال{" "}
                  <span className="text-gold-gradient">۲۰۰۱</span>
                </>
              ) : (
                <>
                  مخکښ افغان ګروپ له{" "}
                  <span className="text-gold-gradient">۲۰۰۱</span> کال راهیسې
                </>
              )}
            </h2>

            <div className="space-y-6 about-body-text text-white/60">
              <p>
                {lang === "en"
                  ? "Hafez Group of Companies (HGC) was founded in 2001 with a singular vision: to rebuild and transform Afghanistan's infrastructure landscape. What began as a modest construction firm has evolved into one of the nation's most diversified and respected conglomerates."
                  : lang === "dari"
                    ? "گروپ کمپنی‌های حافظ (HGC) در سال ۲۰۰۱ با یک چشم‌انداز واحد تأسیس شد: بازسازی و تحول چشم‌انداز زیرساخت‌های افغانستان. آنچه که به عنوان یک شرکت ساختمانی متواضع آغاز شد، به یکی از متنوع‌ترین و محترم‌ترین گروه‌های کشور تبدیل شده است."
                    : "د حافظ شرکتونو ګروپ (HGC) په ۲۰۰۱ کال کې د یوې واحدې لید سره تاسیس شو: د افغانستان د زیربنو د منظرې بیا رغونه او بدلون. هغه څه چې د یوې عادي جوړونې شرکت په توګه پیل شول، په هیواد کې یو له تر ټولو متنوع او محترمو ګروپونو څخه واوښت."}
              </p>
              <p>
                {lang === "en"
                  ? "Today, HGC operates six specialized companies across construction, mining, logistics, and financial services. With over 200 completed projects spanning 38+ provinces, we have built a reputation for quality, reliability, and innovation that extends beyond Afghanistan's borders."
                  : lang === "dari"
                    ? "امروز، HGC شش شرکت تخصصی در ساختمان، استخراج معادن، لوژستیک و خدمات مالی اداره می‌کند. با بیش از ۲۰۰ پروژه تکمیل شده در ۳۸+ ولایت، ما اعتباری برای کیفیت، قابلیت اطمینان و نوآوری ساخته‌ایم که فراتر از مرزهای افغانستان گسترش یافته است."
                    : "نن ورځ، HGC په جوړونو، د کانونو استخراج، لوجستیک او مالي خدماتو کې شپږ تخصصي شرکتونه اداره کوي. په ۳۸+ ولایتونو کې د ۲۰۰+ بشپړو شویو پروژو سره، موږ د کیفیت، باوري والي او نوښت لپاره یو اعتبار رامنځته کړی چې د افغانستان له پولو څخه هاخوا خپریږي."}
              </p>
              <p>
                {lang === "en"
                  ? "Our partnerships with international organizations including UNOPS, World Bank, USACE, and UNICEF reflect our commitment to global standards and sustainable development. We don't just build structures — we build trust, communities, and the foundation for Afghanistan's prosperous future."
                  : lang === "dari"
                    ? "مشارکت‌های ما با سازمان‌های بین‌المللی از جمله UNOPS، بانک جهانی، USACE و UNICEF تعهد ما را به استانداردهای جهانی و توسعه پایدار منعکس می‌کند. ما فقط سازه‌ها را نمی‌سازیم — ما اعتماد، جوامع و بنیان آینده شکوفای افغانستان را می‌سازیم."
                    : "زموږ د UNOPS، نړیوال بانک، USACE، او UNICEF په ګډون د نړیوالو سازمانونو سره شریکي زموږ د نړیوالو معیارونو او پایدارې پراختیا ته ژمنه منعکسوي. موږ یوازې جوړښتونه نه جوړوو — موږ باور، ټولنې، او د افغانستان د ګټور راتلونکي بنسټ جوړوو."}
              </p>
            </div>

            {/* Highlights */}
            <div className="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-10">
              {highlights.map((item, idx) => {
                const Icon = item.icon;
                return (
                  <div
                    key={idx}
                    className="glass-card rounded-xl p-4 text-center group"
                    style={{ transitionDelay: `${idx * 100}ms` }}
                  >
                    <div className="w-10 h-10 mx-auto rounded-lg bg-[#C9A227]/10 flex items-center justify-center mb-2 group-hover:bg-[#C9A227]/20 transition-colors">
                      <Icon className="w-5 h-5 text-[#C9A227]" />
                    </div>
                    <p className="text-white/70 text-xs font-medium">
                      {lang === "en" ? item.label : item.labelDari}
                    </p>
                  </div>
                );
              })}
            </div>
          </div>

          {/* Image Side */}
          <div className={`relative transition-all duration-1000 delay-300 ${isVisible ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-12'}`}>
            <div className="relative">
              {/* Main Image */}
              <div className="relative rounded-2xl overflow-hidden aspect-[4/5]">
                <div className="absolute inset-0 bg-[url('/images/placeholder.png')] bg-cover bg-center img-zoom" />
                <div className="absolute inset-0 bg-gradient-to-t from-[#0A1628]/60 via-transparent to-transparent" />
              </div>

              {/* Floating Card */}
              <div className="absolute -bottom-6 -left-6 bg-[#0A1628] border border-[#C9A227]/20 rounded-2xl p-5 shadow-2xl glow-gold max-w-[200px]">
                <p className="text-[#C9A227] text-3xl font-bold mb-1">24+</p>
                <p className="text-white/60 text-sm">
                  {lang === "en" ? "Years of Excellence" : lang === "dari" ? "سال excellence" : "د عالي کیفیت کالونه"}
                </p>
              </div>

              {/* Decorative Element */}
              <div className="absolute -top-4 -right-4 w-24 h-24 border border-[#C9A227]/20 rounded-2xl -z-10" />
              <div className="absolute -bottom-4 -right-4 w-32 h-32 border border-[#C9A227]/10 rounded-2xl -z-10" />
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}