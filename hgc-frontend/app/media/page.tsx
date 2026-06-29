"use client";

import React from "react";
import { motion } from "framer-motion";
import MediaHero from "./sections/MediaHero";
import VideoGallery from "./sections/VideoGallery";
import PhotoGallery from "./sections/PhotoGallery";
import ScrollReveal from "@/components/ScrollReveal";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";

// ─── Quick Stats Strip ───
function StatsStrip() {
  const { lang } = useI18n();

  const stats = [
    { label: t(lang, "media.stats.videos"), value: "48+" },
    { label: t(lang, "media.stats.photos"), value: "1,200+" },
    { label: t(lang, "media.stats.documentaries"), value: "12" },
    { label: t(lang, "media.stats.pressKits"), value: "8" },
  ];

  return (
    <section className="relative py-10 border-y border-white/5 bg-[#0A1628]/80 backdrop-blur-sm">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-8">
          {stats.map((stat, idx) => (
            <ScrollReveal key={idx} delay={idx * 0.1}>
              <div className="text-center">
                <p className="text-3xl lg:text-4xl font-bold text-[#C9A227]">{stat.value}</p>
                <p className="text-white/40 text-sm mt-1 uppercase tracking-wider">{stat.label}</p>
              </div>
            </ScrollReveal>
          ))}
        </div>
      </div>
    </section>
  );
}

// ─── Section Divider ───
function SectionDivider({ title, subtitle }: { title: string; subtitle: string }) {
  return (
    <div className="py-16 text-center relative overflow-hidden">
      <div className="absolute inset-0 flex items-center justify-center">
        <div className="w-px h-full bg-white/5" />
      </div>
      <ScrollReveal>
        <div className="relative inline-block">
          <span className="text-[#C9A227] text-sm font-semibold uppercase tracking-[0.3em] block mb-3">
            {subtitle}
          </span>
          <h2 className="text-3xl lg:text-4xl font-bold text-white">{title}</h2>
          <div className="mt-4 flex items-center justify-center gap-3">
            <div className="w-12 h-px bg-[#C9A227]/30" />
            <div className="w-2 h-2 rounded-full bg-[#C9A227]" />
            <div className="w-12 h-px bg-[#C9A227]/30" />
          </div>
        </div>
      </ScrollReveal>
    </div>
  );
}

// ─── Main Page ───
export default function MediaPage() {
  const { dir, lang } = useI18n();

  return (
    <div className="min-h-screen bg-[#0A1628]" dir={dir}>
      {/* Hero */}
      <MediaHero />

      {/* Stats */}
      <StatsStrip />

      {/* Video Gallery */}
      <VideoGallery />

      {/* Divider */}
      <SectionDivider
        title={t(lang, "media.divider.visualStories")}
        subtitle={t(lang, "media.divider.photography")}
      />

      {/* Photo Gallery */}
      <PhotoGallery />
    </div>
  );
}
