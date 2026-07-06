"use client";

import React, { useState, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";
import {
  ChevronRight,
  ArrowRight,
  Check,
  Loader2,
  Boxes,
  // Import the dynamic loader
  type LucideIcon,
} from "lucide-react";
import * as Icons from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import { getCategories, getProducts, type CategoryItem, type ProductListItem } from "@/lib/api";
import ScrollReveal from "@/components/ScrollReveal";

// Dynamic icon resolver — no hardcoded names needed
function getIcon(iconName: string | null | undefined): LucideIcon {
  if (!iconName) return Boxes;
  // lucide-react exports all icons as named exports
  const Icon = (Icons as Record<string, LucideIcon>)[iconName];
  return Icon || Boxes;
}

interface CategoryWithProducts extends CategoryItem {
  products: ProductListItem[];
}

export default function ProductCategories() {
  const { lang, dir } = useI18n();
  const [categories, setCategories] = useState<CategoryWithProducts[]>([]);
  const [activeCategory, setActiveCategory] = useState(0);
  const [loading, setLoading] = useState(true);

  const isRTL = dir === "rtl";

  useEffect(() => {
    const fetchData = async () => {
      try {
        const catRes = await getCategories(lang, "product");
        if (!catRes.success) return;

        const catsWithProducts = await Promise.all(
          catRes.data.map(async (cat) => {
            const prodRes = await getProducts(lang, { category: cat.slug });
            return {
              ...cat,
              products: prodRes.success ? prodRes.data : [],
            };
          })
        );

        setCategories(catsWithProducts);
      } catch (error) {
        console.error("Failed to fetch categories:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [lang]);

  if (loading) {
    return (
      <section id="categories" className="py-24 relative" dir={dir}>
        <div className="max-w-7xl mx-auto px-4 flex justify-center">
          <Loader2 className="w-8 h-8 text-[#C9A227] animate-spin" />
        </div>
      </section>
    );
  }

  if (categories.length === 0) return null;

  const activeCat = categories[activeCategory];
  const CatIcon = getIcon(activeCat?.icon_name);

  return (
    <section id="categories" className="py-24 relative" dir={dir}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <ScrollReveal>
          <div className="text-center mb-16">
            <span className="text-[#C9A227] text-sm font-semibold uppercase tracking-[0.2em] mb-3 block">
              {t(lang, "products.categories.sectionSubtitle")}
            </span>
            <h2 className="text-3xl lg:text-5xl font-bold text-white mb-4">
              {t(lang, "products.categories.sectionTitle")}
            </h2>
            <p className="text-white/40 max-w-2xl mx-auto text-lg">
              {t(lang, "products.categories.sectionDesc")}
            </p>
          </div>
        </ScrollReveal>

        <ScrollReveal delay={0.1}>
          <div className="flex items-center gap-2 overflow-x-auto pb-4 mb-12 scrollbar-hide">
            {categories.map((cat, idx) => {
              const Icon = getIcon(cat.icon_name);
              const isActive = idx === activeCategory;
              return (
                <button
                  key={cat.id}
                  id={`category-${cat.slug}`}
                  onClick={() => setActiveCategory(idx)}
                  className={`flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-medium whitespace-nowrap transition-all duration-300 ${
                    isActive
                      ? "text-white shadow-lg"
                      : "bg-white/5 text-white/50 hover:bg-white/10 hover:text-white border border-white/5"
                  }`}
                  style={
                    isActive
                      ? {
                          backgroundColor: "#C9A22720",
                          border: "1px solid #C9A22740",
                          color: "#C9A227",
                        }
                      : {}
                  }
                >
                  <Icon className="w-4 h-4" />
                  <span>{cat.name}</span>
                </button>
              );
            })}
          </div>
        </ScrollReveal>

        <AnimatePresence mode="wait">
          <motion.div
            key={activeCat?.id}
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            exit={{ opacity: 0, y: -20 }}
            transition={{ duration: 0.4 }}
          >
            <div className="relative rounded-3xl overflow-hidden mb-12">
              <div
                className="h-64 sm:h-80 bg-cover bg-center"
                style={{ backgroundImage: `url(${activeCat?.image_url})` }}
              />
              <div className="absolute inset-0 bg-[#0A1628]/60" />
              <div className="absolute inset-0 flex items-center">
                <div className="max-w-3xl px-8 sm:px-12">
                  <div className="w-14 h-14 rounded-2xl flex items-center justify-center mb-4 bg-[#C9A227]20">
                    <CatIcon className="w-7 h-7 text-[#C9A227]" />
                  </div>
                  <h3 className="text-2xl sm:text-3xl font-bold text-white mb-3">
                    {activeCat?.name}
                  </h3>
                  <p className="text-white/60 text-sm sm:text-base leading-relaxed max-w-xl">
                    {activeCat?.description}
                  </p>
                </div>
              </div>
            </div>

            {activeCat?.products && activeCat.products.length > 0 ? (
              <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {activeCat.products.map((product, idx) => (
                  <motion.div
                    key={product.id}
                    initial={{ opacity: 0, y: 30 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.4, delay: idx * 0.1 }}
                    className="group relative bg-white/[0.02] border border-white/5 rounded-2xl overflow-hidden hover:border-white/10 transition-all duration-500"
                  >
                    <div className="relative h-48 overflow-hidden">
                      <div
                        className="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
                        style={{
                          backgroundImage: `url(${product.primary_image?.url || product.thumbnail_url || "/placeholder.jpg"})`,
                        }}
                      />
                      <div className="absolute inset-0 bg-[#0A1628]/30 group-hover:bg-[#0A1628]/10 transition-colors duration-500" />
                      <div
                        className={`absolute top-3 ${isRTL ? "left-3" : "right-3"} w-9 h-9 rounded-lg flex items-center justify-center backdrop-blur-sm bg-[#C9A227]25`}
                      >
                        <CatIcon className="w-4 h-4 text-[#C9A227]" />
                      </div>
                      <div className="absolute inset-0 bg-[#0A1628]/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <a
                          href={`/products/${product.slug}`}
                          className="px-5 py-2.5 bg-[#C9A227] text-[#0A1628] font-semibold rounded-xl text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 flex items-center gap-2"
                        >
                          {t(lang, "products.categories.viewDetails")}
                          <ArrowRight className="w-4 h-4" />
                        </a>
                      </div>
                    </div>

                    <div className="p-5 space-y-3">
                      <h4 className="text-white font-semibold text-base group-hover:text-[#C9A227] transition-colors duration-300">
                        {product.name}
                      </h4>
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
                        <div className="pt-2">
                          <span className="text-[#C9A227] font-bold text-sm">
                            {product.price_range} {product.currency}
                          </span>
                          <span className="text-white/30 text-xs ml-1">/ {product.unit}</span>
                        </div>
                      )}
                    </div>
                  </motion.div>
                ))}
              </div>
            ) : (
              <div className="text-center py-12">
                <p className="text-white/40">{t(lang, "products.categories.noProducts")}</p>
              </div>
            )}

            <div className="mt-10 text-center">
              <a
                href={`/products?category=${activeCat?.slug}`}
                className="inline-flex items-center gap-2 text-[#C9A227] font-medium hover:underline transition-all"
              >
                {t(lang, "products.categories.viewAll")} {activeCat?.name}
                <ChevronRight className="w-4 h-4" />
              </a>
            </div>
          </motion.div>
        </AnimatePresence>
      </div>
    </section>
  );
}