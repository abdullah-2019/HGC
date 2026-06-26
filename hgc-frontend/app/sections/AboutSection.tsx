"use client";

import Link from "next/link";
import { Award, CheckCircle2, TrendingUp, Building2, Mountain, Road, Truck, ArrowRight } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

export default function AboutSection() {
  const { lang } = useI18n();

  const badges = [
    { icon: CheckCircle2, text: "ISO Certified", textDari: "گواهی ISO" },
    { icon: CheckCircle2, text: "AISA Licensed", textDari: "جواز AISA" },
    { icon: CheckCircle2, text: "Ministry Approved", textDari: "تایید وزارت" },
  ];

  return (
    <section className="py-24 bg-[#0A1628] relative">
      <div className="absolute top-0 right-0 w-1/2 h-full bg-[#C9A227]/[0.02]" />
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div className="grid lg:grid-cols-2 gap-16 items-center">
          {/* Text Content */}
          <div>
            <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-6">
              <Award className="w-4 h-4" />
              {lang === "en" ? "About HGC" : lang === "dari" ? "درباره گروپ حافظ" : "د حافظ ګروپ په اړه"}
            </div>

            <h2 className="text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">
              {lang === "en" ? (
                <>
                  Leading Afghan Conglomerate Since <span className="text-[#C9A227]">2001</span>
                </>
              ) : lang === "dari" ? (
                <>
                  گروپ پیشرو افغان از سال <span className="text-[#C9A227]">۲۰۰۱</span>
                </>
              ) : (
                <>
                  مخکښ افغان ګروپ له <span className="text-[#C9A227]">۲۰۰۱</span> کال راهیسې
                </>
              )}
            </h2>

            <p className="text-white/60 text-lg leading-relaxed mb-6">
              {lang === "en"
                ? "Hafez Group of Companies is a leading Afghan conglomerate operating in construction, mining, logistics, and financial services. With over 200 completed projects across 38+ provinces, we are transforming Afghanistan's infrastructure landscape."
                : lang === "dari"
                  ? "گروپ کمپنی های حافظ یک گروپ پیشرو افغان است که در ساختمان، استخراج معادن، لوژستیک و خدمات مالی فعالیت می کند. با بیش از ۲۰۰ پروژه تکمیل شده در ۳۸+ ولایت، ما چشم انداز زیرساخت های افغانستان را تغییر می دهیم."
                  : "د حافظ شرکتونو ګروپ یو مخکښ افغان ګروپ دی چې په جوړولو، د کانونو استخراج، لوجستیک او مالي خدماتو کې فعالیت کوي. په ۳۸+ ولایتونو کې د ۲۰۰+ بشپړو شویو پروژو سره، موږ د افغانستان د زیربنا منظره بدلوو."}
            </p>

            <p className="text-white/60 text-lg leading-relaxed mb-8">
              {lang === "en"
                ? "Our group comprises six specialized companies, each bringing unique expertise to deliver comprehensive solutions for government agencies, international organizations, and private sector clients."
                : lang === "dari"
                  ? "گروپ ما شامل شش شرکت تخصصی است که هر کدام تخصص منحصر به فردی را برای ارائه راه حل های جامع به سازمان های دولتی، سازمان های بین المللی و مشتریان بخش خصوصی به ارمغان می آورند."
                  : "زموږ ګروپ شپږ تخصصي شرکتونه لري، هر یو یې د دولتي ادارو، نړیوالو سازمانونو او خصوصي سکتور پیرودونکو ته جامع حلونه وړاندې کولو لپاره ځانګړې مهارت راوړي."}
            </p>

            <div className="flex flex-wrap gap-4 mb-8">
              {badges.map((item, i) => (
                <div key={i} className="flex items-center gap-2 text-white/70">
                  <item.icon className="w-5 h-5 text-[#C9A227]" />
                  <span>{lang === "en" ? item.text : item.textDari}</span>
                </div>
              ))}
            </div>

            <Link
              href="/about"
              className="inline-flex items-center gap-2 text-[#C9A227] font-semibold hover:gap-3 transition-all"
            >
              {lang === "en" ? "Read More" : lang === "dari" ? "بیشتر بخوانید" : "نور ولولئ"}
              <ArrowRight className="w-5 h-5" />
            </Link>
          </div>

          {/* Image Grid */}
          <div className="relative">
            <div className="grid grid-cols-2 gap-4">
              <div className="space-y-4">
                <div className="aspect-[4/5] rounded-2xl bg-[#C9A227]/10 border border-[#C9A227]/20 overflow-hidden relative">
                  <div className="w-full h-full bg-[#C9A227]/5 flex items-center justify-center">
                    <Building2 className="w-16 h-16 text-[#C9A227]/30" />
                  </div>
                </div>
                <div className="aspect-square rounded-2xl bg-[#1A237E]/10 border border-[#1A237E]/20 overflow-hidden relative">
                  <div className="w-full h-full bg-[#1A237E]/5 flex items-center justify-center">
                    <Mountain className="w-12 h-12 text-[#1A237E]/30" />
                  </div>
                </div>
              </div>
              <div className="space-y-4 pt-8">
                <div className="aspect-square rounded-2xl bg-[#2E7D32]/10 border border-[#2E7D32]/20 overflow-hidden relative">
                  <div className="w-full h-full bg-[#2E7D32]/5 flex items-center justify-center">
                    <Road className="w-12 h-12 text-[#2E7D32]/30" />
                  </div>
                </div>
                <div className="aspect-[4/5] rounded-2xl bg-[#00838F]/10 border border-[#00838F]/20 overflow-hidden relative">
                  <div className="w-full h-full bg-[#00838F]/5 flex items-center justify-center">
                    <Truck className="w-16 h-16 text-[#00838F]/30" />
                  </div>
                </div>
              </div>
            </div>

            <div className="absolute -bottom-6 -left-6 bg-[#0A1628] border border-[#C9A227]/30 rounded-2xl p-4 shadow-xl">
              <div className="flex items-center gap-3">
                <div className="w-12 h-12 rounded-xl bg-[#C9A227]/10 flex items-center justify-center">
                  <TrendingUp className="w-6 h-6 text-[#C9A227]" />
                </div>
                <div>
                  <p className="text-white font-bold text-lg">200+</p>
                  <p className="text-white/50 text-xs">
                    {lang === "en" ? "Projects Done" : lang === "dari" ? "پروژه انجام شده" : "ترسره شوې پروژې"}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}