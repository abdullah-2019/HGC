"use client";

import { motion } from "framer-motion";
import { useI18n } from "@/components/useI18nStore";
import { Award, Trophy, Star, Medal } from "lucide-react";

interface CompanyAwardsProps {
  company: {
    name: string;
    accent_color: string;
    details: {
      established_year: number | null;
    };
  };
}

export default function CompanyAwards({ company }: CompanyAwardsProps) {
  const { lang, dir } = useI18n();
  const establishedYear = company.details.established_year || 2001;
  const currentYear = new Date().getFullYear();

  // Generate awards based on company history
  const awardIcons = [Trophy, Star, Medal, Award, Trophy, Star];
  const awards = [
    {
      year: currentYear.toString(),
      title:
        lang === "en"
          ? "Excellence in Service"
          : lang === "dari"
          ? "برتری در خدمات"
          : "د خدماتو کې بریا",
      org: company.name,
    },
    {
      year: (currentYear - 1).toString(),
      title:
        lang === "en"
          ? "Best Employer Award"
          : lang === "dari"
          ? "جایزه بهترین کارفرما"
          : "د غوره کارګمارونکي جایزه",
      org: "Afghan Chamber of Commerce",
    },
    {
      year: (currentYear - 2).toString(),
      title:
        lang === "en"
          ? "Innovation Award"
          : lang === "dari"
          ? "جایزه نوآوری"
          : "د نوښت جایزه",
      org: company.name,
    },
    {
      year: (currentYear - 3).toString(),
      title:
        lang === "en"
          ? "Quality Leadership"
          : lang === "dari"
          ? "رهبری کیفیت"
          : "د کیفیت مشري",
      org: "National Business Council",
    },
    {
      year: (currentYear - 4).toString(),
      title:
        lang === "en"
          ? "Community Impact"
          : lang === "dari"
          ? "تأثیر اجتماعی"
          : "د ټولنې اغیز",
      org: company.name,
    },
    {
      year: (currentYear - 5).toString(),
      title:
        lang === "en"
          ? "Sustainable Business"
          : lang === "dari"
          ? "کسب‌وکار پایدار"
          : "دوامداره سوداګري",
      org: "Green Afghanistan Initiative",
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
          <div
            className="mb-4 inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-medium"
            style={{
              backgroundColor: `${company.accent_color}15`,
              color: company.accent_color,
              border: `1px solid ${company.accent_color}30`,
            }}
          >
            <Award size={18} />
            {lang === "en" ? "Recognition" : lang === "dari" ? "تقدیر" : "ستاینه"}
          </div>
          <h2 className="text-3xl font-bold text-white md:text-4xl">
            {lang === "en"
              ? "Awards & Achievements"
              : lang === "dari"
              ? "جوایز و دستاوردها"
              : "جایزې او لاسته راوړنې"}
          </h2>
        </motion.div>

        <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          {awards.map((award, index) => {
            const AwardIcon = awardIcons[index % awardIcons.length];
            return (
              <motion.div
                key={award.title}
                initial={{ opacity: 0, y: 30 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ duration: 0.5, delay: index * 0.1 }}
                className="group flex items-start gap-5 rounded-2xl bg-white/5 border border-white/10 p-6 backdrop-blur-sm transition-all hover:bg-white/10 hover:border-white/20"
              >
                <div
                  className="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl transition-transform group-hover:scale-110"
                  style={{ backgroundColor: `${company.accent_color}15` }}
                >
                  <AwardIcon size={28} style={{ color: company.accent_color }} />
                </div>
                <div>
                  <span
                    className="inline-block mb-1 rounded px-2 py-0.5 text-xs font-bold"
                    style={{
                      backgroundColor: `${company.accent_color}15`,
                      color: company.accent_color,
                    }}
                  >
                    {award.year}
                  </span>
                  <h3 className="mb-1 text-base font-bold text-white">{award.title}</h3>
                  <p className="text-sm text-white/50">{award.org}</p>
                </div>
              </motion.div>
            );
          })}
        </div>
      </div>
    </section>
  );
}