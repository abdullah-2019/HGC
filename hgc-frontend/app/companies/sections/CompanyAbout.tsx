"use client";

import { motion } from "framer-motion";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import { Target, Globe, Users, Award } from "lucide-react";

export default function CompanyAbout() {
  const { lang, dir } = useI18n();

  const highlights = [
    { icon: Target, label: t(lang, "profile.about_founded"), value: "2001" },
    { icon: Globe, label: t(lang, "profile.about_countries"), value: "3+" },
    { icon: Users, label: t(lang, "profile.about_employees"), value: "500+" },
    { icon: Award, label: t(lang, "profile.about_experience"), value: "25+" },
  ];

  return (
    <section className="py-20" dir={dir}>
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div className="grid gap-16 lg:grid-cols-2 items-center">
          {/* Left - Image */}
          <motion.div
            initial={{ opacity: 0, x: dir === "rtl" ? 50 : -50 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.8 }}
            className="relative"
          >
            <div className="relative h-[500px] rounded-2xl overflow-hidden">
              <img
                src="/images/placeholder.png"
                alt="HGC Office"
                className="h-full w-full object-cover"
              />
              <div className="absolute inset-0 bg-gradient-to-tr from-[#0A1628]/40 to-transparent" />
            </div>
            <div className="absolute -bottom-6 -right-6 bg-[#C9A227] rounded-2xl p-6 shadow-2xl">
              <p className="text-4xl font-bold text-[#0A1628]">2001</p>
              <p className="text-sm font-medium text-[#0A1628]/70">
                {t(lang, "profile.about_since")}
              </p>
            </div>
          </motion.div>

          {/* Right - Content */}
          <motion.div
            initial={{ opacity: 0, x: dir === "rtl" ? -50 : 50 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.8 }}
          >
            <div className="mb-4 inline-flex items-center gap-2 rounded-full bg-[#C9A227]/10 border border-[#C9A227]/20 px-4 py-2 text-[#C9A227]">
              <span className="text-sm font-medium">{t(lang, "profile.about_badge")}</span>
            </div>

            <h2 className="mb-6 text-3xl font-bold text-white md:text-4xl">
              {t(lang, "profile.about_title")}
            </h2>

            <p className="mb-6 text-white/60 leading-relaxed">
              {t(lang, "profile.about_desc1")}
            </p>

            <p className="mb-8 text-white/60 leading-relaxed">
              {t(lang, "profile.about_desc2")}
            </p>

            <div className="grid grid-cols-2 gap-4">
              {highlights.map((item) => (
                <div
                  key={item.label}
                  className="rounded-xl bg-white/5 border border-white/10 p-4 transition-all hover:bg-white/10 hover:border-[#C9A227]/30"
                >
                  <item.icon className="mb-2 h-6 w-6 text-[#C9A227]" />
                  <p className="text-2xl font-bold text-white">{item.value}</p>
                  <p className="text-sm text-white/50">{item.label}</p>
                </div>
              ))}
            </div>
          </motion.div>
        </div>
      </div>
    </section>
  );
}