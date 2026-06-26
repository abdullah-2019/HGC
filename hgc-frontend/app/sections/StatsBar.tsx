"use client";

import { Clock, Briefcase, MapPin, Building2 } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import { useCountUp } from "@/app/hooks/useCountUp";

const stats = [
  { value: 24, suffix: "+", labelKey: "common.yearsExperience", icon: Clock },
  { value: 200, suffix: "+", labelKey: "common.projectsCompleted", icon: Briefcase },
  { value: 38, suffix: "+", labelKey: "common.provincesCovered", icon: MapPin },
  { value: 6, suffix: "", labelKey: "common.companiesInGroup", icon: Building2 },
];

export default function StatsBar() {
  const { lang } = useI18n();

  return (
    <section className="relative py-16 bg-[#0A1628] border-y border-white/5">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-8">
          {stats.map((stat, idx) => {
            const { count, ref } = useCountUp(stat.value);
            const Icon = stat.icon;
            return (
              <div key={idx} ref={ref} className="text-center group">
                <div className="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#C9A227]/10 mb-4 group-hover:bg-[#C9A227]/20 transition-colors">
                  <Icon className="w-7 h-7 text-[#C9A227]" />
                </div>
                <div className="text-4xl lg:text-5xl font-bold text-white mb-2">
                  {count}
                  <span className="text-[#C9A227]">{stat.suffix}</span>
                </div>
                <p className="text-white/50 text-sm">{t(lang, stat.labelKey)}</p>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}