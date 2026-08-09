"use client";

import { motion } from "framer-motion";
import { useI18n } from "@/components/useI18nStore";
import {
  Award,
  Trophy,
  Star,
  Medal,
  Gem,
  Mountain,
  Handshake,
  Store,
  Landmark,
  Truck,
  type LucideIcon,
} from "lucide-react";

const iconMap: Record<string, LucideIcon> = {
  Trophy,
  Star,
  Medal,
  Award,
  Gem,
  Mountain,
  Handshake,
  Store,
  Landmark,
  Truck,
};

interface AwardItem {
  id: number;
  icon_name: string | null;
  year: number | null;
  title: string;
  title_en: string | null;
  title_dari: string | null;
  title_pashto: string | null;
  description: string | null;
  description_en: string | null;
  description_dari: string | null;
  description_pashto: string | null;
  organization: string | null;
  organization_en: string | null;
  organization_dari: string | null;
  organization_pashto: string | null;
  image_url: string | null;
  sort_order: number;
}

interface CompanyAwardsProps {
  company: {
    name: string;
    accent_color: string;
    details: {
      established_year: number | null;
    };
  };
  awards: AwardItem[] | null | undefined;
}

export default function CompanyAwards({ company, awards }: CompanyAwardsProps) {
  const { lang, dir } = useI18n();

  if (!awards || awards.length === 0) {
    return null;
  }

  const getLocalized = (
    localized: string | null,
    en: string | null,
    dari: string | null,
    pashto: string | null
  ): string | null => {
    if (lang === "dari" && dari) return dari;
    if (lang === "pashto" && pashto) return pashto;
    return localized ?? en ?? null;
  };

  const sectionTitle =
    lang === "en"
      ? "Awards & Achievements"
      : lang === "dari"
        ? "جوایز و دستاوردها"
        : "جایزې او لاسته راوړنې";

  const sectionBadge =
    lang === "en" ? "Recognition" : lang === "dari" ? "تقدیر" : "ستاینه";

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
            <Award size={18} />
            {sectionBadge}
          </div>
          <h2 className="text-3xl font-bold text-hgc-text md:text-4xl">
            {sectionTitle}
          </h2>
        </motion.div>

        <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          {awards.map((award, index) => {
            const AwardIcon =
              (award.icon_name && iconMap[award.icon_name]) || Award;

            const title = getLocalized(
              award.title,
              award.title_en,
              award.title_dari,
              award.title_pashto
            );
            const description = getLocalized(
              award.description,
              award.description_en,
              award.description_dari,
              award.description_pashto
            );
            const organization = getLocalized(
              award.organization,
              award.organization_en,
              award.organization_dari,
              award.organization_pashto
            );

            if (!title) return null;

            return (
              <motion.div
                key={award.id}
                initial={{ opacity: 0, y: 30 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ duration: 0.5, delay: index * 0.1 }}
                className="group flex items-start gap-5 rounded-2xl bg-hgc-card border border-hgc-border p-6 transition-all hover:shadow-md"
              >
                <div
                  className="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl transition-transform group-hover:scale-110"
                  style={{ backgroundColor: `${company.accent_color}15` }}
                >
                  <AwardIcon
                    size={28}
                    style={{ color: company.accent_color }}
                  />
                </div>
                <div className="min-w-0 flex-1">
                  {award.year && (
                    <span
                      className="inline-block mb-1 rounded px-2 py-0.5 text-xs font-bold"
                      style={{
                        backgroundColor: `${company.accent_color}15`,
                        color: company.accent_color,
                      }}
                    >
                      {award.year}
                    </span>
                  )}

                  <h3 className="mb-1 text-base font-bold text-hgc-text">
                    {title}
                  </h3>

                  {description && (
                    <p className="mb-1 text-sm text-hgc-text-secondary line-clamp-2">
                      {description}
                    </p>
                  )}

                  {organization && (
                    <p className="text-sm text-hgc-text-muted">{organization}</p>
                  )}
                </div>
              </motion.div>
            );
          })}
        </div>
      </div>
    </section>
  );
}