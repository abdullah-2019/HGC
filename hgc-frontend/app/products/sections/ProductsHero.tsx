"use client";

import React, { useState, useEffect, useMemo } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { ChevronDown, ArrowRight, Factory, Boxes } from "lucide-react";
import type { LucideProps } from "lucide-react";
import * as Icons from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";

function seededRandom(seed: number) {
  const x = Math.sin(seed * 9999) * 10000;
  return x - Math.floor(x);
}

// Dynamic icon resolver
type LucideIcon = React.ComponentType<LucideProps>;

function getIcon(iconName: string | null | undefined): LucideIcon {
  if (!iconName) return Boxes;
  const Icon = (Icons as unknown as Record<string, LucideIcon>)[iconName];
  return Icon || Boxes;
}

export default function ProductsHero() {
  const { lang, dir } = useI18n();
  const [currentBg, setCurrentBg] = useState(0);

  const API_URL = process.env.NEXT_PUBLIC_API_URL || "https://api.hgc.af";

  const backgrounds = [
    `${API_URL}/storage/uploads/hero-construction.webp`,
    `${API_URL}/storage/uploads/companies/albahrain/hero.webp`,
    `${API_URL}/storage/uploads/companies/alkoozi/hero.webp`,
  ];

  const particles = useMemo(() => {
    return Array.from({ length: 12 }, (_, i) => ({
      id: i,
      left: `${(seededRandom(i) * 100).toFixed(2)}%`,
      top: `${(seededRandom(i + 100) * 100).toFixed(2)}%`,
      duration: 5 + seededRandom(i + 200) * 4,
      delay: seededRandom(i + 300) * 3,
    }));
  }, []);

  useEffect(() => {
    const timer = setInterval(() => {
      setCurrentBg((prev) => (prev + 1) % backgrounds.length);
    }, 6000);
    return () => clearInterval(timer);
  }, []);

  return (
    <section className="relative min-h-[85vh] flex items-center overflow-hidden" dir={dir}>
      <AnimatePresence mode="wait">
        <motion.div
          key={currentBg}
          initial={{ opacity: 0, scale: 1.1 }}
          animate={{ opacity: 1, scale: 1 }}
          exit={{ opacity: 0 }}
          transition={{ duration: 1.5 }}
          className="absolute inset-0"
        >
          <div
            className="absolute inset-0 bg-cover bg-center"
            style={{ backgroundImage: `url(${backgrounds[currentBg]})` }}
          />
          <div className="absolute inset-0 bg-white/30" />
          <div className="absolute inset-0 bg-gradient-to-b from-white/20 via-transparent to-white/40" />
        </motion.div>
      </AnimatePresence>

      <div className="absolute inset-0 overflow-hidden pointer-events-none">
        {particles.map((p) => (
          <motion.div
            key={p.id}
            className="absolute w-1 h-1 bg-hgc-gold/30 rounded-full"
            style={{ left: p.left, top: p.top }}
            animate={{ y: [0, -40, 0], opacity: [0.2, 0.7, 0.2] }}
            transition={{ duration: p.duration, repeat: Infinity, delay: p.delay }}
          />
        ))}
      </div>

      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div className="max-w-3xl mx-auto text-center">
          <motion.div
            initial={{ opacity: 0, y: 30 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8 }}
          >
            <span className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-hgc-gold/15 text-hgc-gold text-sm font-semibold border border-hgc-gold/20 mb-6">
              <Factory className="w-4 h-4" />
              {t(lang, "products.hero.badge")}
            </span>

            <h1 className="text-4xl sm:text-5xl lg:text-7xl font-bold text-hgc-text leading-[1.1] mb-6">
              {t(lang, "products.hero.title")}
            </h1>

            <p className="text-hgc-text-secondary text-lg sm:text-xl leading-relaxed mb-8 max-w-2xl mx-auto">
              {t(lang, "products.hero.subtitle")}
            </p>

            <div className="flex flex-wrap items-center justify-center gap-4">
              <a
                href="#categories"
                className="group inline-flex items-center gap-2 px-8 py-4 bg-hgc-gold text-hgc-navy font-bold rounded-xl hover:bg-hgc-gold-bright transition-all duration-300"
              >
                {t(lang, "products.hero.exploreBtn")}
                <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
              </a>
              <a
                href="#contact"
                className="inline-flex items-center gap-2 px-8 py-4 bg-hgc-surface-elevated border border-hgc-border text-hgc-text font-medium rounded-xl hover:bg-hgc-card-hover transition-all duration-300"
              >
                {t(lang, "products.hero.contactBtn")}
              </a>
            </div>
          </motion.div>
        </div>
      </div>

      <motion.div
        animate={{ y: [0, 10, 0] }}
        transition={{ duration: 2, repeat: Infinity }}
        className="absolute bottom-8 left-1/2 -translate-x-1/2"
      >
        <ChevronDown className="w-6 h-6 text-hgc-text-muted" />
      </motion.div>
    </section>
  );
}