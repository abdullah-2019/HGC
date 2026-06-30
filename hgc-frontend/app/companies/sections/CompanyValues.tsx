"use client";

import { motion } from "framer-motion";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import { Shield, Handshake, Lightbulb, Heart, Scale, Leaf } from "lucide-react";

export default function CompanyValues() {
  const { lang, dir } = useI18n();

  const values = [
    { icon: Shield, title: t(lang, "profile.val_integrity"), desc: t(lang, "profile.val_integrity_desc") },
    { icon: Handshake, title: t(lang, "profile.val_commitment"), desc: t(lang, "profile.val_commitment_desc") },
    { icon: Lightbulb, title: t(lang, "profile.val_innovation"), desc: t(lang, "profile.val_innovation_desc") },
    { icon: Heart, title: t(lang, "profile.val_excellence"), desc: t(lang, "profile.val_excellence_desc") },
    { icon: Scale, title: t(lang, "profile.val_accountability"), desc: t(lang, "profile.val_accountability_desc") },
    { icon: Leaf, title: t(lang, "profile.val_sustainability"), desc: t(lang, "profile.val_sustainability_desc") },
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
            <span className="text-sm font-medium">{t(lang, "profile.values_badge")}</span>
          </div>
          <h2 className="text-3xl font-bold text-white md:text-4xl">
            {t(lang, "profile.values_title")}
          </h2>
        </motion.div>

        <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          {values.map((value, index) => (
            <motion.div
              key={value.title}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.5, delay: index * 0.1 }}
              className="group rounded-2xl bg-white/5 border border-white/10 p-6 backdrop-blur-sm transition-all hover:-translate-y-1 hover:bg-white/10 hover:border-[#C9A227]/30"
            >
              <div className="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-[#C9A227]/15 text-[#C9A227] transition-transform group-hover:scale-110">
                <value.icon size={28} />
              </div>
              <h3 className="mb-2 text-lg font-bold text-white">{value.title}</h3>
              <p className="text-white/60 text-sm leading-relaxed">{value.desc}</p>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}