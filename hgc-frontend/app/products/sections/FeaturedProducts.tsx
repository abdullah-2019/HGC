"use client";

import React, { useState, useEffect } from "react";
import { motion } from "framer-motion";
import { ArrowRight, Check, Loader2 } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import { getFeaturedProducts, type ProductListItem } from "@/lib/api";
import ScrollReveal from "@/components/ScrollReveal";

export default function FeaturedProducts() {
  const { lang, dir } = useI18n();
  const [products, setProducts] = useState<ProductListItem[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    getFeaturedProducts(lang)
      .then((res) => {
        if (res.success) setProducts(res.data);
      })
      .finally(() => setLoading(false));
  }, [lang]);

  const getAvailabilityColor = (status: string) => {
    switch (status) {
      case "in_stock": return "text-green-400";
      case "limited": return "text-yellow-400";
      case "pre_order": return "text-blue-400";
      default: return "text-red-400";
    }
  };

  if (loading) {
    return (
      <section className="py-24 relative border-y border-white/5 bg-[#0A1628]/80">
        <div className="max-w-7xl mx-auto px-4 flex justify-center">
          <Loader2 className="w-8 h-8 text-[#C9A227] animate-spin" />
        </div>
      </section>
    );
  }

  if (products.length === 0) return null;

  return (
    <section className="py-24 relative border-y border-white/5 bg-[#0A1628]/80">
      <div className="absolute inset-0 bg-[#C9A227]/[0.02]" />
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <ScrollReveal>
          <div className="text-center mb-16">
            <span className="text-[#C9A227] text-sm font-semibold uppercase tracking-[0.2em] mb-3 block">
              {t(lang, "products.featured.subtitle")}
            </span>
            <h2 className="text-3xl lg:text-5xl font-bold text-white mb-4">
              {t(lang, "products.featured.title")}
            </h2>
          </div>
        </ScrollReveal>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {products.map((product, idx) => (
            <ScrollReveal key={product.id} delay={idx * 0.1}>
              <motion.div
                whileHover={{ y: -5 }}
                className="group relative bg-white/[0.02] border border-white/5 rounded-2xl overflow-hidden hover:border-[#C9A227]/20 transition-all duration-500"
              >
                <div className="relative h-48 overflow-hidden">
                  <div
                    className="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
                    style={{
                      backgroundImage: `url(${product.primary_image?.url || product.thumbnail_url || "/placeholder.jpg"})`,
                    }}
                  />
                  <div className="absolute inset-0 bg-[#0A1628]/30 group-hover:bg-[#0A1628]/10 transition-colors duration-500" />
                  <div className="absolute top-3 left-3">
                    <span className={`text-xs font-medium px-3 py-1 rounded-full bg-[#0A1628]/60 backdrop-blur-sm ${getAvailabilityColor(product.availability)}`}>
                      {product.availability_label}
                    </span>
                  </div>
                  <div className="absolute inset-0 bg-[#0A1628]/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <a
                      href={`/products/${product.slug}`}
                      className="px-5 py-2.5 bg-[#C9A227] text-[#0A1628] font-semibold rounded-xl text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 flex items-center gap-2"
                    >
                      {t(lang, "products.viewDetails")}
                      <ArrowRight className="w-4 h-4" />
                    </a>
                  </div>
                </div>

                <div className="p-5 space-y-3">
                  <div className="flex items-center justify-between">
                    <span className="text-xs text-[#C9A227]/60 font-medium uppercase tracking-wider">
                      {product.category?.name}
                    </span>
                    {product.company && (
                      <span
                        className="text-xs px-2 py-1 rounded-md"
                        style={{
                          backgroundColor: product.company.accent_color ? `${product.company.accent_color}20` : undefined,
                          color: product.company.accent_color || undefined,
                        }}
                      >
                        {product.company.name}
                      </span>
                    )}
                  </div>

                  <h3 className="text-white font-semibold text-lg group-hover:text-[#C9A227] transition-colors duration-300">
                    {product.name}
                  </h3>

                  <p className="text-white/40 text-sm leading-relaxed line-clamp-2">
                    {product.tagline}
                  </p>

                  {product.specifications && product.specifications.length > 0 && (
                    <div className="space-y-1.5 pt-2">
                      {product.specifications.slice(0, 2).map((spec, sIdx) => (
                        <div key={sIdx} className="flex items-center gap-2 text-white/30 text-xs">
                          <Check className="w-3 h-3 text-[#C9A227]/60 flex-shrink-0" />
                          <span>{spec.label}: {spec.value}</span>
                        </div>
                      ))}
                    </div>
                  )}

                  {product.price_range && (
                    <div className="pt-3 border-t border-white/5">
                      <span className="text-[#C9A227] font-bold text-sm">
                        {product.price_range} {product.currency}
                      </span>
                      <span className="text-white/30 text-xs ml-1">/ {product.unit}</span>
                    </div>
                  )}
                </div>
              </motion.div>
            </ScrollReveal>
          ))}
        </div>
      </div>
    </section>
  );
}