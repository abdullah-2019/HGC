"use client";

import React from "react";
import { motion } from "framer-motion";
import {
  ShieldCheck,
  FlaskConical,
  ClipboardCheck,
  BadgeCheck,
  Truck,
  Leaf,
  CheckCircle2,
} from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import ScrollReveal from "@/components/ScrollReveal";

const qualityFeatures = [
  {
    icon: FlaskConical,
    title: "Laboratory Testing",
    description: "Every batch undergoes rigorous laboratory analysis to ensure purity, grade, and compliance with international standards.",
  },
  {
    icon: ClipboardCheck,
    title: "Quality Certification",
    description: "Products certified to ISO 9001, ASTM, and relevant Afghan national standards for consistent reliability.",
  },
  {
    icon: ShieldCheck,
    title: "Traceability",
    description: "Full chain-of-custody documentation from extraction to delivery, ensuring transparency and accountability.",
  },
  {
    icon: Truck,
    title: "Safe Transportation",
    description: "Specialized logistics for hazardous and fragile materials with temperature-controlled and secure transport options.",
  },
  {
    icon: Leaf,
    title: "Sustainable Sourcing",
    description: "Responsible mining and extraction practices that minimize environmental impact and support local communities.",
  },
  {
    icon: BadgeCheck,
    title: "Customer Support",
    description: "Dedicated account managers and technical consultants to assist with product selection, specifications, and after-sales service.",
  },
];

export default function ProductQuality() {
  const { lang, dir } = useI18n();

  return (
    <section className="py-24 relative overflow-hidden" dir={dir}>
      <div className="absolute top-0 right-0 w-[500px] h-[500px] bg-[#C9A227]/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4" />
      <div className="absolute bottom-0 left-0 w-[500px] h-[500px] bg-[#1A237E]/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div className="grid lg:grid-cols-2 gap-16 items-center">
          {/* Left: Image */}
          <ScrollReveal>
            <div className="relative">
              <div className="relative rounded-3xl overflow-hidden">
                <div
                  className="h-[500px] bg-cover bg-center"
                  style={{
                    backgroundImage: `url(https://images.unsplash.com/photo-1581093458791-9f3c3900df4b?w=800&q=80)`,
                  }}
                />
                <div className="absolute inset-0 bg-[#0A1628]/20" />
              </div>

              {/* Floating Card */}
              <motion.div
                initial={{ opacity: 0, x: -30 }}
                whileInView={{ opacity: 1, x: 0 }}
                viewport={{ once: true }}
                transition={{ duration: 0.6, delay: 0.3 }}
                className="absolute -bottom-8 -right-4 lg:right-8 bg-[#0A1628] border border-white/10 rounded-2xl p-6 max-w-xs shadow-2xl"
              >
                <div className="flex items-center gap-3 mb-3">
                  <div className="w-10 h-10 rounded-xl bg-[#C9A227]/15 flex items-center justify-center">
                    <CheckCircle2 className="w-5 h-5 text-[#C9A227]" />
                  </div>
                  <span className="text-white font-semibold">ISO 9001:2015</span>
                </div>
                <p className="text-white/40 text-sm">
                  Certified quality management system ensuring consistent product excellence.
                </p>
              </motion.div>
            </div>
          </ScrollReveal>

          {/* Right: Content */}
          <div>
            <ScrollReveal>
              <span className="text-[#C9A227] text-sm font-semibold uppercase tracking-[0.2em] mb-3 block">
                {t(lang, "products.quality.sectionSubtitle")}
              </span>
              <h2 className="text-3xl lg:text-4xl font-bold text-white mb-6">
                {t(lang, "products.quality.sectionTitle")}
              </h2>
              <p className="text-white/40 text-lg leading-relaxed mb-10">
                {t(lang, "products.quality.sectionDesc")}
              </p>
            </ScrollReveal>

            <div className="grid sm:grid-cols-2 gap-5">
              {qualityFeatures.map((feature, idx) => {
                const Icon = feature.icon;
                return (
                  <ScrollReveal key={idx} delay={idx * 0.08}>
                    <div className="group p-5 bg-white/[0.02] border border-white/5 rounded-xl hover:border-[#C9A227]/20 hover:bg-white/[0.04] transition-all duration-300">
                      <div className="w-10 h-10 rounded-lg bg-[#C9A227]/10 flex items-center justify-center mb-3 group-hover:bg-[#C9A227]/20 transition-colors">
                        <Icon className="w-5 h-5 text-[#C9A227]" />
                      </div>
                      <h3 className="text-white font-semibold text-sm mb-1.5">
                        {feature.title}
                      </h3>
                      <p className="text-white/30 text-xs leading-relaxed">
                        {feature.description}
                      </p>
                    </div>
                  </ScrollReveal>
                );
              })}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
