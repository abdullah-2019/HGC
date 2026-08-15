"use client";

import { useState, useEffect } from "react";
import { useI18n } from "@/components/useI18nStore";

// Dynamic icon loader for Lucide icons
import * as LucideIcons from "lucide-react";
import type { LucideIcon } from "lucide-react";

interface WhyChooseFeature {
  id: number;
  icon: string;
  titleEn: string;
  titleDari: string | null;
  titlePashto: string | null;
  descEn: string;
  descDari: string | null;
  descPashto: string | null;
}

const API_BASE = process.env.NEXT_PUBLIC_API_URL || "https://api.hgc.af";

// Safe icon resolver — falls back to Award if icon not found
function resolveIcon(iconName: string): LucideIcon {
  const Icon = (LucideIcons as Record<string, unknown>)[iconName];
  return (Icon as LucideIcon) || LucideIcons.Award;
}

export default function WhyChooseSection() {
  const { lang } = useI18n();
  const isRtl = lang === "dari" || lang === "pashto";
  const [features, setFeatures] = useState<WhyChooseFeature[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchFeatures = async () => {
      try {
        setLoading(true);
        const res = await fetch(`${API_BASE}/api/why-choose`, {
          headers: { Accept: "application/json" },
        });
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const json = await res.json();
        if (json.success) {
          setFeatures(json.data);
        } else {
          throw new Error(json.message || "Failed to load features");
        }
      } catch (err) {
        setError(err instanceof Error ? err.message : "Unknown error");
      } finally {
        setLoading(false);
      }
    };

    fetchFeatures();
  }, []);

  // Localized text helpers
  const getTitle = (f: WhyChooseFeature) => {
    if (lang === "dari") return f.titleDari || f.titleEn;
    if (lang === "pashto") return f.titlePashto || f.titleEn;
    return f.titleEn;
  };

  const getDesc = (f: WhyChooseFeature) => {
    if (lang === "dari") return f.descDari || f.descEn;
    if (lang === "pashto") return f.descPashto || f.descEn;
    return f.descEn;
  };

  const sectionLabel =
    lang === "en" ? "Why Us" : lang === "dari" ? "چرا ما" : "ولې موږ";

  const sectionTitle =
    lang === "en" ? (
      <>
        Why Choose <span className="text-hgc-gold">HGC</span>
      </>
    ) : lang === "dari" ? (
      <>
        چرا <span className="text-hgc-gold">گروپ حافظ</span> را انتخاب کنیم
      </>
    ) : (
      <>
        ولې <span className="text-hgc-gold">حافظ ګروپ</span> غوره کړئ
      </>
    );

  // Loading skeleton
  if (loading) {
    return (
      <section className="py-24 bg-hgc-bg relative overflow-hidden">
        <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom,_var(--color-hgc-gold)/5_0%,_transparent_50%)]" />
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
          <div className="text-center mb-16 animate-pulse">
            <div className="h-4 w-20 bg-hgc-border rounded-full mx-auto mb-4" />
            <div className="h-12 w-72 bg-hgc-border rounded-lg mx-auto" />
          </div>
          <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6 justify-items-center">
            {[1, 2, 3, 4].map((i) => (
              <div
                key={i}
                className="bg-hgc-card-alt border border-hgc-border rounded-2xl p-8 w-full max-w-sm"
              >
                <div className="w-16 h-16 rounded-2xl bg-hgc-border mb-6" />
                <div className="h-6 w-40 bg-hgc-border rounded mb-3" />
                <div className="h-4 w-full bg-hgc-border rounded" />
              </div>
            ))}
          </div>
        </div>
      </section>
    );
  }

  // Error state
  if (error) {
    return (
      <section className="py-24 bg-hgc-bg relative overflow-hidden">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <p className="text-red-400 mb-2">Failed to load features</p>
          <p className="text-hgc-text-muted text-sm">{error}</p>
        </div>
      </section>
    );
  }

  return (
    <section dir={isRtl ? "rtl" : "ltr"} className="py-24 bg-hgc-bg relative overflow-hidden">
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom,_var(--color-hgc-gold)/5_0%,_transparent_50%)]" />
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        {/* Header */}
        <div className="text-center mb-16">
          <span className="inline-block px-4 py-1 rounded-full bg-hgc-gold/10 text-hgc-gold text-sm font-medium mb-4">
            {sectionLabel}
          </span>
          <h2 className="text-4xl lg:text-5xl font-bold text-hgc-text mb-4">
            {sectionTitle}
          </h2>
        </div>

        {/* Features Grid — cards centered on page, content left-aligned inside */}
        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6 justify-items-center">
          {features.map((feature) => {
            const Icon = resolveIcon(feature.icon);
            return (
              <div
                key={feature.id}
                className="group relative bg-hgc-card-alt border border-hgc-border rounded-2xl p-8 hover:bg-hgc-card-hover hover:border-hgc-gold/20 transition-all duration-500 w-full max-w-sm"
              >
                <div className="w-16 h-16 rounded-2xl bg-hgc-gold/10 flex items-center justify-center mb-6 group-hover:bg-hgc-gold/20 group-hover:scale-110 transition-all duration-500">
                  <Icon className="w-8 h-8 text-hgc-gold" />
                </div>
                <h3 className="text-hgc-text font-bold text-xl mb-3">
                  {getTitle(feature)}
                </h3>
                <p className="text-hgc-about-text-secondary text-sm leading-relaxed">
                  {getDesc(feature)}
                </p>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}