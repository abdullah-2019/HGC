"use client";

import React from "react";
import { motion } from "framer-motion";
import { Package, Truck, Globe, Users, Factory } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import ScrollReveal from "@/components/ScrollReveal";

export default function ProductStats() {
  const { lang } = useI18n();

  const stats = [
    { icon: Package, value: "50+", label: t(lang, "products.stats.products") },
    { icon: Factory, value: "5", label: t(lang, "products.stats.categories") },
    { icon: Truck, value: "34", label: t(lang, "products.stats.provinces") },
    { icon: Globe, value: "12", label: t(lang, "products.stats.countries") },
    { icon: Users, value: "500+", label: t(lang, "products.stats.clients") },
  ];

  return (
    <section className="relative py-16 border-y border-white/5 bg-[#0A1628]/80">
      <div className="absolute inset-0 bg-[#C9A227]/[0.02]" />
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div className="grid grid-cols-2 lg:grid-cols-5 gap-8">
          {stats.map((stat, idx) => {
            const Icon = stat.icon;
            return (
              <ScrollReveal key={idx} delay={idx * 0.08}>
                <div className="text-center group">
                  <div className="w-14 h-14 rounded-2xl bg-[#C9A227]/10 flex items-center justify-center mx-auto mb-4 group-hover:bg-[#C9A227]/20 transition-colors">
                    <Icon className="w-6 h-6 text-[#C9A227]" />
                  </div>
                  <motion.p
                    className="text-2xl lg:text-3xl font-bold text-white"
                    initial={{ opacity: 0, scale: 0.5 }}
                    whileInView={{ opacity: 1, scale: 1 }}
                    viewport={{ once: true }}
                    transition={{ duration: 0.5, delay: idx * 0.1 }}
                  >
                    {stat.value}
                  </motion.p>
                  <p className="text-white/40 text-sm mt-1">{stat.label}</p>
                </div>
              </ScrollReveal>
            );
          })}
        </div>
      </div>
    </section>
  );
}