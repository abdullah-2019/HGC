"use client";

import { motion } from "framer-motion";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import { Award, Trophy, Star, Medal } from "lucide-react";

interface AwardItem {
  icon: typeof Award;
  year: string;
  title: string;
  org: string;
}

export default function CompanyAwards() {
  const { lang, dir } = useI18n();

  const awards: AwardItem[] = [
    { icon: Trophy, year: "2024", title: t(lang, "profile.award1_title"), org: t(lang, "profile.award1_org") },
    { icon: Star, year: "2023", title: t(lang, "profile.award2_title"), org: t(lang, "profile.award2_org") },
    { icon: Medal, year: "2022", title: t(lang, "profile.award3_title"), org: t(lang, "profile.award3_org") },
    { icon: Award, year: "2021", title: t(lang, "profile.award4_title"), org: t(lang, "profile.award4_org") },
    { icon: Trophy, year: "2020", title: t(lang, "profile.award5_title"), org: t(lang, "profile.award5_org") },
    { icon: Star, year: "2019", title: t(lang, "profile.award6_title"), org: t(lang, "profile.award6_org") },
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
            <Award size={18} />
            <span className="text-sm font-medium">{t(lang, "profile.awards_badge")}</span>
          </div>
          <h2 className="text-3xl font-bold text-white md:text-4xl">
            {t(lang, "profile.awards_title")}
          </h2>
        </motion.div>

        <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          {awards.map((award, index) => (
            <motion.div
              key={award.title}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.5, delay: index * 0.1 }}
              className="group flex items-start gap-5 rounded-2xl bg-white/5 border border-white/10 p-6 backdrop-blur-sm transition-all hover:bg-white/10 hover:border-[#C9A227]/30"
            >
              <div className="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-[#C9A227]/15 text-[#C9A227] transition-transform group-hover:scale-110">
                <award.icon size={28} />
              </div>
              <div>
                <span className="inline-block mb-1 rounded bg-[#C9A227]/10 px-2 py-0.5 text-xs font-bold text-[#C9A227]">
                  {award.year}
                </span>
                <h3 className="mb-1 text-base font-bold text-white">{award.title}</h3>
                <p className="text-sm text-white/50">{award.org}</p>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}