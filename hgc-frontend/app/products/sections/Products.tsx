"use client";

import React, { useState, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";
import {
  ArrowRight,
  Loader2,
  Boxes,
} from "lucide-react";
import type { LucideProps } from "lucide-react";
import * as Icons from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import { getCategories, getProducts, type CategoryItem, type ProductListItem } from "@/lib/api";
import ScrollReveal from "@/components/ScrollReveal";

type LucideIcon = React.ComponentType<LucideProps>;

function getIcon(iconName: string | null | undefined): LucideIcon {
  if (!iconName) return Boxes;
  const Icon = (Icons as unknown as Record<string, LucideIcon>)[iconName];
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
    let cancelled = false;

    const fetchData = async () => {
      setLoading(true);
      try {
        const [catRes, prodRes] = await Promise.all([
          getCategories(lang, "product"),
          getProducts(lang),
        ]);

        if (!catRes.success || !prodRes.success) {
          if (!cancelled) setCategories([]);
          return;
        }

        const allProducts = prodRes.data;

        const catsWithProducts = catRes.data
          .map((cat) => ({
            ...cat,
            products: allProducts.filter((p) => {
              if (p.category?.slug === cat.slug) return true;
              if (p.category_slugs?.includes(cat.slug)) return true;
              return false;
            }),
          }))
          .filter((cat) => cat.products.length > 0);

        if (!cancelled) {
          setCategories(catsWithProducts);
          setActiveCategory(0);
        }
      } catch (error) {
        console.error("Failed to fetch categories/products:", error);
        if (!cancelled) setCategories([]);
      } finally {
        if (!cancelled) setLoading(false);
      }
    };

    fetchData();
    return () => {
      cancelled = true;
    };
  }, [lang]);

  if (loading) {
    return (
      <section id="categories" className="py-24 relative bg-hgc-bg-alt" dir={dir}>
        <div className="max-w-7xl mx-auto px-4 flex justify-center">
          <Loader2 className="w-8 h-8 text-hgc-gold animate-spin" />
        </div>
      </section>
    );
  }

  if (categories.length === 0) {
    return (
      <section id="categories" className="py-24 relative bg-hgc-bg-alt" dir={dir}>
        <div className="max-w-7xl mx-auto px-4 text-center">
          <Boxes className="w-12 h-12 text-hgc-text-muted mx-auto mb-4" />
          <p className="text-hgc-text-secondary text-lg font-medium">
            {t(lang, "products.categories.noProducts")}
          </p>
        </div>
      </section>
    );
  }

  const activeCat = categories[activeCategory];
  const CatIcon = getIcon(activeCat?.icon_name);

  return (
    <section id="categories" className="py-24 relative bg-hgc-bg-alt" dir={dir}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <ScrollReveal>
          <div className="text-center mb-16">
            <span className="text-hgc-gold text-sm font-semibold uppercase tracking-[0.2em] mb-3 block">
              {t(lang, "products.categories.sectionSubtitle")}
            </span>
            <p className="text-hgc-text-muted max-w-2xl mx-auto text-lg">
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
                  onClick={() => setActiveCategory(idx)}
                  className={`flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-medium whitespace-nowrap transition-all duration-300 ${
                    isActive
                      ? "bg-hgc-gold/15 text-hgc-gold border border-hgc-gold/30 shadow-lg"
                      : "bg-hgc-surface-elevated text-hgc-text-secondary hover:bg-hgc-card-hover hover:text-hgc-text border border-hgc-border"
                  }`}
                >
                  <Icon className="w-4 h-4" />
                  <span>{cat.name}</span>
                  <span className="text-xs opacity-60 ml-1">
                    ({cat.products.length})
                  </span>
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
              <div className="absolute inset-0 bg-white/40" />
              <div className="absolute inset-0 flex items-center">
                <div className="max-w-3xl px-8 sm:px-12">
                  <div className="w-14 h-14 rounded-2xl flex items-center justify-center mb-4 bg-hgc-gold/20">
                    <CatIcon className="w-7 h-7 text-hgc-gold" />
                  </div>
                  <h3 className="text-2xl sm:text-3xl font-bold text-hgc-text mb-3">
                    {activeCat?.name}
                  </h3>
                  <p className="text-hgc-text-secondary text-sm sm:text-base leading-relaxed max-w-xl">
                    {activeCat?.description}
                  </p>
                </div>
              </div>
            </div>

            {activeCat.products.length > 0 ? (
              <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {activeCat.products.map((product, idx) => (
                  <motion.div
                    key={product.id}
                    initial={{ opacity: 0, y: 30 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.4, delay: idx * 0.1 }}
                    className="group relative bg-hgc-card border border-hgc-border rounded-2xl overflow-hidden hover:border-hgc-gold/30 transition-all duration-500 shadow-sm hover:shadow-md"
                  >
                    <div className="relative h-48 overflow-hidden">
                      <div
                        className="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
                        style={{
                          backgroundImage: `url(${
                            product.primary_image?.url ||
                            product.thumbnail_url ||
                            "/placeholder.jpg"
                          })`,
                        }}
                      />
                      <div className="absolute inset-0 bg-hgc-navy/10 group-hover:bg-hgc-navy/5 transition-colors duration-500" />
                      <div
                        className={`absolute top-3 ${
                          isRTL ? "left-3" : "right-3"
                        } w-9 h-9 rounded-lg flex items-center justify-center backdrop-blur-sm bg-hgc-gold/20`}
                      >
                        <CatIcon className="w-4 h-4 text-hgc-gold" />
                      </div>
                      <div className="absolute inset-0 bg-hgc-navy/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <a
                          href={`/products/${product.slug}`}
                          className="px-5 py-2.5 bg-hgc-gold text-hgc-navy font-semibold rounded-xl text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 flex items-center gap-2"
                        >
                          {t(lang, "products.categories.viewDetails")}
                          <ArrowRight
                            className={`w-4 h-4 ${isRTL ? "rotate-180" : ""}`}
                          />
                        </a>
                      </div>
                    </div>

                    <div className="p-5 space-y-3">
                      <h4 className="text-hgc-text font-semibold text-base group-hover:text-hgc-gold transition-colors duration-300">
                        {product.name}
                      </h4>
                      <p className="text-hgc-text-muted text-sm leading-relaxed line-clamp-2">
                        {product.tagline || product.description}
                      </p>
                      {product.availability_label && (
                        <span className="inline-block text-xs px-2 py-1 rounded-md bg-hgc-gold/10 text-hgc-gold border border-hgc-gold/20">
                          {product.availability_label}
                        </span>
                      )}
                    </div>
                  </motion.div>
                ))}
              </div>
            ) : (
              <div className="text-center py-16 bg-hgc-surface-elevated rounded-2xl border border-hgc-border">
                <Boxes className="w-12 h-12 text-hgc-text-muted mx-auto mb-4" />
                <p className="text-hgc-text-secondary text-lg font-medium">
                  {t(lang, "products.categories.noProducts")}
                </p>
              </div>
            )}
          </motion.div>
        </AnimatePresence>
      </div>
    </section>
  );
}