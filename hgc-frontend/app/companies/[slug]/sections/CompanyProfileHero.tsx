"use client";

import { motion } from "framer-motion";
import { useI18n } from "@/components/useI18nStore";
import { ChevronDown } from "lucide-react";
import { iconMap } from "@/components/company/iconMap";

interface CompanyProfileHeroProps {
  company: {
    name: string;
    tagline: string | null;
    description: string;
    accent_color: string;
    secondary_color: string | null;
    icon_name: string;
    hero_image_url: string | null;
    logo_url: string | null;
    sector: string | null;
  };
}

export default function CompanyProfileHero({ company }: CompanyProfileHeroProps) {
  const { lang, dir } = useI18n();
  const Icon = iconMap[company.icon_name] || iconMap.Building2;
  const secondaryColor = company.secondary_color || company.accent_color;

  return (
    <section
      className="relative h-[70vh] min-h-[500px] w-full overflow-hidden bg-[#F8FAFC]"
      dir={dir}
    >
      {/* Background */}
      <div className="absolute inset-0">
        {company.hero_image_url ? (
          <img
            src={company.hero_image_url}
            alt={company.name}
            className="h-full w-full object-cover"
          />
        ) : (
          <div
            className="h-full w-full"
            style={{
              background: `linear-gradient(135deg, ${company.accent_color}20, ${secondaryColor}10)`,
            }}
          />
        )}

        {/* Soft vignette only */}
        <div
          className="absolute inset-0 pointer-events-none"
          style={{
            background: "radial-gradient(circle, rgba(15,43,91,0) 40%, rgba(15,43,91,0.3) 100%)"
          }}
        />

        {/* REMOVED: White bottom fade */}
      </div>
      <div className="relative z-10 flex h-full flex-col items-center justify-center px-4">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.8 }}
          className="text-center"
        >
          {/* Sector Badge */}
          {company.sector && (
            <div className="mb-6 inline-flex items-center gap-2 rounded-full bg-slate-900/60 backdrop-blur-md border border-hgc-gold/30 px-5 py-2 text-hgc-gold shadow-sm">
              <Icon size={18} />
              <span className="text-sm font-medium tracking-wide uppercase">
                {company.sector}
              </span>
            </div>
          )}

          {/* 3. TITLE CHANNELS: High-contrast edge isolation via text drop shadow */}
          <h1 className="mb-6 text-4xl font-bold text-white md:text-5xl lg:text-6xl drop-shadow-[0_4px_12px_rgba(0,0,0,0.85)]">
            {company.name}
          </h1>

          {/* 4. TAGLINE WRAPPER: Framed inside a subtle translucent plate to prevent color conflict */}
          {company.tagline ? (
            <div className="px-6 py-3 rounded-2xl bg-slate-900/40 backdrop-blur-[4px] border border-white/5 max-w-3xl mx-auto shadow-md">
              <p
                className="text-base md:text-lg font-medium leading-relaxed drop-shadow-[0_2px_4px_rgba(0,0,0,0.6)]"
                style={{ color: company.accent_color }}
              >
                {company.tagline}
              </p>
            </div>
          ) : null}
        </motion.div>

        <motion.div
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ delay: 1, duration: 1 }}
          className="absolute bottom-10 left-1/2 -translate-x-1/2"
        >
          <ChevronDown className="w-8 h-8 text-hgc-gold filter drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)] animate-bounce" />
        </motion.div>
      </div>
    </section>
  );
}