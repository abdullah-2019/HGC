"use client";

import { useI18n } from "@/components/useI18nStore";

const clients = [
  { name: "UNOPS", abbr: "UNOPS" },
  { name: "UNICEF", abbr: "UNICEF" },
  { name: "UNFPA", abbr: "UNFPA" },
  { name: "USACE", abbr: "USACE" },
  { name: "Ministry of Interior", abbr: "MOI" },
  { name: "Ministry of Public Works", abbr: "MPW" },
  { name: "World Bank", abbr: "WB" },
  { name: "Ministry of Finance", abbr: "MOF" },
];

export default function ClientsBar() {
  const { lang } = useI18n();

  return (
    <section className="py-20 bg-[#0A1628] border-y border-white/5">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-12">
          <h3 className="text-white/40 text-sm uppercase tracking-wider">
            {lang === "en"
              ? "Trusted by Leading Organizations"
              : lang === "dari"
                ? "مورد اعتماد سازمان های برجسته"
                : "د مخکښو سازمانونو لخوا باوري"}
          </h3>
        </div>

        <div className="flex flex-wrap items-center justify-center gap-8 lg:gap-16">
          {clients.map((client) => (
            <div
              key={client.name}
              className="group flex items-center gap-3 px-6 py-3 rounded-xl bg-white/[0.02] border border-white/5 hover:border-[#C9A227]/20 hover:bg-white/[0.04] transition-all duration-300"
            >
              <div className="w-10 h-10 rounded-lg bg-[#C9A227]/10 flex items-center justify-center">
                <span className="text-[#C9A227] font-bold text-xs">{client.abbr}</span>
              </div>
              <span className="text-white/40 group-hover:text-white/70 text-sm font-medium transition-colors">
                {client.name}
              </span>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}