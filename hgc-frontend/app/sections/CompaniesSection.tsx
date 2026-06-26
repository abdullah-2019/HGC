"use client";

import Link from "next/link";
import { useState } from "react";
import { Building2, Mountain, HardHat, Store, Landmark, Truck, ArrowRight } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";

const companies = [
  { slug: "hcrc", accent: "#B22222", icon: Building2 },
  { slug: "albahrain", accent: "#1A237E", icon: Mountain },
  { slug: "zainnoorain", accent: "#F57C00", icon: HardHat },
  { slug: "almadinah", accent: "#2E7D32", icon: Store },
  { slug: "haramain", accent: "#FFD700", icon: Landmark },
  { slug: "alkoozi", accent: "#00838F", icon: Truck },
];

export default function CompaniesSection() {
  const { lang } = useI18n();
  const [hoveredCompany, setHoveredCompany] = useState<string | null>(null);

  return (
    <section className="py-24 bg-[#0A1628] relative overflow-hidden">
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_#C9A227/5_0%,_transparent_50%)]" />
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div className="text-center mb-16">
          <span className="inline-block px-4 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-4">
            {lang === "en" ? "Our Group" : lang === "dari" ? "گروپ ما" : "زموږ ګروپ"}
          </span>
          <h2 className="text-4xl lg:text-5xl font-bold text-white mb-4">
            {lang === "en" ? (
              <>
                Six Specialized <span className="text-[#C9A227]">Companies</span>
              </>
            ) : lang === "dari" ? (
              <>
                شش شرکت <span className="text-[#C9A227]">تخصصی</span>
              </>
            ) : (
              <>
                شپږ <span className="text-[#C9A227]">تخصصي</span> شرکتونه
              </>
            )}
          </h2>
          <p className="text-white/50 max-w-2xl mx-auto">
            {lang === "en"
              ? "Each company brings unique expertise to deliver comprehensive solutions across Afghanistan."
              : lang === "dari"
                ? "هر شرکت تخصص منحصر به فردی را برای ارائه راه حل های جامع در سراسر افغانستان به ارمغان می آورد."
                : "هر شرکت ځانګړې مهارت راوړي ترڅو په افغانستان کې جامع حلونه وړاندې کړي."}
          </p>
        </div>

        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          {companies.map((company) => {
            const Icon = company.icon;
            const isHovered = hoveredCompany === company.slug;
            return (
              <Link
                key={company.slug}
                href={`/companies/${company.slug}`}
                onMouseEnter={() => setHoveredCompany(company.slug)}
                onMouseLeave={() => setHoveredCompany(null)}
                className="group relative bg-white/[0.02] border border-white/5 rounded-2xl p-6 hover:bg-white/[0.04] hover:border-white/10 transition-all duration-500 overflow-hidden"
              >
                <div
                  className="absolute top-0 left-0 right-0 h-1 rounded-t-2xl transition-all duration-500"
                  style={{
                    backgroundColor: isHovered ? company.accent : "transparent",
                    opacity: isHovered ? 1 : 0,
                  }}
                />
                <div className="flex items-start gap-4">
                  <div
                    className="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0 transition-all duration-500"
                    style={{
                      backgroundColor: isHovered ? `${company.accent}25` : `${company.accent}10`,
                    }}
                  >
                    <Icon className="w-7 h-7 transition-colors duration-300" style={{ color: company.accent }} />
                  </div>
                  <div className="flex-1 min-w-0">
                    <h3 className="text-white font-bold text-lg mb-1 group-hover:text-[#C9A227] transition-colors">
                      {t(lang, `companies.${company.slug}.name`)}
                    </h3>
                    <p className="text-white/40 text-sm mb-3">
                      {t(lang, `companies.${company.slug}.desc`)}
                    </p>
                    <span className="inline-flex items-center gap-1 text-sm text-[#C9A227]/70 group-hover:text-[#C9A227] transition-colors">
                      {t(lang, "common.visit")}
                      <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
                    </span>
                  </div>
                </div>
              </Link>
            );
          })}
        </div>
      </div>
    </section>
  );
}