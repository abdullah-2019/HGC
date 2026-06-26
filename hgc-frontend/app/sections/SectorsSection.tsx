"use client";

import { Road, Home, Mountain, Zap, Sun, Truck } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

const sectors = [
  { name: "Roads", nameDari: "سرک ها", icon: Road, count: 85 },
  { name: "Buildings", nameDari: "ساختمان ها", icon: Home, count: 62 },
  { name: "Mining", nameDari: "معادن", icon: Mountain, count: 18 },
  { name: "Electrical", nameDari: "برق", icon: Zap, count: 24 },
  { name: "Solar", nameDari: "سولری", icon: Sun, count: 12 },
  { name: "Logistics", nameDari: "لوژستیک", icon: Truck, count: 30 },
];

export default function SectorsSection() {
  const { lang } = useI18n();

  return (
    <section className="py-20 bg-[#0A1628] border-y border-white/5">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-12">
          <h3 className="text-white/40 text-sm uppercase tracking-wider mb-2">
            {lang === "en" ? "Business Verticals" : lang === "dari" ? "حوزه های کاری" : "د سوداګرۍ عمودي"}
          </h3>
          <p className="text-white/60 text-lg">
            {lang === "en"
              ? "Mining, Construction, Energy, and General Trading solutions driving sustainable growth across Afghanistan."
              : lang === "dari"
                ? "راه حل های استخراج معادن، ساخت و ساز، انرژی و تجارت عمومی که رشد پایدار را در سراسر افغانستان هدایت می کنند."
                : "د کانونو استخراج، جوړونه، انرژي، او عمومي سوداګرۍ حلونه چې په افغانستان کې د پایدار ودې هدایت کوي."}
          </p>
        </div>

        <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
          {sectors.map((sector) => {
            const Icon = sector.icon;
            return (
              <div
                key={sector.name}
                className="group text-center p-6 rounded-2xl bg-white/[0.02] border border-white/5 hover:bg-white/[0.05] hover:border-[#C9A227]/20 transition-all duration-300"
              >
                <div className="w-12 h-12 mx-auto rounded-xl bg-[#C9A227]/10 flex items-center justify-center mb-3 group-hover:bg-[#C9A227]/20 transition-colors">
                  <Icon className="w-6 h-6 text-[#C9A227]" />
                </div>
                <p className="text-white font-medium text-sm mb-1">
                  {lang === "en" ? sector.name : sector.nameDari}
                </p>
                <p className="text-[#C9A227] text-xs font-bold">{sector.count}+</p>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}