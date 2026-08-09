"use client";

import { motion } from "framer-motion";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import { valueIconMap } from "@/components/company/iconMap";

interface CompanyValues {
  icon_name: string;
  title: string;
  title_en: string;
  title_dari: string | null;
  title_pashto: string | null;
  description: string;
  description_en: string;
  description_dari: string | null;
  description_pashto: string | null;
  sort_order: number;
}

interface CompanyValuesProps {
  company: {
    name: string;
    accent_color: string;
    values: CompanyValues[];
  };
}

export default function CompanyValues({ company }: CompanyValuesProps) {
  const { lang, dir } = useI18n();

  if (!company.values || company.values.length === 0) return null;

  return (
    <section className="py-20 bg-hgc-bg-alt" dir={dir}>
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="mb-16 text-center"
        >
          <div
            className="mb-4 inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-medium"
            style={{
              backgroundColor: `${company.accent_color}15`,
              color: company.accent_color,
              border: `1px solid ${company.accent_color}30`,
            }}
          >
            {t(lang, "profile.values_badge")}
          </div>
          <h2 className="text-3xl font-bold text-hgc-text md:text-4xl">
            {t(lang, "profile.values_title")}
          </h2>
        </motion.div>

        <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          {company.values.map((value, index) => {
            const Icon = valueIconMap[value.icon_name];
            if (!Icon) return null;

            return (
              <motion.div
                key={value.sort_order}
                initial={{ opacity: 0, y: 30 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ duration: 0.5, delay: index * 0.1 }}
                className="group rounded-2xl bg-hgc-card border border-hgc-border p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-md"
              >
                <div
                  className="mb-4 flex h-14 w-14 items-center justify-center rounded-xl transition-transform group-hover:scale-110"
                  style={{ backgroundColor: `${company.accent_color}15` }}
                >
                  <Icon size={28} style={{ color: company.accent_color }} />
                </div>
                <h3 className="mb-2 text-lg font-bold text-hgc-text">{value.title}</h3>
                <p className="text-hgc-text-secondary text-sm leading-relaxed">{value.description}</p>
              </motion.div>
            );
          })}
        </div>
      </div>
    </section>
  );
}