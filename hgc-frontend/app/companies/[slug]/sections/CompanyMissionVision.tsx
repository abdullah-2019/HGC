"use client";

import { motion } from "framer-motion";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import { Eye, Target, Compass } from "lucide-react";

interface CompanyMissionVisionProps {
  company: {
    mission: string | null;
    mission_dari: string | null;
    mission_pashto: string | null;
    vision: string | null;
    vision_dari: string | null;
    vision_pashto: string | null;
    value: string | null;
    value_en: string | null;
    value_dari: string | null;
    value_pashto: string | null;
    accent_color: string;
  };
}

export default function CompanyMissionVision({ company }: CompanyMissionVisionProps) {
  const { lang, dir } = useI18n();

  const getLocalized = (
    en: string | null,
    dari: string | null,
    pashto: string | null
  ): string | null => {
    if (lang === "dari" && dari) return dari;
    if (lang === "pashto" && pashto) return pashto;
    return en;
  };

  const cards = [
    {
      icon: Target,
      titleKey: "missionVision.mission",
      desc: getLocalized(company.mission, company.mission_dari, company.mission_pashto),
      color: company.accent_color,
    },
    {
      icon: Eye,
      titleKey: "missionVision.vision",
      desc: getLocalized(company.vision, company.vision_dari, company.vision_pashto),
      color: "#4A90D9",
    },
    {
      icon: Compass,
      titleKey: "missionVision.values",
      desc: getLocalized(
        company.value_en || company.value,
        company.value_dari,
        company.value_pashto
      ),
      color: "#2E7D32",
    },
  ].filter((card) => card.desc);

  if (cards.length === 0) return null;

  return (
    <section className="py-20 bg-hgc-bg-alt" dir={dir}>
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="mb-16 text-center"
        >
          <div className="mb-4 inline-flex items-center gap-2 rounded-full bg-hgc-gold/10 border border-hgc-gold/20 px-4 py-2 text-hgc-gold">
            <span className="text-sm font-medium">{t(lang, "missionVision.badge")}</span>
          </div>
          <h2 className="text-3xl font-bold text-hgc-text md:text-4xl">
            {t(lang, "missionVision.heading")}
          </h2>
        </motion.div>

        <div className="grid gap-8 md:grid-cols-3">
          {cards.map((card, index) => (
            <motion.div
              key={card.titleKey}
              initial={{ opacity: 0, y: 40 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.6, delay: index * 0.15 }}
              className="group relative rounded-2xl bg-hgc-card border border-hgc-border p-8 transition-all hover:-translate-y-2 hover:shadow-lg"
            >
              <div
                className="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl transition-transform group-hover:scale-110"
                style={{ backgroundColor: `${card.color}15` }}
              >
                <card.icon size={32} style={{ color: card.color }} />
              </div>
              <h3 className="mb-4 text-xl font-bold text-hgc-text">{t(lang, card.titleKey)}</h3>
              <p className="text-hgc-text-secondary leading-relaxed">
                {card.desc}
              </p>
              <div
                className="absolute bottom-0 left-0 h-1 w-0 rounded-b-2xl transition-all duration-500 group-hover:w-full"
                style={{ backgroundColor: card.color }}
              />
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}