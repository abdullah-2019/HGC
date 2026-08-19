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
    `${API_URL}/storage/embedded/products/hero/ph1.webp`,
    `${API_URL}/storage/embedded/products/hero/ph2.jpg`,
    `${API_URL}/storage/embedded/products/hero/ph3.jpg`,
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
    <section className="relative min-h-[85vh] flex items-center overflow-hidden bg-slate-900" dir={dir}>
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
          
          {/* REMOVED: bg-white/30 and the white-based linear-gradient layer */}
          
          {/* OPTIONAL CLEAN VIGNETTE: Soft dark edge border to naturally push focus center-inward */}
          <div 
            className="absolute inset-0 pointer-events-none" 
            style={{ 
              background: "radial-gradient(circle, rgba(15,43,91,0) 50%, rgba(15,43,91,0.2) 100%)" 
            }} 
          />
        </motion.div>
      </AnimatePresence>

      <div className="absolute inset-0 overflow-hidden pointer-events-none">
        {particles.map((p) => (
          <motion.div
            key={p.id}
            className="absolute w-1 h-1 bg-hgc-gold/40 rounded-full"
            style={{ left: p.left, top: p.top }}
            animate={{ y: [0, -40, 0], opacity: [0.3, 0.8, 0.3] }}
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
            {/* 1. BADGE UPGRADE: Added explicit dark backdrop blur protection */}
            <span className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-slate-900/60 backdrop-blur-md text-hgc-gold text-sm font-semibold border border-hgc-gold/30 mb-6 shadow-sm">
              <Factory className="w-4 h-4" />
              {t(lang, "products.hero.badge")}
            </span>

            {/* 2. TITLE VISIBILITY: Sharp drop-shadow to separate text layers from unpredictable backgrounds */}
            <h1 className="text-4xl sm:text-5xl lg:text-7xl font-bold text-white leading-[1.1] mb-6 drop-shadow-[0_4px_12px_rgba(0,0,0,0.85)]">
              {t(lang, "products.hero.title")}
            </h1>

            {/* 3. PARAGRAPH VISIBILITY: Embedded inside an isolated subtle frosted protection plate */}
            <div className="px-6 py-3 rounded-2xl bg-slate-900/30 backdrop-blur-[3px] border border-white/5 max-w-2xl mx-auto mb-8 shadow-md">
              <p className="text-white text-base sm:text-lg leading-relaxed font-normal tracking-wide drop-shadow-[0_2px_4px_rgba(0,0,0,0.6)]">
                {t(lang, "products.hero.subtitle")}
              </p>
            </div>

            <div className="flex flex-wrap items-center justify-center gap-4">
              <a
                href="#categories"
                className="group inline-flex items-center gap-2 px-8 py-4 bg-hgc-gold text-hgc-navy font-bold rounded-xl hover:bg-hgc-gold-bright shadow-lg shadow-hgc-gold/10 transition-all duration-300"
              >
                {t(lang, "products.hero.exploreBtn")}
                <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
              </a>
              <a
                href="#contact"
                className="inline-flex items-center gap-2 px-8 py-4 bg-slate-900/40 backdrop-blur-sm border border-white/10 text-white font-medium rounded-xl hover:bg-slate-900/60 transition-all duration-300"
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
        <ChevronDown className="w-6 h-6 text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]" />
      </motion.div>
    </section>
  );
}
