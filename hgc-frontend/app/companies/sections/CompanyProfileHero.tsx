"use client";

import Image from "next/image";
import { motion } from "framer-motion";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import { Building2, ChevronDown } from "lucide-react";

export default function CompanyProfileHero() {
  const { lang, dir } = useI18n();

  return (
    <section
      className="relative h-[70vh] min-h-[500px] w-full overflow-hidden"
      dir={dir}
    >
      <div className="absolute inset-0">
        <Image
          src="/images/placeholder.png"
          alt="HGC Company Profile"
          fill
          className="object-cover"
          priority
        />
        <div className="absolute inset-0 bg-gradient-to-b from-[#0A1628]/70 via-[#0A1628]/50 to-[#0A1628]" />
      </div>

      <div className="relative z-10 flex h-full flex-col items-center justify-center px-4">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.8 }}
          className="text-center"
        >
          <div className="mb-6 inline-flex items-center gap-2 rounded-full bg-[#C9A227]/15 border border-[#C9A227]/30 px-5 py-2 text-[#C9A227]">
            <Building2 size={18} />
            <span className="text-sm font-medium tracking-wide uppercase">
              {t(lang, "profile.hero_badge")}
            </span>
          </div>

          <h1 className="mb-6 text-5xl font-bold text-white md:text-6xl lg:text-7xl">
            {t(lang, "profile.hero_title")}
          </h1>

          <p className="mx-auto max-w-3xl text-lg text-white/70 md:text-xl leading-relaxed">
            {t(lang, "profile.hero_subtitle")}
          </p>
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