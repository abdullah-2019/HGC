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
      className="relative h-[70vh] min-h-[500px] w-full overflow-hidden"
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
        <div className="absolute inset-0 bg-gradient-to-b from-[#0A1628]/70 via-[#0A1628]/50 to-[#0A1628]" />
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
            <div className="mb-6 inline-flex items-center gap-2 rounded-full bg-[#C9A227]/15 border border-[#C9A227]/30 px-5 py-2 text-[#C9A227]">
              <Icon size={18} />
              <span className="text-sm font-medium tracking-wide uppercase">
                {company.sector}
              </span>
            </div>
          )}

          <h1 className="mb-6 text-5xl font-bold text-white md:text-6xl lg:text-7xl">
            {company.name}
          </h1>

          {company.tagline ? (
            <p
              className="mx-auto max-w-3xl text-lg md:text-xl leading-relaxed mb-4"
              style={{ color: `${company.accent_color}cc` }}
            >
              {company.tagline}
            </p>
          ) : null}
        </motion.div>

        <motion.div
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ delay: 1, duration: 1 }}
          className="absolute bottom-10 left-1/2 -translate-x-1/2"
        >
          <ChevronDown className="w-8 h-8 text-[#C9A227] animate-bounce" />
        </motion.div>
      </div>
    </section>
  );
}