"use client";

import { useState, useEffect } from "react";
import Link from "next/link";
import Image from "next/image";
import {
  Package,
  CheckCircle2,
  ArrowRight,
  Loader2,
  ExternalLink,
} from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

interface Product {
  id: number;
  slug: string;
  name: string;
  tagline: string | null;
  description: string | null;
  category: {
    slug: string;
    name: string;
    icon_name: string;
    image_url: string | null;
  } | null;
  company: {
    slug: string;
    name: string;
    accent_color: string;
  } | null;
  origin: string | null;
  grade: string | null;
  specifications: Array<{ label: string; value: string }> | null;
  currency: string;
  unit: string | null;
  availability_label: string;
  hero_image_url: string | null;
  thumbnail_url: string | null;
  is_featured: boolean;
}

// Strip HTML tags for plain text preview
function stripHtml(html: string | null): string {
  if (!html) return "";
  return html.replace(/<[^>]*>/g, "").replace(/\s+/g, " ").trim();
}

export default function ProductsSection() {
  const { lang } = useI18n();
  const [products, setProducts] = useState<Product[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchProducts = async () => {
      try {
        const apiUrl = `${process.env.NEXT_PUBLIC_API_URL}/api/products/featured?lang=${lang}`;

        const res = await fetch(apiUrl, {
          headers: { Accept: "application/json" },
          cache: "no-store",
        });

        if (!res.ok) {
          const text = await res.text();
          console.error("Products API error:", text.substring(0, 200));
          throw new Error(`HTTP ${res.status}`);
        }

        const json = await res.json();

        if (json.success) {
          setProducts(json.data);
        }
      } catch (err) {
        console.error("Products fetch error:", err);
      } finally {
        setLoading(false);
      }
    };

    fetchProducts();
  }, [lang]);

  if (loading) {
    return (
      <section className="py-24 bg-hgc-bg relative overflow-hidden">
        <div className="max-w-7xl mx-auto px-4 flex items-center justify-center min-h-[400px]">
          <Loader2 className="w-10 h-10 text-hgc-gold animate-spin" />
        </div>
      </section>
    );
  }

  return (
    <section className="py-24 bg-hgc-bg relative overflow-hidden">
      {/* Subtle background glow */}
      <div className="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-hgc-gold/[0.03] rounded-full blur-[120px]" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        {/* Section Header */}
        <div className="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-14">
          <div className="max-w-2xl">
            <span className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-hgc-gold/10 border border-hgc-gold/20 text-hgc-gold text-sm font-medium mb-5">
              <Package className="w-4 h-4" />
              {lang === "en"
                ? "Products & Services"
                : lang === "dari"
                ? "محصولات و خدمات"
                : "محصولات او خدمات"}
            </span>
            <h2 className="text-4xl lg:text-5xl font-bold text-hgc-text mb-4 tracking-tight">
              {lang === "en" ? (
                <>
                  Featured{" "}
                  <span className="text-hgc-gold">Products</span>
                </>
              ) : lang === "dari" ? (
                <>
                  محصولات{" "}
                  <span className="text-hgc-gold">برجسته</span>
                </>
              ) : (
                <>
                  ټاکل شوي{" "}
                  <span className="text-hgc-gold">محصولات</span>
                </>
              )}
            </h2>
            <p className="text-hgc-text-secondary text-lg leading-relaxed">
              {lang === "en"
                ? "High-quality construction materials, energy solutions, and logistics services from our own production facilities."
                : lang === "dari"
                ? "مواد ساختمانی با کیفیت بالا، راه حل های انرژی و خدمات لوژستیک از تاسیسات تولیدی خود ما."
                : "د لوړ کیفیت جوړونې مواد، د انرژي حلونه، او د لوجستیکي خدماتو زموږ د خپلو تولیدي تاسیساتو څخه."}
            </p>
          </div>
          <Link
            href="/products"
            className="group mt-6 lg:mt-0 inline-flex items-center gap-2 text-hgc-gold font-semibold hover:gap-3 transition-all"
          >
            {lang === "en"
              ? "View All Products"
              : lang === "dari"
              ? "مشاهده همه محصولات"
              : "ټول محصولات وګورئ"}
            <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
          </Link>
        </div>

        {/* Products Grid */}
        {products.length === 0 ? (
          <div className="text-center text-hgc-text-muted py-16">
            {lang === "en"
              ? "No products found."
              : lang === "dari"
              ? "هیچ محصولی یافت نشد."
              : "هیڅ محصول ونه موندل شو."}
          </div>
        ) : (
          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {products.map((product) => {
              const accentColor = product.company?.accent_color || "#D4AF37";

              const imageUrl =
                product.hero_image_url ||
                product.thumbnail_url ||
                product.category?.image_url ||
                "/images/placeholder.png";

              const plainDescription = stripHtml(product.description);
              const plainTagline = stripHtml(product.tagline);

              return (
                <Link
                  key={product.slug}
                  href={`/products/${product.slug}`}
                  className="group relative bg-hgc-card border border-hgc-border rounded-2xl overflow-hidden hover:border-hgc-gold/30 hover:bg-hgc-card-hover hover:shadow-lg hover:shadow-hgc-overlay/5 transition-all duration-500"
                >
                  {/* Image Area */}
                  <div className="aspect-[16/10] relative overflow-hidden">
                    <Image
                      src={imageUrl}
                      alt={product.name}
                      fill
                      className="object-cover transition-transform duration-700 group-hover:scale-105"
                      sizes="(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 33vw"
                    />
                    {/* Soft gradient overlay */}
                    <div className="absolute inset-0 bg-gradient-to-t from-hgc-overlay/40 via-transparent to-transparent" />

                    {/* Top badges */}
                    <div className="absolute top-4 left-4 right-4 flex items-start justify-between">
                      <span className="px-3 py-1.5 rounded-lg bg-hgc-surface/80 backdrop-blur-md text-hgc-text/80 text-xs font-medium border border-hgc-border">
                        {product.category?.name || "Product"}
                      </span>
                      <span
                        className="px-3 py-1.5 rounded-lg text-xs font-medium backdrop-blur-md"
                        style={{
                          backgroundColor: `${accentColor}18`,
                          color: accentColor,
                          border: `1px solid ${accentColor}30`,
                        }}
                      >
                        {product.availability_label}
                      </span>
                    </div>
                  </div>

                  {/* Content */}
                  <div className="p-6">
                    {/* Product name */}
                    <h3 className="text-hgc-text font-bold text-lg mb-2 group-hover:text-hgc-gold transition-colors duration-300">
                      {product.name}
                    </h3>

                    {/* Tagline */}
                    {plainTagline && (
                      <p className="text-hgc-gold/70 text-sm font-medium mb-3">
                        {plainTagline}
                      </p>
                    )}

                    {/* Description */}
                    {plainDescription && (
                      <p className="text-hgc-text-muted text-sm leading-relaxed mb-5 line-clamp-2">
                        {plainDescription}
                      </p>
                    )}

                    {/* Specs */}
                    {product.specifications &&
                      product.specifications.length > 0 && (
                        <div className="space-y-2 mb-5">
                          {product.specifications.slice(0, 3).map((spec, i) => (
                            <div
                              key={i}
                              className="flex items-center gap-2.5 text-sm"
                            >
                              <CheckCircle2 className="w-4 h-4 text-hgc-gold/50 shrink-0" />
                              <span className="text-hgc-text-muted truncate">
                                <span className="text-hgc-text-secondary">
                                  {spec.label}:
                                </span>{" "}
                                {spec.value}
                              </span>
                            </div>
                          ))}
                        </div>
                      )}

                    {/* Footer */}
                    <div className="flex items-center justify-between pt-4 border-t border-hgc-border">
                      <div className="flex items-center gap-3">
                        {product.origin && (
                          <span className="text-hgc-text-muted text-xs">
                            {product.origin}
                          </span>
                        )}
                        {product.grade && (
                          <span className="text-hgc-gold text-xs font-medium px-2 py-0.5 rounded bg-hgc-gold/10">
                            {product.grade}
                          </span>
                        )}
                      </div>
                      <ExternalLink className="w-4 h-4 text-hgc-text-muted group-hover:text-hgc-gold transition-colors" />
                    </div>
                  </div>
                </Link>
              );
            })}
          </div>
        )}
      </div>
    </section>
  );
}