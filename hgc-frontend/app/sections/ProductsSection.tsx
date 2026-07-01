"use client";

import { useState, useEffect } from "react";
import Link from "next/link";
import {
  Package,
  CheckCircle2,
  ArrowRight,
  Pickaxe,
  Wrench,
  Road,
  Sun,
  Hammer,
  Container,
  Loader2,
} from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

const iconMap: Record<string, React.ElementType> = {
  Pickaxe,
  Wrench,
  Road,
  Sun,
  Hammer,
  Container,
};

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
  } | null;
  company: {
    slug: string;
    name: string;
    accent_color: string;
  } | null;
  origin: string | null;
  grade: string | null;
  specifications: Array<{ label: string; value: string }> | null;
  price_range: string | null;
  currency: string;
  unit: string | null;
  availability_label: string;
  hero_image_url: string | null;
  thumbnail_url: string | null;
  is_featured: boolean;
}

export default function ProductsSection() {
  const { lang } = useI18n();
  const [products, setProducts] = useState<Product[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchProducts = async () => {
      try {
        const apiUrl = `${process.env.NEXT_PUBLIC_API_URL}/api/products/featured?lang=${lang}`;
        console.log("Fetching products from:", apiUrl); // DEBUG
        
        const res = await fetch(apiUrl, {
          headers: { Accept: "application/json" },
        });

        console.log("Response status:", res.status); // DEBUG

        if (!res.ok) {
          const text = await res.text();
          console.error("Error response:", text.substring(0, 200)); // DEBUG
          throw new Error(`HTTP ${res.status}: ${text.substring(0, 100)}`);
        }

        const contentType = res.headers.get("content-type");
        if (!contentType?.includes("application/json")) {
          const text = await res.text();
          throw new Error(`Expected JSON, got: ${text.substring(0, 100)}`);
        }

        const json = await res.json();
        console.log("API response:", json); // DEBUG

        if (json.success) {
          setProducts(json.data);
        } else {
          console.error("API returned success=false:", json.message);
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
      <section className="py-24 bg-[#0A1628] relative overflow-hidden">
        <div className="max-w-7xl mx-auto px-4 flex items-center justify-center min-h-[400px]">
          <Loader2 className="w-10 h-10 text-[#C9A227] animate-spin" />
        </div>
      </section>
    );
  }

  return (
    <section className="py-24 bg-[#0A1628] relative overflow-hidden">
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_#C9A227/5_0%,_transparent_50%)]" />
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div className="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-16">
          <div>
            <span className="inline-block px-4 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-4">
              <Package className="w-4 h-4 inline mr-2" />
              {lang === "en"
                ? "Products & Services"
                : lang === "dari"
                ? "محصولات و خدمات"
                : "محصولات او خدمات"}
            </span>
            <h2 className="text-4xl lg:text-5xl font-bold text-white mb-4">
              {lang === "en" ? (
                <>
                  Featured <span className="text-[#C9A227]">Products</span>
                </>
              ) : lang === "dari" ? (
                <>
                  محصولات <span className="text-[#C9A227]">برجسته</span>
                </>
              ) : (
                <>
                  ټاکل شوي <span className="text-[#C9A227]">محصولات</span>
                </>
              )}
            </h2>
            <p className="text-white/50 max-w-xl">
              {lang === "en"
                ? "High-quality construction materials, energy solutions, and logistics services from our own production facilities."
                : lang === "dari"
                ? "مواد ساختمانی با کیفیت بالا، راه حل های انرژی و خدمات لوژستیک از تاسیسات تولیدی خود ما."
                : "د لوړ کیفیت جوړونې مواد، د انرژي حلونه، او د لوجستیکي خدماتو زموږ د خپلو تولیدي تاسیساتو څخه."}
            </p>
          </div>
          <Link
            href="/products"
            className="mt-4 lg:mt-0 inline-flex items-center gap-2 text-[#C9A227] font-semibold hover:gap-3 transition-all"
          >
            {lang === "en"
              ? "View All Products"
              : lang === "dari"
              ? "مشاهده همه محصولات"
              : "ټول محصولات وګورئ"}
            <ArrowRight className="w-5 h-5" />
          </Link>
        </div>

        {products.length === 0 ? (
          <div className="text-center text-white/40 py-12">
            {lang === "en"
              ? "No products found."
              : lang === "dari"
              ? "هیچ محصولی یافت نشد."
              : "هیڅ محصول ونه موندل شو."}
          </div>
        ) : (
          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {products.map((product) => {
              const CategoryIcon = product.category?.icon_name
                ? iconMap[product.category.icon_name] || Package
                : Package;
              const accentColor = product.company?.accent_color || "#C9A227";

              return (
                <Link
                  key={product.slug}
                  href={`/products/${product.slug}`}
                  className="group relative bg-white/[0.02] border border-white/5 rounded-2xl overflow-hidden hover:border-[#C9A227]/20 transition-all duration-500"
                >
                  <div className="aspect-[16/10] relative overflow-hidden bg-[#0A1628]">
                    <div
                      className="absolute inset-0 flex items-center justify-center"
                      style={{ backgroundColor: `${accentColor}08` }}
                    >
                      <CategoryIcon
                        className="w-16 h-16"
                        style={{ color: `${accentColor}25` }}
                      />
                    </div>
                    <div className="absolute inset-0 bg-[#0A1628]/40 group-hover:bg-[#0A1628]/20 transition-colors" />
                    <div className="absolute top-4 left-4">
                      <span
                        className="px-3 py-1 rounded-full text-xs font-medium border"
                        style={{
                          backgroundColor: `${accentColor}15`,
                          color: accentColor,
                          borderColor: `${accentColor}30`,
                        }}
                      >
                        {product.category?.name || ""}
                      </span>
                    </div>
                    <div className="absolute top-4 right-4">
                      <span className="px-3 py-1 rounded-full bg-[#0A1628]/80 text-white/60 text-xs font-medium border border-white/10">
                        {product.availability_label}
                      </span>
                    </div>
                  </div>
                  <div className="p-6">
                    <h3 className="text-white font-bold text-xl mb-2 group-hover:text-[#C9A227] transition-colors">
                      {product.name}
                    </h3>
                    {product.tagline && (
                      <p
                        className="text-sm mb-3"
                        style={{ color: `${accentColor}aa` }}
                      >
                        {product.tagline}
                      </p>
                    )}
                    <p className="text-white/50 text-sm leading-relaxed mb-4 line-clamp-2">
                      {product.description || ""}
                    </p>

                    {product.specifications && product.specifications.length > 0 && (
                      <ul className="space-y-2">
                        {product.specifications.slice(0, 3).map((spec, i) => (
                          <li
                            key={i}
                            className="flex items-center gap-2 text-white/40 text-xs"
                          >
                            <CheckCircle2
                              className="w-3.5 h-3.5 shrink-0"
                              style={{ color: `${accentColor}80` }}
                            />
                            <span className="truncate">
                              <span className="text-white/60">{spec.label}:</span>{" "}
                              {spec.value}
                            </span>
                          </li>
                        ))}
                      </ul>
                    )}

                    {product.price_range && (
                      <div className="mt-4 pt-4 border-t border-white/5 flex items-center justify-between">
                        <span className="text-white/40 text-xs">
                          {lang === "en"
                            ? "Price Range"
                            : lang === "dari"
                            ? "محدوده قیمت"
                            : "د قیمت حد"}
                        </span>
                        <span className="text-[#C9A227] font-bold text-sm">
                          {product.price_range} {product.currency}
                          {product.unit ? ` / ${product.unit}` : ""}
                        </span>
                      </div>
                    )}
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