"use client";

import { motion } from "framer-motion";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import { Eye, Target, Compass } from "lucide-react";

export default function CompanyMissionVision() {
  const { lang, dir } = useI18n();

  const cards = [
    {
      icon: Target,
      title: t(lang, "profile.mission_title"),
      desc: t(lang, "profile.mission_desc"),
      color: "#C9A227",
    },
    {
      icon: Eye,
      title: t(lang, "profile.vision_title"),
      desc: t(lang, "profile.vision_desc"),
      color: "#4A90D9",
    },
    {
      icon: Compass,
      title: t(lang, "profile.values_title"),
      desc: t(lang, "profile.values_desc"),
      color: "#2E7D32",
    },
  ];

  return (
    <section className="py-20" dir={dir}>
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="mb-16 text-center"
        >
          <div className="mb-4 inline-flex items-center gap-2 rounded-full bg-[#C9A227]/10 border border-[#C9A227]/20 px-4 py-2 text-[#C9A227]">
            <span className="text-sm font-medium">{t(lang, "profile.mv_badge")}</span>
          </div>
          <h2 className="text-3xl font-bold text-white md:text-4xl">
            {t(lang, "profile.mv_title")}
          </h2>
        </motion.div>

        <div className="grid gap-8 md:grid-cols-3">
          {cards.map((card, index) => (
            <motion.div
              key={card.title}
              initial={{ opacity: 0, y: 40 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.6, delay: index * 0.15 }}
              className="group relative rounded-2xl bg-white/5 border border-white/10 p-8 backdrop-blur-sm transition-all hover:-translate-y-2 hover:bg-white/10 hover:border-white/20"
            >
              <div
                className="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl transition-transform group-hover:scale-110"
                style={{ backgroundColor: `${card.color}15` }}
              >
                <card.icon size={32} style={{ color: card.color }} />
              </div>
              <h3 className="mb-4 text-xl font-bold text-white">{card.title}</h3>
              <p className="text-white/60 leading-relaxed">{card.desc}</p>
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