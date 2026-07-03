"use client";

import { motion } from "framer-motion";
import { useI18n } from "@/components/useI18nStore";
import { Target, Globe, Users, Award, Calendar } from "lucide-react";

interface CompanyAboutProps {
  company: {
    name: string;
    name_dari: string;
    name_pashto: string;
    about: string | null;
    about_dari: string | null;
    about_pashto: string | null;
    accent_color: string;
    icon_name: string;
    logo_url: string | null;
    hero_image_url: string | null;
    details: {
      established_year: number | null;
      founded_year: number | null;
    };
  };
}

export default function CompanyAbout({ company }: CompanyAboutProps) {
  const { lang, dir } = useI18n();

  const establishedYear = company.details.established_year || company.details.founded_year;
  const yearsOfExperience = establishedYear ? new Date().getFullYear() - establishedYear : null;

  const highlights = [
    { icon: Calendar, labelKey: "profile.about_founded", value: establishedYear?.toString() || "—" },
    { icon: Award, labelKey: "profile.about_experience", value: yearsOfExperience ? `${yearsOfExperience}+` : "25+" },
  ];

  // Get the about text based on language
  const getAboutText = () => {
    if (lang === "dari" && company.about_dari) return company.about_dari;
    if (lang === "pashto" && company.about_pashto) return company.about_pashto;
    return company.about;
  };

  const aboutText = getAboutText();

  // Fallback text when about is empty
  const fallbackText = {
    en: "With a commitment to quality and innovation, we continue to expand our services and impact across multiple sectors.",
    dari: "با تعهد به کیفیت و نوآوری، ما به توسعه خدمات و تأثیر خود در بخش‌های مختلف ادامه می‌دهیم.",
    pashto: "د کیفیت او نوښت سره د تعهد سره، موږ خپل خدمات او اغیز په بیلابیلو برخو کې پراخوو.",
  };

  return (
    <section className="py-20" dir={dir}>
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {/* Changed: items-start instead of items-center */}
        <div className="grid gap-16 lg:grid-cols-2 items-start">
          {/* Left - Image */}
          <motion.div
            initial={{ opacity: 0, x: dir === "rtl" ? 50 : -50 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.8 }}
            className="relative"
          >
            <div className="relative h-[500px] rounded-2xl overflow-hidden border border-white/10">
              <img
                src={company.hero_image_url || company.logo_url || "/images/placeholder.png"}
                alt={company.name}
                className="h-full w-full object-cover"
              />
              <div className="absolute inset-0 bg-gradient-to-tr from-[#0A1628]/40 to-transparent" />
            </div>
            {establishedYear && (
              <div
                className="absolute -bottom-6 -right-6 rounded-2xl p-6 shadow-2xl"
                style={{ backgroundColor: company.accent_color }}
              >
                <p className="text-4xl font-bold text-white">{establishedYear}</p>
                <p className="text-sm font-medium text-white/70">
                  {lang === "en" ? "Since" : lang === "dari" ? "از سال" : "له کال راهیسې"}
                </p>
              </div>
            )}
          </motion.div>

          {/* Right - Content */}
          <motion.div
            initial={{ opacity: 0, x: dir === "rtl" ? -50 : 50 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.8 }}
            className="flex flex-col" // Added flex flex-col
          >
            <div
              className="mb-4 inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-medium w-fit"
              style={{
                backgroundColor: `${company.accent_color}15`,
                color: company.accent_color,
                border: `1px solid ${company.accent_color}30`,
              }}
            >
              {lang === "en" ? "About Us" : lang === "dari" ? "درباره ما" : "زموږ په اړه"}
            </div>

            <h2 className="mb-6 text-3xl font-bold text-white md:text-4xl">
              {lang === "en"
                ? `About ${company.name}`
                : lang === "dari"
                  ? `درباره ${company.name_dari || company.name}`
                  : `په اړه ${company.name_pashto || company.name}`}
            </h2>

            {/* About text - always render HTML if available, show fallback if empty */}
            {aboutText ? (
              <div
                className="mb-8 text-white/60 leading-relaxed prose prose-invert max-w-none"
                dangerouslySetInnerHTML={{ __html: aboutText }}
              />
            ) : (
              <p className="mb-8 text-white/60 leading-relaxed">
                {fallbackText[lang as keyof typeof fallbackText] || fallbackText.en}
              </p>
            )}

            {/* Spacer to push highlights to bottom when text is short */}
            <div className="flex-1" />

            <div className="grid grid-cols-2 gap-4">
              {highlights.map((item) => (
                <div
                  key={item.labelKey}
                  className="rounded-xl bg-white/5 border border-white/10 p-4 transition-all duration-300 hover:bg-white/10"
                >
                  <item.icon className="mb-2 h-6 w-6" style={{ color: company.accent_color }} />
                  <p className="text-2xl font-bold text-white">{item.value}</p>
                  <p className="text-sm text-white/50">
                    {lang === "en"
                      ? item.labelKey === "profile.about_founded"
                        ? "Founded"
                        : item.labelKey === "profile.about_employees"
                          ? "Employees"
                          : "Years Exp."
                      : lang === "dari"
                        ? item.labelKey === "profile.about_founded"
                          ? "تأسیس"
                          : "سال تجربه"
                        : item.labelKey === "profile.about_founded"
                          ? "تأسیس"
                          : "د تجربې کالونه"}
                  </p>
                </div>
              ))}
            </div>
          </motion.div>
        </div>
      </div>
    </section>
  );
}