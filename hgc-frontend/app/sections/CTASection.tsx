"use client";

import Link from "next/link";
import { ArrowRight, Phone } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";

export default function CTASection() {
  const { lang } = useI18n();
  const isRtl = lang === "dari" || lang === "pashto";

  return (
    <section dir={isRtl ? "rtl" : "ltr"} className="py-24 bg-hgc-bg relative overflow-hidden">
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--color-hgc-gold)/5_0%,_transparent_60%)]" />
      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
        <h2 className="text-4xl lg:text-5xl font-bold text-hgc-text mb-6">
          {lang === "en" ? (<>Ready to Start Your <span className="text-hgc-gold">Project?</span></>)
            : lang === "dari" ? (<>آماده شروع <span className="text-hgc-gold">پروژه خود</span> هستید؟</>)
            : (<>ستاسو <span className="text-hgc-gold">پروژې</span> پیلولو لپاره چمتو یاست؟</>)}
        </h2>
        <p className="text-hgc-text-secondary text-lg mb-10 max-w-2xl mx-auto">
          {lang === "en" ? "Contact us for a free consultation and quotation. Our team of experts is ready to bring your vision to life."
            : lang === "dari" ? "برای مشاوره رایگان و پیشنهاد قیمت با ما تماس بگیرید. تیم متخصصان ما آماده است چشم انداز شما را زنده کند."
            : "د وړیا مشورې او قیمت وړاندیز لپاره موږ سره اړیکه ونیسئ. زموږ د متخصصینو ټیم ستاسو لید زنده کولو لپاره چمتو دی."}
        </p>
        <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
          <Link href="/contact" className="group flex items-center gap-2 px-8 py-4 bg-hgc-gold text-hgc-text font-bold rounded-xl hover:bg-hgc-gold/90 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-hgc-gold/20">
            {t(lang, "common.getQuote")}
            <ArrowRight className={`w-5 h-5 transition-transform ${isRtl ? "rotate-180 group-hover:-translate-x-1" : "group-hover:translate-x-1"}`} />
          </Link>
          <a href="tel:+93711111694" className="flex items-center gap-2 px-8 py-4 border-2 border-hgc-border text-hgc-text font-semibold rounded-xl hover:bg-hgc-card-hover hover:border-hgc-gold/50 transition-all duration-300">
            <Phone className="w-5 h-5" />
            {t(lang, "common.callUs")}
          </a>
        </div>
      </div>
    </section>
  );
}