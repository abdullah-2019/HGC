"use client";

import Link from "next/link";
import { ArrowRight, Phone, Star } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import Particles from "@/app/components/Particles";

export default function HeroSection() {
  const { lang, dir } = useI18n();

  return (
    <section className="relative min-h-screen flex items-center justify-center overflow-hidden">
      {/* Background layers */}
      <div className="absolute inset-0">
        <div className="absolute inset-0 bg-[url('/images/hero-construction.webp')] bg-cover bg-center" />
        <div className="absolute inset-0 bg-[#0A1628]/85" />
        <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_transparent_0%,_#0A1628_70%)]" />
      </div>
      <div className="absolute inset-0 opacity-10">
        <div
          className="absolute inset-0"
          style={{
            backgroundImage: `linear-gradient(rgba(201,162,39,0.3) 1px, transparent 1px), linear-gradient(90deg, rgba(201,162,39,0.3) 1px, transparent 1px)`,
            backgroundSize: "60px 60px",
          }}
        />
      </div>

      {/* Particles - client-only to avoid hydration mismatch */}
      <Particles count={30} />

      {/* Content */}
      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#C9A227]/10 border border-[#C9A227]/20 mb-8 animate-fade-in">
          <Star className="w-4 h-4 text-[#C9A227]" />
          <span className="text-[#C9A227] text-sm font-medium">
            {lang === "en"
              ? "Since 2001 — Building Afghanistan's Future"
              : lang === "dari"
                ? "از سال ۲۰۰۱ — ساختن آینده افغانستان"
                : "له ۲۰۰۱ کال راهیسې — د افغانستان راتلونکی جوړول"}
          </span>
        </div>

        <h1 className="text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-bold text-white mb-6 leading-tight tracking-tight">
          {lang === "en" ? (
            <>
              Building <span className="text-[#C9A227]">Afghanistan&apos;s</span>
              <br />
              Future
            </>
          ) : lang === "dari" ? (
            <>
              <span className="text-[#C9A227]">آینده</span> افغانستان
              <br />
              را می سازیم
            </>
          ) : (
            <>
              د <span className="text-[#C9A227]">افغانستان</span>
              <br />
              راتلونکی جوړوو
            </>
          )}
        </h1>

        <p className="text-xl text-white/60 max-w-3xl mx-auto mb-12 leading-relaxed">
          {lang === "en"
            ? "Construction • Mining • Logistics • Financial Services — A diversified conglomerate driving national development across 38+ provinces."
            : lang === "dari"
              ? "ساختمان • استخراج معادن • لوژستیک • خدمات مالی — یک گروپ متنوع که توسعه ملی را در بیش از ۳۸ ولایت هدایت می کند."
              : "ودانۍ • د کانونو استخراج • لوجستیک • مالي خدمات — یو متنوع ګروپ چې په ۳۸+ ولایتونو کې ملي پراختیا رهبري کوي."}
        </p>

        <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
          <Link
            href="/projects"
            className="group flex items-center gap-2 px-8 py-4 bg-[#C9A227] text-[#0A1628] font-bold rounded-xl hover:bg-[#C9A227]/90 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-[#C9A227]/20"
          >
            {t(lang, "common.viewProjects")}
            <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
          </Link>
          <Link
            href="/contact"
            className="flex items-center gap-2 px-8 py-4 border-2 border-white/20 text-white font-semibold rounded-xl hover:bg-white/5 hover:border-[#C9A227]/50 transition-all duration-300"
          >
            <Phone className="w-5 h-5" />
            {t(lang, "common.contactUs")}
          </Link>
        </div>

        <div className="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
          <div className="w-6 h-10 rounded-full border-2 border-white/20 flex items-start justify-center p-2">
            <div className="w-1.5 h-3 bg-[#C9A227] rounded-full animate-pulse" />
          </div>
        </div>
      </div>
    </section>
  );
}