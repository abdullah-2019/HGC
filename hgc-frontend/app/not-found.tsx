"use client";

import Link from "next/link";
import {
  Home,
  Building2,
  Phone,
  ArrowLeft,
} from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

export default function NotFound() {
  const { lang } = useI18n();

  const t = {
    en: {
      headline: "Destination Not Found",
      description:
        "The page you're looking for may have been moved, renamed, or is no longer available. Explore Hafez Group of Companies through the links below.",
      returnHome: "Return Home",
      contactUs: "Contact Us",
      quickNav: "Quick Navigation",
      aboutUs: "About Us",
      projects: "Projects",
      companies: "Companies",
      products: "Products",
    },
    dari: {
      headline: "صفحه مورد نظر یافت نشد",
      description:
        "صفحه‌ای که به دنبال آن هستید ممکن است جابجا شده، تغییر نام یافته یا دیگر در دسترس نباشد. از طریق لینک‌های زیر گروپ شرکت‌های حافظ را جستجو کنید.",
      returnHome: "بازگشت به صفحه اصلی",
      contactUs: "تماس با ما",
      quickNav: "جستجوی سریع",
      aboutUs: "درباره ما",
      projects: "پروژه‌ها",
      companies: "شرکت‌ها",
      products: "محصولات",
    },
    pashto: {
      headline: "مخ په لټه شوي ونه موندل شو",
      description:
        "مخ چې تاسې یې لټوئ، ممکنه ده چې لیږدول شوی، نوم بدل شوی یا نور شتون نه لري. د لاندې لینکونو له لارې د حافظ د شرکتونو ګروپ وګورئ.",
      returnHome: "بیرته کور ته",
      contactUs: "موږ سره اړیکه ونیسئ",
      quickNav: "چټکه نیویگیشن",
      aboutUs: "زموږ په اړه",
      projects: "پروژې",
      companies: "شرکتونه",
      products: "محصولات",
    },
  };

  const copy = t[lang] ?? t.en;

  const navItems = [
    { label: copy.aboutUs, href: "/about" },
    { label: copy.projects, href: "/projects" },
    { label: copy.companies, href: "/companies" },
    { label: copy.products, href: "/products" },
  ];

  return (
    <section className="relative min-h-[calc(100vh-11rem)] overflow-hidden bg-[#0A1628] flex items-center justify-center">
      {/* Background Grid */}
      <div
        className="absolute inset-0 opacity-[0.04]"
        style={{
          backgroundImage: `
            linear-gradient(to right, #C9A227 1px, transparent 1px),
            linear-gradient(to bottom, #C9A227 1px, transparent 1px)
          `,
          backgroundSize: "80px 80px",
        }}
      />

      {/* Gold Glow */}
      <div className="absolute top-1/4 left-1/2 h-[500px] w-[500px] -translate-x-1/2 rounded-full bg-[#C9A227]/10 blur-[120px]" />

      {/* Decorative circles */}
      <div className="absolute top-20 left-20 h-3 w-3 rounded-full bg-[#C9A227]/40 animate-pulse" />
      <div className="absolute bottom-32 right-24 h-2 w-2 rounded-full bg-[#C9A227]/50 animate-pulse" />
      <div className="absolute top-40 right-40 h-4 w-4 rounded-full bg-[#C9A227]/20 animate-pulse" />

      <div className="relative z-10 max-w-5xl px-6 text-center">
        {/* 404 */}
        <div className="relative">
          <h1 className="text-[140px] md:text-[220px] font-black leading-none tracking-tighter text-white/[0.04] select-none">
            404
          </h1>

          <div className="absolute inset-0 flex items-center justify-center">
            <div className="h-24 w-24 md:h-32 md:w-32 rounded-3xl border border-[#C9A227]/30 bg-[#C9A227]/10 backdrop-blur-sm flex items-center justify-center">
              <Building2 className="h-12 w-12 md:h-16 md:w-16 text-[#C9A227]" />
            </div>
          </div>
        </div>

        {/* Headline */}
        <h2 className="mt-2 text-4xl md:text-6xl font-bold text-white">
          {copy.headline}
        </h2>

        <div className="mx-auto mt-4 h-1 w-24 rounded-full bg-[#C9A227]" />

        <p className="mx-auto mt-8 max-w-2xl text-lg md:text-xl leading-relaxed text-white/65">
          {copy.description}
        </p>

        {/* Actions */}
        <div className="mt-12 flex flex-col sm:flex-row justify-center gap-4">
          <Link
            href="/"
            className="group inline-flex items-center justify-center gap-3 rounded-2xl bg-[#C9A227] px-8 py-4 font-semibold text-[#0A1628] transition-all duration-300 hover:scale-105 hover:shadow-[0_0_40px_rgba(201,162,39,0.35)]"
          >
            <Home className="h-5 w-5" />
            {copy.returnHome}
          </Link>

          <Link
            href="/contact"
            className="inline-flex items-center justify-center gap-3 rounded-2xl border border-[#C9A227]/30 bg-white/5 px-8 py-4 text-white backdrop-blur-sm transition-all duration-300 hover:border-[#C9A227] hover:bg-[#C9A227]/10"
          >
            <Phone className="h-5 w-5" />
            {copy.contactUs}
          </Link>
        </div>

        {/* Quick Navigation */}
        <div className="mt-20 mb-6 text-center">
          <p className="mb-6 text-sm uppercase tracking-[0.3em] text-[#C9A227]/70">
            {copy.quickNav}
          </p>

          <div className="grid gap-4 md:grid-cols-4">
            {navItems.map((item) => (
              <Link
                key={item.href}
                href={item.href}
                className="group rounded-2xl border border-white/10 bg-white/[0.03] p-5 backdrop-blur-sm transition-all duration-300 hover:border-[#C9A227]/40 hover:bg-white/[0.06]"
              >
                <div className="flex items-center justify-between">
                  <span className="font-medium text-white">
                    {item.label}
                  </span>

                  <ArrowLeft className="h-4 w-4 text-[#C9A227] transition-transform group-hover:-translate-x-1" />
                </div>
              </Link>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}