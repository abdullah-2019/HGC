"use client";

import React, { useState, useEffect, useMemo } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { ChevronDown, ArrowRight, Boxes, Gem, Fuel, HardHat, Factory } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";

const categoryIcons = [
  { icon: Factory, label: "Minerals & Metals" },
  { icon: Gem, label: "Stones & Gemstones" },
  { icon: Fuel, label: "Refinery Products" },
  { icon: HardHat, label: "Construction Materials" },
  { icon: Boxes, label: "Industrial Chemicals" },
];

// Seeded pseudo-random generator for consistent SSR/client values
function seededRandom(seed: number) {
  const x = Math.sin(seed * 9999) * 10000;
  return x - Math.floor(x);
}

export default function ProductsHero() {
  const { lang, dir } = useI18n();
  const [currentBg, setCurrentBg] = useState(0);

  const BASE_URL = process.env.NEXT_PUBLIC_API_URL;

  const backgroundPaths = [
    "/storage/uploads/hero-products.webp",
    "/storage/uploads/companies/albahrain/hero.webp",
    "/storage/uploads/companies/alkoozi/hero.webp"
  ];

  // Create absolute URLs
  const backgrounds = backgroundPaths.map(path => `${BASE_URL}${path}`);


  // Use seeded random for consistent SSR/client hydration
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
      {/* Animated Background */}
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
          <div className="absolute inset-0 bg-[#0A1628]/75" />
          <div className="absolute inset-0 bg-[#0A1628]/30" />
        </motion.div>
      </AnimatePresence>

      {/* Gold particles — seeded for consistent SSR/client */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none">
        {particles.map((p) => (
          <motion.div
            key={p.id}
            className="absolute w-1 h-1 bg-[#C9A227]/30 rounded-full"
            style={{ left: p.left, top: p.top }}
            animate={{ y: [0, -40, 0], opacity: [0.2, 0.7, 0.2] }}
            transition={{ duration: p.duration, repeat: Infinity, delay: p.delay }}
          />
        ))}
      </div>

      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div className="max-w-3xl">
          <motion.div
            initial={{ opacity: 0, y: 30 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8 }}
          >
            <span className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#C9A227]/15 text-[#C9A227] text-sm font-semibold border border-[#C9A227]/20 mb-6">
              <Factory className="w-4 h-4" />
              {t(lang, "products.hero.badge")}
            </span>

            <h1 className="text-4xl sm:text-5xl lg:text-7xl font-bold text-white leading-[1.1] mb-6">
              {t(lang, "products.hero.title")}
            </h1>

            <p className="text-white/50 text-lg sm:text-xl leading-relaxed mb-8 max-w-2xl">
              {t(lang, "products.hero.subtitle")}
            </p>

            <div className="flex flex-wrap items-center gap-4">
              <a
                href="#categories"
                className="group inline-flex items-center gap-2 px-8 py-4 bg-[#C9A227] text-[#0A1628] font-bold rounded-xl hover:bg-[#C9A227]/90 transition-all duration-300"
              >
                {t(lang, "products.hero.exploreBtn")}
                <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
              </a>
              <a
                href="#contact"
                className="inline-flex items-center gap-2 px-8 py-4 bg-white/5 border border-white/10 text-white font-medium rounded-xl hover:bg-white/10 transition-all duration-300"
              >
                {t(lang, "products.hero.contactBtn")}
              </a>
            </div>
          </motion.div>

          {/* Category Quick Links */}
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8, delay: 0.3 }}
            className="mt-16 pt-8 border-t border-white/10"
          >
            <p className="text-white/30 text-sm uppercase tracking-wider mb-4">
              {t(lang, "products.hero.categoriesLabel")}
            </p>
            <div className="flex flex-wrap gap-3">
              {categoryIcons.map((cat, idx) => {
                const Icon = cat.icon;
                return (
                  <a
                    key={idx}
                    href={`#category-${idx}`}
                    className="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white/60 hover:text-[#C9A227] hover:border-[#C9A227]/30 hover:bg-[#C9A227]/5 transition-all duration-300 text-sm"
                  >
                    <Icon className="w-4 h-4" />
                    {cat.label}
                  </a>
                );
              })}
            </div>
          </motion.div>
        </div>
      </div>

      {/* Scroll indicator */}
      <motion.div
        animate={{ y: [0, 10, 0] }}
        transition={{ duration: 2, repeat: Infinity }}
        className="absolute bottom-8 left-1/2 -translate-x-1/2"
      >
        <ChevronDown className="w-6 h-6 text-white/30" />
      </motion.div>
    </section>
  );
}
